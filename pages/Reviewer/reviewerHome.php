<?php
    session_start();
    if(!isset($_SESSION['role'])){
        header("Location: ../../");
        die();
    }
    

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tag -->
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Reviewer Home</title>
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
        <link rel="stylesheet" href="../../css/reviewerHome.css" />
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns@3.0.0"></script>
    </head>

    <body>
        <div class="wrapper">
            <!-- Sidebar -->
            <aside id="sidebar">
                <div class="h-100">
                    <div class="sidebar-logo">
                        <a href="#">Reviewer</a>
                    </div>
                    <!-- Sidebar Navigation -->
                    <ul class="sidebar-nav">
                        <li class="sidebar-item">
                            <a class="nav-link" href="./reviewerHome.php">
                                <span class="fas fa-home"></span>
                                Home
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
                <div class="container mt-1">
                    <div class="row justify-content-end"> <!-- Add this row to align content to the right -->
                        <div class="col-auto">
                            <!-- Button trigger modal -->
                            <!-- <button type="button" class="btn btn-primary bi bi-bell-fill " data-bs-toggle="modal" data-bs-target="#notificationModal">
                                Notifications
                            </button> -->
                        </div>
                    </div>
            
                    <!-- Notification Modal -->
                    <div class="modal fade" id="notificationModal" tabindex="-1" aria-labelledby="notificationModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="notificationModalLabel">Notifications</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div id="notification-content">
                                        This is a notification message. You can customize this content as needed.
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col users-label">
                        <h1>
                            Document List
                        </h1>
                    </div>
                </div>
                    <div class="ps-5 row  border rounded bg-light user-search-bar">
                        
                        </div>
                                    <!-- List of documents -->
                                    <div class="row justify-content-center px-5 mt-3">
                                        <div class="col-md-12">
                                            <div class="card shadow-2-strong">
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table id="menu-items-data" class="table table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">NAME</th>
                                                                    <th scope="col">Office</th>
                                                                    <th scope="col">DOCUMENT TITLE</th>
                                                                    <th scope="col">STATUS</th>
                                                                    <th scope="col">Comment</th>
                                                                    <th scope="col">ACTION</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="user-products-data" class="products-list">

                                                            <?php
                                                    
                                            include '../../php/db.php';

                                            $sql = "SELECT document.*, concat(users.firstName,' ', users.lastName) as Name, officeName FROM document 
                                            INNER JOIN users on users.user_ID = document.userid 
                                            INNER JOIN offices on document.officeid = offices.officeID
                                            WHERE document.officeid=".$_SESSION["oid"];

                                            $st = $conn->prepare($sql);
                
                                            $st->execute();

                                            $res = $st->get_result();

                                            $ar = [];
                                            if ($res->num_rows > 0) {
                                                while ($row = $res->fetch_assoc()) {
                                                    $ar[] = "<tr>
                                                    <td>" .$row['Name'] . "</td>
                                                    <td>" .$row['officeName'] . "</td>
                                                    <td>" .$row['documentName'] . "</td>
                                                    <td>" .$row['documentStatus'] ."</td>
                                                    <td>" .$row['comment'] ."</td>
                                                    <td>
                                                        <a class='btn btn-success' href='http://localhost:3000/download?filename=".$row['documentFile']."'>Download</a>
                                                        <button type='button' data-id='".$row['documentID']."' class='btn btn-success btn-sm px-3 py-2' data-toggle='modal' data-target='#editDiscountModal'> Edit </button>
                                                    </td>
                                                    </tr>";
                                                }
                                            }
                                            foreach ($ar as $item) {
                                                echo $item;
                                            } ;
                                                ?>
                                                                    
                                                                </tr>
                                                                <!-- Add more rows as needed -->
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
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

<div class="modal fade" id="editDiscountModal" tabindex="-1" aria-labelledby="editDiscountModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editDiscountModalLabel">Edit Document Details</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="http://localhost:3000/updateDocument" id="editDocumentForm" method="POST">

                    <!-- Edit Status -->
                    <div class="mb-3">
                        <label for="editStatus" class="form-label">Edit Status</label>
                        <select class="form-select" id="editStatus" name="status">
                            <option value="return">Return</option>
                            <option value="approved">Approved</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="comment" class="form-label">Comment</label>
                        <textarea rows="4" cols="50" type="text" class="form-control" id="comment" name="comment" placeholder="Enter your comment"></textarea>
                    </div>
                    <input value="<?php echo $_SESSION['uid']; ?>" hidden name="uid"></input>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button name="id" id="edit-submit" form="editDocumentForm" type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
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

            $(document).ready(function() {
                $('#editDiscountModal').on('show.bs.modal', function(e) {
                    var id = $(e.relatedTarget).data('id');
                    $('#edit-submit').val(id)
                });
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