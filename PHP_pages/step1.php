<?php
    session_start();
    require_once("connection.php");
    session_start();
    if ($_SESSION["stop"] == 0) {
        header("location: http://www.computing.northampton.ac.uk/~13432616/CSY2028/project/PHP_pages/signIn.php");
    }
    $titleErr = $snameErr = $attErr =  $dateErr = $stimeErr = $etimeErr = "";
    $title = $_POST["title"];
    $desc = $_POST["desc"];
    $sname = $_POST["speakers"];
    $att = $_POST["att"];
    $date = $_POST["date"];
    $stime = $_POST["stime"];
    $etime = $_POST["etime"];
	$today = date("Y-m-d");
    
    function test($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;

    }
    
    if(isset($_POST["next"])) {
        if (empty($title)) {
            $titleErr= "Required";
        } else {
            $title = test($title);
            
            if (!preg_match("/[a-zA-Z]/",$title)) {
                $titleErr = "Only letters allowed";
                
            }
        }
        if (empty($sname)) {
            $snameErr= "Required";
        }else {
            $sname = test($sname);
            if (!preg_match("/[a-zA-Z]/",$sname)) {
                $snameErr = "Only letters allowed"; 
                
            }
        }
        if (empty($att)) {
            $attErr= "Required";
        }else {
            $att = test($att);
            if (!preg_match("/[0-9]/",$att)) {
                $attErr = "Numbers Only "; 
                
            }
        }
        
        if (empty($date)) {
            $dateErr= "Required";
        } else if ($date < $today) {
            $dateErr = "This date is befor today";
        }
        if (empty($stime)) {
            $stimeErr= "Required";
        }
        if (empty($etime)) {
            $etimeErr= "Required";
        }else if ($etime <= $stime) {
             $etimeErr= "Invalid time";
        }
		// check if there is no error and the form has submitted
        if (isset($_POST["next"]) && $titleErr == "" && $snameErr == "" && $attErr == "" && $dateErr == "" && $stimeErr == "" && $etimeErr == "") {
		// register the interned data to a session
            $_SESSION["title"] = $title;
            $_SESSION["sname"] = $sname;
            $_SESSION["att"] = $att;
            $_SESSION["desc"] = $desc;
            $_SESSION["date"] = $date;
            $_SESSION["stime"] = $stime;
            $_SESSION["etime"] = $etime;
		// redirect the user to the next step 
            header("location: http://www.computing.northampton.ac.uk/~13432616/CSY2028/project/PHP_pages/step2.php");
        }
        
    }

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title></title>
        <link rel="stylesheet" href="http://www.computing.northampton.ac.uk/~13432616/CSY2028/project/css/add.css" />
        <link rel="stylesheet" href="http://www.computing.northampton.ac.uk/~13432616/CSY2028/project/css/Home.css" />
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
    
    <div class="main4">
         <form action="http://www.computing.northampton.ac.uk/~13432616/CSY2028/project/PHP_pages/step1.php" method="post">
		        <header><span>Create Seminar</span></header>
                <fieldset>
                    <legend>Step 1 : Seminar Details</legend>
				    <section>
					    <label class="input">
                            <span class="title_input">Seminar Title<span class="star">*</span><span class="error"><?php echo $titleErr; ?></span></span>
							<input type="text" placeholder="Give it a short distinct name"  name="title" value="<?php echo $title;?>" />
						</label>
					</section>
                    <section>
					    <label>
                            <span class="title_input">Decription</span>
					        <textarea placeholder="Tell people what's special about this seminar"  name="desc" ><?php echo $desc;?></textarea>
					    </label>
					</section>
                    <section class="size">
				        <label class="input">
                            <span class="title_input">Speakers Names<span class="star">*</span><span class="error"><?php echo $snameErr;?></span></span>
					        <input type="text" placeholder="Speakers Names" name="speakers" value="<?php echo $sname;?>"/>
                        </label>
	                </section>
                    <section class="att">
					    <label class="input">
                            <span class="title_input" >Number of attendence<span class="star">*</span><span class="error"><?php echo $attErr; ?></span></span>
					        <input type="text" placeholder="Number of attendence" name="att" value="<?php echo $att; ?>"/>
			            </label>
					</section>
                    <section class="size">
					    <label class="input">
                            <span class="title_input" >Seminar Date<span class="star">*</span><span class="error"><?php echo $dateErr; ?></span></span>
							<input type="text" name="date" value="<?php echo $date;?>" placeholder="yyyy-mm-dd" title="yyyy-mm-dd" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[0-1])"/>
						</label>
				    </section>
                    <section class="time1">
					    <label class="input">
                            <span class="title_input">Start Time<span class="star">*</span><span class="error"><?php echo $stimeErr;?></span></span>
					        <input type="text" name="stime" value="<?php echo $stime;?>" placeholder="HH:MM" title="HH:MM (make sure it is in 24 houres pattern)" pattern="(0[0-9]|1[0-9]|2[0-3]):(0[0-9]|1[0-9]|2[0-9]|3[0-9]|4[0-9]|5[0-9]|6[0-0])" />
					    </label>
					</section>
                    <section class="time2">
					    <label class="input">
                            <span class="title_input">End Time<span class="star">*</span><span class="error"><?php echo $etimeErr;?></span></span>
					        <input type="text" name="etime" value="<?php echo $etime;?>" placeholder="HH:MM" title="HH:MM (make sure it is in 24 houres pattern)" pattern="(0[0-9]|1[0-9]|2[0-3]):(0[0-9]|1[0-9]|2[0-9]|3[0-9]|4[0-9]|5[0-9]|6[0-0])"/>
					    </label>
					</section>
                
	            </fieldset>
                <footer>
				    <input type="submit" name="next" class="button" value="Next"/>
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