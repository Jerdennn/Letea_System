<?php require_once '../require/navbar.php'; ?>
<?php require_once '../require/sidebar.php'; ?>
<div class="wrapper">
    <div class="row">
        <div class="header">
            <h3 style="text-transform:uppercase;">
                &nbsp; &nbsp; Merchant &nbsp;
                <a class="js-open-modal" href="#" data-modal-id="addMerchant"><i class="fas fa-plus"></i></a>
            </h3>
        </div>
        <div class="col-20 col-m-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 style="text-transform:uppercase;">
                        Merchant List
                    </h4>
                </div>
                <div class="card-content">
                    <table>
                        <thead>
                            <tr>
                                <th style="text-align:left;">Merchant Name</th>
                                <th style="text-align:left;">Address</th>
                                <th style="text-align:left;">Contact</th>
                                <th style="text-align:left;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
        $query ='select * from branch';
        $result = mysqli_query($db, $query) or die (mysqli_error($db)); ?>

                            <?php    while ($cat_row = mysqli_fetch_array($result)) {?>

                            <tr>
                                <td><?php echo strtoupper($cat_row['branch_name'])?></td>
                                <td><?php echo $cat_row['branch_address']?></td>
                                <td><?php echo $cat_row['branch_contact']?></td>
                                <td>
                                    <a href="category.php?cat_edit=<?php echo $cat_row['category_id']?>"
                                        class="js-open-modal" href="#" data-modal-id="editMerchant"><i
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
<div id="addMerchant" class="modal-box">
    <header>
        <a href="#" class="js-modal-close close">×</a>
        <h5>ADD MERCHANT</h5>
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
        <h5>Le'tea Milktea Hub &copy; 2019</h5>
    </footer>
</div>

<!-- EDIT CUSTOMER MODAL -->
<div id="editMerchant" class="modal-box">
    <header>
        <a href="#" class="js-modal-close close">×</a>
        <h5>EDIT MERCHANT</h5>
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
        <h5>Le'tea Milktea Hub &copy; 2019</h5>
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