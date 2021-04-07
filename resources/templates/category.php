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
                &nbsp; &nbsp; Category &nbsp;
                <a href="#" data-toggle="modal" data-target="#addModal" type="button" class="btn btn-primary bg-gradient-primary"><i class="fas fa-plus"> CATEGORIES</i></a>
            </h3>
        </div>
        <div class="col-20 col-m-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3 style="text-transform:uppercase;">
                        Category Table
                    </h3>
                </div>
                <div class="card-content">
                    <table>
                        <thead>
                            <tr>
                            <th style="text-align:left;">ID </th>
                                <th style="text-align:left;">Category Name</th>
                                <th style="text-align:left;">Description</th>
                                <th style="text-align:left;">Status</th>
                                <th style="text-align:center;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $query ="SELECT * FROM CATEGORY ORDER BY CATEGORY_ID ASC";
                        $result = mysqli_query($db, $query) or die(mysqli_error($db)); ?>
                        <?php foreach ($result as $data):?>
                       
                            <tr>
                                <td><?php echo $data['category_id']?></td>
                                <td><?php echo $data['category_name']?></td>
                                <td><?php echo $data['description']?></td>
                                <td><?php $status = $data['status'];
                        if ($status == 0):
                          echo "Unavailable";
                        else:
                          echo "Available";
                        endif;
                        ?></td>
                                <td style="text-align:center;">
                                    <button data-toggle="modal" data-target="#editModal<?php echo $data['category_id']?>" type="button" class="btn btn-primary bg-gradient-primary"><i class="fas fa-pen fa-m"> EDIT</i></button>
                                    <button data-toggle="modal" data-target="#deleteModal<?php echo $data['category_id']?>" class="btn btn-danger"><i class="fas fa-trash fa-m"> DELETE</i></button>
                                </td>
<!-- EDIT MODAL CATEGORY -->
<div class="modal fade" id="editModal<?php echo $data['category_id']?>" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" action="../libraries/editCategory.php">
          <div class="form-group">
             <input type="hidden" class="form-control" name="category_id" value="<?php echo $data['category_id']?>" readonly>
           </div>
           <div class="form-group">
             <input class="form-control" name="category_name" required value="<?php echo $data['category_name']?>">
           </div>
           <div class="form-group">
             <textarea rows="5" cols="50" class="form-control" name="description" required><?php echo $data['description']?></textarea>
           </div>
           <div class="form-group">
           <select name="status" class="form-control" value="<?php echo $data['status']?>">
           <option readonly>Select Category Status</option>
           <option value=0>Enabled</option>
           <option value=1>Disabled</option>
           </select>
           </div>
          <div class="modal-footer">
          <h6>Le'tea Milktea Hub &copy; 2019</h6>
            <button class="btn btn-default" type="button" data-dismiss="modal">Cancel</button>
            <button class="btn btn-primary" type="submit">Update</button>
         </div>
         </form>  
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="deleteModal<?php echo $data['category_id']?>" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" action="../libraries/deleteCategory.php">
          <div class="form-group">
             <input type="hidden" class="form-control" name="category_id" value="<?php echo $data['category_id']?>" readonly>
           </div>
           <div class="form-group">
             <center><h4>Are you sure you want to delete Category <?php echo $data['category_name']?></h4></center>
           </div>
          <div class="modal-footer">
          <h6>Le'tea Milktea Hub &copy; 2019</h6>
            <button class="btn btn-default" type="button" data-dismiss="modal">Cancel</button>
            <button class="btn btn-danger" type="submit">DELETE</button>
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
<div class="modal fade" id="addModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post" action="../libraries/addCategory.php">
           <div class="form-group">
             <input class="form-control" placeholder="Category name" name="category_name" required>
           </div>
           <div class="form-group">
             <textarea rows="5" cols="50" class="form-control" placeholder="Description" name="description" required></textarea>
           </div>
           <div class="form-group">
           <select name="status" class="form-control">
           <option readonly>Select Category Status</option>
           <option value=0>Available</option>
           <option value=1>Unavailable</option>
           </select>
           </div>
          <div class="modal-footer">
          <h6>Le'tea Milktea Hub &copy; 2019</h6>
            <button class="btn btn-default" type="button" data-dismiss="modal">Cancel</button>
            <button class="btn btn-primary" type="submit" name="save_category">Save</button>
            <button type="reset" class="btn btn-danger"><i class="fa fa-times fa-fw"></i>Reset</button>
         </div>
         </form>  
        </div>
      </div>
    </div>
  </div>