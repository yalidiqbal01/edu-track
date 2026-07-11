<?php
session_start();
include("includes/db.php");

$message = "";

if (isset($_POST['login'])) {

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Find user by email
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if (!$result) {

        $message = "<div class='alert alert-danger'>Database Error: " . mysqli_error($conn) . "</div>";

    } elseif (mysqli_num_rows($result) == 1) {

        $user = mysqli_fetch_assoc($result);

        // Verify password
        if (password_verify($password, $user['password'])) {

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['full_name'] = $user['full_name'];
            $_SESSION['email'] = $user['email'];

            // Redirect to Dashboard
            header("Location: dashboard.php");
            exit();

        } else {

            $message = "<div class='alert alert-danger'>Incorrect Password!</div>";

        }

    } else {

        $message = "<div class='alert alert-danger'>User not found!</div>";

    }

}
?>

<?php include("includes/header.php"); ?>
<?php include("includes/navbar.php"); ?>

<div class="container mt-5">

    <?php echo $message; ?>

    <div class="row justify-content-center">

        <div class="col-md-5">

            <div class="card shadow">

                <div class="card-header bg-success text-white text-center">
                    <h3>Student Login</h3>
                </div>

                <div class="card-body">

                    <form method="POST">

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                placeholder="Enter your email"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                placeholder="Enter your password"
                                required>
                        </div>

                        <button
                            type="submit"
                            name="login"
                            class="btn btn-success w-100">
                            Login
                        </button>

                    </form>

                    <div class="text-center mt-3">
                        Don't have an account?
                        <a href="register.php">Register</a>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<?php include("includes/footer.php"); ?>