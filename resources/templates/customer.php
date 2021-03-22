<?php 
require_once '../require/navbar.php'; ?>
<?php 
require_once '../require/sidebar.php';
?>
<div class="wrapper">
    <div class="row">
        <div class="header">
            <h3 style="text-transform:uppercase;">
                &nbsp; &nbsp; Customer &nbsp;
                <a class="js-open-modal" href="#" data-modal-id="addCustomer"><i class="fas fa-plus"></i></a>
            </h3>
        </div>
    </div>
    <div class="row">
        <div class="col-20 col-m-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3 style="text-transform:uppercase;">
                        Customer Records
                    </h3>
                </div>
                <div class="card-content">
                    <table style="text-align:left;">
                        <thead>
                            <tr>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Address</th>
                                <th>Contact</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php 
        $query ='SELECT * FROM customer ORDER BY firstname asc';
        $result = mysqli_query($db, $query) or die (mysqli_error($db)); ?>

                            <?php while ($emp_row = mysqli_fetch_array($result)) { ?>
                            <tr>
                                <td><?php echo $emp_row['firstname']?></td>
                                <td><?php echo $emp_row['lastname']?></td>
                                <td><?php echo $emp_row['address']?></td>
                                <td><?php echo $emp_row['phone']?></td>
                                <td>
                                    <a href="customer.php?emp_edit=<?php echo $emp_row['employee_id']?>"
                                        class="js-open-modal" href="#" data-modal-id="editCustomer"><i
                                            class="fas fa-pen fa-l"></i></a>
                                    <a href="admin_employee.php?emp_del=<?php echo $emp_row['eployee_id']?>"><i
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

<!-- ADD CUSTOMER MODAL -->
<div id="addCustomer" class="modal-box">
    <header>
        <a href="#" class="js-modal-close close">×</a>
        <h2>ADD CUSTOMER</h2>
    </header>
    <div class="modal-body">
        <form method="POST" action="admin_customer.php">
            <div class="form-group">
                <input type="text" name="c_fname" value="<?php //echo $customer_name; ?>" placeholder="FIRST NAME">
            </div>
            <div class="form-group">
                <input type="text" name="c_lname" value="<?php //echo $customer_name; ?>" placeholder="LAST NAME">
            </div>
            <div class="form-group">
                <textarea type="text" rows="5" cols="20" name="c_address" value="<?php //echo $customer_name; ?>"
                    placeholder="ADDRESS"></textarea>
            </div>
            <div class="form-group">

                <input type="text" name="c_contact" value="<?php //echo $customer_name; ?>" placeholder="CONTACT">
            </div>
            <input type="submit" name="c_button" value="SAVE">
        </form>
    </div>
    <footer>
        <h3>Le'tea Milktea Hub &copy; 2019</h3>
    </footer>
</div>

<!-- EDIT CUSTOMER MODAL -->
<div id="editCustomer" class="modal-box">
    <header>
        <a href="#" class="js-modal-close close">×</a>
        <h2>EDIT CUSTOMER</h2>
    </header>
    <div class="modal-body">
        <form method="POST" action="admin_customer.php">
            <div class="form-group">
                <input type="text" name="c_fname" value="<?php //echo $customer_name; ?>" placeholder="FIRST NAME">
            </div>
            <div class="form-group">
                <input type="text" name="c_lname" value="<?php //echo $customer_name; ?>" placeholder="LAST NAME">
            </div>
            <div class="form-group">
                <textarea type="text" rows="5" cols="20" name="c_address" value="<?php //echo $customer_name; ?>"
                    placeholder="ADDRESS"></textarea>
            </div>
            <div class="form-group">

                <input type="text" name="c_contact" value="<?php //echo $customer_name; ?>" placeholder="CONTACT">
            </div>
            <input type="submit" name="c_button" value="SAVE">
        </form>
    </div>
    <footer>
        <h3>Le'tea Milktea Hub &copy; 2019</h3>
    </footer>
</div>
<?php include '../require/footer.php'; ?>

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