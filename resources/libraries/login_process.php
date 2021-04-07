<?php
require_once '../config.php'; 
require('../session.php'); ?>


<?php if(isset($_POST['btn_login'])){
     $username = $_POST['username'];
     $password = $_POST['password'];
     $merchant = $_POST['merchant'];

     $user = mysqli_real_escape_string($db,$username);
     $pass1 = mysqli_real_escape_string($db,$password);

     $pass=md5($pass1); ?>
     <?php
          $query = mysqli_query($db,"SELECT * FROM USERS u INNER JOIN merchant m ON m.merchant_id = u.merchant_id INNER JOIN employee e ON e.employee_id = u.employee_id WHERE u.username = '$user' and u.passwordHash = '$pass' and u.merchant_id = '$merchant' and u.status = 0") or die(mysqli_error($db));
          $data = mysqli_fetch_array($query);
          $id = $data['user_id'];
          $name = $data['username'];

          $counter = mysqli_num_rows($query);
          $_SESSION['merchant'] = $data['merchant_id']; 
          $_SESSION['merchant_name'] = $data['merchant_name']; ?>
          
          <?php
          if($counter == 0){ ?>
               <script> 
               alert("Invalid username or password!");
               window.location = "../../index.php";
               </script>
         <?php } 
          elseif($counter > 0){
                $_SESSION['FIRSTNAME'] = $data['firstname']; 
                $_SESSION['LASTNAME']  =  $data['lastname'];  
                $_SESSION['GENDER']  =  $data['gender'];
                $_SESSION['EMAIL']  =  $data['email'];
                $_SESSION['PHONE_NUMBER']  =  $data['phone'];
                $_SESSION['ROLES']  =  $data['role_name'];
                    $_SESSION['user_id']=$id;	
                    $_SESSION['name']=$name; 
                    ?>
                    <script> 
                    alert("Welcome <?php echo $_SESSION['name']?> redirecting to Dashboard");
                    window.location = "../../resources/templates/dashboard.php";
                    </script>
                    <?php
               } ?>
<?php } ?>