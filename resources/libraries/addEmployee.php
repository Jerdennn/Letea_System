<?php
require_once '../config.php';
if(isset($_POST['save_employee'])){
    $firstname = $_POST['fname'];
    $lastname = $_POST['lname'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $roles = $_POST['roles'];
    $address = $_POST['address'];
    $status = $_POST['status'];
    $date = $_POST['date_hired'];

    $query = "SELECT * FROM employee";
    $result = mysqli_query($db,$query) or die(mysqli_error($db));

     $counter = mysqli_num_rows($result);
        if ($counter > 0 ): ?>
        <script type="text/javascript">
            alert("Employee Already Exist!");
            window.location = "../templates/employee.php";
        </script>
        <?php  
        else: 
            mysqli_query($db,"INSERT INTO EMPLOYEE(ROLE_ID,FIRSTNAME,LASTNAME,PHONE,ADDRESS,GENDER,STATUS,DATE_OF_HIRED) VALUES ('$roles','$firstname','$lastname','$phone','$address','$gender','$status','$date')") OR die(mysqli_error($db));
        endif; ?>
        <script type="text/javascript">
            alert("Successfully save employee");
            window.location = "../templates/employee.php";
        </script>
        <?php }?>