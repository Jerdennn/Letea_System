<?php
require_once('../config.php');
require_once '../session.php';

if (isset($_POST['btn_login'])) {
  $users = trim($_POST['username']);
  $upass = trim($_POST['password']);
  $h_upass = md5($upass);
if ($upass == ''){
     ?>    <script type="text/javascript">
                alert("Password is missing!");
                window.location = "/index.php";
                </script>
        <?php
}else{
//create some sql statement             
        $sql = "SELECT USER_ID,e.FIRSTNAME,e.LASTNAME,e.GENDER,e.EMAIL,e.PHONE_NUMBER,j.JOB_TITLE,t.TYPE
        FROM  `users` u
        INNER JOIN `employee` e ON e.EMPLOYEE_ID=u.EMPLOYEE_ID
        INNER JOIN `job` j ON e.JOB_ID=j.JOB_ID
        INNER JOIN `type` t ON t.TYPE_ID=u.TYPE_ID
        WHERE  `USERNAME` ='" . $users . "' AND  `PASSWORD` =  '" . $h_upass . "'";
        $result = $db->query($sql);

        if ($result){
        //get the number of results based n the sql statement
        //check the number of result, if equal to one   
        //IF theres a result
            if ( $result->num_rows > 0) {
                //store the result to a array and passed to variable found_user
                $found_user  = mysqli_fetch_array($result);
                //fill the result to session variable
                $_SESSION['MEMBER_ID']  = $found_user['USER_ID']; 
                $_SESSION['FIRSTNAME'] = $found_user['FIRSTNAME']; 
                $_SESSION['LASTNAME']  =  $found_user['LASTNAME'];  
                $_SESSION['GENDER']  =  $found_user['GENDER'];
                $_SESSION['EMAIL']  =  $found_user['EMAIL'];
                $_SESSION['PHONE_NUMBER']  =  $found_user['PHONE_NUMBER'];
                $_SESSION['JOB_TITLE']  =  $found_user['JOB_TITLE'];
                $_SESSION['TYPE']  =  $found_user['TYPE'];
                $mem_id = $_SESSION['MEMBER_ID'];

        //this part is the verification if admin or user ka
        if ($_SESSION['TYPE']=='ADMINISTRATOR'){
           
             ?>    <script type="text/javascript">
                      //then it will be redirected to index.php
                      alert("<?php echo  $_SESSION['FIRSTNAME']; ?> Welcome!");
                      window.location = "../templates/dashboard.php";
                  </script>
             <?php        
           
        }elseif ($_SESSION['TYPE']=='SALES MANAGER'){
           
             ?>    <script type="text/javascript">
                      //then it will be redirected to index.php
                      alert("<?php echo  $_SESSION['FIRSTNAME']; ?> Welcome!");
                      window.location = "../templates/dashboard.php";
                  </script>
             <?php        
           
        }
                elseif ($_SESSION['TYPE']=='INVENTORY CLERK'){
           
             ?>    <script type="text/javascript">
                      //then it will be redirected to index.php
                      alert("<?php echo  $_SESSION['FIRSTNAME']; ?> Welcome!");
                      window.location = "../templates/dashboard.php";
                  </script>
             <?php        
           
        }
            } else {
            //IF theres no result
              ?>
                <script type="text/javascript">
                alert("Username or Password Not Registered! Contact Your administrator.");
                window.location = "../../index.php";
                </script>
              <?php

            }

         } else {
                 # code...
        echo "Error: " . $sql . "<br>" . $db->error;
        }     
    }
}

 $db->close();



?>