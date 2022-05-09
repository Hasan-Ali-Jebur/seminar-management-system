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
    
    
    if ($emailErr == "" && $passErr == "") {
        if ($email == "hassn.ali1212@yahoo.com" && $pass == 13432616){
            $_SESSION["exit"] =1;
            header("location:http://www.computing.northampton.ac.uk/~13432616/CSY2028/project/PHP_pages/overmanager.php");
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
        
        <form action="" method="post">
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