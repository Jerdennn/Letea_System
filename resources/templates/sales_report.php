<?php require_once '../require/navbar.php'; ?>
<?php require_once '../require/sidebar.php'; ?>
<div class="wrapper">
    <div class="row">
        <div class="header">
            <h3 style="text-transform:uppercase;">
                &nbsp; &nbsp; &nbsp; Reports &nbsp;
            </h3>
        </div>

    </div>

    <form method="GET" action="sales_report.php" class="row gy-2 gx-3 align-items-center">
        <div class="col-auto">

        </div>
        <div class="col-auto">
            <h3>Select Merchant</h3>
        </div>
        <div class="col-auto">
            <select name="merchant" class="form-control" required>
                <option readonly>SELECT MERCHANT</option>
                <?php $merchant = $_GET['merchant']?>
                <?php
          $query = "SELECT * FROM merchant";
          $result = mysqli_query($db,$query) or die(mysqli_error($db));
            foreach($result as $data): ?>
                <option value="<?php echo $data['merchant_name']?>"><?php echo $data['merchant_name']?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-auto">
            <h3>From: </h3>
        </div>
        <?php 
         $from_date = $_GET['from'];
         $to_date = $_GET['to'];
        if (date($to_date) < date($from_date)){?>
        <div class=col-auto>
            <input type=date name=from required style='border: 2px solid red;' class=form-control>
        </div>
        <?php } 
        else { ?>
        <div class=col-auto>
            <input type=date name=from required class=form-control>
        </div>
        <?php } ?>
        <div class="col-auto">
            <h3>To: </h3>
        </div>
        <?php 
        if (date($to_date) < date($from_date)) { ?>
        <div class=col-auto>
            <input type=date name=to required style='border: 2px solid red;' class=form-control>
        </div>
        <?php }
       else{ ?>
        <div class=col-auto>
            <input type=date name=to required class=form-control>
        </div>
        <?php }?>
        <div class="col-auto">
            <button type="submit" class="btn btn-success"> Search</button>
        </div>
    </form>
    <br> <br> <br>
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
                    if($merchant!= $merchant){
                        echo "SELECT MERCHANT";
                    }
                    else{
                      echo "Sales Report for ".$merchant; 
                    }
                    ?>
                </h3>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Transaction ID</th>
                        <th>Invoice Number</th>
                        <th>SKU</th>
                        <th>Product Name</th>
                        <th>Customer Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Transaction Date</th>
                        <th>Amount Paid</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $from_date = $_GET['from'];
                    $to_date = $_GET['to'];
                    $grandtotal=0;
                    $query2 = "SELECT * FROM transaction t 
                    INNER JOIN order_item o ON o.order_id = t.order_id
                    INNER JOIN customer c ON c.customer_id = t.customer_id
                    WHERE transaction_date BETWEEN '$from_date' AND '$to_date' ORDER by transaction_id ASC"; 
                    $result2 = mysqli_query($db,$query2) or die (mysqli_error($db));
                    foreach($result2 as $data2): ?>
                    <tr>
                        <td>STI-00<?php echo $data2['transaction_id']?></td>
                        <td><?php echo $data2['invoice']?></td>
                        <td><?php echo $data2['SKU']?></td>
                        <td><?php echo $data2['item_id']?></td>
                        <td><?php echo $data2['customer_name']?></td>
                        <td><?php echo $data2['qty']?></td>
                        <td><?php echo $data2['price']?></td>
                        <td><?php echo $data2['transaction_date']?></td>
                        <td><?php  
                        $total = $data2['cash'];
                        echo $total;   
                        $grandtotal += $total;
                        ?></td>
                    </tr>
                        <?php endforeach; ?>
                    <tr>
                        <td colspan="4">TOTAL</td>
                        <td></td>   
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><?php echo formatMoney($grandtotal,true);?></td>
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
</div>
<?php require_once '../require/footer.php'; ?>