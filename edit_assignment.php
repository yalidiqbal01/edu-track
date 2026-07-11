<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include("includes/db.php");

$message = "";

$id = $_GET['id'];

$sql = "SELECT * FROM assignments WHERE id='$id'";
$result = mysqli_query($conn, $sql);
$assignment = mysqli_fetch_assoc($result);

if(isset($_POST['update_assignment']))
{
    $title = $_POST['title'];
    $subject = $_POST['subject'];
    $due_date = $_POST['due_date'];
    $status = $_POST['status'];

    $update = "UPDATE assignments
               SET title='$title',
                   subject='$subject',
                   due_date='$due_date',
                   status='$status'
               WHERE id='$id'";

    if(mysqli_query($conn,$update))
    {
        header("Location: view_assignments.php");
        exit();
    }
    else
    {
        $message="<div class='alert alert-danger'>".mysqli_error($conn)."</div>";
    }
}

include("includes/header.php");
include("includes/navbar.php");
?>

<div class="container mt-5">

<?php echo $message; ?>

<div class="card shadow">

<div class="card-header bg-warning">
<h3>Edit Assignment</h3>
</div>

<div class="card-body">

<form method="POST">

<div class="mb-3">
<label>Assignment Title</label>
<input
type="text"
name="title"
class="form-control"
value="<?php echo $assignment['title']; ?>"
required>
</div>

<div class="mb-3">
<label>Subject</label>
<input
type="text"
name="subject"
class="form-control"
value="<?php echo $assignment['subject']; ?>"
required>
</div>

<div class="mb-3">
<label>Due Date</label>
<input
type="date"
name="due_date"
class="form-control"
value="<?php echo $assignment['due_date']; ?>"
required>
</div>

<div class="mb-3">

<label>Status</label>

<select
name="status"
class="form-control">

<option value="Pending"
<?php if($assignment['status']=="Pending") echo "selected"; ?>>
Pending
</option>

<option value="Completed"
<?php if($assignment['status']=="Completed") echo "selected"; ?>>
Completed
</option>

</select>

</div>

<button
type="submit"
name="update_assignment"
class="btn btn-warning">

Update Assignment

</button>

</form>

</div>

</div>

</div>

<?php include("includes/footer.php"); ?>