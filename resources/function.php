<?php
    require_once 'config.php';

if(isset($_GET['editItem'])){
    $id = $_GET['editItem'];
    $record = mysqli_query($db,"SELECT * FROM item WHERE item_id=$id");
    if (count($record) == 1 ) {
			$data = mysqli_fetch_array($record);
			$sku = $data['barcode'];
            $item_name = $data['item_name'];
            $description = $data['description'];
            $qty = $data['qty'];
            $price = $data['price'];
            $category = $data['category'];           
            $date_stockin = $data['date'];
		}
}





