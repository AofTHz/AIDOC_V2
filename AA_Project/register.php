<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Register Admin</title>

    <?php include('../AA_Project/link.php'); ?>

</head>

<body class="bg-gradient-warning">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <a class="font-weight-bold " href="HomepageStart.php">
                                <button class="close" style="color: red;" type="button">
                                    <i class="fa-solid fa-square-xmark"></i>
                                </button>
                            </a>
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form class="needs-validation" novalidate action="../FSALIN/regis_Student.php" id="regisform" method="POST">
                                <div class="form-group row">
                                    <div class="col-sm-4 mb-3 mb-sm-0">
                                        <select name="initial" class="form-select" id="initial" required>
                                            <option value selected disabled>Initial</option>
                                            <option value="1">Mr.</option>
                                            <option value="2">Mrs.</option>
                                            <option value="3">Miss</option>
                                            <option value="4">Master(mstr)</option>
                                        </select>
                                        <div class="invalid-tooltip">
                                            Valid initial in required.
                                        </div>
                                    </div>
                                    <div class="col-sm-4 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="firstName" name="firstName" placeholder="First Name" required>
                                        <div class="invalid-tooltip">
                                            Please enter your first name.
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control form-control-user" id="lastName" name="lastName" placeholder="Last Name" required>
                                        <div class="invalid-tooltip">
                                            Please enter your last name.
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <div class="input-group has-validation">
                                            <span class="input-group-text">@</span>
                                            <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Username" required>
                                            <div class="invalid-tooltip">
                                                Please enter Username.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 ">
                                        <div class="input-group has-validation">
                                            <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                                            <input type="email" class="form-control form-control-user" id="email" name="email" placeholder="you@example.com" required>
                                            <div class="invalid-tooltip">
                                                Please enter your email.
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <div class="input-group has-validation">
                                            <span class="input-group-text"><i class="fa-solid fa-key"></i></span>
                                            <input type="password" class="form-control form-control-user"
                                                id="password" name="password" placeholder="Password" required>
                                            <div class="invalid-tooltip">
                                                Password required.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="input-group has-validation">
                                            <span class="input-group-text"><i class="fa-solid fa-circle-check"></i></span>
                                            <input type="password" class="form-control form-control-user"
                                                id="c_password" name="c_password" placeholder="Comfrim Password" required>
                                            <div class="invalid-tooltip">
                                                Comfrim password required.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-warning btn-user btn-block" type="submit" name="singupad">Register Account</button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.php">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="login.php">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <?php include('../AA_Project/Script.php'); ?>

</body>

</html>