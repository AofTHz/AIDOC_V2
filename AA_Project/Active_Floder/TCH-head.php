<?php include('../AA_Project/Confirm_A/count_TCH.php'); ?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800 font-weight-bold"> <i class="fa-brands fa-phoenix-framework" style="color: DarkOrange;"></i> FS School<sup style="color: MediumSeaGreen;">Teacher</sup></h1>
    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
        Total teacher
        <div class="h5 mb-0 font-weight-bold text-gray-800 align-items-center justify-content-center ">
            <?php echo  $fetch['data_TCH'] ?>
        </div>
    </div>
    <div class="align-items-center justify-content-between mb-0">
        <a href="tb_student.php" class="d-none d-sm-inline-block btn btn-sm btn-outline-primary 
        shadow-sm font-weight-bold <?php active('tb_student.php'); ?>">
            <i class="fa-solid fa-user"></i> Student</a>
        <a href="tb_teacher.php" class="d-none d-sm-inline-block btn btn-sm btn-outline-success 
        shadow-sm font-weight-bold <?php active('tb_teacher.php'); ?>">
            <i class="fa-solid fa-chalkboard-user"></i> Teacher</a>
    </div>
</div>