<?php
require_once '../config.php';
if(isset($_POST['save_user'])){
    $employee_id = $_POST['employee'];
    $role_id = $_POST['roles'];
    $merchant_id = $_POST['merchant'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $status = $_POST['status'];

    $passwordHash = PASSWORD_HASH($password, PASSWORD_DEFAULT);

    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($db,$query) or die(mysqli_error($db));

     $counter = mysqli_num_rows($result);
        if ($counter > 0 ): ?>
        <script type="text/javascript">
            alert("Employee Already Exist!");
            window.location = "../templates/user.php";
        </script>
        <?php  
        else: 
            mysqli_query($db,"INSERT INTO users(role_id,merchant_id,employee_id,username,passwordHash,email,status) VALUES ('$role_id','$merchant_id','$employee_id','$username','$passwordHash','$email','$status')") OR die(mysqli_error($db));
        endif; ?>
        <script type="text/javascript">
            alert("Successfully save employee");
            window.location = "../templates/user.php";
        </script>
        <?php }?>