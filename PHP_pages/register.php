<?php 
    session_start();
    require_once("connection.php");
    $fnameErr = $lnameErr = $emailErr = $conemailErr = $existeErr = $genderErr = "";
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $email = $_POST["email"];
    $conemail = $_POST["conemail"];
    $gender = $_POST["gender"];
    $seminar = $_GET["seminar_id"];
    $q100 = mysql_query("select * from seminar where seminar_id=$seminar",$connect);
    while($arrseminarinfo = mysql_fetch_array($q100)) {
        $title= $arrseminarinfo["title"]; 
        $date =$arrseminarinfo["seminar_date"];
        $stime =$arrseminarinfo["startTime"];
        $sname =$arrseminarinfo["speakers_names"];
        $desc = $arrseminarinfo["description"];
    }
    
    
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
        if (empty($gender)) {
            $genderErr= "Required";
        }
        if (empty($email)) {
            $emailErr= "Required";
        }else {
            $email = test($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format"; 
            }
        }
        
         $q30 = mysql_query("select email from registration where seminar_id = $seminar and email='$email'",$connect);
         $checkfound = mysql_num_rows($q30);
         if ($checkfound > 0) { $existeErr = "You already signed for this seminar!";
            
         }
        
        if (empty($conemail)) {
            $conemailErr = "Required";
        }
        else if ($email != $conemail) {$conemailErr = "should be the same as email";
        }
        
        // Check if there is no error messages
        if ($emailErr=="" && $conemailErr=="" && $fnameErr=="" && $lnameErr== "" && $existeErr == "" && $genderErr== "") {
		
		// insert data to the 'registration' table
            mysql_query("insert into registration values ('','$fname','$lname','$email',$seminar,'$gender')",$connect);
		
		// obtaining the ticket number 
            $q40 = mysql_query("select max(ticket_num) from registration",$connect);
            while($arrticket = mysql_fetch_array($q40)) {
			
			// register ticket number and seminar is in a session and redirect to ticket_info.php
                $_SESSION["ticket_num"] = $arrticket["max(ticket_num)"];
                $_SESSION["seminar_id"]=$seminar;
                header("location:http://www.computing.northampton.ac.uk/~13432616/CSY2028/project/PHP_pages/ticket_info.php");
                
                
            }
            
        }        
    }
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title></title>
    <link rel="stylesheet" href="http://www.computing.northampton.ac.uk/~13432616/CSY2028/project/css/register.css"/>
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
        <div class="body1">
        <div class="seminar">
            <h3>Ganeral information about the seminar:</h3>
            <p class="par"><?php echo $title;?></p>
            <p><i><?php echo $date ."".","." ".$stime;?></i></p>
            <p><b>Description:</b><?php echo $desc;?></p>
            <p><b>Speakers:</b><?php echo $sname;?></p>
            <br /><br /><br />
            <h4 style="color:rgba(36, 180, 55, 0.83);">Create your own seminar, click : <a href="http://www.computing.northampton.ac.uk/~13432616/CSY2028/project/PHP_pages/Home.php">Home</a></h4>
        </div>
        <form action="" method="post" class="right">
		        <header><span>Your Information </span></header>
                <fieldset>
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
								            <input type="email" placeholder="Email Address(Required)" name="email" value="<?php echo $email ;?>"/>
                                            
							            </label>
						            </section>
						            <section>
							            <label class="input">
                                            <?php if ($conemailErr != ""){echo "<span class='error'> $conemailErr </span>";}?>
								            <input type="email" placeholder="Confirm Email Address(Required)" name="conemail" value="<?php echo $conemail ; ?>"/>
                                            
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
				       </footer>
            </form>
        </div>
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