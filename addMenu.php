<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.5/dist/sweetalert2.min.css">
    <style>
        body {
            background-color: lightyellow;
        }
        .container {
            margin-top: 20px;
        }
        h1 {
            color: #333366;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">PATIGAYON POS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="addMenu.php">Manage</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Menu</a> 
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="panel panel-primary">
                    <div class="text-center">
                        <h1>Add Menu Form</h1>
                    </div>
                    <div class="panel-body">
                        <form id="menuForm">
                            <div class="mb-3">
                                <label for="menu_name" class="form-label">Menu Name:</label>
                                <input type="text" class="form-control" id="menu_name" name="menu_name" required maxlength="100">
                            </div>
                            <div class="mb-3">
                                <label for="menu_desc" class="form-label">Menu Description:</label>
                                <textarea class="form-control" id="menu_desc" name="menu_desc" required maxlength="1000"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">Price:</label>
                                <input type="number" class="form-control" id="price" name="price" required min="0" step="0.01">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                    <div class="panel-footer text-right">
                        <small>&copy; PATIGAYON </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <h1>Menu List</h1>
        <div class="mb-3">
            <input type="text" class="form-control" id="search" placeholder="Search by Name or ID">
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Menu Name</th>
                    <th>Description</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody id="menuList">
                <?php
                $conn = new mysqli('localhost', 'root', '', 'pointofsale');

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT id, menu_name, menu_desc, price FROM ref_menu";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["menu_name"] . "</td>";
                        echo "<td>" . $row["menu_desc"] . "</td>";
                        echo "<td>" . $row["price"] . "</td>";
                        echo "<td><button class='btn btn-primary editBtn' data-id='" . $row["id"] . "'>Update</button> <button class='btn btn-danger deleteBtn' data-id='" . $row["id"] . "'>Delete</button></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No data found</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
        <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateModalLabel">Update Menu</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="updateForm">
                            <input type="hidden" id="update_id" name="update_id">
                            <div class="mb-3">
                                <label for="update_menu_name" class="form-label">Menu Name:</label>
                                <input type="text" class="form-control" id="update_menu_name" name="update_menu_name" required maxlength="100">
                            </div>
                            <div class="mb-3">
                                <label for="update_menu_desc" class="form-label">Menu Description:</label>
                                <textarea class="form-control" id="update_menu_desc" name="update_menu_desc" required maxlength="1000"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="update_price" class="form-label">Price:</label>
                                <input type="number" class="form-control" id="update_price" name="update_price" required min="0" step="0.01">
                            </div>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.5/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    $(document).ready(function () {
        $('#menuForm').submit(function (e) {
            e.preventDefault();

            const menuName = $('#menu_name').val();
            const menuDesc = $('#menu_desc').val();
            const price = $('#price').val();

            if (menuName === '' || menuDesc === '' || price === '') {
                Swal.fire('Warning', 'All fields are required!', 'warning');
                return;
            }
            
            $.ajax({
              type: 'POST',
              url: 'connectdb.php',
              data: $(this).serialize(),
              dataType: 'json',
              success: function (data) {
                  if (data.status === 'success') {
                      Swal.fire('Success!', 'Menu was created! 🥳', 'success');
                      $('#menuForm')[0].reset();
                  } else {
                      Swal.fire('Error', data.message, 'error');
                  }
              },
              error: function (jqXHR, textStatus, errorThrown) {
                  if (jqXHR.responseJSON) {
                      Swal.fire('Error', jqXHR.responseJSON.message, 'error');
                  } else {
                      Swal.fire('Error', 'Could not send the data. Please try again later.', 'error');
                  }
              }
          });
        });
        
        $('#price').on('input', function () {
            var allowedKeys = [46, 8, 9, 27, 13, 110, 190];
            if (allowedKeys.indexOf(event.keyCode) !== -1 ||
                (event.keyCode === 65 && (event.ctrlKey === true || event.metaKey === true)) ||
                (event.keyCode >= 35 && event.keyCode <= 40)) {
                return;
            }
            
            if ((event.shiftKey || (event.keyCode < 48 || event.keyCode > 57)) && 
                (event.keyCode < 96 || event.keyCode > 105)) {
                event.preventDefault();
            }
        });
                $('.editBtn').click(function() {
                const id = $(this).data('id');
                $.ajax({
                    url: 'getMenuDetails.php',
                    type: 'GET',
                    data: { id: id },
                    dataType: 'json',
                    success: function(data) {
                        if(data.status !== 'error') {
                            $('#update_id').val(data.id);
                            $('#update_menu_name').val(data.menu_name);
                            $('#update_menu_desc').val(data.menu_desc);
                            $('#update_price').val(data.price);
                            $('#updateModal').modal('show');
                        } else {
                            Swal.fire('Error', 'Could not fetch menu details.', 'error');
                        }
                    }
                });
            });

            $('#updateForm').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: 'updateMenuAction.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(data) {
                        if(data.status === 'success') {
                            Swal.fire('Success', 'Menu updated successfully!', 'success');
                            location.reload(); 
                        } else {
                            Swal.fire('Error', 'Could not update menu.', 'error');
                        }
                    }
                });
            });

            $('.deleteBtn').click(function() {
                const id = $(this).data('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if(result.isConfirmed) {
                        $.ajax({
                            url: 'deleteMenuAction.php',
                            type: 'POST',
                            data: { id: id },
                            dataType: 'json',
                            success: function(data) {
                                if(data.status === 'success') {
                                    Swal.fire('Deleted!', 'Menu has been deleted.', 'success');
                                    location.reload(); 
                                } else {
                                    Swal.fire('Error', 'Could not delete menu.', 'error');
                                }
                            }
                        });
                    }
                });
            });
        });
    </script>
</body>
</html>