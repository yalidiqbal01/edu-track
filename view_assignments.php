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

// Search Feature
$search = "";

if (isset($_GET['search'])) {

    $search = mysqli_real_escape_string($conn, $_GET['search']);

    $sql = "SELECT *
            FROM assignments
            WHERE user_id='$user_id'
            AND (
                title LIKE '%$search%'
                OR subject LIKE '%$search%'
            )
            ORDER BY due_date ASC";

} else {

    $sql = "SELECT *
            FROM assignments
            WHERE user_id='$user_id'
            ORDER BY due_date ASC";
}

$result = mysqli_query($conn, $sql);

$today = date("Y-m-d");
?>

<div class="container mt-5">

    <h2 class="mb-4">📚 My Assignments</h2>

    <div class="row mb-4">

        <div class="col-md-8">

            <form method="GET">

                <div class="input-group">

                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        placeholder="Search by title or subject..."
                        value="<?php echo htmlspecialchars($search); ?>">

                    <button class="btn btn-primary">
                        🔍 Search
                    </button>

                </div>

            </form>

        </div>

        <div class="col-md-4 text-end">

            <a href="add_assignment.php" class="btn btn-success">
                ➕ Add Assignment
            </a>

        </div>

    </div>

    <table class="table table-bordered table-hover shadow">

        <thead class="table-dark">

            <tr>

                <th>ID</th>
                <th>Title</th>
                <th>Subject</th>
                <th>Due Date</th>
                <th>Status</th>
                <th width="200">Actions</th>

            </tr>

        </thead>

        <tbody>

        <?php if(mysqli_num_rows($result) > 0){ ?>

            <?php while($row = mysqli_fetch_assoc($result)){ ?>

                <tr>

                    <td><?php echo $row['id']; ?></td>

                    <td><?php echo $row['title']; ?></td>

                    <td><?php echo $row['subject']; ?></td>

                    <td><?php echo $row['due_date']; ?></td>

                    <td>

                        <?php

                        if($row['status'] == "Completed")
                        {
                            echo "<span class='badge bg-success'>Completed</span>";
                        }
                        elseif($row['due_date'] < $today)
                        {
                            echo "<span class='badge bg-danger'>Overdue</span>";
                        }
                        else
                        {
                            echo "<span class='badge bg-warning text-dark'>Pending</span>";
                        }

                        ?>

                    </td>

                    <td>

                        <a href="edit_assignment.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">
                            ✏️ Edit
                        </a>

                        <a href="delete_assignment.php?id=<?php echo $row['id']; ?>"
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Are you sure you want to delete this assignment?');">
                            🗑 Delete
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