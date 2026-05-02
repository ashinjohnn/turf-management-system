<?php require '../Admin/connection.php';?>

<?php
if(isset($_GET['turf_id'])) {
    $turf_id = $_GET['turf_id'];

    $delete_query = "DELETE FROM turfground WHERE turf_id ='$turf_id'";
    if(mysqli_query($conn, $delete_query)) {
        echo "<script>alert('Turf deleted successfully');</script>";
        echo "<script>window.location.href = 'AdminTurf.php';</script>";
    } else {
        echo "Error deleting Turf: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>