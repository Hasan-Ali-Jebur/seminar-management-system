
<?php
    require_once("connection.php");
    session_start();
    if ($_SESSION["exit"] == 0){header("location: http://www.computing.northampton.ac.uk/~13432616/CSY2028/project/PHP_pages/signIn1.php");}
    if (isset($_POST["Signout"])) {
        $_SESSION["exit"]=0;
        header("location: http://www.computing.northampton.ac.uk/~13432616/CSY2028/project/PHP_pages/Home.php");
    }
	$q1 =mysql_query("select first_name from organiser where organiser_id=$orglast_id",$connect);
	// Obtaining the organiser id using a registered session
    $orglast_id = $_SESSION["organiser_id"] ;
	
	//Querying the database to get all organiser's seminars
    while($arrname = mysql_fetch_array($q1)) {$name = $arrname["first_name"];}
    $q2 =mysql_query("select seminar.seminar_id,seminar.title,seminar.description,seminar.seminar_date,
	seminar.startTime,seminar.endTime,seminar.speakers_names,seminar.room_id,
	count(registration.seminar_id) from seminar LEFT JOIN registration ON seminar.seminar_id=registration.seminar_id 
	where seminar.organiser_id=$orglast_id group by seminar.seminar_id",$connect);
    ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title></title>
        <link rel="stylesheet" href="http://www.computing.northampton.ac.uk/~13432616/CSY2028/project/css/over.css" />
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
         <form action="" method="post" class="conf">
		        <header>
                    <span>Welcome <span style="color:rgba(25, 92, 156, 0.68);"><?php echo $name; ?></span></span>
                     <input type="submit" name="Signout" class="button"value="Sign out"/>
		        </header>
                <fieldset>
                    <legend>Please see your seminars ?</legend>
                    <table id="t01">
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Date</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Speakers Names</th>
                            <th>Room Number</th>
                            <th>Registered People</th>
                            <th>Seminar link</th>
                            
                        </tr>
                        <?php
                        while($arrview = mysql_fetch_array($q2)) {
                            $seminar = $arrview["seminar_id"];
                            $title= $arrview["title"]." ";
                            $desc = $arrview["description"]." ";
                            $date = $arrview["seminar_date"]." ";
                            $stime = $arrview["startTime"]." ";
                            $etime = $arrview["endTime"]." ";
                            $sname = $arrview["speakers_names"]." ";
                            $room = $arrview["room_id"]." ";
                            $number = $arrview["count(registration.seminar_id)"]."<br/>";
                            $link ="<a href='http://www.computing.northampton.ac.uk/~13432616/CSY2028/project/PHP_pages/register.php?seminar_id=$seminar'>http://www.computing.northampton.ac.uk/~13432616/CSY2028/project/PHP_pages/register.php?seminar_id=$seminar</a>";
                        
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
                                <td>$link</td>
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
        &copy;&nbsp;<?php echo "2014".date("Y");?>&nbsp;SEMINAR<br />
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
