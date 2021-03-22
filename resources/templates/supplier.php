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
$sup = "<select name='supplier'> <option readonly selected>SUPPLIER</option>";
while ($row = mysqli_fetch_assoc($result2)) {
    $sup .= "<option value='".$row['SUPPLIER_ID']."'>".$row['supplier_name']."</option>";
}
$sup .= "</select>";
?>

<div class="wrapper">
    <div class="row">
        <div class="header">
            <h3 style="text-transform:uppercase;">
                &nbsp; &nbsp; Supplier &nbsp;
                <a class="js-open-modal" href="#" data-modal-id="addSupplier"><i class="fas fa-plus"></i></a>
            </h3>
        </div>
        <div class="col-20 col-m-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3 style="text-transform:uppercase;">
                        Supplier Table
                    </h3>
                </div>
                <div class="card-content">
                    <?php
        $query ='select * from supplier';
        $result = mysqli_query($db, $query) or die (mysqli_error($db)); ?>
                    <table>
                        <thead>
                            <tr>
                                <th style="text-align:left;">Company Name</th>
                                <th style="text-align:left;">Company Address</th>
                                <th style="text-align:left;">Contact</th>
                                <th style="text-align:left;">Action</th>
                            </tr>
                        </thead>
                        <tbody>


                            <?php while ($row = mysqli_fetch_array($result)) {?>

                            <tr>
                                <td><?php echo $row['supplier_name']?></td>
                                <td><?php echo $row['supplier_address']?></td>
                                <td><?php echo $row['contact']?></td>
                                <td>
                                    <a href="supplier.php?edit=<?php echo $row['supplier_id']; ?>" class="js-open-modal"
                                        href="#" data-modal-id="editSupplier"><i class="fas fa-pen fa-l"> </i>
                                    </a>
                                    <a href="admin_supplier.php?del=<?php echo $row['supplier_id']; ?>"><i
                                            class="fas fa-trash fa-l"></i></a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ADD SUPPLIER MODAL -->
<div id="addSupplier" class="modal-box">
    <header>
        <a href="#" class="js-modal-close close">×</a>
        <h2>ADD SUPPLIER</h2>
    </header>
    <div class="modal-body">
        <form method="POST" action="admin_supplier.php">
            <div class="form-group">
                <input type="hidden" name="id">
            </div>
            <div class="form-group">
                <!--<label>Product Code</label>-->
                <input type="text" name="s_company_name" placeholder="COMPANY NAME">
            </div>
            <div class="form-group">
                <!-- <label>Product Name</label>-->
                <input type="text" name="s_company_address" placeholder="COMPANY ADDRESS">
            </div>
            <div class="form-group">
                <!--                        <label>Product Name</label>-->
                <input type="text" name="s_contact" placeholder="COMPANY CONTACT">
            </div>
            <input type="submit" name="s_btn" value="SAVE">
        </form>
    </div>
    <footer>
        <h3>Le'tea Milktea Hub &copy; 2019</h3>
    </footer>
</div>

<!-- EDIT SUPPLIER MODAL -->
<div id="editSupplier" class="modal-box">
    <header>
        <a href="#" class="js-modal-close close">×</a>
        <h2>EDIT SUPPLIER</h2>
    </header>
    <div class="modal-body">
        <form method="POST" action="admin_supplier.php">
            <div class="form-group">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
            </div>
            <div class="form-group">
                <!--<label>Product Code</label>-->
                <input type="text" name="s_company_name" value="<?php echo $supplier_name; ?>"
                    placeholder="COMPANY NAME">
            </div>
            <div class="form-group">
                <!--                        <label>Product Name</label>-->
                <input type="text" name="s_company_address" value="<?php echo $supplier_address; ?>"
                    placeholder="COMPANY ADDRESS">
            </div>
            <div class="form-group">
                <!--<label>Product Name</label>-->
                <input type="text" name="s_contact" value="<?php echo $contact; ?>" placeholder="CONTACT">
            </div>
            <input type="submit" name="s_btn" value="SAVE">
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