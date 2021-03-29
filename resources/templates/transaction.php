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
        <input type="text" class="form-control" readonly value="<?php echo $_GET['invoice']?>" name="invoice" >
    </div>
    <div class="col-auto">
        <input type="text" class="form-control" readonly value="<?php echo $_GET['id']?>" name="cash">
    </div>
    <div class="col-auto">
        <input type="text" class="form-control" readonly value="<?php echo date("Y-m-d"); ?>" name="date">
    </div>
    <div class="col-auto">
        <select name="item" id="" class="form-control">
        <option readonly>SELECT FLAVOR</option>
        <?php $query = "SELECT * FROM item i INNER JOIN category c ON c.category_id = i.category_id WHERE category_name = 'POWDER'";
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
                    <a href="../templates/payment.php?payment=<?php echo $_GET['payment']?>&invoice=<?php echo $_GET['invoice']?>&total=<?php echo $total?>&user=<?php echo $_SESSION['name']?>"> 
                    <button class="btn btn-success" data-toggle="modal" data-target="#payment"><i class="fas fa-save fa-m"> Transaction</i></button>
                    <?php include '../templates/payment.php'; ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once '../require/footer.php';?>

