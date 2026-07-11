<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include("includes/db.php");

$message = "";

$id = $_GET['id'];
$user_id = $_SESSION['user_id'];

// Load assignment (only logged-in user's assignment)
$sql = "SELECT * FROM assignments
        WHERE id='$id' AND user_id='$user_id'";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
    header("Location: view_assignments.php");
    exit();
}

$assignment = mysqli_fetch_assoc($result);

if (isset($_POST['update_assignment'])) {

    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $due_date = $_POST['due_date'];
    $priority = $_POST['priority'];
    $status = $_POST['status'];

    $update = "UPDATE assignments
               SET
                    title='$title',
                    subject='$subject',
                    due_date='$due_date',
                    priority='$priority',
                    status='$status'
               WHERE id='$id'
               AND user_id='$user_id'";

    if (mysqli_query($conn, $update)) {

        header("Location: view_assignments.php");
        exit();

    } else {

        $message = "<div class='alert alert-danger'>"
                    . mysqli_error($conn) .
                    "</div>";

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

                    <label class="form-label">
                        Assignment Title
                    </label>

                    <input
                        type="text"
                        name="title"
                        class="form-control"
                        value="<?php echo $assignment['title']; ?>"
                        required>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Subject
                    </label>

                    <input
                        type="text"
                        name="subject"
                        class="form-control"
                        value="<?php echo $assignment['subject']; ?>"
                        required>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Due Date
                    </label>

                    <input
                        type="date"
                        name="due_date"
                        class="form-control"
                        value="<?php echo $assignment['due_date']; ?>"
                        required>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Priority
                    </label>

                    <select
                        name="priority"
                        class="form-select"
                        required>

                        <option value="High"
                        <?php if($assignment['priority']=="High") echo "selected"; ?>>
                            🔴 High
                        </option>

                        <option value="Medium"
                        <?php if($assignment['priority']=="Medium") echo "selected"; ?>>
                            🟡 Medium
                        </option>

                        <option value="Low"
                        <?php if($assignment['priority']=="Low") echo "selected"; ?>>
                            🟢 Low
                        </option>

                    </select>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Status
                    </label>

                    <select
                        name="status"
                        class="form-select">

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

                <a href="view_assignments.php"
                   class="btn btn-secondary">

                    Cancel

                </a>

            </form>

        </div>

    </div>

</div>

<?php include("includes/footer.php"); ?>