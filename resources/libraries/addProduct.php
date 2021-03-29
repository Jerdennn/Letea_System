<?php 
session_start();
require_once '../config.php';
$merchant = $_SESSION['merchant'];
$user_id = $_SESSION['user_id'];

if (isset($_POST['save_item'])){
    $sku = $_POST['barcode'];
    $item_name = $_POST['item_name'];
    $description = $_POST['description'];
    $qty = $_POST['quantity'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $date_stockin = $_POST['stock_in'];

    $query = "SELECT * FROM ITEM i INNER JOIN category c ON c.category_id = i.category_id WHERE item_name = '$item_name' AND merchant_id = '$merchant'";
    $result = mysqli_query($db,$query) or die(mysqli_error($db));
    $count = mysqli_num_rows($result);

    if($count > 0){ ?>
         <script type = "text/javascript">
            alert("Product Already Exist!");
            window.location = "../templates/products.php";
        </script>
    <?php }
    else{
        $pic = $_FILES["image"]["name"];
        if ($pic=="")
        {
            $pic="default.gif";
        }
        else
        {
            $pic = $_FILES["image"]["name"];
            $type = $_FILES["image"]["type"];
            $size = $_FILES["image"]["size"];
            $temp = $_FILES["image"]["tmp_name"];
            $error = $_FILES["image"]["error"];
        
            if ($error > 0){
                die("Error uploading file! Code $error.");
                }
            else{
                if($size > 100000000000) //conditions for the file
                    {
                    die("Format is not allowed or file size is too big!");
                    }
                else
                  {
                move_uploaded_file($temp, "../../public_html/img/dist/uploads/".$pic);
                  }
                }
            }	
        
        mysqli_query($db,"INSERT INTO item(merchant_id,user_id,sku,item_name,description,category_id,qty,price,item_image,created_at)
        VALUES('$merchant','$user_id','$sku','$item_name','$description','$category','$qty','$price','$pic','$date_stockin')")or die(mysqli_error($db));
        }
        ?>
       <script type = "text/javascript">
        alert('Successfully added new item!');
        window.location = "../templates/products.php";
       </script> 
   <?php } ?>