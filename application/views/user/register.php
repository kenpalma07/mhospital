<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-4">
    <!-- Corrected Form -->
    <?php echo form_open('user/register', ['id' => 'registerForm', 'method' => 'post']); ?>
        <div class="row">
            <div class="col-md-4 col-sm-6 mx-auto">
                <div class="card shadow border-success">
                    <div class="card-body p-3">
                        <h5 class="card-title text-center mb-3">Register</h5>

                        <div class="mb-2">
                            <label for="first_name" class="form-label small">First Name:</label>
                            <input type="text" class="form-control form-control-sm" id="first_name" name="firstname" required>
                        </div>

                        <div class="mb-2">
                            <label for="last_name" class="form-label small">Last Name:</label>
                            <input type="text" class="form-control form-control-sm" id="last_name" name="lastname" required>
                        </div>

                        <div class="mb-2">
                            <label for="email" class="form-label small">Email:</label>
                            <input type="email" class="form-control form-control-sm" id="email" name="email" required>
                        </div>

                        <div class="mb-2">
                            <label for="username" class="form-label small">Username:</label>
                            <input type="text" class="form-control form-control-sm" id="username" name="username" required>
                        </div>

                        <div class="mb-2">
                            <label for="password" class="form-label small">Password:</label>
                            <input type="password" class="form-control form-control-sm" id="password" name="password" required>
                        </div>

                        <div class="mb-2">
                            <label for="confirm_password" class="form-label small">Confirm Password:</label>
                            <input type="password" class="form-control form-control-sm" id="confirm_password" required>
                            <small id="passwordError" class="text-danger d-none">Passwords do not match!</small>
                        </div>

                        <div class="d-flex justify-content-between mt-3">
                            <button type="button" class="btn btn-danger btn-sm">Cancel</button>
                            <button type="submit" class="btn btn-success btn-sm">Submit</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    <?php echo form_close(); ?>
</div>

<!-- JavaScript for Password Validation -->
<script>
    document.getElementById("registerForm").addEventListener("submit", function (event) {
        var password = document.getElementById("password").value;
        var confirmPassword = document.getElementById("confirm_password").value;
        var passwordError = document.getElementById("passwordError");

        if (password !== confirmPassword) {
            passwordError.classList.remove("d-none"); // Show error message
            event.preventDefault(); // Prevent form submission
        } else {
            passwordError.classList.add("d-none"); // Hide error if matches
        }
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
