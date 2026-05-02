<?php require '../Admin/connection.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>
    <link rel="stylesheet" href="\TurfTrack\style.css">
    <link rel="stylesheet" href="\TurfTrack\CommonFiles\bootstap.css">
    <link rel="stylesheet" href="\TurfTrack\CommonFiles\adminstaffstyles.css">
    <link rel="icon" href="\TurfTrack\images\icon.png" type="image/x-icon">
    <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> -->
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
        <a href="#">Booking</a>
        <a href="\TurfTrack\Admin\AdminEvents.php">Events</a>
        <a href="\TurfTrack\Admin\AdminReview.php">Review</a> 
        
        <p>&copy; 2023 Turf Track.<br> All rights reserved.</p></div>
        <main class="AdminPageMain">
            
        <table class="DataTable">
            <tr id="DataTableHeadings">
                <th>ID</th><th>Slot ID</th><th>Customer ID</th><th>Date Booked</th><th>Total Price</th><th>Status</th>
            </tr>
            <?php
            $sql = "SELECT * FROM booking";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td class='tabledatas'>" . $row["booking_id"] . "</td>";
                echo "<td class='tabledatas'>" . $row["slot_id"] . "</td>";
                echo "<td class='tabledatas'>" . $row["customer_id"] . "</td>";
                echo "<td class='tabledatas'>" . $row["date_booked"] . "</td>";
                echo "<td class='tabledatas'>" . $row["total_price"] . "</td>";
                echo "<td class='tabledatas'>" . $row["status"] . "</td>";
                echo "</tr>";
              }
            } else {
              echo "<tr><td colspan=6>No records</td></tr>";
            }
            $conn->close();
            ?>    
               
            </table>
        </main>
    </div>
  
</body>
</html>