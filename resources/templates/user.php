<?php require_once '../require/navbar.php'; ?>
<?php require_once '../require/sidebar.php'; ?>
<style type="text/css">
    .modal .modal-dialog {
        width: 100%;
    }
</style>
<div class="wrapper">
    <div class="row">
        <div class="header">
            <h3 style="text-transform:uppercase;">
                &nbsp; &nbsp; User Accounts &nbsp;
                <a href="#" data-toggle="modal" data-target="#addModal" type="button" class="btn btn-primary bg-gradient-primary"><i class="fas fa-plus"> USER</i></a>
            </h3>
        </div>
        <div class="col-20 col-m-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3 style="text-transform:uppercase;">
                        User Accounts
                    </h3>
                </div>
                <div class="card-content">
                    <table>
                        <thead>
                            <tr>
                                <th style="text-align:left;">ID </th>
                                <th style="text-align:left;">Employee name</th>
                                <th style="text-align:left;">Username</th>
                                <th style="text-align:left;">Email</th>
                                <th style="text-align:left;">Role</th>
                                <th style="text-align:left;">Merchant</th>
                                <th style="text-align:left;">Status</th>
                                <th style="text-align:left;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $query ="SELECT * FROM USERS u JOIN roles r ON r.role_id=u.role_id INNER JOIN merchant m ON m.merchant_id=u.merchant_id INNER JOIN employee e ON e.employee_id = u.employee_id ORDER BY e.lastname ASC";
                        $result = mysqli_query($db, $query) or die (mysqli_error($db)); ?>
                        <?php foreach($result as $data):?>
                       
                            <tr>
                                <td><?php echo $data['user_id']?></td>
                                <td><?php echo $data['firstname']?>, <?php echo $data['lastname']?></td>
                                <td><?php echo $data['username']?></td>
                                <td><?php echo $data['email']?></td>
                                <td><?php echo strtoupper($data['role_name'])?></td>
                                <td><?php echo $data['merchant_name']?></td>
                                <td><?php $status = $data['status'];
                        if ($status == 0):
                          echo "Active";
                        else:
                          echo "Not Active";
                        endif;
                        ?></td>
                                <td>
                                    <button data-toggle="modal" data-target="#editUsers<?php echo $data['user_id']?>" type="button" class="btn btn-primary bg-gradient-primary"><i class="fas fa-pen fa-m"> EDIT</i></button>
                                    <button href="admin_category.php?cat_del=<?php echo $data['user_id']?>" class="btn btn-danger"><i class="fas fa-trash fa-m"> DELETE</i></button>
                                </td> 
                         </tr>
                         <!-- EDIT MODAL FOR USERS -->
  <div class="modal fade" id="editUsers<?php echo $data['user_id']?>" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add User Account</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post" action="../libraries/addUsers.php">
          <div class="form-group">
             <input type="text" class="form-control" placeholder="Username" name="username" value="<?php echo $data['username']?>" required>
           </div>
           <div class="form-group">
             <input type="email" class="form-control" placeholder="email" name="email" value="<?php echo $data['email']?>" required>
           </div>
           <div class="form-group">
                <input type="password" class="form-control" placeholder="Password" name="password" required>
           </div>
          <div class="form-group">
           <select name="employee" class="form-control">
           <option readonly>Select Employee</option>
           <?php $query = "SELECT employee_id, firstname, lastname, r.role_name FROM EMPLOYEE e INNER JOIN roles r on r.role_id=e.role_id ORDER BY e.lastname ASC";
           $result = mysqli_query($db,$query) or die(mysqli_error($db));
           foreach($result as $data): ?>
           <option value="<?php echo $data['employee_id']?>"><?php echo strtoupper($data['lastname'])?>, <?php echo strtoupper($data['firstname'])?> - <?php echo strtoupper($data['role_name'])?></option>
           <?php endforeach; ?>
           </select>
           </div>
           <div class="form-group">
           <select name="merchant" class="form-control">
           <option readonly>Select Merchant</option>
           <?php $query = "SELECT * FROM MERCHANT";
           $result = mysqli_query($db,$query) or die(mysqli_error($db));
           foreach($result as $data): ?>
           <option value="<?php echo $data['merchant_id']?>"><?php echo strtoupper($data['merchant_name'])?></option>
           <?php endforeach; ?>
           </select>
           </div>
           <div class="form-group">
           <select name="roles" class="form-control">
           <option readonly>Select Role</option>
           <?php $query = "SELECT * FROM ROLES";
           $result = mysqli_query($db,$query) or die(mysqli_error($db));
           foreach($result as $data): ?>
           <option value="<?php echo $data['role_id']?>"><?php echo strtoupper($data['role_name'])?></option>
           <?php endforeach; ?>
           </select>
           </div>
           <div class="form-group">
           <select name="status" class="form-control">
           <option readonly>Select Category Status</option>
           <option value=0>Active</option>
           <option value=1>Not Active</option>
           </select>
           </div>
          <div class="modal-footer">
          <h6>Le'tea Milktea Hub &copy; 2019</h6>
            <button class="btn btn-default" type="button" data-dismiss="modal">Cancel</button>
            <button class="btn btn-primary" type="submit" name="save_user">Save</button>
            <button type="reset" class="btn btn-danger"><i class="fa fa-times fa-fw"></i>Reset</button>
         </div>
         </form>  
        </div>
      </div>
    </div>
  </div>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once '../require/footer.php';?>

