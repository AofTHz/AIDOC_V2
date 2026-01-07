<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Files Organization</title>

  <!-- Example: If you have a separate "link.php" that includes CSS or meta tags -->
  <?php include('link.php'); ?>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">


  <!-- Bring in the separate PHP files that contain your JavaScript code -->
  <?php include('utilityFunctions.php'); ?>
  <?php include('folderFunctions.php'); ?>
  <?php include('uploadFunctions.php'); ?>

  <style>
    /* Ensure the page takes up the whole screen */
    html, body {
      height: 100%;
      margin: 0;
      display: flex;
      flex-direction: column;
    }

    #content {
      flex-grow: 1; /* Makes content take up remaining space */
      display: flex;
      flex-direction: column;
    }

    .container {
      flex-grow: 1; /* Ensures sections expand properly */
    }

    /* Dropzone styling */
    #dropzone {
      min-height: 300px;
      border: 2px dashed #ccc;
      border-radius: 10px;
      padding: 30px;
    }

    /* Ensures the upload button is properly positioned */
    .btn-primary {
      display: block;
      margin: 0 auto;
    }
  </style>
</head>
<body id="page-top">
  <div id="content" class="bg-gradient-light">
    <?php include('NavHead/NheadFile.php'); ?>

    <!-- Dropzone / Upload Section -->
    <div class="container my-5 d-flex flex-column">
      <div id="dropzone" class="position-relative text-center text-muted bg-body dropzone"
           ondragover="highlightDropzone(event);" 
           ondragleave="resetDropzone(event);" 
           ondrop="handleFileUpload(event);">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fa-solid fa-file-import" style="color: DarkOrange;"></i>
        </div>
        <h1 class="text-body-emphasis">Upload your files here</h1>
        <p class="col-lg-6 mx-auto mb-4">
          You can load from a single file or multiple at once files by dragging them onto the website, or press the upload button.
        </p>
        <input type="file" id="fileInput" multiple style="display: none;" onchange="handleFileUpload(event)">
        <button class="btn btn-primary px-5 mb-5" type="button" onclick="openFileExplorer()">Upload</button>
      </div>
      <!-- This will display the upload progress statuses -->
      <div id="uploadStatuses" class="mt-3"></div>
    </div>

    <!-- Folders Section -->
    <div class="container-fluid flex-grow-1">
      <div class="row" id="folderContainer"></div>
    </div>
  </div>

  <!-- Modal for showing extra files -->
  <div class="modal fade" id="moreFilesModal" tabindex="-1" role="dialog" aria-labelledby="moreFilesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="moreFilesModalLabel">More Files</h5>
          <button type="button" class="close" onclick="closeMoreFilesModal()" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="moreFilesModalBody"></div>
      </div>
    </div>
  </div>

  <!-- Example: If you have a separate "Script.php" that includes additional JS libraries, you can include that here -->
  <?php include('Script.php'); ?>

  <!-- Initialize fetch folders and reconnect tasks on DOM load -->
  <script src="config.js"></script>
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      fetchFolders();
      let tasks = getActiveTasks();
      tasks.forEach(taskId => {
        connectUploadStatus(taskId);
      });
    });
  </script>
  
</body>
</html>
