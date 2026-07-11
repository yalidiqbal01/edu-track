<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include("includes/db.php");
include("includes/header.php");
include("includes/navbar.php");

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM assignments WHERE user_id='$user_id' ORDER BY due_date ASC";
$result = mysqli_query($conn, $sql);
?>

<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>📚 My Assignments</h2>

        <a href="add_assignment.php" class="btn btn-primary">
            ➕ Add Assignment
        </a>

    </div>

    <table class="table table-bordered table-hover shadow">

        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Subject</th>
                <th>Due Date</th>
                <th>Status</th>
                <th width="180">Actions</th>
            </tr>
        </thead>

        <tbody>

        <?php if(mysqli_num_rows($result) > 0) { ?>

            <?php while($row = mysqli_fetch_assoc($result)) { ?>

                <tr>

                    <td><?php echo $row['id']; ?></td>

                    <td><?php echo $row['title']; ?></td>

                    <td><?php echo $row['subject']; ?></td>

                    <td><?php echo $row['due_date']; ?></td>

                    <td>
                        <?php if($row['status'] == "Pending") { ?>
                            <span class="badge bg-warning text-dark">Pending</span>
                        <?php } else { ?>
                            <span class="badge bg-success">Completed</span>
                        <?php } ?>
                    </td>

                    <td>

                        <a href="edit_assignment.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">
                            Edit
                        </a>

                        <a href="delete_assignment.php?id=<?php echo $row['id']; ?>"
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Are you sure you want to delete this assignment?');">
                           Delete
                        </a>

                    </td>

                </tr>

            <?php } ?>

        <?php } else { ?>

            <tr>
                <td colspan="6" class="text-center">
                    No assignments found.
                </td>
            </tr>

        <?php } ?>

        </tbody>

    </table>

</div>

<?php include("includes/footer.php"); ?>