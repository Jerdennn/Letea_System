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
                        </tr>

                    </thead>
                    <tbody>
                       
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                       
                        <tr>
                            <td colspan="4">TOTAL</td>
                            <td></td>
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