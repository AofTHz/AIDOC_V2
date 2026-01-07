<?php include('Active_Floder/Active.php'); ?>
<nav class="p-3 bg-dark mb-4 static-top shadow">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start sidebar-dark">
            <!-- Button Homepage -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="HMMoveFile.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fa-solid fa-file-import" style="color: DarkOrange;"></i>
                </div>
            </a>
            <!-- Button choose page -->
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li class="nav-item <?php active('HMMoveFile.php'); ?>">
                    <a class="nav-link" href="HMMoveFile.php">
                        <i class="fa-solid fa-house"></i>
                        <span id="NV_menu_up">Upload</span>
                    </a>
                </li>
                <li class="nav-item <?php active('#'); ?>">
                    <a class="nav-link" href="#">
                        <i class="fa-solid fa-chart-simple"></i>
                        <span id="NV_menu_State">Statistic</span>
                    </a>
                </li>
                <li class="nav-item <?php active('Test.php'); ?>">
                    <a class="nav-link" href="Test.php">
                        <i class="fa-solid fa-wrench"></i>
                        <span id="NV_menu_test">Test</span>
                    </a>
                </li>
            </ul>

            <div class="btn-group">
                <button id="btn_lang" onclick="togglelang()" class="btn btn-primary" type="button">
                    EN
                </button>
            </div>
        </div>
    </div>
</nav>