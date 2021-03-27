<?php
require_once '../config.php';
if(isset($_POST['save_customer'])){
    $customer_name = $_POST['customer_name'];
    $customer_address = $_POST['customer_address'];
    $customer_phone = $_POST['customer_phone'];

    $query = "SELECT * FROM CUSTOMER";
    $result = mysqli_query($db,$query) or die(mysqli_error($db));

     $counter = mysqli_num_rows($result);
        if ($counter > 0 ): ?>
        <script type="text/javascript">
            alert("Customer Already Exist!");
            window.location = "../templates/customer.php";
        </script>
        <?php  
        else: 
            mysqli_query($db,"INSERT INTO CUSTOMER(CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_PHONE) VALUES ('$customer_name','$customer_address','$customer_phone')") OR die(mysqli_error($db));
        endif; ?>
        <script type="text/javascript">
            alert("Successfully save customer");
            window.location = "../templates/customer.php";
        </script>
        <?php }?>