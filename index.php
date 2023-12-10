<?php
    session_start();

    if(isset($_SESSION['role'])){
        if ($_SESSION['role'] == 'Administrator'){
            echo '<script>window.location.href = "./pages/Admin/adminHome.php"</script>';
        }
        if ($_SESSION['role'] == 'Requester'){
            echo '<script>window.location.href = "./pages/Requester/requester.php"</script>';
        }
        if ($_SESSION['role'] == 'Reviewer'){
            echo '<script>window.location.href = "./pages/Reviewer/reviewerHome.php"</script>';
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tag -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Login Page</title>
        <!-- Favicon -->
        <link rel="shortcut icon" href="./img/logo.png" type="stylesheet" />

        <!-- Bootstrap 5 -->
        <!-- Bootstrap CSS -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9"
            crossorigin="anonymous" />
        <link rel="stylesheet" href="css/index.css" />
    </head>
    <body>
        <!-- Login form start here -->
        <section class="wrapper">
            <div class="container-login">
                <div class="div-login">
                    <!-- login form -->

                    <!-- Connected to the login.php -->
                    <form class="border border-secondary rounded bg-white shadow p-5" action="php/login.php" method="POST">
                        <div class="logo">
                            <!-- image for the logo -->
                            <img src="img/slu-logo.png" class="mx-auto d-block" alt="logo" />
                        </div>
                        <h3 class="text-center fw-bolder">User Login</h3>
                        <!-- Email -->
                        <div class="form-floating mb-3">
                            <input
                                type="text"
                                class="form-control"
                                id="floatingInput"
                                placeholder="Username"
                                name="username" />
                            <label for="floatingInput">Username</label>
                        </div>
                        <!-- Password -->
                        <div class="form-floating">
                            <input
                                type="password"
                                class="form-control"
                                id="floatingPassword"
                                placeholder="Password"
                                name="password" />
                            <label for="floatingPassword">Password</label>
                        </div>
                        <!-- Login Button -->
                        <button type="submit" class="login_btn w-100 my-4"  >Login</button>
                    </form>
                </div>
            </div>
        </section>
        <!-- Login form ends here -->

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
            crossorigin="anonymous"></script>
    </body>
</html>
