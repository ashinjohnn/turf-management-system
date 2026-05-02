<?php require '../Admin/connection.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EditStaff</title>
    <link rel="stylesheet" href="\TurfTrack\style.css" />
  <link rel="stylesheet" href="\TurfTrack\CommonFiles\bootstap.css" />
  <link rel="stylesheet" href="\TurfTrack\CommonFiles\adminstaffstyles.css" />
  <link rel="stylesheet" href="\TurfTrack\CommonFiles\Modalpopupstyle.css" />
  <link rel="icon" href="\TurfTrack\images\icon.png" type="image/x-icon" />
</head>
<body>


<?php
if (isset($_GET['event_id'])) {
    $event_id = $_GET['event_id'];
    $sql = "SELECT * FROM events WHERE event_id ='$event_id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
?>


<div class="staff-modal-content">
                          <div class="modal-header">
                            <h6>EDIT EVENT</h6>
                             
                          </div>
                          <div class="modal-body">
                          <form method="post" id="AddEventForm">
                          <div class="flexhalf">
                           <div class="form-container">
                          <div class="form-group">
                            <label for="name">Name <span class="required">*</span></label>
                            <input type="text" id="name" name="name" class="form-control" value="<?php echo $row["event_name"]  ?>" required />
                          </div>
                              <div class="form-group">
                                <label for="description">Description <span class="required">*</span></label>
                                <textarea id="description" name="description" class="form-control" required rows="4"><?php echo $row["description"]  ?></textarea>
                              </div>
                              <div class="form-group">
                                  <label for="selectGame">Game<span class="required">*</span></label>
                                  <select id="selectGame" name="selectGame" class="form-control">
                                    <option value="<?php echo $row["game_id"]  ?>">Change Game</option>
                                    <?php
                                  
                                  require '../Admin/connection.php';
                                        
                                        $sql = "SELECT * FROM game";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                          while ($game = $result->fetch_assoc()) {
                                            echo "<option value=" . $game["game_id"] . ">" . $game["game_name"] . "</option>";
                                          }
                                        }
                                      
                                        ?>
                                  </select>
                                </div>
                          </div>
                                <div class="form-container">
                              <div class="form-outline mb-4">
                                <label class="form-label" for="start_date">Start Date&nbsp;<span class="required">*</span></label>
                                <input type="date" id="start_date" name="start_date" class="form-control form-control-lg" value="<?php echo $row["start_date"]  ?>" required/>
                              </div>
                              <div class="form-outline mb-4">
                              <label class="form-label" for="end_date">End Date&nbsp;<span class="required">*</span></label>
                                <input type="date" id="end_date" name="end_date" class="form-control form-control-lg" value="<?php echo $row["end_date"]  ?>" required/>
                              </div>
                              <div class="form-group">
                                  <label for="registration_fee">Registration Fee<span class="required">*</span></label>
                                  <input type="number" id="registration_fee" name="registration_fee" class="form-control" value="<?php echo $row["registration_fee"]  ?>" required />
                                </div>
                              
                                
                              
                                <div class="btn-container">
                                  <button class="btn btn-primary btn-lg" id="EditEvent" name="EditEvent">SUBMIT</button>
                                </div>
                            </div>
                          </div>
                        </form>
                          </div>
        </div>




<?php
    if (isset($_POST['EditEvent'])) {
        $name = $_POST["name"];
        $description = $_POST["description"];
        $selectGame = $_POST["selectGame"];
        $start_date = $_POST["start_date"];
        $end_date = $_POST["end_date"];
        $registration_fee = $_POST["registration_fee"];
      
        $sql ="UPDATE events SET event_name = '$name', description = '$description', game_id = '$selectGame', start_date = '$start_date', end_date = '$end_date', registration_fee = '$registration_fee' WHERE event_id=$event_id";

        if ($conn->query($sql) === TRUE) {
        echo "Event updated successfully";
        echo "<script>window.location.href = 'AdminEvents.php';</script>";  
        } else {
        echo "Error editing event: " . $conn->error;
        }
    }
        }
    } else {
        echo "Error fetching event: " . mysqli_error($conn);
    }
}
mysqli_close($conn);
?>

    
</body>
</html>