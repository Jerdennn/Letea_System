<?php
require '../config.php';
    $customer_id = $_POST['customer_id'];
    $customer_name = $_POST['customer_name'];
    $customer_address = $_POST['customer_address'];
    $customer_phone = $_POST['customer_phone'];

    $query = "UPDATE customer SET customer_name = '$customer_name', customer_address = '$customer_address', customer_phone = '$customer_phone' WHERE customer_id = '$customer_id'";
    mysqli_query($db,$query); 
    ?>
    <script type="text/javascript">
    alert('Customer Successfully updated');
    window.location = '../templates/customer.php';
    </script>
