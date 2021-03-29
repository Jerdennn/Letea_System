<?php
session_start();

$merchant = $_SESSION['merchant'];
$user_id = $_SESSION['user_id'];

if(isset($_POST['transaction_save'])){
include('../config.php');
$invoice = $_POST['invoice'];
$item_id = $_POST['item'];
$qty = $_POST['qty'];
$payment = $_POST['cash'];
$date = $_POST['date'];
$query = "SELECT * FROM item WHERE item_id = '$item_id'";
$result = mysqli_query($db,$query) or die(mysqli_error($db));
if(mysqli_num_rows($result) > 0):
    while($row = mysqli_fetch_array($result)):
        $barcode = $row['SKU'];
        $price = $row['price'];
    endwhile;
    endif;

    $query1 = "UPDATE item SET qty = qty-'$qty' WHERE item_id = '$item_id'";
    mysqli_query($db,$query1) or die(mysqli_error($db));

    $total = $price * $qty;

    $query2 = "INSERT INTO order_item (item_id,invoice,user_id,merchant_id,SKU,amount,price,qty,created_at) VALUES ('$item_id','$invoice','$user_id','$merchant',' $barcode',' $total',' $price','$qty','$date')";
    mysqli_query($db,$query2) or die(mysqli_error($db));

    header("location: ../templates/transaction.php?id=$payment&invoice=$invoice");
}
?>