<!-- MODAL FOR ADD USERS -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add User Account</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post" action="../libraries/addUsers.php">
          <div class="form-group">
           <select name="employee" class="form-control">
           <option readonly>Select Employee</option>
           <?php $query = "SELECT employee_id, firstname, lastname, r.role_name FROM EMPLOYEE e INNER JOIN roles r on r.role_id=e.role_id ORDER BY e.lastname ASC";
           $result = mysqli_query($db,$query) or die(mysqli_error($db));
           foreach($result as $data): ?>
           <option value="<?php echo $data['employee_id']?>"><?php echo strtoupper($data['lastname'])?>, <?php echo strtoupper($data['firstname'])?> - <?php echo strtoupper($data['role_name'])?></option>
           <?php endforeach; ?>
           </select>
           </div>
           <div class="form-group">
           <select name="merchant" class="form-control">
           <option readonly>Select Merchant</option>
           <?php $query = "SELECT * FROM MERCHANT";
           $result = mysqli_query($db,$query) or die(mysqli_error($db));
           foreach($result as $data): ?>
           <option value="<?php echo $data['merchant_id']?>"><?php echo strtoupper($data['merchant_name'])?></option>
           <?php endforeach; ?>
           </select>
           </div>
           <div class="form-group">
             <input type="text" class="form-control" placeholder="Username" name="username" required>
           </div>
           <div class="form-group">
                <input type="password" class="form-control" placeholder="Password" name="password" required>
           </div>
           <div class="form-group">
             <input type="email" class="form-control" placeholder="email" name="email" required>
           </div>
           <div class="form-group">
           <select name="roles" class="form-control">
           <option readonly>Select Role</option>
           <?php $query = "SELECT * FROM ROLES";
           $result = mysqli_query($db,$query) or die(mysqli_error($db));
           foreach($result as $data): ?>
           <option value="<?php echo $data['role_id']?>"><?php echo strtoupper($data['role_name'])?></option>
           <?php endforeach; ?>
           </select>
           </div>
           <div class="form-group">
           <select name="status" class="form-control">
           <option readonly>Select Category Status</option>
           <option value=0>Active</option>
           <option value=1>Not Active</option>
           </select>
           </div>
          <div class="modal-footer">
          <h6>Le'tea Milktea Hub &copy; 2019</h6>
            <button class="btn btn-default" type="button" data-dismiss="modal">Cancel</button>
            <button class="btn btn-primary" type="submit" name="save_user">Save</button>
            <button type="reset" class="btn btn-danger"><i class="fa fa-times fa-fw"></i>Reset</button>
         </div>
         </form>  
        </div>
      </div>
    </div>
  </div>