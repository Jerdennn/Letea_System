<?php require_once '../require/navbar.php'; ?>
<?php require_once '../require/sidebar.php'; ?>
<?php $sql = "SELECT DISTINCT category_name, CATEGORY_ID FROM category order by category_name asc";
$result = mysqli_query($db, $sql) or die ("Bad SQL: $sql");
$opt = "<select name='category'>
<option disabled selected>CATEGORY</option>";
while ($row = mysqli_fetch_assoc($result)) {
    $opt .= "<option value='".$row['CATEGORY_ID']."'>".$row['category_name']."</option>";
}
$opt .= "</select>";

$sql2 = "SELECT DISTINCT SUPPLIER_ID, supplier_name FROM supplier order by supplier_name asc";
$result2 = mysqli_query($db, $sql2) or die ("Bad SQL: $sql2");
$sup = "<select name='supplier'> <option disabled selected>SUPPLIER</option>";
while ($row = mysqli_fetch_assoc($result2)) {
    $sup .= "<option value='".$row['SUPPLIER_ID']."'>".$row['supplier_name']."</option>";
}
$sup .= "</select>";
?>
<div class="wrapper">
    <div class="row">
        <div class="header">
            <h3 style="text-transform:uppercase;">
                &nbsp; &nbsp; Product &nbsp;
                <a href="#" id="modal-open"><i class="fas fa-plus"></i></a>
            </h3>
        </div>
        <div class="col-20 col-m-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3 style="text-transform:uppercase;">
                        Product List
                    </h3>
                </div>
                <div class="card-content">
                   <?php $query=mysqli_query($db,"SELECT *, p_price * p_qty as total FROM product INNER JOIN category ON category.category_ID = product.cat_ID INNER JOIN supplier ON supplier.supplier_ID = product.supplier_ID ORDER BY p_name" )or die(mysqli_error($db));
                    ?>
                    <table>
                        <thead>
                            <tr>
                             
                                <th>Picture</th>
                                <th>Product Code</th>
                                <th>Product Name</th>
                                <th>Description</th>
                                <th>Supplier</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Category</th>
                                
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row=mysqli_fetch_array($query)){ ?>
                            <tr>
                                <?php 
                               $availableqty=$row['p_qty'];
				if ($availableqty < 15) {
				echo '<tr style="color: #fff; background:rgb(255, 95, 66);">';
				}
				else {
				echo '<tr>';
				}
			?>
                                <td><img style="width:80px;height:60px" src=" ../../../../public_html/img/dist/uploads/<?php echo $row['p_pic'];?>"></td>
                                <td><?php echo $row['p_code'];?></td>
                                <td><?php echo $row['p_name'];?></td>
                                <td><?php echo $row['p_descrp'];?></td>
                                <td><?php echo $row['supplier_name'];?></td>
                                <td><?php echo $row['p_qty'];?></td>
                                <td><?php echo $row['p_price'];?></td>
                                <td><?php echo $row['category_name'];?></td>
                                <td><?php echo number_format($row['total']);?></td>
                                <td>
                                <a href="update_product.php?pro=<?php echo $row['p_id']; ?>"><i class="fas fa-pen fa-l"></i></a>
                                <a href="admin_product.php?pro_del=<?php echo $row['p_id']; ?>"><i class="fas fa-trash fa-l"></i></a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="contact-modal" class="modal">
    <div id="modal-content">
        <div id="modal-header">
            <span class="close-modal">&times;</span>
            <h2>add products</h2>
        </div>
        <div id="modal-body">
            <form method="post" action="admin_product_add.php" enctype="multipart/form-data">
                <div class="form-group">
                            <input type="hidden" name="pro_id" >
                        </div>
                           <div class="form-group">
                            <!--<label>Product Code</label>-->
                            <input type="text" name="p_code"  placeholder="PRODUCT CODE">
                        </div>
                        <div class="form-group">
                            <!--<label>Product Name</label>-->
                            <input type="text" name="p_name"  placeholder="PRODUCT NAME">
                        </div>
                        <div class="form-group">
                            <!--<label>Product Description</label>-->
                            <textarea type="text" rows="5" cols="50" name="p_descrp"  placeholder="PRODUCT DESCRIPTION"></textarea>
                        </div>
                        <div class="form-group">
                            <!--<label>Supplier</label>-->
                            <?php
                                echo $opt;
                            ?>
                        </div>
                        <div class="form-group">
                            <!--<label>Product Price</label>-->
                            <input type="text" name="price" placeholder="PRODUCT PRICE">
                        </div>

                        <div class="form-group">
                            <!--<label>Category</label>-->
                           <?php
                                echo $sup;
                            ?>
                        </div>
                        <div class="form-group">
                            <!--<label>Product Qty</label>-->
                            <input type="number" name="p_qty"  placeholder="PRODUCT QUANTITY">
                        </div>
                        

                        <div class="form-group">
                            <input type="file" class="form-control" id="price" name="image">
                        </div>
                        <!--
                    <div class="form-group">
                        <label>Date Stock in</label>
                        <input type="Date" name="customer" value="<?php //echo $customer_name; ?>">
                    </div>
                -->
                <input type="submit" name="p_save" value="SAVE">
            </form>
        </div>
        <div id="modal-footer">
            <h3>Le'tea Milktea Hub &copy; 2019</h3>
        </div>
    </div>
</div>


<?php require_once '../require/footer.php';?>