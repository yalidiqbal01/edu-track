<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include("includes/db.php");

$message = "";

if(isset($_POST['add_assignment']))
{
    $user_id = $_SESSION['user_id'];
    $title = $_POST['title'];
    $subject = $_POST['subject'];
    $due_date = $_POST['due_date'];

    $sql = "INSERT INTO assignments(user_id, title, subject, due_date)
            VALUES('$user_id','$title','$subject','$due_date')";

    if(mysqli_query($conn, $sql))
    {
        $message = "<div class='alert alert-success'>Assignment Added Successfully!</div>";
    }
    else
    {
        $message = "<div class='alert alert-danger'>".mysqli_error($conn)."</div>";
    }
}

include("includes/header.php");
include("includes/navbar.php");
?>

<div class="container mt-5">

    <?php echo $message; ?>

    <div class="card shadow">

        <div class="card-header bg-primary text-white">
            <h3>Add Assignment</h3>
        </div>

        <div class="card-body">

            <form method="POST">

                <div class="mb-3">
                    <label>Assignment Title</label>
                    <input type="text" name="title" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Subject</label>
                    <input type="text" name="subject" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Due Date</label>
                    <input type="date" name="due_date" class="form-control" required>
                </div>

                <button
                    type="submit"
                    name="add_assignment"
                    class="btn btn-primary">
                    Add Assignment
                </button>

            </form>

        </div>

    </div>

</div>

<?php include("includes/footer.php"); ?>