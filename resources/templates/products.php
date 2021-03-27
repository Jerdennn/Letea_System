<?php require_once '../require/navbar.php'; ?>
<?php require_once '../require/sidebar.php'; ?>
<div class="wrapper">
    <div class="row">
        <div class="header">
            <h3 style="text-transform:uppercase;">
                &nbsp; &nbsp; Ingredient &nbsp;
        <a href="#addItem" class="btn btn-primary" data-toggle="modal" data-target="#addItem"><i class="fas fa-plus"></i> Item</a>
        <a href="#addStock" class="btn btn-primary" data-toggle="modal" data-target="#addStock"><i class="fas fa-plus"></i> Stock</a>
            </h3>
        </div>
        <div class="col-20 col-m-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3 style="text-transform:uppercase;">
                        Ingredient List
                    </h3>
                </div>
                <div class="card-content">
                    <?php 
                    $query = "SELECT *, price * qty as total FROM item INNER JOIN category ON category.category_ID = item.category_ID ORDER BY item_id ASC LIMIT 10";
                    $result = mysqli_query($db,$query)or die(mysqli_error($db));
                    ?>
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Picture</th>
                                <th>SKU</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Category</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Date</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            foreach($result as $data): ?>
                            <tr>
                                <?php 
                               $availableqty = $data['qty'];
				if ($availableqty < 15) {
				echo '<tr style="color: #fff; background:rgb(255, 95, 66);">';
				}
				else {
				echo '<tr>';
				}
			?>
                                <td><?php echo $data['item_id'];?></td>
                                <td><img style="width:80px;height:60px"
                                        src=" ../../../../public_html/img/dist/uploads<?php echo $data['item_image'];?>">
                                </td>
                                <td><?php echo $data['SKU'];?></td>
                                <td><?php echo $data['item_name'];?></td>
                                <td><?php echo $data['description'];?></td>
                                <td><?php echo $data['qty'];?></td>
                                <td><?php echo $data['price'];?></td>
                                <td><?php echo $data['category_name'];?></td>
                                <td><?php echo $data['created_at'];?></td>
                                <td><?php echo number_format($data['total']);?></td>
                                <td>
                                <button data-toggle="modal" data-target="#editProduct<?php echo $data['item_id']?>" type="button" class="btn btn-primary bg-gradient-primary"><i class="fas fa-pen fa-m"> Edit</i></button>
                                <button href="admin_category.php?cat_del=<?php echo $data['item_id']?>" class="btn btn-danger"><i class="fas fa-trash fa-m"> Delete</i></button>
                                </td>
                            </tr>
<!-- EDIT MODAL FOR ITEMS -->
 <div class="modal fade" id="editProduct<?php echo $data['item_id']?>" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Item</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post" action="" class="form-horizontal">
          <div class="form-group">
             <input type="text" class="form-control" value="<?php echo $data['item_id']?>" readonly readonly>
           </div>
           <div class="form-group">
           <input type="text" placeholder="Barcode" name="barcode" value="<?php echo $data['SKU']?>" class="form-control" />
           </div>
           <div class="form-group">
           <input type="text" name="item_name" value="<?php echo $data['item_name']?>" class="form-control" placeholder="Item name" />
           </div>
           <div class="form-group">
             <textarea rows="5" cols="50" class="form-control" placeholder="Description" name="description" required><?php echo $data['description']?></textarea>
           </div>
            <div class="form-group">
            <input type="number" placeholder="Quantity" name="quantity" value="<?php echo $data['qty']?>" min="0" max="999999999" class="form-control" />
            </div>
            <div class="form-group">
            <input type="number" placeholder="Price" name="price" value="<?php echo $data['price']?>" class="form-control" />
            </div>
            <div class="form-group">
            <input type="date" name="stock_in" class="form-control" />
            </div>
           <div class="form-group">
           <select name="status" class="form-control" value="<?php echo $data['status']?>">
           <option readonly>Select Category</option>
           <?php 
           $query = "SELECT * FROM CATEGORY ORDER BY CATEGORY_ID";
           $result = mysqli_query($db,$query) or die(mysqli_error($db));
           foreach($result as $data):
           ?>
            <option value="<?php echo $data['category_id']?>"><?php echo strtoupper($data['category_name'])?></option>
           <?php endforeach; ?>
           </select>
           </div>

           <div class="form-group">
           <input type="file" name="image" class="form-control">
           </div>
          <div class="modal-footer">
          <h6>Le'tea Milktea Hub &copy; 2019</h6>
            <button class="btn btn-default" type="button" data-dismiss="modal">Cancel</button>
            <button class="btn btn-primary" type="submit" name="btn_save">Update</button>
         </div>
         </form>  
        </div>
      </div>
    </div>
  </div>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once '../require/footer.php';?>

