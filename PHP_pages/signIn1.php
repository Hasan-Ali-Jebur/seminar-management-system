<?php

session_start();
require_once("connection.php");
$emailErr = $passErr =  $notexistErr = "";
$email = $_POST["email"];
$pass = $_POST["pass"];

function test($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;

}
if (isset($_POST["signIn"])) {
    if (empty($email)) {
        $emailErr= "Required";
    }else {
        $email = test($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format"; 
        }
    }
    
    if (empty($pass)) {
        $passErr= "Required";
    }
    
    // Check if there is no errors and the form has been submitted
    if (isset($_POST["signIn"]) && $emailErr == "" && $passErr == "" && $repassErr ==  "") {
    
	// query the actual table
		$q1 = mysql_query("select organiser_id from organiser where email='$email' and password='$pass' and password = re_password",$connect);
    
	// use mysql_num_rows function to count the result rows
        $check = mysql_num_rows($q1);
	// if there is a valid match $check = 1
        if ( $check == 1) {
            while($arrorg = mysql_fetch_array($q1)) {
	
	// register the user id in a session
                $org_id = $arrorg["organiser_id"];
                $_SESSION["organiser_id"] = $org_id;
                $_SESSION["exit"] =1;
                header("location: http://www.computing.northampton.ac.uk/~13432616/CSY2028/project/PHP_pages/overview.php");
                
            }
	// if there is an invalid match error message will be displayed
        } else {
            $notexistErr = "Incorrect username or password";
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
        <form action="http://www.computing.northampton.ac.uk/~13432616/CSY2028/project/PHP_pages/signIn1.php" method="post">
		        <header><span>Please sign in</span></header>
                <fieldset>
						            <section>
							            <label class="input">
                                            <?php if ($notexistErr != "") { echo "<b style='color:red;'>$notexistErr</b>";} 
                                                  if ($emailErr != ""){echo "<span class='error' > $emailErr </span>";}?>
								            <input type="text" placeholder="Email" name="email" value="<?php echo $email;?>"/>
							            </label>
						            </section>
						            <section>
							            <label class="input">
                                            <?php if ($passErr != ""){echo "<span class='error'> $passErr </span>";}?>
								            <input type="password" name="pass" placeholder="Password" value="<?php echo $pass ; ?>"/>
							            </label>
						            </section>
				       </fieldset>
            		   <footer>
                           <input type="submit" class="button1" value="Sign In" name="signIn"/>
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
