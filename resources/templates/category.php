<?php require_once '../require/navbar.php'; ?>
<?php require_once '../require/sidebar.php'; ?>
<?php $sql = "SELECT DISTINCT category_name, CATEGORY_ID FROM category order by category_name asc";
$result = mysqli_query($db, $sql) or die ("Bad SQL: $sql");
$opt = "<select name='category'>
<option disabled selected>CATEGORY</option>";
while ($row = mysqli_fetch_assoc($result)) {
    $opt .= "<option value='".$row['CATEGORY_ID']."'>".$row['category_name']."</option>";
}
$opt .= "</select>";

$sql2 = "SELECT DISTINCT SUPPLIER_ID, supplier_name FROM supplier order by supplier_name asc";
$result2 = mysqli_query($db, $sql2) or die ("Bad SQL: $sql2");
$sup = "<select name='supplier'> <option disabled selected>SUPPLIER</option>";
while ($row = mysqli_fetch_assoc($result2)) {
    $sup .= "<option value='".$row['SUPPLIER_ID']."'>".$row['supplier_name']."</option>";
}
$sup .= "</select>";
?>
<div class="wrapper">
    <div class="row">
        <div class="header">
            <h3 style="text-transform:uppercase;">
                &nbsp; &nbsp; Category &nbsp;
                <a class="js-open-modal" href="#" data-modal-id="addCategory"><i class="fas fa-plus"></i></a>
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
                                <th style="text-align:left;">Category Name</th>
                                <th style="text-align:left;">Description</th>
                                <th style="text-align:left;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
        $query ='select * from category';
        $result = mysqli_query($db, $query) or die (mysqli_error($db)); ?>

                            <?php    while ($cat_row = mysqli_fetch_array($result)) {?>

                            <tr>
                                <td><?php echo $cat_row['category_name']?></td>
                                <td><?php echo $cat_row['category_description']?></td>

                                <td>
                                    <a href="category.php?cat_edit=<?php echo $cat_row['category_id']?>"
                                        class="js-open-modal" href="#" data-modal-id="editCategory"><i
                                            class="fas fa-pen fa-l"> </i>
                                    </a>
                                    <a href="admin_category.php?cat_del=<?php echo $cat_row['category_id']?>"><i
                                            class="fas fa-trash fa-l"></i></a>
                                </td>
                            </tr>
                            <?php    } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ADD CATEGORY MODAL -->
<div id="addCategory" class="modal-box">
    <header>
        <a href="#" class="js-modal-close close">×</a>
        <h2>ADD CATEGORY</h2>
    </header>
    <div class="modal-body">
        <form method="POST" action="admin_category.php">
            <div class="form-group">
                <!--<label>Product Code</label>-->
                <input type="text" name="cat_name" value="<?php //echo $customer_name; ?>" placeholder="CATEGORY NAME">
            </div>
            <div class="form-group">
                <!--                        <label>Product Name</label>-->
                <textarea rows="5" cols="50" type="text" name="cat_descrp" value="<?php //echo $customer_name; ?>"
                    placeholder="CATEGORY DESCRIPTION"></textarea>
            </div>
            <input type="submit" name="cat_btn" value="SAVE">
        </form>
    </div>
    <footer>
        <h3>Le'tea Milktea Hub &copy; 2019</h3>
    </footer>
</div>

<!-- EDIT CUSTOMER MODAL -->
<div id="editCategory" class="modal-box">
    <header>
        <a href="#" class="js-modal-close close">×</a>
        <h2>EDIT CATEGORY</h2>
    </header>
    <div class="modal-body">
        <form method="POST" action="admin_category.php">
            <div class="form-group">
                <!--<label>Product Code</label>-->
                <input type="text" name="cat_name" value="<?php //echo $customer_name; ?>" placeholder="CATEGORY NAME">
            </div>
            <div class="form-group">
                <!--                        <label>Product Name</label>-->
                <textarea rows="5" cols="50" type="text" name="cat_descrp" value="<?php //echo $customer_name; ?>"
                    placeholder="CATEGORY DESCRIPTION"></textarea>
            </div>
            <input type="submit" name="cat_btn" value="SAVE">
        </form>
    </div>
    <footer>
        <h3>Le'tea Milktea Hub &copy; 2019</h3>
    </footer>
</div>
<?php require_once '../require/footer.php';?>

<script>
    $(function () {

        var appendthis = ("<div class='modal-overlay js-modal-close'></div>");

        $('a[data-modal-id]').click(function (e) {
            e.preventDefault();
            $("body").append(appendthis);
            $(".modal-overlay").fadeTo(300, 0.7);
            //$(".js-modalbox").fadeIn(500);
            var modalBox = $(this).attr('data-modal-id');
            $('#' + modalBox).fadeIn($(this).data());
        });


        $(".js-modal-close, .modal-overlay").click(function () {
            $(".modal-box, .modal-overlay").fadeOut(300, function () {
                $(".modal-overlay").remove();
            });
        });

        $(window).resize(function () {
            $(".modal-box").css({
                top: ($(window).height() - $(".modal-box").outerHeight()) / 2,
                left: ($(window).width() - $(".modal-box").outerWidth()) / 2
            });
        });

        $(window).resize();

    });
</script>