<!-- ADD MODAL FOR ITEMS -->
<div class="modal fade" id="addItem" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Item</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post" action="../libraries/addProduct.php" class="form-horizontal">
          <div class="form-group">
             <input type="hidden" class="form-control" readonly>
           </div>
           <div class="form-group">
           <input type="text" placeholder="Barcode" name="barcode" class="form-control" required/>
           </div>
           <div class="form-group">
           <input type="text" name="item_name" class="form-control" placeholder="Item name" required/>
           </div>
           <div class="form-group">
             <textarea rows="5" cols="50" class="form-control" placeholder="Description" name="description" required></textarea>
           </div>
            <div class="form-group">
            <input type="number" placeholder="Quantity" name="quantity" min="0" max="999999999" class="form-control" />
            </div>
            <div class="form-group">
            <input type="number" placeholder="Price" name="price" value="" class="form-control" />
            </div>
            <div class="form-group">
            <input type="date" name="stock_in" class="form-control" />
            </div>
           <div class="form-group">
           <select name="category" class="form-control">
           <option readonly>Select Category</option>
           <?php 
           $query = "SELECT * FROM CATEGORY ORDER BY CATEGORY_ID";
           $result = mysqli_query($db,$query) or die(mysqli_error($db));
           foreach($result as $data):
           ?>
            <option value="<?php echo $data['category_id']?>"><?php echo strtoupper($data['category_name'])?></option>
           <?php endforeach; ?>
           </select>
           </div>
           <div class="form-group">
           <input type="file" name="image" class="form-control">
           </div>
          <div class="modal-footer">
          <h6>Le'tea Milktea Hub &copy; 2019</h6>
            <button class="btn btn-default" type="button" data-dismiss="modal">Cancel</button>
            <button class="btn btn-primary" type="submit" name="save_item">Save</button>
            <button type="reset" class="btn btn-danger"><i class="fa fa-times fa-fw"></i>Reset</button>
         </div>
         </form>  
        </div>
      </div>
    </div>
  </div>

  
<!-- ADD MODAL FOR ITEMS -->
<div class="modal fade" id="addStock" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Stock Quantity</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post" action="../libraries/addProduct.php" class="form-horizontal">
           <div class="form-group">
           <select name="category" class="form-control">
           <option readonly>Select Category</option>
           <?php 
           $query = "SELECT * FROM item ORDER BY item_id";
           $result = mysqli_query($db,$query) or die(mysqli_error($db));
           foreach($result as $data):
           ?>
            <option value="<?php echo $data['item_id']?>"><?php echo strtoupper($data['item_name'])?></option>
           <?php endforeach; ?>
           </select>
           </div>
           <div class="form-group">
            <input type="number" placeholder="Quantity" name="quantity" min="0" max="999999999" class="form-control" />
            </div>
          <div class="modal-footer">
          <h6>Le'tea Milktea Hub &copy; 2019</h6>
            <button class="btn btn-default" type="button" data-dismiss="modal">Cancel</button>
            <button class="btn btn-primary" type="submit" name="save_item">Save</button>
            <button type="reset" class="btn btn-danger"><i class="fa fa-times fa-fw"></i>Reset</button>
         </div>
         </form>  
        </div>
      </div>
    </div>
  </div>