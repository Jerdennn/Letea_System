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
                &nbsp; &nbsp; Ingredient &nbsp;
                <a class="js-open-modal" href="#" data-modal-id="popup"><i class="fas fa-plus"></i></a>
            </h3>
        </div>
        <div class="col-20 col-m-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3 style="text-transform:uppercase;">
                        Ingredient List
                    </h3>
                </div>
                <div class="card-content">
                    <?php $query=mysqli_query($db,"SELECT *, p_price * p_qty as total FROM product INNER JOIN category ON category.category_ID = product.cat_ID INNER JOIN supplier ON supplier.supplier_ID = product.supplier_ID ORDER BY p_name" )or die(mysqli_error($db));
                    ?>
                    <table>
                        <thead>
                            <tr>

                                <th>Picture</th>
                                <th>Product Code</th>
                                <th>Product Name</th>
                                <th>Description</th>
                                <th>Supplier</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row=mysqli_fetch_array($query)){ ?>
                            <tr>
                                <?php 
                               $availableqty=$row['p_qty'];
				if ($availableqty < 15) {
				echo '<tr style="color: #fff; background:rgb(255, 95, 66);">';
				}
				else {
				echo '<tr>';
				}
			?>
                                <td><img style="width:80px;height:60px"
                                        src=" ../../../../public_html/img/dist/uploads/<?php echo $row['p_pic'];?>">
                                </td>
                                <td><?php echo $row['p_code'];?></td>
                                <td><?php echo $row['p_name'];?></td>
                                <td><?php echo $row['p_descrp'];?></td>
                                <td><?php echo $row['supplier_name'];?></td>
                                <td><?php echo $row['p_qty'];?></td>
                                <td><?php echo $row['p_price'];?></td>
                                <td><?php echo $row['category_name'];?></td>
                                <td><?php echo number_format($row['total']);?></td>
                                <td>
                                    <a href="products.php?pro=<?php echo $row['p_id']; ?>" class="js-open-modal"
                                        data-modal-id="popup2"><i class="fas fa-pen fa-l"></i></a>
                                    <a href="admin_product.php?pro_del=<?php echo $row['p_id']; ?>"><i
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
<!-- ADD MODAL -->
<div id="popup" class="modal-box">
    <header>
        <a href="#" class="js-modal-close close">×</a>
        <h5>ADD INGREDIENT</h5>
    </header>
    <div class="modal-body">
        <div class="form-style-2" >
            <form action="" method="post">
                <label for="barcode">
                    <span>Barcode<span class="required">*</span></span>
                    <input type="text" class="input-field" name="barcode" value="" maxlength="80" autofocus id="itemCode">
                </label>

                <label for="field2"><span>Ingredient Name<span class="required">*</span></span>
                    <input type="text" class="input-field" name="field2" value="" />
                </label>

                <label for="field5"><span>Description</span>
                    <textarea name="field5" class="textarea-field"></textarea>
                </label>

                <label>
                    <span>Quantity</span>
                    <input type="number" class="tel-number-field" name="tel_no_1" value="0" min="0" max="999999999" />
                </label>

                <label for="field1"><span>Price<span class="required"></span></span>
                    <input type="number" class="input-field" name="field1" value="" />
                </label>

                <label for="field4"><span>Category</span>
                    <select name="field4" class="select-field"></select>
                </label>

                <!-- <label for="field4">
                    <span>Supplier</span>
                    <select name="field4" class="select-field"></select>
                </label> -->

                <label for="date">
                    <span>Date Stock in</span>
                    <input type="Date" name="date" />
                </label>

                <label for="image">
                    <span>Image</span>
                    <input type="file" name="image">
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
<!-- EDIT MODAL -->
<div id="popup2" class="modal-box">
    <header>
        <a href="#" class="js-modal-close close">×</a>
        <h5>EDIT INGREDIENT</h5>
    </header>
    <div class="modal-body">
        <div class="form-style-2">
            <form action="" method="post">
                <label for="field1">
                    <span>Barcode<span class="required"></span></span>
                    <input type="text" class="input-field" name="field1" value="" />
                </label>

                <label for="field2"><span>Ingredient Name<span class="required"></span></span>
                    <input type="text" class="input-field" id="itemName" name="field2" value="" />
                </label>

                <label for="field5"><span>Description</span>
                    <textarea name="field5" class="textarea-field"></textarea>
                </label>

                <label>
                    <span>Quantity</span>
                    <input type="number" class="tel-number-field" name="tel_no_1" value="0" min="0" max="999999999" />
                </label>

                <label for="field1"><span>Price<span class="required"></span></span>
                    <input type="number" class="input-field" name="field1" value="" />
                </label>

                <label for="field4"><span>Category</span>
                    <select name="field4" class="select-field"></select>
                </label>

                <!-- <label for="field4">
                    <span>Supplier</span>
                    <select name="field4" class="select-field"></select>
                </label> -->

                <label for="date">
                    <span>Date Stock Arrival</span>
                    <input type="Date" name="date" />
                </label>

                <label for="date">
                    <span>Expiry Date</span>
                    <input type="Date" name="date" />
                </label>

                <label for="images">
                    <span>Image</span>
                    <input type="file" name="image">
                </label>

                <label><span></span>
                    <input type="submit" value="Update" />
                </label>
            </form>
        </div>
    </div>
    <footer>
        <h5>Le'tea Milktea Hub &copy; 2019</h5>
    </footer>
</div>
<?php require_once '../require/footer.php';?>

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

<!-- Script for Jquery Modals -->
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
                top: ($(window).height() - $(".modal-box").outerHeight()) / 10,
                left: ($(window).width() - $(".modal-box").outerWidth()) / 2
            });
        });

        $(window).resize();

    });


    $("#useBarcodeScanner").click(function(e){
        e.preventDefault();
        
        $("#itemCode").focus();
    });

    $("#itemCode").keypress(function(e){
        if(e.which === 13){
            e.preventDefault();
            
            //change to next input by triggering the tab keyboard
            $("#itemName").focus();
        }
    });
</script>