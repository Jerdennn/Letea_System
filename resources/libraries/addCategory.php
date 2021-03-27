<?php

require_once '../config.php';

if(isset($_POST['save_category'])){
    $category_name = $_POST['category_name'];
    $description = $_POST['description'];
    $category_status = $_POST['status'];

    $query = "SELECT * FROM CATEGORY WHERE CATEGORY_NAME = '$category_name'";
    $result = mysqli_query($db,$query) or die(mysqli_error($db));

     $counter = mysqli_num_rows($result);
        if ($counter > 0 ): ?>
        <script type="text/javascript">
            alert("Category Already Exist!");
            window.location = "../templates/category.php";
        </script>
        <?php  
        else: 
            mysqli_query($db,"INSERT INTO CATEGORY(CATEGORY_NAME,DESCRIPTION,STATUS) VALUES ('$category_name','$description','$category_status')") OR die(mysqli_error($db));
        endif; ?>
        <script type="text/javascript">
            alert("Successfully save category");
            window.location = "../templates/category.php";
        </script>
        <?php }?>