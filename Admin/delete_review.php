<?php require '../Admin/connection.php';?>

<?php
if(isset($_GET['review_id'])) {
    $review_id = $_GET['review_id'];

    $delete_query = "DELETE FROM review WHERE review.review_id ='$review_id'";
    if(mysqli_query($conn, $delete_query)) {
        echo "Review deleted successfully";
        echo "<script>window.location.href = 'AdminReview.php';</script>";
    } else {
        echo "Error deleting review: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>