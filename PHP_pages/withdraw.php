<?php

    require_once("connection.php");
    $numErr = $emailErr = "";
    
    $email =$_POST["email"];
    $num =$_POST["num"];
    
    function test($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;

    }
    if (isset($_POST["cancel"])) {
        if (empty($num)) {
            $numErr= "Required";
        }else{
            $num = test($num);
            if (!preg_match("/[0-9]/",$num)) {
                $numErr = "Numbers Only"; 
            }
        }
        
        if (empty($email)) {
            $emailErr= "Required";
        }else {
            $email = test($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format"; 
            }
        }
        // Check if the data interred correctly
        if ($emailErr =="" && $numErr== "") {    
        
		// query the actual table
		$q1 = mysql_query("select email,ticket_num from registration where email ='$email' and ticket_num = $num",$connect);
		
		// use mysql_num_rows function to count the result rows
		$x = mysql_num_rows($q1);
		
		// if there is a invalid match $check = 0
        if ($x == 0) {
		// displaying an error message
            $numErr = "Please insert a valid ticket number or email";
		// // if there is a valid match 
        }else{
		// delete a record
            mysql_query("delete from registration where ticket_num =$num and email='$email'",$connect);
            $x = "done";
        }
        }

                
    }
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title></title>
    <link rel="stylesheet" href="http://www.computing.northampton.ac.uk/~13432616/CSY2028/project/css/sign up.css"/>
    <link rel="stylesheet" href="http://www.computing.northampton.ac.uk/~13432616/CSY2028/project/css/Home.css"/>
</head>
<body>
    <div class="header">
        <div class="title"></div>
        <ul>
            <li><a href="http://www.computing.northampton.ac.uk/~13432616/CSY2028/project/PHP_pages/Home.php">Home</a></li>
            <li><a href="http://www.computing.northampton.ac.uk/~13432616/CSY2028/project/PHP_pages/signIn.php">Create Seminar</a></li>
            <li><a href="http://www.computing.northampton.ac.uk/~13432616/CSY2028/project/PHP_pages/signIn1.php">Organiser overview</a></li>
            <li><a href="http://www.computing.northampton.ac.uk/~13432616/CSY2028/project/PHP_pages/signInmanager.php">Manager overview</a></li>
        </ul>
    </div>
    
    <div class="main1">
        
        <form action="" method="post">
		        <header><span>Cancle your Registration</span></header>
                <fieldset>
                                   <section>
							            <label class="input"><span style="color:green;"><?php if (!empty($x)) {echo $x;} ?></span>
                                            <?php if ($emailErr != "") { echo "<b style='color:red;'>$emailErr</b>";}?>
								            <input type="text" placeholder="Email" name="email" value="<?php echo $email;?>"/>
							            </label>
						            </section>

						            <section>
							            <label class="input">
                                            <?php if ($numErr != "") { echo "<b style='color:red;'>$numErr</b>";}?>
								            <input type="text" placeholder="Ticket Number" name="num" value="<?php echo $num;?>"/>
							            </label>
						            </section>
				       </fieldset>
            		   <footer>
                           <input type="submit" class="button1" value="cancel" name="cancel"/>
				       </footer>
            </form>
        
    </div>
    <div class="footer">
        <div class="copyright">
            <br />
        &copy;&nbsp;<?php echo date("Y");?>&nbsp;SEMINAR<br />
        Designed by Hasan Abo Dihin
        </div>
        <div class="footer_title"></div>
        <div class="contact">
            <br />
            <span>Please contact me at:</span><br /><br />
            <img src="http://www.computing.northampton.ac.uk/~13432616/CSY2028/project/images/call.png"/><span>&nbsp;&nbsp;+44 7999299105&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <img src="http://www.computing.northampton.ac.uk/~13432616/CSY2028/project/images/email.png" /><span>&nbsp;&nbsp;hassn.ali1212@yahoo.com</span>
        </div>
    </div>
</body>
</html>