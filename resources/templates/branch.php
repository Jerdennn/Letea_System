<?php require_once '../require/navbar.php'; ?>
<?php require_once '../require/sidebar.php'; ?>
<div class="wrapper">
    <div class="row">
        <div class="header">
            <h3 style="text-transform:uppercase;">
                &nbsp; &nbsp; Merchant &nbsp;
                <button href="#addMerchant" class="btn btn-primary" data-toggle="modal" data-target="#addMerchant"><i class="fas fa-plus"></i> Merchant</button>
            </h3>
        </div>
        <div class="col-20 col-m-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 style="text-transform:uppercase;">
                        Merchant List
                    </h4>
                </div>
                <div class="card-content">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Merchant Name</th>
                                <th>Address</th>
                                <th>Contact</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
        $query ="SELECT * FROM MERCHANT ORDER BY MERCHANT_ID ASC";
        $result = mysqli_query($db, $query) or die (mysqli_error($db)); ?>

                            <?php foreach($result as $data): ?>

                            <tr>
                                <td><?php echo $data['merchant_id']?></td>
                                <td><?php echo strtoupper($data['merchant_name'])?></td>
                                <td><?php echo $data['merchant_address']?></td>
                                <td><?php echo $data['merchant_phone']?></td>
                                <td><?php echo $data['merchant_email']?></td>
                                <td><?php $status = $data['status'];
                                if ($status == 0):
                                  echo "Available";
                                else:
                                  echo "Unavailable";
                                endif;
                                ?></td>
                                <td>
                <button class="btn btn-primary" data-toggle="modal" data-target="#editMerchant<?php echo $data['merchant_id']?>"><i class="fas fa-pen fa-m"> Edit </i></button> 
                <button href="#addItem" class="btn btn-danger" data-toggle="modal" data-target="#addItem"><i class="fas fa-trash fa-m"> Delete</i></button>
                                </td>
                            </tr>
<!-- EDIT MODAL FOR MERCHANT -->
<div class="modal fade" id="editMerchant<?php echo $data['merchant_id']?>" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Merchant</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" action="../libraries/editMerchant.php">
          <div class="form-group">
             <input type="hidden" class="form-control" name="merchant_id" required value="<?php echo $data['merchant_id']?>" readonly>
           </div>
           <div class="form-group">
             <input class="form-control"  name="merchant_name" required value="<?php echo $data['merchant_name']?>">
           </div>
           <div class="form-group">
             <textarea rows="5" cols="50" class="form-control" name="merchant_address" required><?php echo $data['merchant_address']?></textarea>
           </div>
           <div class="form-group">
             <input class="form-control" name="merchant_phone" required value="<?php echo $data['merchant_phone']?>">
           </div>
           <div class="form-group">
             <input class="form-control" name="merchant_email" required value="<?php echo $data['merchant_email']?>">
           </div>
           <div class="form-group">
           <select name="status" class="form-control">
           <option readonly>Select Merchant Status</option>
           <option value=0>Available</option>
           <option value=1>Unavailable</option>
           </select>
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

<!-- MODAL FOR ADD BRANCH -->
<div class="modal fade" id="addMerchant" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Merchant</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" action="../libraries/addMerchant.php">
           <div class="form-group">
             <input type="text" class="form-control" placeholder="Merchant name" name="merchant_name" required>
           </div>
           <div class="form-group">
             <textarea rows="5" cols="50" class="form-control" placeholder="Merchant Address" name="merchant_address" required></textarea>
           </div>
           <div class="form-group">
             <input type="text" class="form-control" placeholder="Merchant Phone" name="merchant_phone" required>
           </div>
           <div class="form-group">
             <input type="text" class="form-control" placeholder="Merchant Email" name="merchant_email" required>
           </div>
           <div class="form-group">
           <select name="status" class="form-control">
           <option readonly>Select Merchant Status</option>
           <option value=0>Available</option>
           <option value=1>Unavailable</option>
           </select>
           </div>
          <div class="modal-footer">
          <h6>Le'tea Milktea Hub &copy; 2019</h6>
            <button class="btn btn-default" type="button" data-dismiss="modal">Cancel</button>
            <button class="btn btn-primary" type="submit" name="save_merchant">Save</button>
            <button type="reset" class="btn btn-danger"><i class="fa fa-times fa-fw"></i>Reset</button>
         </div>
         </form>  
        </div>
      </div>
    </div>
  </div>