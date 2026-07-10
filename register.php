<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include("includes/db.php");

$message = "";

if (isset($_POST['register'])) {

    $full_name = trim($_POST['full_name']);
    $student_id = trim($_POST['student_id']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check password match
    if ($password != $confirm_password) {

        $message = "<div class='alert alert-danger'>Passwords do not match!</div>";

    } else {

        // Check duplicate Email or Student ID
        $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' OR student_id='$student_id'");

        if (mysqli_num_rows($check) > 0) {

            $message = "<div class='alert alert-warning'>Email or Student ID already exists!</div>";

        } else {

            // Hash password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert data
            $sql = "INSERT INTO users (full_name, student_id, email, password)
                    VALUES ('$full_name', '$student_id', '$email', '$hashed_password')";

            if (mysqli_query($conn, $sql)) {

                $message = "<div class='alert alert-success'>Registration Successful!</div>";

            } else {

                $message = "<div class='alert alert-danger'>Database Error: " . mysqli_error($conn) . "</div>";

            }
        }
    }
}

?>

<?php include("includes/header.php"); ?>
<?php include("includes/navbar.php"); ?>

<div class="container mt-5">

    <?php echo $message; ?>

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card shadow">

                <div class="card-header bg-primary text-white text-center">
                    <h3>Student Registration</h3>
                </div>

                <div class="card-body">

                    <form method="POST" action="">

                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input
                                type="text"
                                name="full_name"
                                class="form-control"
                                placeholder="Enter your full name"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Student ID</label>
                            <input
                                type="text"
                                name="student_id"
                                class="form-control"
                                placeholder="2210XXXX"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                placeholder="student@iub.edu.bd"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                placeholder="Enter password"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Confirm Password</label>
                            <input
                                type="password"
                                name="confirm_password"
                                class="form-control"
                                placeholder="Confirm password"
                                required>
                        </div>

                        <button
                            type="submit"
                            name="register"
                            class="btn btn-primary w-100">
                            Register
                        </button>

                    </form>

                    <div class="text-center mt-3">
                        Already have an account?
                        <a href="login.php">Login</a>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<?php include("includes/footer.php"); ?>