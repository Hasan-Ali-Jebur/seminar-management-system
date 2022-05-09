
<?php
require_once("connection.php");
session_start();
$ronumErr = $seaErr = $no = $yes = "";
$ronum = $_POST["ronum"];
$sea = $_POST["sea"];

function test($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;

    }
    
    if(isset($_POST["addr"])) {
        if (empty($ronum)) {
            $ronumErr= "Required";
        } else {
            $ronum = test($ronum);
            
            if (!preg_match("/[0-9]/",$ronum)) {
                $ronumErr = "Numbers only";
                
            }
        }
        if (empty($sea)) {
            $seaErr= "Required";
        }else {
            $sea = test($sea);
            if (!preg_match("/[0-9]/",$sea)) {
                $seaErr = "Numbers only"; 
                
            }
        }
        // Check if there is an error message
        if ($ronumErr == "" && $seaErr == "") {
		
		// querying the actual table
            $q40 = mysql_query("select * from room where room_id =$ronum and seat_num =$sea",$connect);
        
		// count the table rows and if there is a valid match error message will display   
			if (mysql_num_rows($q40) > 0) {
                $no = "Room already existe";
            }
		
		// is there is invalid match insert the room to 'room' table
            else {
            mysql_query("insert into room values($ronum,$sea)",$connect);
            $yes = "New room has been added";
            }
    }
    }

if ($_SESSION["exit"] == 0)
	{header("location: http://www.computing.northampton.ac.uk/~13432616/CSY2028/project/PHP_pages/signInmanager.php");}
if (isset($_POST["Signout"])) {
    $_SESSION["exit"]=0;
    header("location: http://www.computing.northampton.ac.uk/~13432616/CSY2028/project/PHP_pages/signInmanager.php");
}
// upcoming seminars
$q2 =mysql_query("select seminar.seminar_id,seminar.title,seminar.description,seminar.seminar_date,
				seminar.startTime,seminar.endTime,seminar.speakers_names,seminar.room_id,
				count(registration.seminar_id) from seminar LEFT JOIN registration ON seminar.seminar_id=registration.seminar_id 
				where seminar.seminar_date > now() group by seminar.seminar_id",$connect);
// past seminars			
$q3 =mysql_query("select seminar.seminar_id,seminar.title,seminar.description,seminar.seminar_date,
				seminar.startTime,seminar.endTime,seminar.speakers_names,seminar.room_id,
				count(registration.seminar_id) from seminar LEFT JOIN registration ON seminar.seminar_id=registration.seminar_id 
				where seminar.seminar_date < now()group by seminar.seminar_id",$connect);
// room popularity
$q4 =mysql_query("select room.room_id,room.seat_num,count(seminar.room_id) from room LEFT JOIN seminar 
				ON room.room_id = seminar.room_id group by room.room_id order by count(seminar.room_id) DESC",$connect);

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title></title>
        <link rel="stylesheet" href="http://www.computing.northampton.ac.uk/~13432616/CSY2028/project/css/over.css" />
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
        <form action="" method="post">
            <header>
                    <span>Please insert the room information</span>
                <input type="submit" name="Signout" class="button2" value="Sign out"/>
		    </header>
            <fieldset>
                    <section class="size">
				        <label class="input">
                            			<span class="title_input">Room number<span class="star">*</span><span class="error"><?php echo $ronumErr;?><span style="color:green;"><?php echo $yes;?> </span><span class='error'><?php echo $no; ?></span>
					        <input type="text" placeholder="Room Number" name="ronum" value="<?php echo $ronum;?>"/>
                        		</label>
	            </section>
                    <section class="att">
					<label class="input">
                            			<span class="title_input" >Number of seat<span class="star">*</span><span class="error"><?php echo $seaErr; ?></span></span>
					        <input type="text" placeholder="Number of seat" name="sea" value="<?php echo $sea; ?>"/>
			            	</label>
		    </section>
            </fieldset>
            <footer>
                <input type="submit" class="button" value="Add room" name="addr"/>
		    </footer>
        </form>
        <br /><br /><br />
         <form action="" method="post" class="conf">
		        <header>
                    <span>View</span>
		        </header>
                <fieldset>
                    <legend>Upcoming seminar</legend>
                    <table id="t01">
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Date</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Speakers Names</th>
                            <th>Room Number</th>
                            <th>Number of attendence</th>
                            
                        </tr>
                        <?php
                        $today =date("Y-m-d");
                        while($arrview = mysql_fetch_array($q2)) {
                            
                            $title= $arrview["title"]." ";
                            $desc = $arrview["description"]." ";
                            $date = $arrview["seminar_date"]." ";
                            $stime = $arrview["startTime"]." ";
                            $etime = $arrview["endTime"]." ";
                            $sname = $arrview["speakers_names"]." ";
                            $room = $arrview["room_id"]." ";
                            $number = $arrview["count(registration.seminar_id)"]."<br/>";
                            if ($date > $today) {
                            
                            echo "
                            <tr>
                                <td>$title</td>
                                <td>$desc</td>
                                <td>$date</td>
                                <td>$stime</td>
                                <td>$etime</td>
                                <td>$sname</td>
                                <td>$room</td>
                                <td>$number</td>
                            </tr>";
                            }
                        }
                        ?>
                    </table>
                </fieldset>
                <fieldset>
                    <legend>Past seminar</legend>
                    <table id="Table1">
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Date</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Speakers Names</th>
                            <th>Room Number</th>
                            <th>Number of attendence</th>
                            
                        </tr>
                        <?php
                        $today =date("Y-m-d");
                        
                        while($arrview2 = mysql_fetch_array($q3)) {
                            $title2= $arrview2["title"]." ";
                            $desc2 = $arrview2["description"]." ";
                            $date2 = $arrview2["seminar_date"]." ";
                            $stime2 = $arrview2["startTime"]." ";
                            $etime2 = $arrview2["endTime"]." ";
                            $sname2 = $arrview2["speakers_names"]." ";
                            $room2 = $arrview2["room_id"]." ";
                            $number2 = $arrview2["count(registration.seminar_id)"]."<br/>";
                            if ($date2 < $today) {
                            
                            echo "
                            <tr>
                                <td>$title2</td>
                                <td>$desc2</td>
                                <td>$date2</td>
                                <td>$stime2</td>
                                <td>$etime2</td>
                                <td>$sname2</td>
                                <td>$room2</td>
                                <td>$number2</td>
                            </tr>";
                            }
                        }
                        ?>
                    </table>
                </fieldset>
                <fieldset>
                    <legend>Room popularity</legend>
                    <table id="Table2">
                        <tr>
                            <th>Room number</th>
                            <th>Number of seat</th>
                            <th>Used</th>
                            
                        </tr>
                        <?php
                        while($arrview3 = mysql_fetch_array($q4)) {
                            
                            $room= $arrview3["room_id"]." ";
                            $seat = $arrview3["seat_num"]." ";
                            $used = $arrview3["count(seminar.room_id)"]." ";          
                            echo "
                            <tr>
                                <td>$room</td>
                                <td>$seat</td>
                                <td>$used</td>
                            </tr>";
                        }
                        ?>
                    </table>
                </fieldset>
                <footer>
                    
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