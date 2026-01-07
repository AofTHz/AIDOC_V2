<?php
// folderFunctions.php
?>
<script>
/***********************
 * Global Variables
 ***********************/
var folderFilesExtra = {};

/***********************
 * Folder & Files Functions
 ***********************/
async function fetchFolders() {
  try {
    const response = await fetch(`${BASE_URL}/getFolders`);
    const folders = await response.json();
    const folderContainer = document.getElementById("folderContainer");
    folderContainer.innerHTML = "";

    folders.forEach(async folder => {
      const colorClass = getColorByAlphabet(folder.name.charAt(0));
      const folderCard = document.createElement("div");
      folderCard.className = "col-12 col-md-6 col-lg-4 mb-4";
      folderCard.innerHTML = `
        <div class="card border-left-${colorClass} shadow py-2 w-100">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-${colorClass} text-uppercase mb-1 h5">
                  ${folder.name}
                </div>
                <div class="mb-0">total accuracy: ${folder.total_accuracy}%</div>
              </div>
              <div class="col-auto">
                <i class="fa-solid fa-folder-closed fa-2x text-${colorClass}"></i>
              </div>
            </div>
          </div>
          <ul class="list-group list-group-flush" id="files-${folder.id}"></ul>
        </div>
      `;
      folderContainer.appendChild(folderCard);

      fetchFiles(folder.id, folder.name);
    });
  } catch (error) {
    console.error("Error fetching folders:", error);
  }
}

async function fetchFiles(folderId, folderName) {
  try {
    const response = await fetch(`${BASE_URL}/getFiles?folder_id=${folderId}`);
    const files = await response.json();
    const fileList = document.getElementById(`files-${folderId}`);
    fileList.innerHTML = "";

    const threshold = 5;
    if (files.length > threshold) {
      files.slice(0, threshold).forEach(file => {
        // Pass file.id as additional parameter to createFileListItem (defined in utilityFunctions)
        fileList.appendChild(createFileListItem(folderName, file, file.id));
      });
      folderFilesExtra[folderId] = files.slice(threshold);

      const moreCount = files.length - threshold;
      const moreItem = document.createElement("li");
      moreItem.className = "list-group-item text-center";
      moreItem.innerHTML = `<a href="#" onclick="showMoreFilesModal(event, ${folderId}, '${folderName}')">Show ${moreCount} more <i class="fa-solid fa-angle-down"></i></a>`;
      fileList.appendChild(moreItem);
    } else {
      files.forEach(file => {
        fileList.appendChild(createFileListItem(folderName, file, file.id));
      });
    }
  } catch (error) {
    console.error("Error fetching files:", error);
  }
}

/***********************
 * Modal Functions
 ***********************/
function showMoreFilesModal(event, folderId, folderName) {
  event.preventDefault();

  const modalTitle = document.getElementById("moreFilesModalLabel");
  modalTitle.textContent = `${folderName} - More Files`;

  const modalBody = document.getElementById("moreFilesModalBody");
  modalBody.innerHTML = "";

  const extraFiles = folderFilesExtra[folderId];
  if (extraFiles && extraFiles.length > 0) {
    const listGroup = document.createElement("ul");
    listGroup.className = "list-group";

    // Pass file.id to createFileListItem for each extra file
    extraFiles.forEach(file => {
      const li = createFileListItem(folderName, file, file.id);
      listGroup.appendChild(li);
    });
    modalBody.appendChild(listGroup);
  } else {
    modalBody.textContent = "No more files available.";
  }

  // Show the modal
  $('#moreFilesModal').modal('show');

  // Re-initialize tooltips for newly added items
  setTimeout(() => {
    $('[data-toggle="tooltip"]').tooltip({ html: true });
  }, 50);
}

/***********************
 * Close Modal Function (In case button isn't working)
 ***********************/
function closeMoreFilesModal() {
  $('#moreFilesModal').modal('hide');
}
</script>
