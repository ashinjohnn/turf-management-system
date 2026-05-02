<?php require '../Admin/connection.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events</title>
    <link rel="stylesheet" href="\TurfTrack\style.css">
    <link rel="stylesheet" href="\TurfTrack\CommonFiles\bootstap.css">
    <link rel="stylesheet" href="\TurfTrack\CommonFiles\adminstaffstyles.css">
    <link rel="icon" href="\TurfTrack\images\icon.png" type="image/x-icon">
    <link rel="stylesheet" href="\TurfTrack\CommonFiles\Modalpopupstyle.css">
    <link rel="stylesheet" href="\TurfTrack\CommonFiles\css\all.min.css">
  <link rel="stylesheet" href="\TurfTrack\CommonFiles\css\fontawesome.min.css">
</head>
<body>
    
    <header>
        <div class="nav-left">
            <div class="logo">
                <img src="\TurfTrack\images\logo.png" alt="Logo" width="50">
              </div>
              <div class="website-name">Turf Track</div>
        </div>
        <nav class="nav-menu">
          <ul>
            <li class="nav-item"><a class="nav-link" href="\TurfTrack\homepg.html">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Logout</a></li>
          </ul>
        </nav>
      </header>
    
      <div class="side-navbar">
        <a href="\TurfTrack\Admin\AdminStaff.php">Staff</a>
        <a href="\TurfTrack\Admin\AdminTurf.php">Turf</a>
        <a href="\TurfTrack\Admin\AdminGames.php">Games</a>
        <a href="\TurfTrack\Admin\AdminSlot.php">Slot</a>
        <a href="\TurfTrack\Admin\AdminBooking.php">Booking</a>
        <a href="#">Events</a>
        <a href="\TurfTrack\Admin\AdminReview.php">Review</a> 
        
        <p>&copy; 2023 Turf Track.<br> All rights reserved.</p></div>
        <main class="AdminPageMain">
            <div class="addbtn">
                <button onclick="openModal()"><b>&plus; ADD EVENT</b></button>

            </div>
            <table class="DataTable">
                <tr id="DataTableHeadings">
                    <th>ID</th><th>Name</th><th>Description</th><th>Start Date</th><th>End Date</th><th>Game</th><th>Reg Fee</th><th colspan=2>Action</th>
                </tr>
             
                <?php
      $sql = "SELECT events.event_id,events.event_name,events.start_date,events.end_date,events.description,events.registration_fee,game.game_name  FROM events JOIN game ON events.game_id=game.game_id";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<tr>";
          echo "<td class='tabledatas'>" . $row["event_id"] . "</td>";
          echo "<td class='tabledatas'>" . $row["event_name"] . "</td>";
          echo "<td class='tabledatas'>" . $row["description"] . "</td>";
          echo "<td class='tabledatas'>" . $row["start_date"] . "</td>";
          echo "<td class='tabledatas'>" . $row["end_date"] . "</td>";
          echo "<td class='tabledatas'>" . $row["game_name"] . "</td>";
          echo "<td class='tabledatas'>" . $row["registration_fee"] . "</td>";
          echo "<td class='editbtn'><i class='fa-solid fa-pen-to-square' onclick='editEvent(" . $row["event_id"] . ")'></i></td>";
          echo "<td class='deletebtn'><i class='fa-solid fa-trash' onclick='deleteEvent(" . $row["event_id"] . ")'></i></td>";
          echo "</tr>";
        }
      } else {
        echo "<tr><td colspan=6>No records</td></tr>";
      }
      $conn->close();
      ?>

            </table>
        </main>
        <script>
          function editEvent(event_id) {
            window.location.href = 'edit_event.php?event_id=' + event_id;
          }

          function deleteEvent(event_id) {
            if (confirm("Are you sure you want to delete this event?")) {
              window.location.href = 'delete_event.php?event_id=' + event_id;
            }
          }
        </script>
    </div>
   <div id="Modal" class="modal">
        <div class="staff-modal-content">
                          <div class="modal-header">
                            <h6>EVENT</h6>
                             <span id="ModalClose">&times;</span>
                             
                          </div>
                          <div class="modal-body">
                          <form method="post" id="AddEventForm">
                          <div class="flexhalf">
                           <div class="form-container">
                          <div class="form-group">
                            <label for="name">Name <span class="required">*</span></label>
                            <input type="text" id="name" name="name" class="form-control" required />
                          </div>
                              <div class="form-group">
                                <label for="description">Description <span class="required">*</span></label>
                                <textarea id="description" name="description" class="form-control" required rows="4"></textarea>
                              </div>
                              <div class="form-group">
                                  <label for="selectGame">Game<span class="required">*</span></label>
                                  <select id="selectGame" name="selectGame" class="form-control" required>
                                    <option value="" disabled selected>Select an option</option>
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
                                <input type="date" id="start_date" name="start_date" class="form-control form-control-lg" required/>
                              </div>
                              <div class="form-outline mb-4">
                              <label class="form-label" for="end_date">End Date&nbsp;<span class="required">*</span></label>
                                <input type="date" id="end_date" name="end_date" class="form-control form-control-lg" required/>
                              </div>
                              <div class="form-group">
                                  <label for="registration_fee">Registration Fee<span class="required">*</span></label>
                                  <input type="number" id="registration_fee" name="registration_fee" class="form-control" required />
                                </div>
                              
                                
                              
                                <div class="btn-container">
                                  <button class="btn btn-primary btn-lg" id="AddEvent" name="AddEvent">SUBMIT</button>
                                </div>
                            </div>
                          </div>
                        </form>
                          </div>
        </div>
  </div>
     <script src="\TurfTrack\CommonFiles\modal.js"></script>
     <?php
  
  if (isset($_POST['AddEvent'])) {
    $name = $_POST["name"];
    $description = $_POST["description"];
    $selectGame = $_POST["selectGame"];
    $start_date = $_POST["start_date"];
    $end_date = $_POST["end_date"];
    $registration_fee = $_POST["registration_fee"];
    // SQL query to insert a new staff member
    $sql = "INSERT INTO events (event_name, description, start_date, end_date, registration_fee, game_id)
VALUES ('$name', '$description', '$start_date', '$end_date', '$registration_fee', '$selectGame')";
    if ($conn->query($sql) === TRUE) {
      echo "Staff member added successfully";
      echo "<script>window.location.href = 'AdminEvents.php';</script>";
    
    } else {
      echo "Error adding staff member: " . $conn->error;
    }
  }
  // Close the database connection
  $conn->close();
  ?>

</body>
</html>