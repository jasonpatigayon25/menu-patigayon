<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.5/dist/sweetalert2.min.css">
    <style>
        body {
            background-color: lightyellow;
        }
        .container {
            margin-top: 50px;
        }
        h1 {
            color: #333366;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="panel panel-primary">
                    <div class="text-center">
                        <h1>Registration Form</h1>
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
                                <input type="text" class="form-control" id="price" name="price" required>
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.5/dist/sweetalert2.all.min.js"></script>
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
                  if (jqXHR.responseJSON) {  // Check if server sent specific message
                      Swal.fire('Error', jqXHR.responseJSON.message, 'error');
                  } else {
                      Swal.fire('Error', 'Could not send the data. Please try again later.', 'error');
                  }
              }
          });
        });
    });
    </script>
</body>
</html>
