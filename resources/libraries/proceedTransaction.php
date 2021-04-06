<?php
session_start();
$user_id = $_SESSION['user_id'];
$merchant_id = $_SESSION['merchant'];
include '../config.php';

function createRandomPassword() {
	$chars = "003232303232023232023456789";
	srand((double)microtime()*1000000);
	$i = 0;
	$pass = '' ;
	while ($i <= 7) {

		$num = rand() % 33;

		$tmp = substr($chars, $num, 1);

		$pass = $pass . $tmp;

		$i++;

	}
	return $pass;
}
$finalcode='RS-'.createRandomPassword(); 

if(isset($_POST['proceed_transaction'])){
    $date = $_POST['date'];
    $invoice = $_POST['invoice'];
    $payment = $_POST['payment'];
    $total = $_POST['total'];
    $customer = $_POST['customer'];
    $cash = $_POST['cash'];

    $newtotal = $cash - $total;

    $query2 = "SELECT * FROM order_item WHERE invoice = '$invoice'";
    $result2 = mysqli_query($db,$query2);
    if(mysqli_num_rows($result2) > 0){
        while($row2 = mysqli_fetch_array($result2)){
            $order = $row2['order_id'];
            
        }
    }

    $query = "INSERT INTO transaction (user_id, order_id, merchant_id, customer_id, cash, balance, payment, transaction_date) VALUES('$user_id ','$order','$merchant_id','$customer','$cash',' $newtotal','$payment','$date')";
    mysqli_query($db,$query) or die(mysqli_error($db)); 
    echo "<script> alert('Successfully Paid') 
    window.location = '../templates/transaction.php?id=$payment&invoice=$finalcode' </script>";
    
}?>