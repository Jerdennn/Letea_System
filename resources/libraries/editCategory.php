<?php
require '../config.php';
    $category_id = $_POST['category_id'];
    $category_name = $_POST['category_name'];
    $description = $_POST['description'];
    $status = $_POST['status'];

    $query = "UPDATE category SET category_name = '$category_name', description = '$description', status = '$status' WHERE category_id = '$category_id'";
    mysqli_query($db,$query); 
    ?>
    <script type="text/javascript">
    alert('Category Successfully updated');
    window.location = '../templates/category.php';
    </script>
