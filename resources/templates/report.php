<?php require_once '../require/navbar.php'; ?>
<?php require_once '../require/sidebar.php'; ?>
<div class="wrapper">
    <div class="row">
        <div class="header">
            <h3 style="text-transform:uppercase;">
                &nbsp; &nbsp; Sales Report &nbsp;
            </h3>
        </div>
    </div>
    <form method="GET" action="report.php" style="display:flex; align-items:left;">
        <div class="form-group">
            <h2>From: </h2>
        </div>
        <?php 
         $from_date = $_GET['from'];
         $to_date = $_GET['to'];
        if (date($to_date) < date($from_date)){
            echo "
            <div class=form-group>
                <input type=date name=from required style='border: 2px solid red;' >
            </div>";
        } 
        else { 
        echo "<div class=form-group>
            <input type=date name=from required>
        </div>";
            } ?>
            
            <div class=form-group >
            <h2>&nbsp;&nbsp;&nbsp;To: </h2>
            </div>
    <?php 
        if (date($to_date) < date($from_date)){
            echo "<div class=form-group>
            <input type=date name=to required  style='border: 2px solid red;'>
            </div>";
        }
       else{
        echo "<div class=form-group>
            <input type=date name=to required>
        </div>";
            }
        ?> 
          <div class="form-group">
            <input type="submit" value="Search" style="position:relative;">
        </div> 
    </form>

    <div class="col-20 col-m-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3 style="text-transform:uppercase;">
                <?php 
                if (date($to_date) < date($from_date)){
                    echo "From date cannot be greater than To date";
                }else{
                    echo "Sales Report from $from_date to $to_date";
                } 
               ?>
                </h3>
            </div>
            <div class="card-content">
                <?php  
                $from_date = $_GET['from'];
                $to_date = $_GET['to'];
                    $query = mysqli_query($db,"SELECT * FROM sales WHERE tran_date BETWEEN '$from_date' AND '$to_date' ORDER by tran_id ASC") or die (mysqli_error($db));
                ?>
                <table>
                    <thead>
                        <tr>
                            <th>Transaction ID</th>
                            <th>Transaction Date</th>
                            <th>Customer Name</th>
                            <th>Invoice Number</th>
                            <th>Amount</th>
                        </tr>

                    </thead>
                    <tbody>
                        <?php while($row = mysqli_fetch_array ($query)){ ?>
                        <tr>
                            <td><?php echo $row['tran_id'];?></td>
                            <td><?php echo $row['tran_date'];?></td>
                            <td><?php echo $row['customer_name'];?></td>
                            <td><?php echo $row['invoice_number'];?></td>
                            <td><?php echo $row['item_amount'];?></td>
                        </tr>
                        <?php } ?>
                        <tr>
                            <td colspan="4">TOTAL</td>
                            <td><?php
                                $from_date = $_GET['from'];
                                $to_date = $_GET['to'];
                                $query1 = "SELECT sum(item_amount) FROM sales WHERE tran_date BETWEEN '$from_date' AND '$to_date' ORDER by tran_id asc";
                                $result = mysqli_query($db,$query1);
                                while ($row1 = mysqli_fetch_array($result)) {
                                  $total = $row1['sum(item_amount)'];
                                  echo number_format($total);
                              }
                              ?></td>
                        </tr>
                        <tr>
                            <td> <a><input type="submit" name="trans_save" value="PRINT"></a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php require_once '../require/footer.php'; ?>