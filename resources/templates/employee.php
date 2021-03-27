<?php require_once '../require/navbar.php'; ?>
<?php require_once '../require/sidebar.php'; ?>
<div class="wrapper">
    <div class="row">
        <div class="header">
            <h3 style="text-transform:uppercase;">
                &nbsp; &nbsp; Employee &nbsp;
                <a href="#" data-toggle="modal" data-target="#addEmployee" type="button" class="btn btn-primary bg-gradient-primary"><i class="fas fa-plus"> Employee</i></a>
            </h3>
        </div>
        <div class="col-20 col-m-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 style="text-transform:uppercase;">
                        Employee Table
                    </h4>
                </div>
                <div class="card-content">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Phone</th>
                                <th>Gender</th>
                                <th style="text-align:center;">Address</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                      $query ="SELECT * , r.role_name FROM EMPLOYEE e JOIN roles r ON e.role_id=r.role_id";
                      $result = mysqli_query($db, $query) or die (mysqli_error($db)); ?>

                            <?php foreach($result as $data):?>

                            <tr>
                                <td><?php echo $data['employee_id']?></td>
                                <td><?php echo $data['firstname']?></td>
                                <td><?php echo $data['lastname']?></td>
                                <td><?php echo $data['phone']?></td>
                                <td><?php $gender=$data['gender'];
                                if($gender == 0):
                                  echo "Male";
                                elseif ($gender == 1):
                                  echo "Female";
                                else:
                                  echo "Other";
                                endif;
                                ?></td>
                                <td style="text-align:center;"><?php echo $data['address']?></td>
                                <td><?php echo strtoupper($data['role_name'])?></td>
                                <td><?php $status = $data['status'];
                                if($status == 0):
                                  echo "Active";
                                else:
                                  echo "Not Active";
                                endif;
                                ?></td>
                                <td>
                                    <button data-toggle="modal" data-target="#editModal<?php echo $data['employee_id']?>" type="button" class="btn btn-primary bg-gradient-primary"><i class="fas fa-pen fa-l"></i></button>
                                    <button href="admin_category.php?cat_del=<?php echo $data['category_id']?>" class="btn btn-danger"><i class="fas fa-trash fa-l"></i></button>
                                </td>
<!-- EDIT MODAL CATEGORY -->
<div class="modal fade" id="editModal<?php echo $data['employee_id']?>" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Employee</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
        <form method="post" action="../libraries/addEmployee.php">
            <div class="form-group">
             <input class="form-control"  name="fname" value="<?php echo $data['employee_id']?>" readonly>
           </div>
           <div class="form-group">
             <input type="text" class="form-control"  name="fname" value="<?php echo $data['firstname']?>" required>
           </div>
           <div class="form-group">
             <input type="text" class="form-control" name="lname" value="<?php echo $data['lastname']?>" required>
           </div>
           <div class="form-group">
           <select name="gender" class="form-control"  value="<?php echo $data['gender']?>">
           <option readonly>Gender</option>
           <option value=0>Male</option>
           <option value=1>Female</option>
           <option value=2>Other</option>
           </select>
           </div>
           <div class="form-group">
             <input type="text" class="form-control" name="phone" value="<?php echo $data['phone']?>" required>
           </div>
           <div class="form-group">
             <textarea rows="5" cols="50" class="form-control" name="address" required><?php echo $data['address']?></textarea>
           </div>
           <div class="form-group">
           <select name="roles" class="form-control">
           <option readonly>Select Role</option>
            <?php $query = "SELECT * FROM ROLES ORDER BY ROLE_ID ASC";
            $result = mysqli_query($db,$query) or die(mysqli_error($db));
            foreach($result as $data): ?>
            <option value="<?php echo $data['role_id']?>"><?php echo strtoupper($data['role_name'])?></option>
            <?php endforeach;?>
           </select>
           </div>
           <div class="form-group">
           <select name="status" class="form-control"  value="<?php echo $data['status']?>">
           <option readonly>Select Employee Status</option>
           <option value=0>Active</option>
           <option value=1>Not Active</option>
           </select>
           </div>
           <div class="form-group">
           <input type="date" class="form-control" name="date_hired" value="<?php echo $data['date_of_hired']?>"/>
           </div>
          <div class="modal-footer">
          <h6>Le'tea Milktea Hub &copy; 2019</h6>
            <button class="btn btn-default" type="button" data-dismiss="modal">Cancel</button>
            <button class="btn btn-primary" type="submit" name="btn_save">Update</button>
         </div>
         </form>  
        </div>
      </div>
    </div>
  </div>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once '../require/footer.php';?>

<!-- MODAL FOR ADD CATEGORY -->
<div class="modal fade" id="addEmployee" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Employee</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post" action="../libraries/addEmployee.php">
           <div class="form-group">
             <input type="text" class="form-control" placeholder="Firstname" name="fname" required>
           </div>
           <div class="form-group">
             <input type="text" class="form-control" placeholder="Lastname" name="lname" required>
           </div>
           <div class="form-group">
           <select name="gender" class="form-control">
           <option readonly>Gender</option>
           <option value=0>Male</option>
           <option value=1>Female</option>
           <option value=2>Other</option>
           </select>
           </div>
           <div class="form-group">
             <input type="text" class="form-control" placeholder="Phone number" name="phone" required>
           </div>
           <div class="form-group">
           <select name="roles" class="form-control">
           <option readonly>Select Role</option>
            <?php $query = "SELECT * FROM ROLES ORDER BY ROLE_ID ASC";
            $result = mysqli_query($db,$query) or die(mysqli_error($db));
            foreach($result as $data): ?>
            <option value="<?php echo $data['role_id']?>"><?php echo strtoupper($data['role_name'])?></option>
            <?php endforeach;?>
           </select>
           </div>
           <div class="form-group">
             <textarea rows="5" cols="50" class="form-control" placeholder="Address" name="address" required></textarea>
           </div>
           <div class="form-group">
           <select name="status" class="form-control">
           <option readonly>Select Employee Status</option>
           <option value=0>Active</option>
           <option value=1>Not Active</option>
           </select>
           </div>
           <div class="form-group">
           <input type="date" class="form-control" name="date_hired"/>
           </div>
          <div class="modal-footer">
          <h6>Le'tea Milktea Hub &copy; 2019</h6>
            <button class="btn btn-default" type="button" data-dismiss="modal">Cancel</button>
            <button class="btn btn-primary" type="submit" name="save_employee">Save</button>
            <button type="reset" class="btn btn-danger"><i class="fa fa-times fa-fw"></i>Reset</button>
         </div>
         </form>  
        </div>
      </div>
    </div>
  </div>