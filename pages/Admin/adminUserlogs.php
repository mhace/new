<?php
    session_start();
    if(!isset($_SESSION['role'])){
        header("Location: ../../");
        die();
    }

    include '../../php/db.php';
    

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tag -->
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Admin User Logs</title>
        <!-- Favicon -->
        <link rel="shortcut icon" href="/img/logo.png" type="stylesheet" />

        <!-- Footer -->
        <link rel="stylesheet" href="../../css/footer.css" />

        <!-- Bootstrap CSS -->
        <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css"
            integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9"
            crossorigin="anonymous" />
        
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" />
        
        <!-- Boostrap Javascript -->
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
            crossorigin="anonymous"></script>

        <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" />

        <!-- icons:font awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
        <link rel="stylesheet" href="../../css/adminUserlogs.css" />
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns@3.0.0"></script>
    </head>

    <body>
        <div class="wrapper">
            <!-- Sidebar -->
            <aside id="sidebar">
                <div class="h-100">
                    <div class="sidebar-logo">
                        <a href="#">Admin</a>
                    </div>
                    <!-- Sidebar Navigation -->
                    <ul class="sidebar-nav">
                        <li class="sidebar-item">
                            <a class="nav-link" href="./adminHome.php">
                                <span class="fas fa-home"></span>
                                Users
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="nav-link" href="./adminUserlogs.php">
                                <span class="bi bi-people-fill"></span>
                                View User Logs
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <!-- Button to trigger the modal -->
                            <a href="put-link-here" class="nav-link" data-toggle="modal" data-target="#logoutModal">
                                <span class="fas fa-sign-out-alt"></span>
                                Log out
                            </a>
                        </li>
                    </ul>
                </div>
            </aside>

            <!-- Main Component -->
            <div class="main">
                <div class="container-fluid navbar-container">
                <div class="col-sm-1 pt-3">
                            <button class="btn" type="button" data-bs-theme="dark">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col users-label">
                        <h1>
                            User Logs
                        </h1>
                    </div>
                </div>
                    <div class="ps-5 row  border rounded bg-light user-search-bar">
                        <div class="col-10 d-flex flex-wrap align-content-center">
                        </div>
                                    <!-- List of documents -->
                <div class="row justify-content-center px-5 mt-3">
                    <div class="col-md-12">
                        <div class="card shadow-2-strong">
                            <div class="card-body">
                                <div class="table-responsive">
                                <table  id="menu-items-data" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">Timestamp</th>
                                            <th scope="col">User</th>
                                            <th scope="col">EVENT</th>
                                        </tr>
                                    </thead>
                                    <tbody id="user-products-data" class="products-list">
                                        <?php
                                            $sql = "SELECT logs.*, CONCAT(firstName, ' ', lastName) as user FROM logs 
                                                    INNER JOIN users on users.user_ID = logs.uid";
                                            $st = $conn->prepare($sql);
                                            $st->execute();
                                            $res = $st->get_result();
                                            $ar = [];
                                              
                                            if ($res->num_rows > 0) {
                                                while ($row = $res->fetch_assoc()) {
                                                    echo "<tr>
                                                            <td>".$row['timestamp']."</td>
                                                            <td>".$row['user']."</td>
                                                            <td>".$row['event']."</td>
                                                        </tr>";
                                                }
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- Footer -->
            <div class="footer">
                <p>&copy; Team Two One</p>
            </div>
             <!-- End of Footer -->
            </div>
            </div>
        </div>
    </div>
</div>
                    
            <!-- Logout Modal -->
        <div
        class="modal fade"
        id="logoutModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header custom-modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Logout Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">Are you sure you want to log out?</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <a href="../../php/logout.php" class="btn btn-danger">Log out</a>
                </div>
            </div>
        </div>
    </div>
    <!--End of Modal-->

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            const activePageLocation = window.location.pathname;
            const navLinks = document.querySelectorAll(".nav-link");
            navLinks.forEach(links => {
                if(links.href.includes(activePageLocation)){
                links.classList.add('active');
                }
            });
        </script>

        <script>
                // script for sidebar
                const toggler = document.querySelector(".btn");
                toggler.addEventListener("click", function () {
                document.querySelector("#sidebar").classList.toggle("collapsed");
                });

                $(document).ready(function() {
                    let table = new DataTable('#menu-items-data');                    
                });
        </script>

    </body>
</html>