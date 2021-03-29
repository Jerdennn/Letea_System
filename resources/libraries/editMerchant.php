<?php
require '../config.php';
    $merchant_id = $_POST['merchant_id'];
    $merchant_name = $_POST['merchant_name'];
    $merchant_address = $_POST['merchant_address'];
    $merchant_phone = $_POST['merchant_phone'];
    $merchant_email = $_POST['merchant_email'];


    $query = "UPDATE merchant SET merchant_name = '$merchant_name', merchant_address = '$merchant_address', merchant_phone = '$merchant_phone', merchant_email = '$merchant_email' WHERE merchant_id = '$merchant_id'";
    mysqli_query($db,$query); 
    ?>
    <script type="text/javascript">
    alert('Merchant Successfully updated');
    window.location = '../templates/branch.php';
    </script>
