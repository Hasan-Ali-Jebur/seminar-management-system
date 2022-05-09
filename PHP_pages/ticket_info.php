<?php 
    session_start();
    require_once("connection.php");
	// Obtain the ticket number and the seminar id 
    $ticket_num = $_SESSION["ticket_num"];
    $seminar = $_SESSION["seminar_id"];
	
	// querying the database to get the seminar details
    $q1 = mysql_query("select * from seminar where seminar_id=$seminar",$connect);
    while($arrseminarinfo = mysql_fetch_array($q1)) {
        $title= $arrseminarinfo["title"]; 
        $date =$arrseminarinfo["seminar_date"];
        $stime =$arrseminarinfo["startTime"];
        $room =$arrseminarinfo["room_id"];
    }
	// querying the database to get the ticket information
    $q2 = mysql_query("select * from registration where ticket_num=$ticket_num",$connect);
    while($arrticketinfo = mysql_fetch_array($q2)) {
        $fname= $arrticketinfo["first_name"]; 
        $lname =$arrticketinfo["last_name"];
        $email=$arrticketinfo["email"];
    }

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title></title>
    <link rel="stylesheet" href="http://www.computing.northampton.ac.uk/~13432616/CSY2028/project/css/sign up.css"/>
    <link rel="stylesheet" href="http://www.computing.northampton.ac.uk/~13432616/CSY2028/project/css/Home.css"/>
    <style type="text/css">
        .mainti {
            display:block;
            width:700px;
            border: 1px solid rgba(0,0,0,.1);
            background-color: rgba(0, 3, 79, 0.1);
            margin-left:auto;
            margin-right:auto;
            border-radius:3px;
            padding:20px;
            box-shadow: 0 0 20px rgba(0,0,0,.3);
            
        }
        .titleti {
            width:100%;
            display:block;	
	        border-bottom: 3px solid #8b1919;
            color:#8b1919;
            margin-bottom:20px;
            font-size:24px;

        }
        .order {
            width:100%;
            height:270px;
            display:block;
            border-bottom: 1px solid rgba(0,0,0,.1);
            font-size:14px;
        }
        .tit1
        {
            line-height: 1.5;
            float:left;
            display:block;
            height:110px;
            width: 16%;
            font-weight:bold;
        }

        .tit2 {
            line-height: 1.5;
            float:left;
            display:block;
            height:110px;
            width:80%;
        }

        .tit3
        {
            line-height: 1.5;
            float:left;
            display:block;
            height:85px;
            width: 16%;
            font-weight:bold;
            border:1px solid black;
            border-right:none;
            
        }

        .tit4 {
            line-height: 1.5;
            float:left;
            display:block;
            height:85px;
            width:80%;
            border:1px solid black;
            border-left:none;
            margin-bottom:20px;
        }

        i {
            font-size:18px;
        }

        .f {
            font-size:12px;
            color:gray;
        }



    </style>
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
    <div class="mainti">
        <div class="titleti">
            Ticket Report 
        </div>
        <div class="order">
            <span class="tit1">Ticket NO:<br />First Name:<br />Last Name:<br />E-Mail:</span>
            <span class="tit2"><?php echo $ticket_num;?><br /><?php echo $fname;?><br /><?php echo $lname ;?><br /><?php echo $email ;?><br /></span>
            <span class="tit3">Seminar Title:<br />Date:<br />Time:<br />Room:</span>
            <span class="tit4"><?php echo $title;?><br /><?php echo $date;?><br /><?php echo $stime ;?><br /><?php echo $room ;?><br /></span>
            
			<!-- JavaScript code to print the ticket-->
			<button class="print" onclick="myFunction()">Print</button>
            <script>
                function myFunction() {
                window.print();
                }
            </script>
        </div>
        <div class="foot">
            <p>You may need to cancel an order,in this case please use the following link:</p>
            <a href="http://www.computing.northampton.ac.uk/~13432616/CSY2028/project/PHP_pages/withdraw.php" style="color:blue; text-decoration:underline;">withdraw.php</a>
        </div>
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
            <img src="http://www.computing.northampton.ac.uk/~13432616/CSY2028/project/PHP_pages/images/call.png"/><span>&nbsp;&nbsp;+44 7999299105&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <img src="http://www.computing.northampton.ac.uk/~13432616/CSY2028/project/PHP_pages/images/email.png" /><span>&nbsp;&nbsp;hassn.ali1212@yahoo.com</span>
        </div>
    </div>
</body>
</html>