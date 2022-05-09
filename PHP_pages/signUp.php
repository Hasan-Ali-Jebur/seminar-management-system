<?php 
    session_start();
    require_once("connection.php");
    $fnameErr = $lnameErr = $emailErr =  $genderErr  = $passErr =  $repassErr = $existeErr = $genderErr =  "";
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $email = $_POST["email"];
    $pass = $_POST["pass"];
    $repass = $_POST["repass"];
    $gender = $_POST["gender"];
    
    function test($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;

    }
    
    if(isset($_POST["register"])) {
        if (empty($fname)) {
            $fnameErr= "Required";
        } else {
            $fname = test($fname);
            
            if (!preg_match("/[a-zA-Z]/",$fname)) {
                $fnameErr = "Only letters allowed";
                
            }
        }
        if (empty($lname)) {
            $lnameErr= "Required";
        }else {
            $lname = test($lname);
            if (!preg_match("/[a-zA-Z]/",$lname)) {
                $lnameErr = "Only letters allowed"; 
                
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
        // check if the user has interned data
        if ($email !="") { 
		// query the 'organiser' table
            $q10 = mysql_query("select email from organiser where email ='$email'",$connect);
		// count the table row and save the value to a variable
            $check = mysql_num_rows($q10);
		// check if the variable has value or the email address is found
            if ($check > 0) {
                $_SESSION["error"] = "#e89a9a";
		// register the error message
                $existeErr = "User already existe please try again!";
            }
        }
        
        
        if (empty($pass)) {
            $passErr= "Required";
        }
        
        if (empty($gender)) {
            $genderErr= "Required";
        }
        
        if (empty($repass)) {
            $repassErr = "Required";
        }
        else if ($pass != $repass) {$repassErr = "should be the same as password";
        }
        
        
        if (empty($gender)) { $genderErr= "Required";}
		//check if there is not error recorded
        if ( $fnameErr == "" && $lnameErr == "" && $emailErr == "" && $genderErr  == "" && $passErr == "" && $repassErr ==  "" && $existeErr == "" ) {
        // insert the organiser details
			mysql_query("insert into organiser values ('','$fname','$lname','$email','$pass','$repass','$gender')",$connect);
        // querying the organiser table to get the organiser id
			$q1 = mysql_query("select organiser_id from organiser where email='$email' and password='$pass' and password = re_password",$connect);
        // loop to find the id number   
			while($arrorg = mysql_fetch_array($q1)) {
                $org_id = $arrorg["organiser_id"];
		// register the id for a session
                $_SESSION["organiser_id"] = $org_id;
		// redirect the user to step1.php using header() function
                header("location: http://www.computing.northampton.ac.uk/~13432616/CSY2028/project/PHP_pages/step1.php");
            }
        }        
    }
	mysql_close($connect);
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
    
    <div class="main2">
        
        <form action="signUp.php" method="post">
		        <header><span class="signtitle">Please sign up</span></header>
                <fieldset style="background-color:<?php if ($check > 0) {echo $_SESSION["error"];} ?>">
						            <section>
							            <label class="input">
                                            <?php  
                                            if ($existeErr != "") { echo "<b style='color:red;'>$existeErr</b>";}
                                             if ($fnameErr != ""){echo "<span class='error'> $fnameErr </span>";}?>
								            <input type="text" placeholder="First name(Required)" name="fname" value="<?php echo $fname ;?>"/>
                                            
							            </label>
						            </section>
						            <section>
							            <label class="input">
                                            <?php if ($lnameErr != ""){echo "<span class='error'> $lnameErr </span>";}?>
								            <input type="text" placeholder="Last name(Required)" name="lname" value="<?php echo $lname ;?>"/>
                                            
							            </label>
						            </section>
					
					            
						            <section>
							            <label class="input">
								            <?php if ($emailErr != ""){echo "<span class='error' > $emailErr </span>";}?>
								            <input type="email" placeholder="E-mail(Required)" name="email" value="<?php echo $email ;?>"/>
                                            
							            </label>
						            </section>
						            <section>
							            <label class="input">
                                            <?php if ($passErr != ""){echo "<span class='error'> $passErr </span>";}?>
								            <input type="password" placeholder="Password(Required)" name="pass" value="<?php echo $pass ; ?>"/>
                                            
							            </label>
						            </section>
                    					<section>
							            <label class="input">
                                            <?php if ($repassErr != ""){echo "<span class='error'> $repassErr </span>";}?>
								            <input type="password" placeholder="Confirm Password(Required)" name="repass" />
                                            
							            </label>
						            </section>
                                    <section>
							            <label class="select">
                                            <?php if ($genderErr != ""){echo "<span class='error'> $genderErr </span>";}?>
								            <select name="gender" >
									            <option value="0" selected ="selected" disabled="disabled">Gender</option>
                                                <option>Male</option>
                                                <option>Female</option>
					                        </select>
                                            
                                        </label>
                                    </section>
				       </fieldset>
            		   <footer>
					        <input type="submit" value="Register" name="register"/>
                           <span><b>OR</b></span>
                            <a href="signIn.php">Sign In</a>
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