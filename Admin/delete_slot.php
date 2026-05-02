<?php require '../Admin/connection.php';?>

<?php
if(isset($_GET['slot_id'])) {
    $slot_id = $_GET['slot_id'];

    $delete_query = "DELETE FROM slot WHERE slot_id ='$slot_id'";
    if(mysqli_query($conn, $delete_query)) {
        echo "<script>alert('Slot deleted successfully');</script>";
        echo "<script>window.location.href = 'AdminSlot.php';</script>";
    } else {
        echo "Error deleting staff: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>