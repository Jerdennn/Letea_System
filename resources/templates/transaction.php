<?php require_once '../require/navbar.php'; ?>
<?php require_once '../require/sidebar.php'; 

function formatMoney($number, $fractional=false) {
    if ($fractional) {
        $number = sprintf('%.2f', $number);
    }
    while (true) {
        $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
        if ($replaced != $number) {
            $number = $replaced;
        } else {
            break;
        }
    }
    return $number;
}
?>
<div class="wrapper">
    <div class="row">
        <div class="header">
            <h3 style="text-transform:uppercase;">
                &nbsp; &nbsp; Sales &nbsp;
            </h3>
        </div>
    </div>
    <form method="POST" action="../libraries/transaction_incoming.php" class="row gy-2 gx-3 align-items-center">
    <div class="col-auto">
    </div>
    <div class="col-auto">
        <select name="item" id="" class="form-control">
        <option readonly>SELECT FLAVOR</option>
        <?php $query = "SELECT * FROM item i INNER JOIN category c ON c.category_id = i.category_id WHERE category_name = 'POWDER' and qty > 15";
        $result = mysqli_query($db,$query) or die(mysqli_error($db));
        foreach($result as $data):?>
        <option value="<?php echo $data['item_id']?>"><?php echo $data['item_name']?></option>
        <?php endforeach;?>    
        </select>
    </div>
    <div class="col-auto">
        <input type="number" class="form-control" value="0" min="0" max="9999999999999999"? name="qty">
    </div>
    <button type="submit" name="transaction_save" class="btn btn-info" style="width: 123px; height:40px; margin-top:8px;"><i class="fas fa-plus"></i> ADD</button>
    <div class="col-auto">
        <input type="hidden" class="form-control" readonly value="<?php echo $_GET['invoice']?>" name="invoice" >
    </div>
    <div class="col-auto">
        <input type="hidden" class="form-control" readonly value="<?php echo $_GET['id']?>" name="cash">
    </div>
    <div class="col-auto">
        <input type="hidden" class="form-control" readonly value="<?php echo date("Y-m-d"); ?>" name="date">
    </div>
    </form>
        <div class="col-20 col-m-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 style="text-transform:uppercase;">
                       Transaction
                    </h4>
                </div>
                <div class="card-content">
                    <table>
                        <thead>
                            <tr>
                                <th>Product name</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
        $query ="SELECT * FROM order_item o INNER JOIN item i on i.item_id = o.item_id WHERE invoice = '".$_GET['invoice']."'";
        $result = mysqli_query($db, $query) or die (mysqli_error($db)); ?>

                            <?php foreach($result as $data): ?>

                            <tr>
                                <td><?php echo $data['item_name']?></td>
                                <td><?php echo strtoupper($data['qty'])?></td>
                                <td><?php $price = $data['price'];
                                echo formatMoney($price, true); ?></td>
                                <td><?php  $amount = $data['amount'];
                                echo formatMoney($amount, true);?></td>
                                <td>
                                <button href="#addItem" class="btn btn-danger" data-toggle="modal" data-target="#addItem"><i class="fa fa-times"> Cancel</i></button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>Total Amount:</th>
                            </tr>
                            <tr>
                                <th>Total:</th>
                                <td></td>
                                <td></td>
                                <td><?php
                                $invoice = $_GET['invoice'];
                                $query1 = "SELECT sum(amount) FROM order_item WHERE invoice = '$invoice'";
                                $result1 = mysqli_query($db,$query1) or die(mysqli_error($db));
                                foreach($result1 as $data):
                                    $total = $data['sum(amount)'];
                                    echo formatMoney($total, true);
                                endforeach;
                                ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <button class="btn btn-success" data-toggle="modal" data-target="#payments"><i class="fas fa-save fa-m"> Transaction</i></button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once '../require/footer.php';?>

<div class="modal fade" id="payments" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Payment</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post" action="">
          <div class="form-group">
             <input class="form-control" type="hidden" readonly name="date" value="<?php echo date('Y-m-d')?>" required>
           </div>
           <div class="form-group">
             <input class="form-control" type="hidden" readonly name="invoice" value="<?php echo $_GET['invoice']?>" required>
           </div>
           <div class="form-group">
             <input class="form-control" type="hidden" readonly name="payment" value="<?php echo $_GET['id']?>" required>
           </div>
           <div class="form-group">
             <input class="form-control" type="hidden" readonly name="total" value="<?php echo $total?>" required>
           </div>
           <div class="form-group">
           <input class="form-control" type="hidden" readonly name="user" value="<?php echo $_SESSION['name']?>" required>
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
            <input class="form-control" name="cash" placeholder="CASH" type="number" required />
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