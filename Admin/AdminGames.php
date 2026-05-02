<?php require '../Admin/connection.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Games</title>
    <link rel="stylesheet" href="\TurfTrack\style.css">
    <link rel="stylesheet" href="\TurfTrack\CommonFiles\bootstap.css">
    <link rel="stylesheet" href="\TurfTrack\CommonFiles\adminstaffstyles.css">
    <link rel="stylesheet" href="\TurfTrack\CommonFiles\Modalpopupstyle.css">
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
        <a href="#">Games</a>
        <a href="\TurfTrack\Admin\AdminSlot.php">Slot</a>
        <a href="\TurfTrack\Admin\AdminBooking.php">Booking</a>
        <a href="\TurfTrack\Admin\AdminEvents.php">Events</a>
        <a href="\TurfTrack\Admin\AdminReview.php">Review</a> 
        
        <p>&copy; 2023 Turf Track.<br> All rights reserved.</p></div>
        <main class="AdminPageMain">
            <div class="addbtn">
                <button id="AddGamesButton" onclick="openModal()"><b>&plus; ADD GAMES</b></button>

            </div>
            <table class="DataTable">
                <tr id="DataTableHeadings">
                    <th>ID</th><th>Name</th><th>Price Per Hour</th><th>Description</th><th>Turf</th><th>Images</th><th colspan=2>Action</th>
                </tr>
                <?php
                  $sql = "SELECT DISTINCT game.game_id,game.game_name,game.price_per_hour,game.description,turfground.turf_name,game.images, slot.game_id AS slotgame_id, events.game_id AS eventgame_id FROM game JOIN turfground ON game.turf_id=turfground.turf_id LEFT JOIN slot ON game.game_id= slot.game_id LEFT JOIN events ON game.game_id= events.game_id";
                  $result = $conn->query($sql);
                  if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                      echo "<tr>";
                      echo "<td class='tabledatas'>" . $row["game_id"] . "</td>";
                      echo "<td class='tabledatas'>" . $row["game_name"] . "</td>";
                      echo "<td class='tabledatas'>" . $row["price_per_hour"] . "</td>";
                      echo "<td class='tabledatas'>" . $row["description"] . "</td>";
                      echo "<td class='tabledatas'>" . $row["turf_name"] . "</td>";
                      echo '<td class="tabledatas"><i class="fa-solid fa-eye" onclick="showImage(\'' . base64_encode($row["images"]) . '\')"></i></td>';                     
                      echo "<td class='editbtn'><i class='fa-solid fa-pen-to-square' onclick='editGame(" . $row["game_id"] . ")'></i></td>";
                      if ($row["slotgame_id"] == NULL && $row["eventgame_id"] === NULL) {
                        echo "<td class='deletebtn'><i class='fa-solid fa-trash' onclick='deleteGame(" . $row["game_id"] . ")'></i></td>";
                     } else {
                          echo "<td class='deletebtn'><i class='fa-solid fa-trash' style='color: #9b9da1;'></i></td>";
            
                    }
                      echo "</tr>";
                    }
                  } else {
                    echo "<tr><td colspan=8>No records</td></tr>";
                  }
                  ?>    
                

            </table>
        </main>
       <script>
    function editGame(game_id) {
      window.location.href = 'edit_game.php?game_id=' + game_id;
    }

    function deleteGame(game_id) {
      if (confirm("Are you sure you want to delete this Game?")) {
        window.location.href = 'delete_game.php?game_id=' + game_id;
      }
    }
  </script>
          <div class="modal" id="imageModal">
            <div class="modal-content">
           <span class="close" onclick="closeImageModal()">&times;</span>
           <img id="modalImage" src="" alt="Game Image">
          </div>
          </div>
          <script src="\TurfTrack\CommonFiles\imgmodal.js"></script>
        <div id="Modal" class="modal">
            <div class="modal-content">
                              <div class="modal-header">
                                <h6>GAMES</h6>
                                 <span id="ModalClose">&times;</span>
                              </div>
                              <div class="modal-body">
                                <form method="post" id="AddGameForm" enctype="multipart/form-data">
                                <div class="form-group">
                                  <label for="name">Game Name <span class="required">*</span></label>
                                  <input type="text" id="name" name="name" class="form-control" required />
                                </div>
                                  <div class="form-group">
                                    <label for="Description">Description<span class="required">*</span></label>
                                    <textarea id="Description" name="Description" class="form-control" required rows="4" required></textarea>
                                </div>
                                <div class="form-group">
                                  <label for="price_per_hour">Price Per Hour<span class="required">*</span></label>
                                  <input type="number" id="price_per_hour" name="price_per_hour" class="form-control" required />
                                </div>
                                <div class="form-group">
                                  <label for="SelectTurf">Select Turf <span class="required">*</span></label>
                                  <select id="SelectTurf" name="SelectTurf" class="form-control" required>
                                    <option value="" disabled selected>Select an option</option>
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
                                  <input type="file" name="images" id="images" accept=".jpg, .jpeg, .png" required>
                                  <div class="btn-container">
                                    <button class="btn btn-primary btn-lg" id="AddGame" name="AddGame">SUBMIT</button>
                                  </div>
                            
                                </form>
      
      
      
                              </div>
            </div>
      </div>
         <script src="\TurfTrack\CommonFiles\modal.js"></script>
         <?php
  
  if (isset($_POST['AddGame'])) {
    $name  = $_POST["name"];
    $Description  = $_POST["Description"];
    $turf_id = $_POST["SelectTurf"];
    $price_per_hour = $_POST["price_per_hour"];
    // $images = $_POST["images"];
    // SQL query to insert a new slot
    // Get the name of the uploaded image
    $image_name = $_FILES['images']['name'];

    // Read the contents of the uploaded image
    $image = addslashes(file_get_contents($_FILES['images']['tmp_name']));
    $sql = "INSERT INTO game (game_name, description, price_per_hour, turf_id, images) VALUES ('$name', '$Description', '$price_per_hour', '$turf_id','$image')";
    if ($conn->query($sql) === TRUE) {
      echo "Game added successfully";
      echo "<script>window.location.href = 'AdminGames.php';</script>";
    
    } else {
      echo "Error adding Game: " . $conn->error;
    }
  }
 
  ?>
   <?php   $conn->close(); ?>
</body>
</html>