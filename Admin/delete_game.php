<?php require '../Admin/connection.php';?>

<?php
if(isset($_GET['game_id'])) {
    $game_id = $_GET['game_id'];

    $delete_query = "DELETE FROM game WHERE game_id ='$game_id'";
    if(mysqli_query($conn, $delete_query)) {
        echo "<script>alert('Game deleted successfully');</script>";
        echo "<script>window.location.href = 'AdminGames.php';</script>";
    } else {
        echo "Error deleting Game: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>