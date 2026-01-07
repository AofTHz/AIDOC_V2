<!-- utilityFunctions.php -->
<?php
// utilityFunctions.php
?>
<script>
/***********************
 * Utility Functions
 ***********************/
function getColorByAlphabet(letter) {
  const colorMap = {
    A: "danger", B: "primary", C: "warning", D: "success", E: "info",
    F: "warning", G: "danger", H: "primary", I: "success", J: "info",
    K: "success", L: "info", M: "danger", N: "danger", O: "warning",
    P: "info", Q: "success", R: "warning", S: "primary", T: "danger",
    U: "primary", V: "warning", W: "success", X: "danger", Y: "success",
    Z: "warning"
  };
  return colorMap[letter.toUpperCase()] || "secondary";
}

function createPDFLink(folderName, fileName) {
  return `${BASE_URL}/getPDF?folder_name=${encodeURIComponent(folderName)}&file_name=${encodeURIComponent(fileName)}`;
}

/**
 * Create a file list item element.
 * It shows the file name on the left and on the right,
 * a badge with the highest accuracy and a grey cross delete button.
 * The delete button uses the file's unique id for deletion.
 */
function createFileListItem(folderName, file, fileId) {
  const li = document.createElement("li");
  li.className = "list-group-item";
  li.style.cursor = "pointer";
  li.style.fontWeight = "600";
  li.style.color = "#8a8a8a";
  li.style.display = "flex";
  li.style.justifyContent = "space-between";
  li.style.alignItems = "center";

  // Parse accuracies
  let accuracyArr = [0, 0, 0];
  try {
    accuracyArr = JSON.parse(file.accuracy || "[0,0,0]");
  } catch (e) {
    let cleaned = file.accuracy.replace(/[\[\]\s]/g, '');
    accuracyArr = cleaned.split(",").map(v => parseInt(v, 10) || 0);
  }
  const maxVal = Math.max(...accuracyArr);
  const folderLabels = ["MobileApp", "HardwareIOT", "WebApp"];
  const accuracyText = accuracyArr
    .map((val, idx) => `${folderLabels[idx]}: ${val}%`)
    .join('\n');

  // Left side: File name
  const fileNameSpan = document.createElement("span");
  fileNameSpan.textContent = file.name;

  // Right side container: Accuracy badge and delete button
  const rightContainer = document.createElement("div");
  rightContainer.style.display = "flex";
  rightContainer.style.alignItems = "center";

  // Badge for accuracy percentage
  const badge = document.createElement("span");
  badge.className = "badge badge-primary";
  badge.style.marginRight = "5px";
  badge.title = accuracyText;
  badge.textContent = `${maxVal}%`;

  // Delete button as a grey cross
  const deleteBtn = document.createElement("button");
  deleteBtn.style.background = "none";
  deleteBtn.style.border = "none";
  deleteBtn.style.color = "grey";
  deleteBtn.style.fontSize = "1.2em";
  deleteBtn.style.cursor = "pointer";
  deleteBtn.style.padding = "0";
  deleteBtn.innerHTML = "&times;";

  // Use fileId in delete function
  deleteBtn.addEventListener("click", function(e) {
    e.stopPropagation();
    if (confirm("Are you sure you want to delete this file?")) {
      deleteFile(folderName, fileId, li);
    }
  });

  rightContainer.appendChild(badge);
  rightContainer.appendChild(deleteBtn);

  li.appendChild(fileNameSpan);
  li.appendChild(rightContainer);

  // Clicking anywhere on li (except the delete button) opens the PDF
  li.addEventListener("click", function() {
    window.open(createPDFLink(folderName, file.name), "_blank");
  });

  return li;
}

/***********************
 * Delete File Function
 ***********************/
function deleteFile(folderName, fileId, liElement) {
  // Construct the URL using the fileId for deletion
  const url = `${BASE_URL}/deleteFile?file_id=${encodeURIComponent(fileId)}`;
  
  fetch(url, { method: "DELETE" })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        alert("File deleted successfully.");
        liElement.remove();
        fetchFolders();
      } else {
        alert("Failed to delete file.");
      }
    })
    .catch(error => {
      console.error("Error deleting file:", error);
      alert("Error deleting file.");
    });
}

/***********************
 * Session Storage Helpers for Active Task IDs
 ***********************/
function addActiveTask(taskId) {
  let tasks = JSON.parse(sessionStorage.getItem("activeUploadTasks") || "[]");
  if (!tasks.includes(taskId)) {
    tasks.push(taskId);
    sessionStorage.setItem("activeUploadTasks", JSON.stringify(tasks));
  }
}

function removeActiveTask(taskId) {
  let tasks = JSON.parse(sessionStorage.getItem("activeUploadTasks") || "[]");
  tasks = tasks.filter(id => id !== taskId);
  sessionStorage.setItem("activeUploadTasks", JSON.stringify(tasks));
}

function getActiveTasks() {
  return JSON.parse(sessionStorage.getItem("activeUploadTasks") || "[]");
}
</script>
