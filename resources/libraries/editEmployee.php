<?php
require_once '../config.php';

    $employee_id = $_POST['employee_id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $roles = $_POST['roles'];
    $status = $_POST['status'];
    $date = $_POST['date_hired'];

    $query = "UPDATE employee 
    SET firstname = '$fname', lastname = '$lname', phone = '$phone', gender = '$gender', address = '$address', date_of_hired = '$date', employee_status = '$status', role_id = '$roles' WHERE employee_id = '$employee_id'";
    mysqli_query($db,$query) or die(mysqli_error($db));
?>
    <script type="text/javascript">
    alert('Employee Successfully updated');
    window.location = '../templates/employee.php';
    </script>


