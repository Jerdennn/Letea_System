<?php require_once '../require/navbar.php'; ?>
<?php require_once '../require/sidebar.php'; ?>

<!-- main content -->
	<div class="wrapper">
		<div class="row">
			<div class="col-3 col-m-3 col-sm-2">
				<div class="counter bg-primary">
					<p>
						<i class="fas fa-utensils fa-2x"></i>
					</p>
					<h3>INGREDIENT</h3>
					<p><?php
                        $query = "SELECT COUNT(*) FROM item";
                        $result = mysqli_query($db, $query) or die(mysqli_error($db));
                        while ($row = mysqli_fetch_array($result)) {
                            echo $row[0];
                          }
                    ?> Record(s) </p>
				</div>
			</div>
            <div class="col-3 col-m-3 col-sm-2">
				<div class="counter bg-primary">
					<p>
						<i class="fas fa-store fa-2x""></i>
					</p>
					<h3>MERCHANT</h3>
					<p><?php
                        $query = "SELECT COUNT(*) FROM merchant";
                        $result = mysqli_query($db, $query) or die(mysqli_error($db));
                        while ($row = mysqli_fetch_array($result)) {
                            echo $row[0];
                          }
                    ?> Record(s) </p>
				</div>
			</div>
			<div class="col-3 col-m-3 col-sm-2 ">
				<div class="counter bg-warning">
					<p>
						<i class="fa fa-address-book fa-2x"></i>
					</p>
					<h3>CUSTOMER</h3>
					<p><?php
                        $query = "SELECT COUNT(*) FROM category";
                        $result = mysqli_query($db, $query) or die(mysqli_error($db));
                        while ($row = mysqli_fetch_array($result)) {
                            echo $row[0];
                          }
                    ?> Record(s) </p>
				</div>
			</div>
			<div class="col-3 col-m-3 col-sm-3">
				<div class="counter bg-success">
					<p>
						<i class="fas fa-user-circle fa-2x"></i>
					</p>
					<h3>USERS</h3>
					<p><?php
                        $query = "SELECT COUNT(*) FROM users";
                        $result = mysqli_query($db, $query) or die(mysqli_error($db));
                        while ($row = mysqli_fetch_array($result)) {
                            echo "$row[0]";
                          }
                    ?> Record(s) </p>
				</div>
			</div>
			<div class="col-3 col-m-3 col-sm-3">
				<div class="counter bg-danger">
					<p>
						<i class="fa fa-shopping-cart fa-2x"></i>
					</p>
					<h3>SALES</h3>
					<p><?php
                        $query = "SELECT COUNT(*) FROM transaction";
                        $result = mysqli_query($db, $query) or die(mysqli_error($db));
                        while ($row = mysqli_fetch_array($result)) {
                            echo "$row[0]";
                          }
                    ?> Record(s) </p>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-5 col-m-8 col-sm-9">
				<div class="card">
					<div class="card-header">
						<h3>
							Inventory Table
						</h3>
						<i class="fas fa-ellipsis-h"></i>
					</div>
					<div class="card-content">
						<?php $query=mysqli_query($db,"SELECT * FROM item INNER JOIN category ON category.category_ID = item.category_ID ORDER BY item_name LIMIT 10")or die(mysqli_error($db)); ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Product Code</th>
                                <th>Product Name</th>
                                <th>Category</th>
                                <th>Qty</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row=mysqli_fetch_array($query)){ ?>
                            <tr>
                                <td><?php echo $row['SKU'];?></td>
                                <td><?php echo $row['item_name'];?></td>
                                <td><?php echo $row['category_name'];?></td>
                                <td><?php echo $row['qty'];?></td>
                                <td><?php echo $row['price'];?></td>   
                            </tr>
                            <?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
	 <div class="col-3 col-m-3 col-sm-3">
            <div class="card">
                <div class="card-header">
                    <h3>
                        Recent
                    </h3>
                    <i class="fas fa-history"></i>
                </div>
                <div class="card-content">
                    <div class="progress-wrapper">
                     <?php 
                                $query = "SELECT item_name, sku FROM item order by item_id asc LIMIT 10";
                                $result = mysqli_query($db, $query) or die(mysqli_error($db));
                                while ($row = mysqli_fetch_array($result))  { ?>
                                 <ul style="list-style-type: square;margin-top: 5px; margin-bottom: 1 em; margin-left: 0; margin-right: 0;padding-left: 15%;">
                                      <li>
                                        <?php echo strtoupper($row[0]); ?>
                                      </li>
                                    </ul>
                     <?php    } ?>
                      <a href="admin_product.php" style="text-decoration:none;margin-top: 30px; margin-bottom: 1 em; margin-left: 0; margin-right: 0;padding-left: 15%;">View All Products</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
		<div class="row">
			<div class="col-12 col-m-12 col-sm-12">
				<div class="card">
					<div class="card-header">
						<h3>
							Chartjs
						</h3>
					</div>
					<div class="card-content">
						<canvas id="myChart"></canvas>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- end main content -->
<?php require_once '../require/footer.php';?>
<script>
var ctx = document.getElementById('myChart')
ctx.height = 500
ctx.width = 500
var data = {
	labels: ['January', 'February', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
	datasets: [{
		fill: false,
		label: 'Completed',
		borderColor: successColor,
		data: [120, 115, 130, 100, 123, 88, 99, 66, 120, 52, 59],
		borderWidth: 2,
		lineTension: 0,
	}, {
		fill: false,
		label: 'Issues',
		borderColor: dangerColor,
		data: [66, 44, 12, 48, 99, 56, 78, 23, 100, 22, 47],
		borderWidth: 2,
		lineTension: 0,
	}]
}
	var lineChart = new Chart(ctx, {
	type: 'line',
	data: data,
	options: {
		maintainAspectRatio: false,
		bezierCurve: false,
	}
})
	</script>