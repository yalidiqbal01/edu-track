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
$today = date("Y-m-d");

// Total Assignments
$total_query = mysqli_query($conn,
"SELECT COUNT(*) AS total
FROM assignments
WHERE user_id='$user_id'");
$total = mysqli_fetch_assoc($total_query)['total'];

// Pending Assignments
$pending_query = mysqli_query($conn,
"SELECT COUNT(*) AS pending
FROM assignments
WHERE user_id='$user_id'
AND status='Pending'");
$pending = mysqli_fetch_assoc($pending_query)['pending'];

// Completed Assignments
$completed_query = mysqli_query($conn,
"SELECT COUNT(*) AS completed
FROM assignments
WHERE user_id='$user_id'
AND status='Completed'");
$completed = mysqli_fetch_assoc($completed_query)['completed'];

// Overdue Assignments
$overdue_query = mysqli_query($conn,
"SELECT COUNT(*) AS overdue
FROM assignments
WHERE user_id='$user_id'
AND status='Pending'
AND due_date<'$today'");
$overdue = mysqli_fetch_assoc($overdue_query)['overdue'];

// High Priority
$high_query = mysqli_query($conn,
"SELECT COUNT(*) AS high_count
FROM assignments
WHERE user_id='$user_id'
AND priority='High'");
$high = mysqli_fetch_assoc($high_query)['high_count'];

// Medium Priority
$medium_query = mysqli_query($conn,
"SELECT COUNT(*) AS medium_count
FROM assignments
WHERE user_id='$user_id'
AND priority='Medium'");
$medium = mysqli_fetch_assoc($medium_query)['medium_count'];

// Low Priority
$low_query = mysqli_query($conn,
"SELECT COUNT(*) AS low_count
FROM assignments
WHERE user_id='$user_id'
AND priority='Low'");
$low = mysqli_fetch_assoc($low_query)['low_count'];
?>

<div class="container mt-5">

    <h2 class="mb-2">
        Welcome, <?php echo $_SESSION['full_name']; ?> 👋
    </h2>

    <p class="text-muted">
        Manage all your assignments from one place.
    </p>

    <?php if($overdue > 0){ ?>

        <div class="alert alert-danger">

            <strong>⚠ Warning!</strong>

            You have
            <strong><?php echo $overdue; ?></strong>
            overdue assignment(s).

        </div>

    <?php } ?>

    <!-- First Row -->

    <div class="row mt-4">

        <div class="col-md-4 mb-3">

            <div class="card shadow text-center border-primary">

                <div class="card-body">

                    <h5>📚 Total Assignments</h5>

                    <h1><?php echo $total; ?></h1>

                </div>

            </div>

        </div>

        <div class="col-md-4 mb-3">

            <div class="card shadow text-center border-warning">

                <div class="card-body">

                    <h5>🟡 Pending</h5>

                    <h1 class="text-warning">
                        <?php echo $pending; ?>
                    </h1>

                </div>

            </div>

        </div>

        <div class="col-md-4 mb-3">

            <div class="card shadow text-center border-success">

                <div class="card-body">

                    <h5>🟢 Completed</h5>

                    <h1 class="text-success">
                        <?php echo $completed; ?>
                    </h1>

                </div>

            </div>

        </div>

    </div>

    <!-- Second Row -->

    <div class="row">

        <div class="col-md-4 mb-3">

            <div class="card shadow text-center border-danger">

                <div class="card-body">

                    <h5>🔴 High Priority</h5>

                    <h1 class="text-danger">
                        <?php echo $high; ?>
                    </h1>

                </div>

            </div>

        </div>

        <div class="col-md-4 mb-3">

            <div class="card shadow text-center border-warning">

                <div class="card-body">

                    <h5>🟡 Medium Priority</h5>

                    <h1 class="text-warning">
                        <?php echo $medium; ?>
                    </h1>

                </div>

            </div>

        </div>

        <div class="col-md-4 mb-3">

            <div class="card shadow text-center border-success">

                <div class="card-body">

                    <h5>🟢 Low Priority</h5>

                    <h1 class="text-success">
                        <?php echo $low; ?>
                    </h1>

                </div>

            </div>

        </div>

    </div>

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

<?php include("includes/footer.php"); ?>