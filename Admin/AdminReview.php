<?php require '../Admin/connection.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviews</title>
    <link rel="stylesheet" href="\TurfTrack\style.css">
    <link rel="stylesheet" href="\TurfTrack\CommonFiles\bootstap.css">
    <link rel="stylesheet" href="\TurfTrack\CommonFiles\adminstaffstyles.css">
    <link rel="icon" href="\TurfTrack\images\icon.png" type="image/x-icon">
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
        <a href="\TurfTrack\Admin\AdminEvents.php">Events</a>
        <a href="#">Review</a> 
        
        <p>&copy; 2023 Turf Track.<br> All rights reserved.</p></div>
        <main class="AdminPageMain">
            <table class="DataTable">
                <tr id="DataTableHeadings">
                    <th>ID</th><th>UserID</th><th>Rating</th><th>Feedback</th><th>Date</th><th>Action</th>
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
          echo "<td class='deletebtn'><i class='fa-solid fa-trash' onclick='deleteReview(" . $row["review_id"] . ")'></i></td>";
          echo "</tr>";
        }
      } else {
        echo "<tr><td colspan=6>No records</td></tr>";
      }
     
      ?>    
            </table>
        </main>
        <script>
    function deleteReview(review_id) {
      if (confirm("Are you sure you want to delete this review?")) {
        window.location.href = 'delete_review.php?review_id=' + review_id;
      }
    }
  </script>
 <?php $conn->close(); ?>
</body>
</html>