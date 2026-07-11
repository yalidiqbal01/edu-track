<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include("includes/header.php");
include("includes/navbar.php");
?>

<div class="container mt-5">

    <div class="alert alert-success shadow">

        <h2>Welcome, <?php echo $_SESSION['full_name']; ?> 👋</h2>

        <p>You have successfully logged in to <strong>EDU Track</strong>.</p>

        <hr>

        <p><strong>Email:</strong> <?php echo $_SESSION['email']; ?></p>

        <p><strong>User ID:</strong> <?php echo $_SESSION['user_id']; ?></p>

        <div class="mt-4">

            <a href="add_assignment.php" class="btn btn-primary">
                ➕ Add Assignment
            </a>

            <a href="view_assignments.php" class="btn btn-success">
                📚 View Assignments
            </a>

            <a href="logout.php" class="btn btn-danger">
                🚪 Logout
            </a>

        </div>

    </div>

</div>

<?php include("includes/footer.php"); ?>