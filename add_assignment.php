<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include("includes/db.php");

$message = "";

if (isset($_POST['add_assignment'])) {

    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $due_date = $_POST['due_date'];
    $priority = $_POST['priority'];
    $status = $_POST['status'];

    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO assignments
            (user_id, title, subject, due_date, priority, status)
            VALUES
            ('$user_id', '$title', '$subject', '$due_date', '$priority', '$status')";

    if (mysqli_query($conn, $sql)) {

        header("Location: view_assignments.php");
        exit();

    } else {

        $message = "<div class='alert alert-danger'>
                        ".mysqli_error($conn)."
                    </div>";
    }
}

include("includes/header.php");
include("includes/navbar.php");
?>

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-7">

            <div class="card shadow">

                <div class="card-header bg-primary text-white">

                    <h3>Add Assignment</h3>

                </div>

                <div class="card-body">

                    <?php echo $message; ?>

                    <form method="POST">

                        <div class="mb-3">

                            <label class="form-label">
                                Assignment Title
                            </label>

                            <input
                                type="text"
                                name="title"
                                class="form-control"
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

                                <option value="High">
                                    🔴 High
                                </option>

                                <option value="Medium" selected>
                                    🟡 Medium
                                </option>

                                <option value="Low">
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

                                <option value="Pending">
                                    Pending
                                </option>

                                <option value="Completed">
                                    Completed
                                </option>

                            </select>

                        </div>

                        <button
                            type="submit"
                            name="add_assignment"
                            class="btn btn-primary">

                            Save Assignment

                        </button>

                        <a href="view_assignments.php"
                           class="btn btn-secondary">

                            Cancel

                        </a>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<?php include("includes/footer.php"); ?>