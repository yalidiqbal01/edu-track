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

// Search & Filter
$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : "";
$subject_filter = isset($_GET['subject']) ? mysqli_real_escape_string($conn, $_GET['subject']) : "";

// Load Subjects for Dropdown
$subject_query = mysqli_query($conn,
"SELECT DISTINCT subject
FROM assignments
WHERE user_id='$user_id'
ORDER BY subject ASC");

// Main Query
$sql = "SELECT *
FROM assignments
WHERE user_id='$user_id'";

if($search != "")
{
    $sql .= " AND (title LIKE '%$search%' OR subject LIKE '%$search%')";
}

if($subject_filter != "")
{
    $sql .= " AND subject='$subject_filter'";
}

$sql .= " ORDER BY due_date ASC";

$result = mysqli_query($conn,$sql);
?>

<div class="container mt-5">

<h2 class="mb-4">📚 My Assignments</h2>

<div class="row mb-4">

<div class="col-md-4">

<form method="GET">

<input
type="text"
name="search"
class="form-control"
placeholder="Search Assignment..."
value="<?php echo htmlspecialchars($search); ?>">

</div>

<div class="col-md-3">

<select
name="subject"
class="form-select">

<option value="">
All Subjects
</option>

<?php

while($subject=mysqli_fetch_assoc($subject_query))
{

$selected="";

if($subject_filter==$subject['subject'])
{
$selected="selected";
}

?>

<option
value="<?php echo $subject['subject']; ?>"
<?php echo $selected; ?>>

<?php echo $subject['subject']; ?>

</option>

<?php } ?>

</select>

</div>

<div class="col-md-2">

<button
class="btn btn-primary w-100">

🔍 Search

</button>

</div>

</form>

<div class="col-md-3 text-end">

<a
href="add_assignment.php"
class="btn btn-success">

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
<th>Priority</th>
<th>Due Date</th>
<th>Status</th>
<th width="200">Actions</th>

</tr>

</thead>

<tbody>

<?php

if(mysqli_num_rows($result)>0)
{

while($row=mysqli_fetch_assoc($result))
{

?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['title']; ?></td>

<td><?php echo $row['subject']; ?></td>

<td>

<?php

if($row['priority']=="High")
{
echo "<span class='badge bg-danger'>🔴 High</span>";
}
elseif($row['priority']=="Medium")
{
echo "<span class='badge bg-warning text-dark'>🟡 Medium</span>";
}
else
{
echo "<span class='badge bg-success'>🟢 Low</span>";
}

?>

</td>

<td>

<?php echo $row['due_date']; ?>

</td>

<td>

<?php

if($row['status']=="Completed")
{
echo "<span class='badge bg-success'>Completed</span>";
}
elseif($row['due_date']<$today)
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

<a
href="edit_assignment.php?id=<?php echo $row['id']; ?>"
class="btn btn-warning btn-sm">

✏️ Edit

</a>

<a
href="delete_assignment.php?id=<?php echo $row['id']; ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Delete this assignment?')">

🗑 Delete

</a>

</td>

</tr>

<?php

}

}
else
{

?>

<tr>

<td colspan="7" class="text-center">

No assignments found.

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

<?php include("includes/footer.php"); ?>