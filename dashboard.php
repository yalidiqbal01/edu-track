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

// Total Assignments
$total_query = mysqli_query($conn, "SELECT COUNT(*) AS total FROM assignments WHERE user_id='$user_id'");
$total = mysqli_fetch_assoc($total_query)['total'];

// Pending
$pending_query = mysqli_query($conn, "SELECT COUNT(*) AS pending FROM assignments WHERE user_id='$user_id' AND status='Pending'");
$pending = mysqli_fetch_assoc($pending_query)['pending'];

// Completed
$completed_query = mysqli_query($conn, "SELECT COUNT(*) AS completed FROM assignments WHERE user_id='$user_id' AND status='Completed'");
$completed = mysqli_fetch_assoc($completed_query)['completed'];

// Overdue
$today = date("Y-m-d");

$overdue_query = mysqli_query($conn, "
SELECT COUNT(*) AS overdue
FROM assignments
WHERE user_id='$user_id'
AND status='Pending'
AND due_date<'$today'
");

$overdue = mysqli_fetch_assoc($overdue_query)['overdue'];

// Recent Assignments
$recent_query = mysqli_query($conn,"
SELECT *
FROM assignments
WHERE user_id='$user_id'
ORDER BY due_date ASC
LIMIT 5
");
?>

<div class="container mt-5">

    <h2 class="mb-2">
        Welcome, <?php echo $_SESSION['full_name']; ?> 👋
    </h2>

    <p class="text-muted">
        Manage all your assignments from one place.
    </p>

    <?php if($overdue>0){ ?>

        <div class="alert alert-danger">
            ⚠️ You have
            <strong><?php echo $overdue; ?></strong>
            overdue assignment(s)!
        </div>

    <?php } ?>

    <div class="row mt-4">

        <div class="col-md-3 mb-3">

            <div class="card shadow text-center">

                <div class="card-body">

                    <h5>Total</h5>

                    <h2><?php echo $total; ?></h2>

                </div>

            </div>

        </div>

        <div class="col-md-3 mb-3">

            <div class="card shadow text-center">

                <div class="card-body">

                    <h5>Pending</h5>

                    <h2 class="text-warning">
                        <?php echo $pending; ?>
                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-3 mb-3">

            <div class="card shadow text-center">

                <div class="card-body">

                    <h5>Completed</h5>

                    <h2 class="text-success">
                        <?php echo $completed; ?>
                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-3 mb-3">

            <div class="card shadow text-center">

                <div class="card-body">

                    <h5>Overdue</h5>

                    <h2 class="text-danger">
                        <?php echo $overdue; ?>
                    </h2>

                </div>

            </div>

        </div>

    </div>

    <div class="mt-4 mb-4">

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

    <div class="card shadow">

        <div class="card-header bg-dark text-white">

            <h4 class="mb-0">
                📌 Upcoming Assignments
            </h4>

        </div>

        <div class="card-body">

            <table class="table table-hover">

                <thead>

                    <tr>

                        <th>Title</th>
                        <th>Subject</th>
                        <th>Priority</th>
                        <th>Due Date</th>

                    </tr>

                </thead>

                <tbody>

                <?php

                if(mysqli_num_rows($recent_query)>0)
                {

                    while($row=mysqli_fetch_assoc($recent_query))
                    {

                ?>

                    <tr>

                        <td><?php echo $row['title']; ?></td>

                        <td><?php echo $row['subject']; ?></td>

                        <td>

                        <?php

                        if($row['priority']=="High")
                        {
                            echo "<span class='badge bg-danger'>High</span>";
                        }
                        elseif($row['priority']=="Medium")
                        {
                            echo "<span class='badge bg-warning text-dark'>Medium</span>";
                        }
                        else
                        {
                            echo "<span class='badge bg-success'>Low</span>";
                        }

                        ?>

                        </td>

                        <td><?php echo $row['due_date']; ?></td>

                    </tr>

                <?php

                    }

                }
                else
                {

                    echo "<tr>
                    <td colspan='4' class='text-center'>
                    No assignments available.
                    </td>
                    </tr>";

                }

                ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<?php include("includes/footer.php"); ?>