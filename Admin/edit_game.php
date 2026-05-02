<?php require '../Admin/connection.php';  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Game</title>
    <link rel="stylesheet" href="\TurfTrack\style.css">
    <link rel="stylesheet" href="\TurfTrack\CommonFiles\bootstap.css">
    <link rel="stylesheet" href="\TurfTrack\CommonFiles\adminstaffstyles.css">
    <link rel="stylesheet" href="\TurfTrack\CommonFiles\Modalpopupstyle.css">
    <link rel="icon" href="\TurfTrack\images\icon.png" type="image/x-icon">
    <link rel="stylesheet" href="\TurfTrack\CommonFiles\css\all.min.css">
    <link rel="stylesheet" href="\TurfTrack\CommonFiles\css\fontawesome.min.css">
</head>
<body>
<?php
if (isset($_GET['game_id'])) {
    $game_id = $_GET['game_id'];
    $sql = "SELECT * FROM game WHERE game_id ='$game_id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
?>
<div class="modal-content">
                              <div class="modal-header">
                                <h6>EDIT GAME</h6>
                                 <span id="ModalClose">&times;</span>
                              </div>
                              <div class="modal-body">
                                <form method="post" id="EditGameForm" enctype="multipart/form-data">
                                <div class="form-group">
                                  <label for="name">Game Name <span class="required">*</span></label>
                                  <input type="text" id="name" name="name" class="form-control" value="<?php echo $row["game_name"]  ?>" required />
                                </div>
                                  <div class="form-group">
                                    <label for="Description">Description<span class="required">*</span></label>
                                    <textarea id="Description" name="Description" class="form-control" required rows="4" required><?php echo $row["description"]  ?></textarea>
                                </div>
                                <div class="form-group">
                                  <label for="price_per_hour">Price Per Hour<span class="required">*</span></label>
                                  <input type="number" id="price_per_hour" name="price_per_hour" class="form-control" value="<?php echo $row["price_per_hour"]  ?>" required />
                                </div>
                                <div class="form-group">
                                  <label for="SelectTurf">Select Turf <span class="required">*</span></label>
                                  <select id="SelectTurf" name="SelectTurf" class="form-control" required>
                                    <option value="<?php echo $row["turf_id"]  ?>" >Change Turf</option>
                                    <?php
                               
                               require '../Admin/connection.php';
                                    
                                    $sql = "SELECT * FROM turfground";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                      while ($turfs = $result->fetch_assoc()) {
                                        echo "<option value=" . $turfs["turf_id"] . ">" . $turfs["turf_name"] . "</option>";
                                      }
                                    }
                                   
                                    ?>
                                  </select>
                                </div>
                                  <input type="file" name="images" id="images" accept=".jpg, .jpeg, .png">
                                  <div class="btn-container">
                                    <button class="btn btn-primary btn-lg" id="updateGame" name="updateGame">SUBMIT</button>
                                  </div>
                            
                                </form>
      
      
      
                              </div>
            </div>
      <?php
      if (isset($_POST['updateGame'])) {
          $name = $_POST['name'];
          $Description = $_POST['Description'];
          $price_per_hour = $_POST['price_per_hour'];
          $turf = $_POST['SelectTurf'];
          // Check if a new image was uploaded
          if ($_FILES['images']['size'] > 0) {
              $new_image = addslashes(file_get_contents($_FILES['images']['tmp_name']));
              $update_sql = "UPDATE game SET game_name = '$name', description = '$Description',turf_id='$turf', price_per_hour = '$price_per_hour', images = '$new_image' WHERE game_id = $game_id";
          } else {
              // No new image uploaded, keep the existing image
              $update_sql = "UPDATE game SET game_name = '$name', description = '$Description',turf_id='$turf', price_per_hour = '$price_per_hour' WHERE game_id = $game_id";
          }
          
          if ($conn->query($update_sql) === TRUE) {
              echo "Game updated successfully";
              echo "<script>window.location.href = 'AdminGames.php';</script>";
          } else {
              echo "Error updating Game: " . $conn->error;
          }
      }

      
        }
    } else {
        echo "Error fetching game: " . mysqli_error($conn);
    }
}
mysqli_close($conn);
?>
</body>
</html>