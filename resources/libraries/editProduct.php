<?php
require '../config.php';

    $item_id = $_POST['item_id'];
    $item_name = $_POST['item_name'];
    $description = $_POST['description'];
    $qty = $_POST['quantity'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $date_stockin = $_POST['stock_in'];

    $query = "UPDATE item SET item_name = '$item_name', description = '$description', category_id = '$category', qty = '$qty', price = '$price', updated_at = '$date_stockin' WHERE item_id = '$item_id'";
    mysqli_query($db,$query); 
    ?>
    <script type="text/javascript">
    alert('Item Successfully updated');
    window.location = '../templates/products.php';
    </script>
