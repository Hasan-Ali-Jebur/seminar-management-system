
<?php
    require_once("connection.php");
    session_start();
    if ($_SESSION["stop"] == 0) {
       header("location: http://www.computing.northampton.ac.uk/~13432616/CSY2028/project/PHP_pages/signIn.php");
    }
    $title = $_SESSION["title"];
    $sname = $_SESSION["sname"];
    $att = $_SESSION["att"];
    $desc = $_SESSION["desc"];
    $date = $_SESSION["date"];
    $stime = $_SESSION["stime"];
    $etime = $_SESSION["etime"];
    $room = $_SESSION["room"];
    $orglast_id = $_SESSION["organiser_id"] ;
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
         <form action="" method="post" class="conf">
		        <header><span>Create Seminar</span></header>
                <fieldset>
                    <legend>Step 3 : Confirmation</legend>
                    <table id="t01">
                        <h3>Your seminar Details is :</h3>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Speakers Names</th>
                            <th>Number of attendence</th>
                            <th>Date</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Room Number</th>
                        </tr>
                        <?php
                        echo "
                            <tr>
                                <td>$title</td>
                                <td>$desc</td>
                                <td>$sname</td>
                                <td>$att</td>
                                <td>$date</td>
                                <td>$stime</td>
                                <td>$etime</td>
                                <td>$room</td>
                            </tr>";
                        ?>
                    </table>
                </fieldset>
                <footer>
                        <input type="submit" name="confirm" class="button"value="Confirm"/>
		        </footer>
            </form>
    <?php
		// Check if the form has been submitted
        if (isset($_POST["confirm"])) {
		
		// Querying the database to insert the seminar details
            mysql_query("insert into seminar values('','$title','$desc','$date','$stime','$etime','$sname',$room,$orglast_id)",$connect);
        
		// obtain the id of the inserted seminar
			$q20 = mysql_query("select max(seminar_id) from seminar",$connect);
            while($arrsend = mysql_fetch_array($q20)) {
		
		// register the seminar id in session and then redirect to final.php
                $_SESSION["seminar_id"] =  $arrsend["max(seminar_id)"];
            }
        
            unset($_SESSION["stop"]);
            header("location: http://www.computing.northampton.ac.uk/~13432616/CSY2028/project/PHP_pages/final.php");
        
        }
    

    ?>           
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

