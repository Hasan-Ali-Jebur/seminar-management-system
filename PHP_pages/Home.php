<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Home Page</title>
    <link rel="stylesheet" type="text/css" href="http://www.computing.northampton.ac.uk/~13432616/CSY2028/project/css/Home.css" />
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
    
    <div class="main">
        <div class="picture"></div>
        <div class="cont_all">
            <div class="cont1">
                <img src="http://www.computing.northampton.ac.uk/~13432616/CSY2028/project/images/add.png"/>
                <a href="http://www.computing.northampton.ac.uk/~13432616/CSY2028/project/PHP_pages/signIn.php" class="padd">Create your seminar</a>
                <p>Our center offers the possibility of creating and managing seminars. Add your seminar and get a link through a few simple steps. join millions of organizers now and see how easy your job will be. Join now</p>
            </div>
            <div class="cont2">
                <img src="http://www.computing.northampton.ac.uk/~13432616/CSY2028/project/images/view.png"/>
                <a href="http://www.computing.northampton.ac.uk/~13432616/CSY2028/project/PHP_pages/signIn1.php" class="pview">Organiser overview</a>
                <p>You can see alot of details about the seminar that you created by clicking on this very simple tool. Use the username and password that you got. Only the organiser is allowed to use this tool.</p>
            </div>
            <div class="cont3">
                <img src="http://www.computing.northampton.ac.uk/~13432616/CSY2028/project/images/manager.png"/>
                <a href="http://www.computing.northampton.ac.uk/~13432616/CSY2028/project/PHP_pages/signInmanager.php" class="pview">Manager overview</a>
                <p>We provided this tool specially for the conference manager. With this tool the manager can have a complete look for all seminars. Only the manager is allowed to use this tool.</p>
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
            <img src="http://www.computing.northampton.ac.uk/~13432616/CSY2028/project/images/call.png"/><span>&nbsp;&nbsp;+44 7999299105&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <img src="http://www.computing.northampton.ac.uk/~13432616/CSY2028/project/images/email.png" /><span>&nbsp;&nbsp;hassn.ali1212@yahoo.com</span>
        </div>
    </div>
</body>
</html>