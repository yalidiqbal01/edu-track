<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include("includes/db.php");

if (isset($_GET['id'])) {

    $id = $_GET['id'];
    $user_id = $_SESSION['user_id'];

    // Delete only the logged-in user's assignment
    $sql = "DELETE FROM assignments WHERE id='$id' AND user_id='$user_id'";

    if (mysqli_query($conn, $sql)) {
        header("Location: view_assignments.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    header("Location: view_assignments.php");
    exit();
}
?>