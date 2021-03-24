<?php
function createRandomPassword() {
	$chars = "003232303232023232023456789";
	srand((double)microtime()*1000000);
	$i = 0;
	$pass = '' ;
	while ($i <= 7) {

		$num = rand() % 33;

		$tmp = substr($chars, $num, 1);

		$pass = $pass . $tmp;

		$i++;

	}
	return $pass;
}
$finalcode='RS-'.createRandomPassword(); 
?>

<?php
  $query = 'SELECT USER_ID, t.TYPE FROM users u INNER JOIN type t ON t.TYPE_ID=u.TYPE_ID WHERE USER_ID = '.$_SESSION['MEMBER_ID'].' ';
  $result = mysqli_query($db, $query) or die (mysqli_error($db));
  
  while ($row = mysqli_fetch_assoc($result)) {
            $mem_id = $row['TYPE'];
                   
  if ($mem_id=='ADMINISTRATOR'){ ?>
<!-- sidebar -->
<div class="sidebar">
    <ul class="sidebar-nav">
        <li class="sidebar-nav-item">
            <a href="../templates/dashboard.php" class="sidebar-nav-link">
                <div>
                    <i class="fas fa-tachometer-alt"></i>
                </div>
                <span>
                    Dashboard
                </span>
            </a>
        </li>
        <li class="sidebar-nav-item">
            <a href="../templates/products.php" class="sidebar-nav-link">
                <div>
                    <i class="fas fa-clipboard-list"></i>
                </div>
                <span>Products</span>
            </a>
        </li>
        <li class="sidebar-nav-item">
            <a href="../templates/report.php?from=0&to=0" class="sidebar-nav-link">
                <div>
                    <i class="fas fa-chart-area"></i>
                </div>
                <span>Reports</span>
            </a>
        </li>
        <li class="sidebar-nav-item">
            <a href="../templates/transaction.php?id=CASH&invoice=<?php echo $finalcode?>" class="sidebar-nav-link">
                <div>
                    <i class="fas fa-file-invoice-dollar"></i>
                </div>
                <span>Sales</span>
            </a>
        </li>
        <li class="sidebar-nav-item">
            <a href="../templates/employee.php" class="sidebar-nav-link">
                <div>
                    <i class="fas fa-users"></i>
                </div>
                <span>Employee</span>
            </a>
        </li>
        <li class="sidebar-nav-item">
            <a href="../templates/user.php" class="sidebar-nav-link">
                <div>
                    <i class="far fa-user-circle"></i>
                </div>
                <span>Accounts</span>
            </a>
        </li>
        <li class="sidebar-nav-item">
            <a href="../templates/customer.php" class="sidebar-nav-link">
                <div>
                    <i class="fas fa-user"></i>
                </div>
                <span>Customer</span>
            </a>
        </li>
        <li class="sidebar-nav-item">
            <a href="../templates/category.php" class="sidebar-nav-link">
                <div>
                    <i class="fas fa-list-alt"></i>
                </div>
                <span>Category</span>
            </a>
        </li>
        <li class="sidebar-nav-item">
            <a href="../templates/audit.php" class="sidebar-nav-link">
                <div>
                    <i class="fas fa-history"></i>
                </div>
                <span>Audit Trail</span>
            </a>
        </li>
        <li class="sidebar-nav-item">
            <a href="../templates/branch.php" class="sidebar-nav-link">
                <div>
                <i class="fas fa-store"></i>
                </div>
                <span>Merchant</span>
            </a>
        </li>
        <li class="sidebar-nav-item">
            <a href="../templates/uom.php" class="sidebar-nav-link">
                <div>
                <i class="fas fa-weight"></i>
                </div>
                <span>Unit of Measurement</span>
            </a>
        </li>
    </ul>
</div>
<!-- end sidebar -->
<?php } 
      
        if ($mem_id=='SALES MANAGER'){ ?>
<!-- sidebar -->
<div class="sidebar">
    <ul class="sidebar-nav">
        <li class="sidebar-nav-item">
            <a href="../templates/dashboard.php" class="sidebar-nav-link">
                <div>
                    <i class="fas fa-tachometer-alt"></i>
                </div>
                <span>
                    Dashboard
                </span>
            </a>
        </li>
        <li class="sidebar-nav-item">
            <a href="../templates/products.php" class="sidebar-nav-link">
                <div>
                    <i class="fas fa-clipboard-list"></i>
                </div>
                <span>Products</span>
            </a>
        </li>
        <li class="sidebar-nav-item">
            <a href="../templates/report.php?from=0&to=0" class="sidebar-nav-link">
                <div>
                    <i class="fas fa-chart-area"></i>
                </div>
                <span>Reports</span>
            </a>
        </li>
        <li class="sidebar-nav-item">
            <a href="../templates/transaction.php?id=CASH&invoice=<?php echo $finalcode?>" class="sidebar-nav-link">
                <div>
                    <i class="fas fa-file-invoice-dollar"></i>
                </div>
                <span>Transaction</span>
            </a>
        </li>
        <li class="sidebar-nav-item">
            <a href="../templates/customer.php" class="sidebar-nav-link">
                <div>
                    <i class="fas fa-user"></i>
                </div>
                <span>Customer</span>
            </a>
        </li>
        <li class="sidebar-nav-item">
            <a href="../templates/category.php" class="sidebar-nav-link">
                <div>
                    <i class="fas fa-list-alt"></i>
                </div>
                <span>Category</span>
            </a>
        </li>
        <li class="sidebar-nav-item">
            <a href="../templates/category.php" class="sidebar-nav-link">
                <div>
                    <i class="fas fa-list-alt"></i>
                </div>
                <span>Merchant</span>
            </a>
        </li>
        <li class="sidebar-nav-item">
            <a href="../templates/category.php" class="sidebar-nav-link">
                <div>
                    <i class="fas fa-list-alt"></i>
                </div>
                <span>Unit of Measurement</span>
            </a>
        </li>
    </ul>
</div>
<!-- end sidebar -->
<?php } 
      
       if ($mem_id=='INVENTORY CLERK'){ ?>
<!-- sidebar -->
<div class="sidebar">
    <ul class="sidebar-nav">
        <li class="sidebar-nav-item">
            <a href="../templates/dashboard.php" class="sidebar-nav-link">
                <div>
                    <i class="fas fa-tachometer-alt"></i>
                </div>
                <span>
                    Dashboard
                </span>
            </a>
        </li>
        <li class="sidebar-nav-item">
            <a href="../templates/products.php" class="sidebar-nav-link">
                <div>
                    <i class="fas fa-clipboard-list"></i>
                </div>
                <span>Products</span>
            </a>
        </li>
        <li class="sidebar-nav-item">
            <a href="../templates/category.php" class="sidebar-nav-link">
                <div>
                    <i class="fas fa-list-alt"></i>
                </div>
                <span>Category</span>
            </a>
        </li>
        <li class="sidebar-nav-item">
            <a href="../templates/category.php" class="sidebar-nav-link">
                <div>
                    <i class="fas fa-list-alt"></i>
                </div>
                <span>Merchant</span>
            </a>
        </li>
        <li class="sidebar-nav-item">
            <a href="../templates/category.php" class="sidebar-nav-link">
                <div>
                    <i class="fas fa-list-alt"></i>
                </div>
                <span>Unit of Measurement</span>
            </a>
        </li>
    </ul>
</div>
<!-- end sidebar -->
<?php } 
  
  }?>
