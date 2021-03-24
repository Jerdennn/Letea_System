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
        <h5>ADD CUSTOMER</h5>
    </header>
    <div class="modal-body">
    <div class="form-style-2">
            <form action="" method="post">
                <label for="field1">
                    <span>First Name<span class="required"></span></span>
                    <input type="text" class="input-field" name="field1" value="" />
                </label>
                <label for="field2">
                    <span>Last Name<span class="required"></span></span>
                    <input type="text" class="input-field" name="field2" value="" />
                </label>
                <label for="field3">
                    <span>Address</span>
                    <textarea name="field5" class="textarea-field"></textarea>
                </label>
                <label for="field4">
                    <span>Contact<span class="required"></span></span>
                    <input type="text" class="input-field" name="field4" value="" />
                </label>
                <label>
                    <span></span>
                    <input type="submit" value="Save" />
                </label>
            </form>
        </div>
    </div>
    <footer>
        <h5>Le'tea Milktea Hub &copy; 2019</h5>
    </footer>
</div>

<!-- EDIT CUSTOMER MODAL -->
<div id="editCustomer" class="modal-box">
<header>
        <a href="#" class="js-modal-close close">×</a>
        <h5>Edit CUSTOMER</h5>
    </header>
    <div class="modal-body">
    <div class="form-style-2">
            <form action="" method="post">
                <label for="field1">
                    <span>First Name<span class="required"></span></span>
                    <input type="text" class="input-field" name="field1" value="" />
                </label>
                <label for="field2">
                    <span>Last Name<span class="required"></span></span>
                    <input type="text" class="input-field" name="field2" value="" />
                </label>
                <label for="field3">
                    <span>Address</span>
                    <textarea name="field5" class="textarea-field"></textarea>
                </label>
                <label for="field4">
                    <span>Contact<span class="required"></span></span>
                    <input type="text" class="input-field" name="field4" value="" />
                </label>
                <label>
                    <span></span>
                    <input type="submit" value="Save" />
                </label>
            </form>
        </div>
    </div>
    <footer>
        <h5>Le'tea Milktea Hub &copy; 2019</h5>
    </footer>
</div>
<?php include '../require/footer.php'; ?>


<!-- Form Styles -->
<style type="text/css">
    .form-style-2 {
        max-width: 500px;
        padding: 20px 12px 10px 20px;
        font: 13px Arial, Helvetica, sans-serif;
    }

    .form-style-2-heading {
        font-weight: bold;
        font-style: italic;
        border-bottom: 2px solid #ddd;
        margin-bottom: 20px;
        font-size: 15px;
        padding-bottom: 3px;
    }

    .form-style-2 label {
        display: block;
        margin: 0px 0px 15px 0px;
    }

    .form-style-2 label>span {
        width: 150px;
        font-weight: bold;
        float: left;
        padding-top: 8px;
        padding-right: 5px;
    }

    .form-style-2 span.required {
        color: red;
    }

    .form-style-2 .tel-number-field {
        width: 70px;
        text-align: left;
    }

    .form-style-2 input.input-field,
    .form-style-2 .select-field {
        width: 50%;
    }

    .form-style-2 input.input-field,
    .form-style-2 .tel-number-field,
    .form-style-2 .textarea-field,
    .form-style-2 .select-field {
        box-sizing: border-box;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        border: 1px solid #C2C2C2;
        box-shadow: 1px 1px 4px #EBEBEB;
        -moz-box-shadow: 1px 1px 4px #EBEBEB;
        -webkit-box-shadow: 1px 1px 4px #EBEBEB;
        border-radius: 3px;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        padding: 8px;
        outline: none;
    }

    .form-style-2 .input-field:focus,
    .form-style-2 .tel-number-field:focus,
    .form-style-2 .textarea-field:focus,
    .form-style-2 .select-field:focus {
        border: 1px solid #0C0;
    }

    .form-style-2 .textarea-field {
        height: 55px;
        width: 55%;
    }

    .form-style-2 input[type=submit],
    .form-style-2 input[type=button] {
        border: none;
        padding: 8px 15px 8px 15px;
        background: #FF8500;
        color: #fff;
        box-shadow: 1px 1px 4px #DADADA;
        -moz-box-shadow: 1px 1px 4px #DADADA;
        -webkit-box-shadow: 1px 1px 4px #DADADA;
        border-radius: 3px;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
    }

    .form-style-2 input[type=submit]:hover,
    .form-style-2 input[type=button]:hover {
        background: #EA7B00;
        color: #fff;
    }
</style>

<!-- SCRIPT FOR MODAL -->
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