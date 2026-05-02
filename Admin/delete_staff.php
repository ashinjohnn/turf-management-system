<?php require '../Admin/connection.php';?>

<?php
if(isset($_GET['staff_id'])) {
    $staff_id = $_GET['staff_id'];

    $delete_query = "DELETE FROM staff WHERE staff_id ='$staff_id'";
    if(mysqli_query($conn, $delete_query)) {
        echo "<script>alert('Staff deleted successfully');</script>";
        echo "<script>window.location.href = 'AdminStaff.php';</script>";
    } else {
        echo "Error deleting staff: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>