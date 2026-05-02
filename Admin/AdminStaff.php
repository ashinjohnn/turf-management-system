<?php require '../Admin/connection.php';?>

<!DOCTYPE.php>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Staff</title>
  <link rel="stylesheet" href="\TurfTrack\style.css" />
  <link rel="stylesheet" href="\TurfTrack\CommonFiles\bootstap.css" />
  <link rel="stylesheet" href="\TurfTrack\CommonFiles\adminstaffstyles.css" />
  <link rel="stylesheet" href="\TurfTrack\CommonFiles\Modalpopupstyle.css" />
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
    <a href="#">Staff</a>
    <a href="\TurfTrack\Admin\AdminTurf.php">Turf</a>
    <a href="\TurfTrack\Admin\AdminGames.php">Games</a>
    <a href="\TurfTrack\Admin\AdminSlot.php">Slot</a>
    <a href="\TurfTrack\Admin\AdminBooking.php">Booking</a>
    <a href="\TurfTrack\Admin\AdminEvents.php">Events</a>
    <a href="\TurfTrack\Admin\AdminReview.php">Review</a>
    <p>
      &copy; 2023 Turf Track.<br />
      All rights reserved.
    </p>
  </div>
  <main class="AdminPageMain">
    <div class="addbtn">
      <button onclick="openModal()"><b>&plus; ADD STAFF</b></button>
    </div>
    <script>
    function displayPopup() {
        var popup = document.getElementById('popup');
        popup.style.display = 'block';
    }

    function closePopup() {
        var popup = document.getElementById('popup');
        popup.style.display = 'none';
    }
    </script>
    <style>
    .popup {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.5);
        padding-top: 60px;
    }

    .popup-content {
        background-color: #fefefe;
        margin: 5% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
</style>
    
<div class="container my-5">
    <form method="post">
        <input type="text" placeholder="search staff" name="searchstaff">
        <button class="btn btn-dark btn-sm" name="submit">Search</button>
    </form>
    <div class="container my-5">
    
        <table class="table">
            <?php
            if(isset($_POST['submit']))
{
    $search=$_POST['searchstaff'];

    $sql="select * from staff where staff_id like '%$search%' or name like '%$search%'";
    $result=mysqli_query($conn,$sql);
    if($result && mysqli_num_rows($result) > 0) {
            echo '<script>displayPopup();</script>';
            echo '<div id="popup" class="popup">';
            echo '<div class="popup-content">';
            echo '
            <tr>
            <th>Staff ID</th>
            <th>Staff Name</th>
            <th>Date of Birth</th>
            <th>Gender</th>
            <th>Address</th>
            <th>Phone</th>
            <th>email</th>
            <th>Turf ID</th>
            <th colspan=2>Action</th>



            </tr>
    
            ';
            while($row=mysqli_fetch_assoc($result)){
            
        
            echo '
            <tr>
            <td>'.$row['staff_id'].'</td>
            <td>'.$row['name'].'</td>
            <td>'.$row['dob'].'</td>
            <td>'.$row['gender'].'</td>
            <td>'.$row['address'].'</td>
            <td>'.$row['phone_number'].'</td>
            <td>'.$row['email'].'</td>
            <td>'.$row['turf_id'].'</td>';
            echo "<td class='editbtn'><i class='fa-solid fa-pen-to-square' onclick='editStaff(" . $row["staff_id"] . ")'></i></td>";
          echo "<td class='deletebtn'><i class='fa-solid fa-trash' onclick='deleteStaff(" . $row["staff_id"] . ")'></i></td>";
            echo' </tr>
            ';
            echo '<script>displayPopup();</script>';
        echo '<div id="popup" class="popup">';
        echo '<div class="popup-content">';

        }}else{
            echo'<h2 class=:text-danger>Data not Found</h2>';
        }

    }


?>
     </table>
    </div>
</div>
    <table class="DataTable">
      <tr id="DataTableHeadings">
        <th>ID</th>
        <th>Name</th>
        <th>Assigned Turf</th>
        <th>Date of birth</th>
        <th>Gender</th>
        <th>E-mail</th>
        <th>Phone Number</th>
        <th>Address</th>
        <th colspan="2">Action</th>
      </tr>
      <?php
     
     $sql = "SELECT DISTINCT staff.staff_id, staff.name,staff.dob,staff.gender, staff.email,staff.phone_number,staff.address,turfground.turf_name AS turfturf_name  FROM staff LEFT JOIN turfground ON staff.turf_id=turfground.turf_id";
           $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<tr>";
          echo "<td class='tabledatas'>" . $row["staff_id"] . "</td>";
          echo "<td class='tabledatas'>" . $row["name"] . "</td>";
          echo "<td class='tabledatas'>" . $row["turfturf_name"] . "</td>";
          echo "<td class='tabledatas'>" . $row["dob"] . "</td>";
          echo "<td class='tabledatas'>" . $row["gender"] . "</td>";
          echo "<td class='tabledatas'>" . $row["email"] . "</td>";
          echo "<td class='tabledatas'>" . $row["phone_number"] . "</td>";
          echo "<td class='tabledatas'>" . $row["address"] . "</td>";
          echo "<td class='editbtn'><i class='fa-solid fa-pen-to-square' onclick='editStaff(" . $row["staff_id"] . ")'></i></td>";
          echo "<td class='deletebtn'><i class='fa-solid fa-trash' onclick='deleteStaff(" . $row["staff_id"] . ")'></i></td>";
          echo "</tr>";
        }
      } else {
        echo "<tr><td colspan=10>No records</td></tr>";
      }
      $conn->close();
      ?>
    </table>
  </main>
  <script>
    function openSearchResultModal(resultHTML) {
      const modal = document.getElementById('searchResultModal');
      const content = document.getElementById('searchResultContent');
      content.innerHTML = resultHTML;
      modal.style.display = 'block';
    }

    function closeSearchResultModal() {
      const modal = document.getElementById('searchResultModal');
      modal.style.display = 'none';
    }

    <?php
    if (isset($_POST['submit'])) {
      $search = $_POST['searchstaff'];

      $sql = "SELECT * FROM staff WHERE staff_id LIKE '%$search%' OR name LIKE '%$search%'";
      $result = mysqli_query($conn, $sql);
      if ($result) {
        if (mysqli_num_rows($result) > 0) {
          $resultHTML = '<table class="table"><thead>
            <tr>
              <th>Staff ID</th>
              <th>Staff Name</th>
              <th>Date of Birth</th>
              <th>Gender</th>
              <th>Address</th>
              <th>Phone</th>
              <th>Email</th>
              <th>Turf ID</th>
              <th colspan=2>ACTION</th>
            </tr>
            </thead><tbody>';

          while ($row = mysqli_fetch_assoc($result)) {
            $resultHTML .= '<tr>
              <td>' . $row['staff_id'] . '</td>
              <td>' . $row['name'] . '</td>
              <td>' . $row['dob'] . '</td>
              <td>' . $row['gender'] . '</td>
              <td>' . $row['address'] . '</td>
              <td>' . $row['phone_number'] . '</td>
              <td>' . $row['email'] . '</td>
              <td>' . $row['turf_id'] . '</td>
              <td class="editbtn"><i class="fa-solid fa-pen-to-square" onclick="editStaff(' . $row["staff_id"] . ')"></i></td>
              <td class="deletebtn"><i class="fa-solid fa-trash" onclick="deleteStaff(' . $row["staff_id"] . ')"></i></td>
            </tr>';
          }

          $resultHTML .= '</tbody></table>';
          echo "openSearchResultModal('$resultHTML');";
        } else {
          echo "console.log('No data found');";
        }
      }
    }
    ?>
  </script>

  <script>
    function editStaff(staff_id) {
      window.location.href = 'edit_staff.php?staff_id=' + staff_id;
    }

    function deleteStaff(staff_id) {
      if (confirm("Are you sure you want to delete this staff?")) {
        window.location.href = 'delete_staff.php?staff_id=' + staff_id;
      }
    }
  </script>
  <!-- modal   -->
  <div id="Modal" class="modal">
    <div class="staff-modal-content">
      <div class="modal-header">
        <h6>STAFF</h6>
        <span id="ModalClose">&times;</span>
      </div>
      <div class="modal-body">
        <!-- edit from here  -->
        <form method="post" id="AddStaffForm">
          <div class="flexhalf">
            <div class="form-container">
              <div class="form-group">
                <label for="name">Name <span class="required">*</span></label>
                <input type="text" id="name" name="name" class="form-control" required />
              </div>
              <div class="form-group">
                <label for="dob">DOB <span class="required">*</span></label>
                <input type="date" id="dob" name="dob" class="form-control" required />
              </div>
              <div class="form-group">
                <label>Gender <span class="required">*</span></label>
                <div class="form-check form-check-inline">
                  <input type="radio" id="femaleGender" name="gender" value="female" class="form-check-input" required />
                  <label for="femaleGender" class="form-check-label">Female</label>
                </div>
                <div class="form-check form-check-inline">
                  <input type="radio" id="maleGender" name="gender" value="male" class="form-check-input" required />
                  <label for="maleGender" class="form-check-label">Male</label>
                </div>
                <div class="form-check form-check-inline">
                  <input type="radio" id="otherGender" name="gender" value="other" class="form-check-input" required />
                  <label for="otherGender" class="form-check-label">Other</label>
                </div>
              </div>
              <div class="form-group">
                <label for="address">Address <span class="required">*</span></label>
                <textarea id="address" name="address" class="form-control" required rows="4"></textarea>
              </div>
              <div class="form-group">
                <label for="phone_number">Phone no. <span class="required">*</span></label>
                <input type="text" id="phone_number" name="phone_number" class="form-control" required />
              </div>
            </div>
            <div class="form-container">
              <div class="form-group">
                <label for="email">Email ID <span class="required">*</span></label>
                <input type="email" id="email" name="email" class="form-control" required />
              </div>
              <div class="form-group">
                <label for="username">Username <span class="required">*</span></label>
                <input type="text" id="username" name="username" class="form-control" required />
              </div>
              <div class="form-group">
                <label for="password">Password <span class="required">*</span></label>
                <input type="text" id="password" name="password" class="form-control" required />
              </div>
              <div class="form-group">
                <label for="AssignedTurf">Assigned Turf <span class="required">*</span></label>
                <select id="AssignedTurf" name="AssignedTurf" class="form-control" required>
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
              <div class="btn-container">
                <button class="btn btn-primary btn-lg" id="addStaff" name="AddStaff">SUBMIT</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script src="\TurfTrack\CommonFiles\modal.js"></script>
  <?php
  
  if (isset($_POST['AddStaff'])) {
    $name = $_POST["name"];
    $turf_id = $_POST["AssignedTurf"];
    $dob = $_POST["dob"];
    $gender = $_POST["gender"];
    $email = $_POST["email"];
    $phone_number = $_POST["phone_number"];
    $address = $_POST["address"];
    $username = $_POST['username'];
    $password = $_POST['password'];
    // SQL query to insert a new staff member
    $sql = "INSERT INTO staff (dob, gender, address, phone_number, email, username, password, turf_id, name)
VALUES ('$dob', '$gender', '$address', '$phone_number', '$email', '$username', '$password', '$turf_id', '$name')";
    if ($conn->query($sql) === TRUE) {
      echo "Staff member added successfully";
      echo "<script>window.location.href = 'AdminStaff.php';</script>";
    
    } else {
      echo "Error adding staff member: " . $conn->error;
    }
  }
  // Close the database connection
  $conn->close();
  ?>
</body>

</html>