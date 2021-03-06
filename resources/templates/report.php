<?php require_once '../require/navbar.php'; ?>
<?php require_once '../require/sidebar.php'; ?>
<div class="wrapper">
    <div class="row">
        <div class="header">
            <h3 style="text-transform:uppercase;"></h3>
        </div>
    </div>

    <form method="GET" action="report.php" class="row gy-2 gx-3 align-items-center">
        <div class="col-auto">
        </div>
        <div class="col-auto">
            <h3>Select Merchant</h3>
        </div>
        <div class="col-auto">
            <select name="merchant" class="form-control">
                <?php $merchant = $_GET['merchant']?>
                <option readonly>SELECT MERCHANT</option>
                <?php
          $query = "SELECT * FROM merchant";
          $result = mysqli_query($db,$query) or die(mysqli_error($db));
            foreach($result as $data): ?>
                <option value="<?php echo $data['merchant_name']?>"><?php echo $data['merchant_name']?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-success"> Search</button>
        </div>
    </form>
    <center>
        <h3><?php echo $merchant?></h3>
        <?php 
        $query1 = "SELECT * FROM merchant WHERE merchant_name ='$merchant'";
        $result1 = mysqli_query($db,$query1) or die(mysqli_error($db));
        foreach($result1 as $data1):
        ?>
        <h6>Address: <?php echo $data1['merchant_address'];?></h6>
        <h6>Contact #: <?php echo $data1['merchant_phone'];?></h6>
        <?php endforeach; ?>
    </center>
    <div class="col-20 col-m-12 col-sm-12">
        <div class="card">
            <div class="card-header">

                <h3 style="text-transform:uppercase;">
                    <?php 
               echo "Inventory Report for ".$merchant; 
            ?>

                </h3>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>SKU</th>
                        <th>Name</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Total</th>
                        <th>Re-order</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                $query2 = "SELECT *,m.merchant_name FROM item i INNER JOIN merchant m ON m.merchant_id = i.merchant_id WHERE m.merchant_name ='$merchant'";
                $result2 = mysqli_query($db,$query2) or die(mysqli_error($db));
                $grandtotal = 0;
                foreach($result2 as $data2):
                    $total = $data2['qty'] * $data2['price'];
                    $grandtotal += $total
                ?>
                    <tr>
                        <td><?php echo $data2['SKU']?></td>
                        <td><?php echo $data2['item_name']?></td>
                        <td><?php echo $data2['qty']?></td>
                        <td><?php echo $data2['price']?></td>
                        <td><?php echo formatMoney($total,TRUE);?></td>
                        <td>
                            <?php 
                         $qty = $data2['qty']; if($qty <= 20){ ?>
                            <span style="background:red;color:white;border-radius:20px;font-weight:bold;padding:8px;"><i
                                    class="fas fa-sync-alt">Reorder</i></span>
                            <?php }?></td>

                    </tr>
                    <?php endforeach;?>
                    <tr>
                        <td colspan="4">TOTAL</td>
                        <td>???<?php echo formatMoney($grandtotal,TRUE);?></td>
                    </tr>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                      </tr>
                    <tr>
                        <th>Prepared by:</th>
                        <th></th>
                        <th></th>
                        <th></th>
                      </tr> 
<?php
    $id=$_SESSION['user_id'];
    $query=mysqli_query($db,"SELECT * FROM users u INNER JOIN employee e ON e.employee_id = u.employee_id WHERE u.user_id = '$id' ")or die(mysqli_error($db));
    $row=mysqli_fetch_array($query);
 
?>                      
                      <tr>
                        <th><?php echo $row['firstname'];?> <?php echo $row['lastname'];?></th>
                        <th></th>
                        <th></th>
                        <th></th>
                      </tr>  				  
                    <tr>
                        <td>
                            <button class="btn btn-primary">PDF</button>
                            <button class="btn btn-primary">EXCEL</button>
                            <button class="btn btn-primary">PRINT</button>
                        </td>
                    </tr>
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php require_once '../require/footer.php'; ?>