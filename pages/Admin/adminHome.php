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
        <title>Admin Users</title>
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
        <!-- Boostrap Javascript -->
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
            crossorigin="anonymous"></script>

        <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />

        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" />

        <!-- icons:font awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
        <link rel="stylesheet" href="../../css/adminUsers.css" />
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
        </aside>
            <!-- Main Component -->
            <div class="main">
                <div class="container-fluid navbar-container">
                </div>
                <div class="row">
                    <div class="col users-label">
                        <h1>
                            Users
                        </h1>
                    </div>
                </div>
                <div class="ps-5 row  border rounded bg-light user-search-bar">
                    <div class="col-10 d-flex flex-wrap align-content-center">
                        <div class="input-group mb-1">
                            <input type="text" class="form-control" id="searchUserField" placeholder="Search User" aria-label="User Search" aria-describedby="button-addon2">
                            <button class="btn btn-primary" type="button" id="searchUserBtn">Search</button>
                        </div>
                    </div>
                    <div class="col d-flex flex-wrap align-content-center">
                        <div class="input-group mb-1 d-flex flex-wrap align-content-center justify-content-center">
                            <button class="btn btn-primary addUsersButton" type="button" id="addUserBtn" data-toggle="modal"
                            data-target="#addUserModal">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-add" viewBox="0 0 16 16">
                                    <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0Zm-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z"/>
                                    <path d="M8.256 14a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10c.26 0 .507.009.74.025.226-.341.496-.65.804-.918C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4s1 1 1 1h5.256Z"/>
                                </svg>
                                Add User
                            </button>
                        </div>
                    </div>
                     <!-- Users table Container -->
                     <div class="row justify-content-center mt-3">
                        <div class="col-md-12">
                            <div class="card shadow-2-strong">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="orderTable" class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th scope="col">ROLE</th>
                                                    <th scope="col">USERNAME</th>
                                                    <th scope="col">FIRST NAME</th>
                                                    <th scope="col">LAST NAME</th>
                                                    <th scope="col">Office</th>
                                                    <th scope="col">ACTION</th>
                                                </tr>
                                            </thead>
                                            <tbody id="user-list-data" class="users-list">
                                               
                                            <?php
                                                $sql = "SELECT users.*, officeName, users.officeID  FROM users 
                                                INNER JOIN offices on users.officeID = offices.officeID
                                                WHERE users.user_ID not in (?, ?);";

                                                $st = $conn->prepare($sql);
                                                $st->bind_param("ii", $adminid, $uid);

                                                $adminid = 1;
                                                $uid = $_SESSION["uid"];

                                                $st->execute();

                                                $res = $st->get_result();

                                                if ($res->num_rows > 0) {
                                                    while ($row = $res->fetch_assoc()) {
                                                    
                                                        echo "<tr><td>" .$row['userType'] . "</td>
                                                        <td>" .$row['username'] ."</td>
                                                        <td>" .$row['firstName'] ."</td>
                                                        <td>" .$row['lastName'] ."</td>
                                                        <td>" .$row['officeName'] ."</td>
                                                        " .
                                                        '<td>
                                                            <button class="btn btn-success" 
                                                            data-id="'.$row["user_ID"].'" 
                                                            data-username="'.$row["username"].'" 
                                                            data-password="'.$row["password"].'" 
                                                            data-firstName="'.$row["firstName"].'" 
                                                            data-lastName="'.$row["lastName"].'" 
                                                            data-userType="'.$row["userType"].'" 
                                                            data-officeID="'.$row["officeID"].'" 
                                                            style="color:white"  data-toggle="modal" data-target="#editDiscountModal">
                                                                Edit
                                                            </button>
                                                            <button type"button" data-id="'.$row["user_ID"].'" class="btn btn-danger btn-sm px-3 py-2" data-toggle="modal" data-target="#deleteConfirmation">
                                                                <i class="bi bi-trash"></i>
                                                            </button>
    
                                                        </td></tr>';
                                                        
                                                    }
                                                }
                                            ?>

                                                
                                                <!-- Add more rows as needed -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Users table Container -->
                </div>
        <!-- Footer -->
        <div class="footer">
            <p>&copy; Team Two One</p>
        </div>
        <!-- End of Footer -->
            </div>
        <!-- admin-dashboard-column -->


             <!-- Modal for Editing Document Information -->
        <div class="modal fade" id="editDiscountModal">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit User</h4>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="../../php/edituser.php" id="editUserForm" method="POST">
                            <div class="inputField">
                                <!-- Role selection dropdown -->
                                <div class="row mb-3">
                                    <label for="editRole" class="col-sm-3 col-form-label">new Role</label>
                                    <div class="col-sm-9">
                                        <select class="form-select" id="editUserType" name="role">
                                        <option value="Administrator">Administrator</option>
                                        <option value="Requester">Requester</option>
                                        <option value="Reviewer">Reviewer</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- Username input -->
                                <div class="row mb-3">
                                    <label for="editUsername" class="col-sm-3 col-form-label">New Username</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="editUsername" name="username">
                                    </div>
                                </div>
                                <!-- Password input -->
                                <div class="row mb-3">
                                    <label for="editPassword" class="col-sm-3 col-form-label">new Password</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" id="editPassword" name="password">
                                    </div>
                                </div>
                                <!-- First Name input -->
                                <div class="row mb-3">
                                    <label for="editFirstName" class="col-sm-3 col-form-label">Edit First Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="editFirstName" name="firstname">
                                    </div>
                                </div>
                                <!-- Last Name input -->
                                <div class="row mb-3">
                                    <label for="editLastName" class="col-sm-3 col-form-label">Edit Last Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="editLastName" name="lastname">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="editOffice" class="col-sm-3 col-form-label">Edit Office</label>
                                    <div class="col-sm-9">
                                        <select class="form-select" id="office" name="office">
                                            <?php
                                            include '../../php/db.php';

                                            $sql = "SELECT * FROM offices;";

                                            $st = $conn->prepare($sql);

                                            $st->execute();

                                            $res = $st->get_result();

                                            $ar = [];


                                            if ($res->num_rows > 0) {
                                                while ($row = $res->fetch_assoc()) {
                                                
                                                    $ar[] = "<option value=".$row['officeID'].">".$row['officeName']."</option>";
                                                    
                                                }
                                            }
                                            foreach ($ar as $item) {
                                                echo $item;
                                            }  ;
                                            ?>
                                            </select>

                                    </div>
                                </div>
                               
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button id="edit-submit" type="submit" name="id" form="editUserForm" class="btn btn-primary submit submit-editUser">Edit</button>
                    </div>
                </div>
            </div>
        </div>
    
    
    <!--  Add Users Modal-->
    <div class="modal fade" id="addUserModal">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">Add User Info</h4>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form action="../../php/adduser.php" method="POST" id="userForm">

                        <div class="inputField">
                             <!-- Role selection dropdown -->
                             <div class="row mb-3">
                                <label for="role" class="col-sm-3 col-form-label">Role</label>
                                <div class="col-sm-9">
                                    <select class="form-select" id="role" name="userType">
                                        <option value="Administrator">Administrator</option>
                                        <option value="Requester">Requester</option>
                                        <option value="Reviewer">Reviewer</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="username" class="col-sm-3 col-form-label">Username :</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="username" placeholder="Enter Username Here" name="username">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-sm-3 col-form-label">Password :</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" id="password" name= "password" placeholder="Enter Password Here">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="firstname" class="col-sm-3 col-form-label">FirstName :</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="firstname" name="first_name" placeholder="Enter FirstName Here">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="lastname" class="col-sm-3 col-form-label">LastName :</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="lastname" name="last_name" placeholder="Enter LastName Here">
                                </div>
                            </div>

                            <div id = "selectofficediv" class="row mb-3" hidden>
                                <label for="office" class="col-sm-3 col-form-label">Office</label>
                                <div class="col-sm-9">
                                    <select class="form-select" id="selectoffice" name="office" >
                                        <?php
                                            $sql = "SELECT * FROM offices";

                                            $result = $conn->query($sql);

                                            while($row = $result->fetch_assoc()) {
                                                echo "<option value='" . $row["officeID"]. "'>" . $row["officeName"]. "</option>";
                                            }

                                        
                                        ?>

                                    </select>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit-addUser" form="userForm" class="btn btn-primary submit submit-addUser">Add</button>
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


                <!-- Delete Confrimation -->
                <div
            class="modal fade"
            id="deleteConfirmation"
            tabindex="-1"
            role="dialog"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header custom-modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">Are you sure you want to delete this user?</div>
                    <form action="../../php/deleteuser.php" method="POST" id="deleteuserform">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button id="delete-submit" name="id" form="deleteuserform" class="btn btn-danger">Confirm</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- custom script -->

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
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
                    var username = $(e.relatedTarget).data('username');
                    var password = $(e.relatedTarget).data('password');
                    var firstName = $(e.relatedTarget).data('firstname');
                    var lastName = $(e.relatedTarget).data('lastname');
                    var userType = $(e.relatedTarget).data('usertype');
                    var officeID = $(e.relatedTarget).data('officeID');
                    $('#edit-submit').val(id)
                    $('#editUsername').val(username)
                    $('#editPassword').val(password)
                    $('#editFirstName').val(firstName)
                    $('#editLastName').val(lastName)
                    $('#editUserType').val(userType)
                    $('#editOffice').val(officeID)
                });

                $('#deleteConfirmation').on('show.bs.modal', function(e) {
                    var id = $(e.relatedTarget).data('id');
                    $('#delete-submit').val(id)
                });
                
                $('#role').on('change', function(e) {
                    var role = $(this).val();

                    if (role == "Reviewer") {
                        $('#selectofficediv').attr("hidden", false);
                    } else {
                        $('#selectofficediv').attr("hidden", true);
                    }

                });

            });

           </script>
        <script src="../js/manager-users.js"></script>
    </body>
</html>
