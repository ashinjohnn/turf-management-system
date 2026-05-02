<?php require '../Admin/connection.php'; ?>
<!DOCTYPE.php>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Slots</title>
  <link rel="stylesheet" href="\TurfTrack\style.css" />
  <link rel="stylesheet" href="\TurfTrack\CommonFiles\bootstap.css" />
  <link rel="stylesheet" href="\TurfTrack\CommonFiles\Modalpopupstyle.css">
  <link rel="stylesheet" href="\TurfTrack\CommonFiles\adminstaffstyles.css" />
  <link rel="icon" href="\TurfTrack\images\icon.png" type="image/x-icon" />
  <link rel="stylesheet" href="\TurfTrack\CommonFiles\css\all.min.css">
  <link rel="stylesheet" href="\TurfTrack\CommonFiles\css\fontawesome.min.css">
</head>

<body>
  <header>
    <div class="nav-left">
      <div class="logo">
        <img src="\TurfTrack\images\logo.png" alt="Logo" width="50" />
      </div>
      <div class="website-name">Turf Track</div>
    </div>
    <nav class="nav-menu">
      <ul>
        <li class="nav-item">
          <a class="nav-link" href="\TurfTrack\homepg.php">Home</a>
        </li>
        <li class="nav-item"><a class="nav-link" href="#">Logout</a></li>
      </ul>
    </nav>
  </header>

  <div class="side-navbar">
    <a href="\TurfTrack\Admin\AdminStaff.php">Staff</a>
    <a href="\TurfTrack\Admin\AdminTurf.php">Turf</a>
    <a href="\TurfTrack\Admin\AdminGames.php">Games</a>
    <a href="#">Slot</a>
    <a href="\TurfTrack\Admin\AdminBooking.php">Booking</a>
    <a href="\TurfTrack\Admin\AdminEvents.php">Events</a>
    <a href="\TurfTrack\Admin\AdminReview.php">Review</a>

    <p>
      &copy; 2023 Turf Track.<br />
      All rights reserved.
    </p>
  </div>
  <main class="AdminPageMain">
    <div class="AdminTools">
      <div class="addbtn">
        <button onclick="openModal()"><b>&plus; ADD SLOT</b></button>
      </div>

    </div>

    <table class="DataTable">
      <tr id="DataTableHeadings">
        <th>ID</th>
        <th>Game</th>
        <th>Date</th>
        <th>StartTime</th>
        <th>EndTime</th>
        <th>Action</th>
      </tr>
      <?php
      $sql = "SELECT DISTINCT slot.slot_id,game.game_name,slot.slot_date,slot.start_time,slot.end_time,booking.slot_id AS bookingslot_id FROM slot JOIN game ON slot.game_id=game.game_id LEFT JOIN booking ON slot.slot_id= booking.slot_id";
      //booking.slot_id AS bookingslot_id :LEFT JOIN booking on slot.slot_id= booking.slot_id
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<tr>";
          echo "<td class='tabledatas'>" . $row["slot_id"] . "</td>";
          echo "<td class='tabledatas'>" . $row["game_name"] . "</td>";
          echo "<td class='tabledatas'>" . $row["slot_date"] . "</td>";
          echo "<td class='tabledatas'>" . $row["start_time"] . "</td>";
          echo "<td class='tabledatas'>" . $row["end_time"] . "</td>";
          if ($row["bookingslot_id"] == NULL) {
            echo "<td class='deletebtn'><i class='fa-solid fa-trash' onclick='deleteSlot(" . $row["slot_id"] . ")'></i></td>";
         } else {
              echo "<td class='deletebtn'><i class='fa-solid fa-trash' style='color: #9b9da1;'></i></td>";

        }
          // echo "<td class='deletebtn'><i class='fa-solid fa-trash' onclick='deleteSlot(" . $row["slot_id"] . ")'></i></td>";
          echo "</tr>";
        }
      } else {
        echo "<tr><td colspan=6>No records</td></tr>";
      }
    
      ?>

    </table>
  </main>
  <script>
    function deleteSlot(slot_id) {
      if (confirm("Are you sure you want to delete this slot?")) {
        window.location.href = 'delete_slot.php?slot_id=' + slot_id;
      }
    }
  </script>
  <div id="Modal" class="modal">
    <div class="modal-content">
      <div class="modal-header">
        <h6>SLOT</h6>
        <span id="ModalClose">&times;</span>
      </div>
      <div class="modal-body">
        <form method="post" id="AddSlotForm">
          <div class="form-group">
            <label for="selectGame">Game<span class="required">*</span></label>
            <select id="selectGame" name="selectGame" class="form-control">
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
          <div class="form-outline mb-4">
            <label class="form-label" for="slot_date">Date&nbsp;<span class="required">*</span></label>
            <input type="date" id="slot_date" name="slot_date" class="form-control form-control-lg" />
          </div>
          <div class="form-outline mb-4">
            <label class="form-label" for="start_time">Start Time&nbsp;<span class="required">*</span></label>
            <input type="time" id="start_time" name="start_time" class="form-control form-control-lg" />
          </div>
          <div class="form-outline mb-4">
            <label class="form-label" for="end_time">End Time&nbsp;<span class="required">*</span></label>
            <input type="time" id="end_time" name="end_time" class="form-control form-control-lg" />
          </div>
          <div class="btn-container">
                <button class="btn btn-primary btn-lg" id="AddSlot" name="AddSlot">SUBMIT</button>
              </div>
          
        </form>
      </div>
    </div>
  </div>
  <script src="\TurfTrack\CommonFiles\modal.js"></script>
  <?php
  
  if (isset($_POST['AddSlot'])) {
    $game_id = $_POST["selectGame"];
    $date = $_POST["slot_date"];
    $stime = $_POST["start_time"];
    $etime = $_POST["end_time"];
    // SQL query to insert a new slot
    $sql = "INSERT INTO slot (game_id, slot_date, start_time, end_time) VALUES ('$game_id', '$date', '$stime', '$etime')";
    if ($conn->query($sql) === TRUE) {
      echo "Slot added successfully";
      echo "<script>window.location.href = 'AdminSlot.php';</script>";
    
    } else {
      echo "Error adding staff member: " . $conn->error;
    }
  }
  // Close the database connection
  $conn->close();
  ?>
</body>

</html>