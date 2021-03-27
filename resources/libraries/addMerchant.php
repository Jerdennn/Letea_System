<?php
require_once '../config.php';
if(isset($_POST['save_merchant'])){
    $merchant_name = $_POST['merchant_name'];
    $merchant_address = $_POST['merchant_address'];
    $merchant_phone = $_POST['merchant_phone'];
    $merchant_email = $_POST['merchant_email'];
    $merchant_status = $_POST['status'];


    $query = "SELECT * FROM MERCHANT WHERE MERCHANT_NAME = '$merchant_name'";
    $result = mysqli_query($db,$query) or die(mysqli_error($db));

     $counter = mysqli_num_rows($result);
        if ($counter > 0 ): ?>
        <script type="text/javascript">
            alert("Merchant Already Exist!");
            window.location = "../templates/branch.php";
        </script>
        <?php  
        else: 
            mysqli_query($db,"INSERT INTO MERCHANT(MERCHANT_NAME,MERCHANT_ADDRESS,MERCHANT_PHONE,MERCHANT_EMAIL,STATUS) VALUES ('$merchant_name','$merchant_address','$merchant_phone','$merchant_email','$merchant_status')") OR die(mysqli_error($db));
        endif; ?>
        <script type="text/javascript">
            alert("Successfully save merchant");
            window.location = "../templates/branch.php";
        </script>
        <?php }?>