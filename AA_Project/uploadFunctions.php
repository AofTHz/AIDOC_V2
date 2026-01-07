<?php
// uploadFunctions.php
?>
<script>
/***********************
 * File Upload Functions
 ***********************/
function openFileExplorer() {
  document.getElementById("fileInput").click();
}

async function handleFileUpload(event) {
  event.preventDefault();
  document.getElementById("dropzone").classList.remove("dropzone-highlight");

  const files = event.dataTransfer ? event.dataTransfer.files : event.target.files;
  if (!files || files.length === 0) {
    console.error("No files detected.");
    return;
  }

  // Clear previous statuses
  document.getElementById("uploadStatuses").innerHTML = "";
  // Clear active task storage
  sessionStorage.removeItem("activeUploadTasks");

  const formData = new FormData();
  for (let i = 0; i < files.length; i++) {
    formData.append("pdfs", files[i]);
  }

  try {
    const response = await fetch(`${BASE_URL}/sendPDF`, {
      method: "POST",
      body: formData
    });

    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }

    const result = await response.json();
    console.log("Upload response:", result);

    if (result.task_ids && Array.isArray(result.task_ids)) {
      result.task_ids.forEach(taskId => {
        connectUploadStatus(taskId);
      });
    } else {
      throw new Error("No task IDs received from server");
    }
  } catch (error) {
    console.error("Upload error:", error);
    document.getElementById("uploadStatuses").innerHTML =
      `<div class="alert alert-danger" role="alert">Upload Error: ${error.message}</div>`;
  }
}

function highlightDropzone(event) {
  event.preventDefault();
  document.getElementById("dropzone").classList.add("dropzone-highlight");
}

function resetDropzone(event) {
  event.preventDefault();
  document.getElementById("dropzone").classList.remove("dropzone-highlight");
}

/***********************
 * Update Files/Folders
 ***********************/
// Quick fix: update files/folders UI after an upload completes.
// This assumes fetchFolders() and fetchFiles(folderId, folderName)
// are defined (e.g., in folderFunctions.php).
async function updateFilesAndFolders() {
  try {
    // Update folder list
    await fetchFolders();
    // Optionally, if you have a selected folder, update its files
    if (window.selectedFolderId && window.selectedFolderName) {
      await fetchFiles(window.selectedFolderId, window.selectedFolderName);
    }
  } catch (error) {
    console.error("Error updating files and folders:", error);
  }
}

/***********************
 * Upload Status via SSE
 ***********************/
// Create a container element for an upload task
function createUploadStatusElement(taskId) {
  const container = document.createElement("div");
  container.className = "upload-status mb-3 p-3 border rounded";
  container.id = `status-${taskId}`;
  container.innerHTML = `
    <div id="filename-${taskId}" class="font-weight-bold mb-2"></div>
    <div class="progress mb-2">
      <div id="progress-${taskId}" class="progress-bar" role="progressbar" 
           style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
    </div>
    <div id="step-${taskId}" class="text-muted small"></div>
    <div id="error-${taskId}" class="text-danger small"></div>
  `;
  return container;
}

// Connects to the SSE endpoint for a given task and updates its UI.
function connectUploadStatus(taskId) {
  const statusContainer = document.getElementById("uploadStatuses");
  let statusElement = document.getElementById(`status-${taskId}`);

  if (!statusElement) {
    statusElement = createUploadStatusElement(taskId);
    statusContainer.appendChild(statusElement);
  }

  addActiveTask(taskId);
  let reconnectAttempts = 0;
  let eventSource;

  function initEventSource() {
    eventSource = new EventSource(`${BASE_URL}/uploadStream/${taskId}`);

    eventSource.onmessage = (event) => {
      try {
        const data = JSON.parse(event.data);
        console.log(`Task ${taskId}:`, data);

        if (data.error) {
          document.getElementById(`error-${taskId}`).textContent = data.error;
          statusElement.classList.add("border-danger");
          cleanup();
          return;
        }

        if (data.file_name) {
          document.getElementById(`filename-${taskId}`).textContent = data.file_name;
        }

        if (data.progress !== undefined) {
          const pb = document.getElementById(`progress-${taskId}`);
          pb.style.width = `${data.progress}%`;
          pb.setAttribute("aria-valuenow", data.progress);
          pb.textContent = `${data.progress}%`;
        }

        if (data.current_step) {
          document.getElementById(`step-${taskId}`).textContent = data.current_step;
        }

        // When the upload is finished
        if (data.status === "Completed" || data.status === "Failed") {
          statusElement.classList.add(
            data.status === "Completed" ? "border-success" : "border-danger"
          );
          setTimeout(() => checkAndRemove(taskId), 1200);
          cleanup();
          removeActiveTask(taskId);
          // Quick fix: update the files/folders UI after upload finishes.
          updateFilesAndFolders();
        }
      } catch (err) {
        console.error("Error parsing SSE data:", err);
        cleanup();
      }
    };

    eventSource.onerror = () => {
      cleanup();
      reconnectAttempts++;
      if (reconnectAttempts < 5) {
        setTimeout(initEventSource, 2000);
      } else {
        document.getElementById(`error-${taskId}`).textContent = "Unable to reconnect.";
        removeActiveTask(taskId);
      }
    };
  }

  function checkAndRemove(taskId) {
    const statusElement = document.getElementById(`status-${taskId}`);
    if (!statusElement) return;

    const progressBar = statusElement.querySelector(".progress");
    if (progressBar) {
      progressBar.remove();
    }

    // Optionally, remove the whole status element after a longer delay
    setTimeout(() => {
      statusElement.remove();
    }, 5000);
  }

  function cleanup() {
    if (eventSource) {
      eventSource.close();
      console.log(`SSE closed for task ${taskId}`);
    }
  }

  initEventSource();
}
</script>
