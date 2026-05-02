
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
if (isset($_GET['staff_id'])) {
    $staff_id = $_GET['staff_id'];
    $sql = "SELECT * FROM staff WHERE staff_id ='$staff_id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
?>
            
                <div class="staff-modal-content">
                    <div class="modal-header">
                        <h6>EDIT STAFF</h6>
                        
                    </div>
                    <div class="modal-body">
                        <!-- edit from here  -->
                        <form method="post" id="EditStaffForm">
                            <div class="flexhalf">
                                <div class="form-container">
                                    <div class="form-group">
                                        <label for="name">Name <span class="required">*</span></label>
                                        <input type="text" id="name" name="name" class="form-control" value="<?php echo $row["name"]  ?>" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="dob">DOB <span class="required">*</span></label>
                                        <input type="date" id="dob" name="dob" class="form-control" value="<?php echo $row["dob"] ?>" required />
                                    </div>
                                    <script>
                                        // Log the value of $row["dob"] to the browser console
                                        console.log("<?php echo $row["dob"]; ?>");
                                    </script>
                                    <?php
                                    $genderValue = $row["gender"];
                                    if($genderValue === 'Female'){
                                        echo"<div class='form-group'>
                                    <label>Gender <span class='required'>*</span></label>
                                    <div class='form-check form-check-inline'>
                                    <input type='radio' id='femaleGender' name='gender' value='female' class='form-check-input' required checked/>
                                    <label for='femaleGender' class='form-check-label'>Female</label>
                                    </div><div class='form-check form-check-inline'>
                                    <input type='radio' id='maleGender' name='gender' value='male' class='form-check-input' required />
                                    <label for='maleGender' class='form-check-label'>Male</label>
                                    </div>
                                    <div class='form-check form-check-inline'>
                                    <input type='radio' id='otherGender' name='gender' value='other' class='form-check-input' required />
                                    <label for='otherGender' class='form-check-label'>Other</label>
                                    </div>
                                    </div>";
                                    } else if($genderValue === 'Male'){
                                        echo"<div class='form-group'>
                                    <label>Gender <span class='required'>*</span></label>
                                    <div class='form-check form-check-inline'>
                                    <input type='radio' id='femaleGender' name='gender' value='female' class='form-check-input' required />
                                    <label for='femaleGender' class='form-check-label'>Female</label>
                                    </div><div class='form-check form-check-inline'>
                                    <input type='radio' id='maleGender' name='gender' value='male' class='form-check-input' required checked/>
                                    <label for='maleGender' class='form-check-label'>Male</label>
                                    </div>
                                    <div class='form-check form-check-inline'>
                                    <input type='radio' id='otherGender' name='gender' value='other' class='form-check-input' required />
                                    <label for='otherGender' class='form-check-label'>Other</label>
                                    </div>
                                    </div>";
                                    } else { echo"<div class='form-group'>
                                    <label>Gender <span class='required'>*</span></label>
                                    <div class='form-check form-check-inline'>
                                    <input type='radio' id='femaleGender' name='gender' value='female' class='form-check-input' required />
                                    <label for='femaleGender' class='form-check-label'>Female</label>
                                    </div><div class='form-check form-check-inline'>
                                    <input type='radio' id='maleGender' name='gender' value='male' class='form-check-input' required />
                                    <label for='maleGender' class='form-check-label'>Male</label>
                                    </div>
                                    <div class='form-check form-check-inline'>
                                    <input type='radio' id='otherGender' name='gender' value='other' class='form-check-input' required checked/>
                                    <label for='otherGender' class='form-check-label'>Other</label>
                                    </div>
                                    </div>";
                                    }
                                    ?>
                                    <div class="form-group">
                                        <label for="address">Address <span class="required">*</span></label>
                                        <textarea id="address" name="address" class="form-control" required rows="4"><?php echo $row["address"]  ?>"</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone_number">Phone no. <span class="required">*</span></label>
                                        <input type="text" id="phone_number" name="phone_number" class="form-control" value="<?php echo $row["phone_number"]  ?>" required />
                                    </div>
                                </div>
                                <div class="form-container">
                                    <div class="form-group">
                                        <label for="email">Email ID <span class="required">*</span></label>
                                        <input type="email" id="email" name="email" class="form-control" value="<?php echo $row["email"]  ?>" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="username">Username <span class="required">*</span></label>
                                        <input type="text" id="username" name="username" class="form-control" value="<?php echo $row["username"]  ?>" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password <span class="required">*</span></label>
                                        <input type="text" id="password" name="password" class="form-control" value="<?php echo $row["password"]  ?>" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="AssignedTurf">Assigned Turf <span class="required">*</span></label>
                                        <select id="AssignedTurf" name="AssignedTurf" class="form-control">
                                        <option value="<?php echo $row["turf_id"]  ?>">Change Turf</option>
                                        <?php
                                         
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
                                        <button class="btn btn-primary btn-lg" id="EditStaff" name="EditStaff">SUBMIT</button>
                                       
                                    </div>
                                    
                                   
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
     
            
<?php
                        if (isset($_POST['EditStaff'])) {
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
                            $sql ="UPDATE staff SET dob = '$dob', gender = '$gender', phone_number = '$phone_number', email = '$email', username = '$username', password = '$password', turf_id = '$turf_id', name = '$name', address='$address' WHERE staff_id=$staff_id";
                        //     $sql = "INSERT INTO staff (dob, gender, address, phone_number, email, username, password, turf_id, name)
                        // VALUES ('$dob', '$gender', '$address', '$phone_number', '$email', '$username', '$password', '$turf_id', '$name')";
                            if ($conn->query($sql) === TRUE) {
                            echo "Staff member updated successfully";
                            echo "<script>window.location.href = 'AdminStaff.php';</script>";  
                            } else {
                            echo "Error editing staff member: " . $conn->error;
                            }
                        }
        }
    } else {
        echo "Error fetching staff: " . mysqli_error($conn);
    }
}
mysqli_close($conn);
?>

    
</body>
</html>