<?php

require "connection.php";

?>

<!DOCTYPE html>

<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Food Court</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resource/logo.png" />

</head>

<body>

    <section class="vh-100">
    <div class="container-fluid h-custom">
        <div class="row d-flex justify-content-center align-items-center h-custom">

            <div class="col-12 mt-1">
                <div class="row">
                    <div class="col-12 logo"></div>
                    <div class="col-12">
                        <p class="text-center title1">Welcome to Food Court</p>
                    </div>
                </div>
            </div>

            <div class="col-md-9 col-lg-6 col-xl-5">
                <img src="resource/background.png"
                class="img-fluid" alt="Sample image">
            </div>


            <div class="col-md-8 col-lg-6 col-12 col-xl-4 offset-xl-1 mb-4" id="signInBox">
                <form>
                <div class="d-flex divider flex-row align-items-center justify-content-center my-4">
                    <p class="lead fw-bold fs-4 text-center mb-0 me-3">Sign in</p>                
                </div>

                <div class="col-12 d-none" id="msgdiv1">
                    <div class="alert alert-danger d-flex align-items-center" role="alert" id="alertdive">
                        <i class="bi bi-exclamation-triangle-fill fs-6" id="msg1">
                        

                        </i>
                    </div>
                </div>

                <?php
                            
                $email="";
                $password="";

                if(isset($_COOKIE["email"])) {
                    $email = $_COOKIE["email"];
                }

                if(isset($_COOKIE["password"])) {
                    $password = $_COOKIE["password"];
                }

                ?>

                <!-- Email input -->
                <div class="form-outline mb-3">
                    <input type="email" id="email2" class="form-control form-control-lg"
                    placeholder="Enter a valid email address" value="<?php echo $email; ?>"/>
                    <label class="form-label">Email address</label>
                </div>

                <!-- Password input -->
                <div class="form-outline mb-3">
                    <input type="password" id="password2" class="form-control form-control-lg"
                    placeholder="Enter password" value="<?php echo $password; ?>"/>
                    <label class="form-label">Password</label>
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <!-- Checkbox -->
                    <div class="form-check mb-0">
                    <input class="form-check-input me-2" type="checkbox" id="rememberme" />
                    <label class="form-check-label">
                        Remember me
                    </label>
                    </div>
                    <label class="text-body signout" onclick="forgotPassword()";>Forgot password?</label>
                </div>

                <div class="text-center text-lg-start mt-2 pt-1">
                    <button type="button" class="btn btn-primary btn-lg"
                    style="padding-left: 2.5rem; padding-right: 2.5rem;" onclick="signIn()";>Login</button>

                    <p class="small fw-bold mt-1 pt-1 mb-0">Don't have an account? 
                        <label class="link-danger" onclick="changeView();">Register</label>
                    </p>
                </div>

                </form>
            </div>


            <div class="col-md-8 col-12 col-lg-6 col-xl-4 offset-xl-1 d-none" id="signUpBox">
                <form>
                <div class="d-flex divider flex-row align-items-center justify-content-center my-3">
                    <p class="lead fw-bold fs-4 text-center mb-0 me-3">Sign Up</p>                
                </div>

                <div class="col-12 d-none" id="msgdiv">
                    <div class="alert alert-danger d-flex align-items-center" role="alert" id="alertdiv">
                        <i class="bi bi-exclamation-triangle-fill fs-6" id="msg">
                        

                        </i>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 col-12 mb-1">
                        <div class="form-outline">
                            <label class="form-label">First name</label>
                            <input type="text" id="f" class="form-control" placeholder="John" id="f"/>
                            
                        </div>
                    </div>
                    <div class="col-md-6 col-12 mb-1">
                        <div class="form-outline">
                            <label class="form-label">Last name</label>
                            <input type="text" id="l" class="form-control" placeholder="Michael" id="l"/>
                            
                        </div>
                    </div>
                </div>

                <!-- Email input -->
                <div class="form-outline col-12 mb-1">
                    <label class="form-label">Email address</label>
                    <input type="email" id="e" class="form-control" placeholder="example@email.com" id="e"/>
                    
                </div>

                <!-- Password input -->
                <div class="form-outline col-12 mb-1">
                    <label class="form-label">Password</label>
                    <input type="password" id="p" class="form-control" placeholder="*****" id="p"/>
                    
                </div>

                <!-- Mobile -->
                <div class="row">
                <div class="form-outline col-md-6 col-12 mb-1">
                    <label class="form-label">Mobile</label>
                    <input type="text" id="m" class="form-control" placeholder="0712345678" id="m"/>
                    
                </div>

                <!-- Gender -->
                <div class="form-outline col-md-6 col-12">
                    <label class="form-label" for="form3Example3">Gender</label>
                    <Select class="form-select" id="g">
                        <?php 
                                    
                        $rs = Database::search("SELECT * FROM `gender`");
                        $n = $rs->num_rows;

                        for($x=0; $x<$n; $x++){
                            $d = $rs->fetch_assoc();

                            ?>

                            <option value="<?php echo $d["id"]; ?>"><?php echo $d["gender_name"]; ?></option>
                            
                            <?php

                        }
                        
                        ?>

                    </Select>
                    
                </div>

                <div class="text-center text-lg-start mt-2 pt-1">
                    <button type="button" class="btn btn-primary btn-lg"
                    style="padding-left: 2.5rem; padding-right: 2.5rem;" onclick="signUp();">Sign Up</button>

                    <p class="small fw-bold mt-1 pt-1 mb-0">Already have an account? 
                        <label class="link-danger" onclick="changeView();">Login</label>
                    </p>
                </div>
                </div>
            </div>

            <div class="modal" tabindex="-1" id="forgotPasswordModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Reset Password</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-3">

                                <div class="col-12">
                                    <label class="form-label">New Password</label>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" id="npi"/>
                                        <button class="btn btn-outline-secondary" type="button" id="npb" onclick="showPassword();"><i id="el" class="bi bi-eye-slash-fill"></i></button>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Re-type Password</label>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" id="rnp"/>
                                        <button class="btn btn-outline-secondary" type="button" id="rnpb" onclick="showPassword2();" ><i id="el" class="bi bi-eye-slash-fill"></i></button>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Verification Code</label>
                                    <input type="text" class="form-control" id="vc"/>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="resetpw();">Reset Password</button>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Copyright -->
            <div class="col-12 d-none fixed-bottom d-block d-lg-block">
                <p class="text-center">Copyrights &copy; 2022 Food Court Cafe || All Rights Reserved</p>
            </div>
        </div>
    </div>

    

    </section>

    <script src="script.js"></script>
    <script src="bootstrap.js"></script>
</body>