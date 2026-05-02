<?php require '../Admin/connection.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Turf</title>
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
        <a href="#">Turf</a>
        <a href="\TurfTrack\Admin\AdminGames.php">Games</a>
        <a href="\TurfTrack\Admin\AdminSlot.php">Slot</a>
        <a href="\TurfTrack\Admin\AdminBooking.php">Booking</a>
        <a href="\TurfTrack\Admin\AdminEvents.php">Events</a>
        <a href="\TurfTrack\Admin\AdminReview.php">Review</a> 
        
        <p>&copy; 2023 Turf Track.<br> All rights reserved.</p></div>
        <main class="AdminPageMain">
            <div class="addbtn">
                <button id="addTurfbtn" onclick="openModal()"><b>&plus; ADD TURF</b></button>

            </div>
            <table class="DataTable">
                <tr id="DataTableHeadings">
                    <th>ID</th><th>Name</th><th>Description</th><th>Images</th><th colspan="2">Action</th>
                </tr>
                
                <?php
                  $sql = "SELECT DISTINCT turfground.turf_id, turfground.turf_name, turfground.description, turfground.images, game.turf_id AS gameturf_id , staff.turf_id AS staffturf_id FROM turfground LEFT JOIN game ON turfground.turf_id= game.turf_id LEFT JOIN staff ON turfground.turf_id= staff.turf_id";
                  $result = $conn->query($sql);
                  if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                      echo "<tr>";
                      echo "<td class='tabledatas'>" . $row["turf_id"] . "</td>";
                      echo "<td class='tabledatas'>" . $row["turf_name"] . "</td>";
                      echo "<td class='tabledatas'>" . $row["description"] . "</td>";
                      echo '<td class="tabledatas"><i class="fa-solid fa-eye" onclick="showImage(\'' . base64_encode($row["images"]) . '\')"></i></td>';                     
                      echo "<td class='editbtn'><i class='fa-solid fa-pen-to-square' onclick='editTurf(" . $row["turf_id"] . ")'></i></td>";
                      if ($row["gameturf_id"] == NULL && $row["staffturf_id"] === NULL) {
                        echo "<td class='deletebtn'><i class='fa-solid fa-trash' onclick='deleteTurf(" . $row["turf_id"] . ")'></i></td>";
                     } else {
                          echo "<td class='deletebtn'><i class='fa-solid fa-trash' style='color: #9b9da1;'></i></td>";
            
                    }
                      echo "</tr>";
                    }
                  } else {
                    echo "<tr><td colspan=6>No records</td></tr>";
                  }
                  ?>
   
            </table>
        </main>
        <script>
    function editTurf(turf_id) {
      window.location.href = 'edit_turf.php?turf_id=' + turf_id;
    }

    function deleteTurf(turf_id) {
      if (confirm("Are you sure you want to delete this Turf?")) {
        window.location.href = 'delete_turf.php?turf_id=' + turf_id;
      }
    }
  </script>
        <div class="modal" id="imageModal">
            <div class="modal-content">
           <span class="close" onclick="closeImageModal()">&times;</span>
           <img id="modalImage" src="" alt="Turf Image">
          </div>
          </div>
          <script src="\TurfTrack\CommonFiles\imgmodal.js"></script>
    <div id="Modal" class="modal">
        <div class="modal-content">
                          <div class="modal-header">
                            <h6>TURF</h6>
                             <span id="ModalClose">&times;</span>
                          </div>
                          <div class="modal-body">
                          <form method="post" id="AddTurfForm" enctype="multipart/form-data"> 
                            <div class="form-outline mb-4">
                                <label class="form-label" for="form3Example9"
                                  >Name&nbsp;<span class="required">*</span></label
                                >
                                <input
                                  type="text"
                                  id="name" name="name"
                                  class="form-control form-control-lg"
                               required />
                              </div>
                              <div class="form-group">
                                <label for="description">Description<span class="required">*</span></label>
                                <textarea id="description" name="description" class="form-control" required rows="4"></textarea>
                            </div>
                              
                              <input type="file" name="images" id="images" accept=".jpg, .jpeg, .png" required>
                              <div class="btn-container">
                                    <button class="btn btn-primary btn-lg" id="AddTurf" name="AddTurf">SUBMIT</button>
                                  </div>
                          </form>
                          </div>
        </div>
  </div>
     <script src="\TurfTrack\CommonFiles\modal.js"></script>
     <?php
  
  if (isset($_POST['AddTurf'])) {
    $name  = $_POST["name"];
    $description  = $_POST["description"];
    
    $image_name = $_FILES['images']['name'];

    // Read the contents of the uploaded image
    $image = addslashes(file_get_contents($_FILES['images']['tmp_name']));
    $sql = "INSERT INTO turfground (turf_name, description, images) VALUES ('$name', '$description', '$image')";
    if ($conn->query($sql) === TRUE) {
      echo "Turf added successfully";
      echo "<script>window.location.href = 'AdminTurf.php';</script>";
    
    } else {
      echo "Error adding Game: " . $conn->error;
    }
  }
 
  ?>
   <?php   $conn->close(); ?>

</body>
</html>