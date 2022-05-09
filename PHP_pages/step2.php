<?php
    require_once("connection.php");
    session_start();
	
    if ($_SESSION["stop"] == 0) {
        header("location: http://www.computing.northampton.ac.uk/~13432616/CSY2028/project/PHP_pages/signIn.php");
    }
    $roomErr = "";
    $room = $_POST["room"];
    
    
    $title = $_SESSION["title"];
    $sname = $_SESSION["sname"];
    $att = $_SESSION["att"];
    $desc = $_SESSION["desc"];
    $date = $_SESSION["date"];
    $stime = $_SESSION["stime"];
    $etime = $_SESSION["etime"];
    
    
    if (isset($_POST["next"])) {
        if (empty($room)) {
            $roomErr= "Required";
        }
        if (isset($_POST["next"]) && $roomErr == "" ) {
            $_SESSION["room"] = $room;
            header("location: http://www.computing.northampton.ac.uk/~13432616/CSY2028/project/PHP_pages/step3.php");
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
    
    <div class="main6">
         <form action="http://www.computing.northampton.ac.uk/~13432616/CSY2028/project/PHP_pages/step2.php" method="post">
		        <header><span>Create Seminar</span></header>
                <fieldset>
                    <legend>Step 2 : Choosing Rooms</legend>
                    <div class="showrooms">
                        <section>
                            <label>
                                <?php 
                                    echo "<span class='title_input'>Available Rooms<span class='star'>*</span><span class='error'>".$roomErr."</span></span>";
									// Bring the available rooms
                                    $q1 = mysql_query("select * from room where seat_num >= $att and  room_id not in 
									(select room_id from seminar where (seminar_date='$date') and 
									((('$stime' between startTime and endTime) or ('$etime' between startTime and endTime)) or 
									((startTime between '$stime' and '$etime') or (endTime between '$stime' and '$etime'))))",$connect) or die("0 Room Found");
									// if there is a valid match the a row will save into an array
                                    while ($arrroom = mysql_fetch_array($q1)) {
									// pass the room information to a variables
                                        $roomR = $arrroom["room_id"];
                                        $seatR = $arrroom["seat_num"];
										// printout the rooms one by one
                                        echo "<div class='maindiv'><input type='radio' name='room' value = '$roomR"."' />Room: ".$roomR." "."Has ".$seatR." Seats</div>";
                                    }
                                    
                                ?>
                            </label>
                        </section>
                    </div>
                </fieldset>
                <footer>
                        <input type="submit" name="next" class="button"value="Next"/>
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