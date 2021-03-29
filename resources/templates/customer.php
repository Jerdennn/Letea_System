<?php require_once '../require/navbar.php';?>
<?php require_once '../require/sidebar.php';?>
<div class="wrapper">
    <div class="row">
        <div class="header">
            <h3 style="text-transform:uppercase;">
                &nbsp; &nbsp; Customer &nbsp;
                <button href="#addCustomer" class="btn btn-primary" data-toggle="modal" data-target="#addCustomer"><i class="fas fa-plus"></i> Customer</button>
            </h3>
        </div>
    </div>
    <div class="row">
        <div class="col-20 col-m-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3 style="text-transform:uppercase;">
                        Customer
                    </h3>
                </div>
                <div class="card-content">
                    <table style="text-align:left;">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Contact</th>
                                <th style="text-align:center;">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php 
        $query ='SELECT * FROM customer ORDER BY customer_id asc';
        $result = mysqli_query($db, $query) or die (mysqli_error($db)); ?>

                            <?php foreach($result as $data): ?>
                            <tr>
                                <td><?php echo $data['customer_id']?></td>
                                <td><?php echo $data['customer_name']?></td>
                                <td><?php echo $data['customer_address']?></td>
                                <td><?php echo $data['customer_phone']?></td>
                                <td style="text-align:center;">
                                <button data-toggle="modal" data-target="#editCustomer<?php echo $data['customer_id']?>" type="button" class="btn btn-primary bg-gradient-primary"><i class="fas fa-pen fa-m"> Edit</i></button>
                                <button href="admin_category.php?cat_del=<?php echo $data['customer_id']?>" class="btn btn-danger"><i class="fas fa-trash fa-m"> Delete</i></button>
                                </td>
                            </tr>
<!-- EDIT MODAL FOR CUSTOMER -->
<div class="modal fade" id="editCustomer<?php echo $data['customer_id']?>" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update Customer</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" action="../libraries/editCustomer.php">
          <div class="form-group">
             <input type="hidden" class="form-control" name="customer_id" value="<?php echo $data['customer_id']?>" readonly>
           </div>
           <div class="form-group">
             <input class="form-control"  name="customer_name" required value="<?php echo $data['customer_name']?>">
           </div>
           <div class="form-group">
             <textarea rows="5" cols="50" class="form-control" name="customer_address" required><?php echo $data['customer_address']?></textarea>
           </div>
           <div class="form-group">
             <input class="form-control" name="customer_phone" required value="<?php echo $data['customer_phone']?>">
            </div>
          <div class="modal-footer">
          <h6>Le'tea Milktea Hub &copy; 2019</h6>
            <button class="btn btn-default" type="button" data-dismiss="modal">Cancel</button>
            <button class="btn btn-primary" type="submit">Update</button>
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

<?php include '../require/footer.php'; ?>


<!-- MODAL FOR ADD BRANCH -->
<div class="modal fade" id="addCustomer" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Customer</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post" action="../libraries/addCustomer.php">
           <div class="form-group">
             <input class="form-control" placeholder="Customer name" name="customer_name" required>
           </div>
           <div class="form-group">
             <textarea rows="5" cols="50" class="form-control" placeholder="Customer Address" name="customer_address" required></textarea>
           </div>
           <div class="form-group">
             <input class="form-control" placeholder="Customer Phone" name="customer_phone" required>
           </div>
          <div class="modal-footer">
          <h6>Le'tea Milktea Hub &copy; 2019</h6>
            <button class="btn btn-default" type="button" data-dismiss="modal">Cancel</button>
            <button class="btn btn-primary" type="submit" name="save_customer">Save</button>
            <button type="reset" class="btn btn-danger"><i class="fa fa-times fa-fw"></i>Reset</button>
         </div>
         </form>  
        </div>
      </div>
    </div>
  </div>