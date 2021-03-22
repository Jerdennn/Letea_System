<?php require_once '../require/navbar.php'; ?>
<?php require_once '../require/sidebar.php'; ?>

<!-- main content -->
	<div class="wrapper">
		<div class="row">
			<div class="col-2 col-m-5 col-sm-6">
				<div class="counter bg-primary">
					<p>
						<i class="fas fa-tasks"></i>
					</p>
					<h3>INGREDIENT</h3>
					<p><?php
                        $query = "SELECT COUNT(*) FROM product";
                        $result = mysqli_query($db, $query) or die(mysqli_error($db));
                        while ($row = mysqli_fetch_array($result)) {
                            echo "$row[0]";
                          }
                    ?> Record(s) </p>
				</div>
			</div>
            <div class="col-2 col-m-5 col-sm-6">
				<div class="counter bg-primary">
					<p>
						<i class="fas fa-tasks"></i>
					</p>
					<h3>BRANCH</h3>
					<p><?php
                        $query = "SELECT COUNT(*) FROM branch";
                        $result = mysqli_query($db, $query) or die(mysqli_error($db));
                        while ($row = mysqli_fetch_array($result)) {
                            echo "$row[0]";
                          }
                    ?> Record(s) </p>
				</div>
			</div>
			<div class="col-2 col-m-5 col-sm-6">
				<div class="counter bg-warning">
					<p>
						<i class="fas fa-spinner"></i>
					</p>
					<h3>CUSTOMER</h3>
					<p><?php
                        $query = "SELECT COUNT(*) FROM category";
                        $result = mysqli_query($db, $query) or die(mysqli_error($db));
                        while ($row = mysqli_fetch_array($result)) {
                            echo "$row[0]";
                          }
                    ?> Record(s) </p>
				</div>
			</div>
			<div class="col-2 col-m-5 col-sm-6">
				<div class="counter bg-success">
					<p>
						<i class="fas fa-check-circle"></i>
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
			<div class="col-2 col-m-5 col-sm-6">
				<div class="counter bg-danger">
					<p>
						<i class="fas fa-bug"></i>
					</p>
					<h3>SALES</h3>
					<p><?php
                        $query = "SELECT COUNT(*) FROM sales";
                        $result = mysqli_query($db, $query) or die(mysqli_error($db));
                        while ($row = mysqli_fetch_array($result)) {
                            echo "$row[0]";
                          }
                    ?> Record(s) </p>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-9 col-m-12 col-sm-12">
				<div class="card">
					<div class="card-header">
						<h3>
							Inventory Table
						</h3>
						<i class="fas fa-ellipsis-h"></i>
					</div>
					<div class="card-content">
						<?php $query=mysqli_query($db,"SELECT * FROM product INNER JOIN category ON category.category_ID = product.cat_ID INNER JOIN supplier ON supplier.supplier_ID = product.supplier_ID ORDER BY p_name LIMIT 5" )or die(mysqli_error($db)); ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Picture</th>
                                <th>Product Code</th>
                                <th>Product Name</th>
                                <th>Supplier</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Category</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row=mysqli_fetch_array($query)){ ?>
                            <tr>
                                <td><img style="width:80px;height:60px" src=" ../dist/uploads/<?php echo $row['p_pic'];?>"></td>
                                <td><?php echo $row['p_code'];?></td>
                                <td><?php echo $row['p_name'];?></td>
                                <td><?php echo $row['supplier_name'];?></td>
                                <td><?php echo $row['p_qty'];?></td>
                                <td><?php echo $row['p_price'];?></td>
                                <td><?php echo $row['category_name'];?></td>
                                
                            </tr>
                            <?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
	 <div class="col-2 col-m-5 col-sm-5">
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
                                $query = "SELECT p_name, p_code FROM product order by p_id asc LIMIT 10";
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
