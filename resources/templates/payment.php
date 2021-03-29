<!-- MODAL FOR SAVE TRANSACTION -->
  <div class="modal fade" id="payment" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post" action="">
          <div class="form-group">
             <input class="form-control" readonly name="date" value="<?php echo date('Y-m-d')?>" required>
           </div>
           <div class="form-group">
             <input class="form-control" readonly name="invoice" value="<?php echo $_GET['invoice']?>" required>
           </div>
           <div class="form-group">
             <input class="form-control" readonly name="payment" value="<?php echo $_GET['id']?>" required>
           </div>
           <div class="form-group">
             <input class="form-control" readonly name="total" value="<?php echo $total?>" required>
           </div>
           <div class="form-group">
           <input class="form-control" readonly name="user" value="<?php echo $_SESSION['name']?>" required>
           </div>
           <div class="form-group">
              <select name="" id="" class="form-control">
              <option readonly>Select Customer</option>
              <?php $query = "SELECT * FROM CUSTOMER";
              $result = mysqli_query($db,$query) or die(mysqli_error($db));
              foreach($result as $data):?>
              <option value="<?php echo $data['customer_id']?>"><?php echo $data['customer_name']?></option>
              <?php endforeach; ?>
              </select>
           </div>
           <div class="form-group">
            <input class="form-control" name="cash" placeholder="Checkout" type="text" required />
           </div>
          <div class="modal-footer">
          <h6>Le'tea Milktea Hub &copy; 2019</h6>
            <button class="btn btn-default" type="button" data-dismiss="modal">Cancel</button>
            <button class="btn btn-primary" type="submit" name="save_checkout">Save</button>
            <button type="reset" class="btn btn-danger"><i class="fa fa-times fa-fw"></i>Reset</button>
         </div>
         </form>  
        </div>
      </div>
    </div>
  </div>