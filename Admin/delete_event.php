<?php require '../Admin/connection.php';?>

<?php
if(isset($_GET['event_id'])) {
    $event_id = $_GET['event_id'];

    $delete_query = "DELETE FROM events WHERE event_id ='$event_id'";
    if(mysqli_query($conn, $delete_query)) {
        echo "<script>alert('Event deleted successfully');</script>";
        echo "<script>window.location.href = 'AdminEvents.php';</script>";
    } else {
        echo "Error deleting staff: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>