<?php require '../Admin/connection.php';  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Turf</title>
    <link rel="stylesheet" href="\TurfTrack\style.css">
    <link rel="stylesheet" href="\TurfTrack\CommonFiles\bootstap.css">
    <link rel="stylesheet" href="\TurfTrack\CommonFiles\adminstaffstyles.css">
    <link rel="icon" href="\TurfTrack\images\icon.png" type="image/x-icon">
    <link rel="stylesheet" href="\TurfTrack\CommonFiles\Modalpopupstyle.css">
    <link rel="stylesheet" href="\TurfTrack\CommonFiles\css\all.min.css">
    <link rel="stylesheet" href="\TurfTrack\CommonFiles\css\fontawesome.min.css">
</head>
<body>
<?php
if (isset($_GET['turf_id'])) {
    $turf_id = $_GET['turf_id'];
    $sql = "SELECT * FROM turfground WHERE turf_id ='$turf_id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
?>
        <div class="modal-content">
                          <div class="modal-header">
                            <h6>TURF</h6>
                             <span id="ModalClose">&times;</span>
                          </div>
                          <div class="modal-body">
                          <form method="post" id="EditTurfForm" enctype="multipart/form-data"> 
                            <div class="form-outline mb-4">
                                <label class="form-label" for="form3Example9"
                                  >Name&nbsp;<span class="required">*</span></label
                                >
                                <input
                                  type="text"
                                  id="name" name="name"
                                  class="form-control form-control-lg" value="<?php echo $row["turf_name"] ?>"
                               required />
                              </div>
                              <div class="form-group">
                                <label for="description">Description<span class="required">*</span></label>
                                <textarea id="description" name="description" class="form-control" required rows="4"><?php echo $row["description"]  ?></textarea>
                            </div>
                              
                              <input type="file" name="images" id="images" accept=".jpg, .jpeg, .png" >
                              <div class="btn-container">
                                    <button class="btn btn-primary btn-lg" id="updateTurf" name="updateTurf">SUBMIT</button>
                                  </div>
                          </form>
                          </div>
        </div>
<?php 
 if (isset($_POST['updateTurf'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    // Check if a new image was uploaded
    if ($_FILES['images']['size'] > 0) {
        $new_image = addslashes(file_get_contents($_FILES['images']['tmp_name']));
        $update_sql = "UPDATE turfground SET turf_name = '$name', description = '$description', images = '$new_image' WHERE turf_id = $turf_id";
    } else {
        // No new image uploaded, keep the existing image
        $update_sql = "UPDATE turfground SET turf_name = '$name', description = '$description' WHERE turf_id = $turf_id";
    }
    
    if ($conn->query($update_sql) === TRUE) {
        echo "Turf updated successfully";
        echo "<script>window.location.href = 'AdminTurf.php';</script>";
    } else {
        echo "Error updating Game: " . $conn->error;
    }
}


    }
    } else {
        echo "Error fetching Turf: " . mysqli_error($conn);
    }
}
mysqli_close($conn);
?>
</body>
</html>