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

        <p>You have successfully logged in to EDU Track.</p>

        <hr>

        <p><strong>Email:</strong> <?php echo $_SESSION['email']; ?></p>

        <p><strong>User ID:</strong> <?php echo $_SESSION['user_id']; ?></p>

    </div>

</div>

<?php include("includes/footer.php"); ?>