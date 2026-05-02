<?php
include 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>search staff</title>
    
</head>
<body>
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
</body>
</html>