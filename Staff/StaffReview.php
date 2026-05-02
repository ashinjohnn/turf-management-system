<?php require '../Admin/connection.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff</title>
    <link rel="stylesheet" href="\TurfTrack\style.css">
    <link rel="stylesheet" href="\TurfTrack\CommonFiles\bootstap.css">
    <link rel="stylesheet" href="\TurfTrack\CommonFiles\adminstaffstyles.css">
    <link rel="icon" href="\TurfTrack\images\icon.png" type="image/x-icon">
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
        <a href="\TurfTrack\Staff\Staffslot.php">Slot</a>
        <a href="\TurfTrack\Staff\StaffBooking.php">Booking</a>
        <a href="\TurfTrack\Staff\StaffEvents.php">Events</a>
        <a href="#">Review</a> 
        
        <p>&copy; 2023 Turf Track.<br> All rights reserved.</p></div>
        <main class="AdminPageMain">
            <table class="DataTable">
                <tr id="DataTableHeadings">
                    <th>ID</th><th>UserID</th><th>Rating</th><th>Feedback</th><th>Date</th>
                </tr>
                <?php
      $sql = "SELECT *  FROM review";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<tr>";
          echo "<td class='tabledatas'>" . $row["review_id"] . "</td>";
          echo "<td class='tabledatas'>" . $row["customer_id"] . "</td>";
          echo "<td class='tabledatas'>" . $row["rating"] . "</td>";
          echo "<td class='tabledatas'>" . $row["feedback"] . "</td>";
          echo "<td class='tabledatas'>" . $row["review_date"] . "</td>";
          echo "</tr>";
        }
      } else {
        echo "<tr><td colspan=5>No records</td></tr>";
      }
     
      ?>    


                
               
            </table>
        </main>
    </div>
    <?php $conn->close(); ?>
</body>
</html>