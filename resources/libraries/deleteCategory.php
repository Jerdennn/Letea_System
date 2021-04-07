<?php

require_once '../config.php';

    $category_id = $_POST['category_id'];

    $query = "UPDATE category
    SET status = 0 WHERE category_id = '$category_id'";
    mysqli_query($db,$query) or die(mysqli_error($db));
?>
<script>
    alert('Successfully Deleted Category');
    window.location = "../templates/category.php";
</script>