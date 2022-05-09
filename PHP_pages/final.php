<?php 
    session_start();
    $seminar = $_SESSION["seminar_id"];

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Thank you page</title>
    <link rel="stylesheet" type="text/css" href="http://www.computing.northampton.ac.uk/~13432616/CSY2028/project/css/Home.css" />
    <link rel="stylesheet" type="text/css" href="http://www.computing.northampton.ac.uk/~13432616/CSY2028/project/css/add.css" />
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
         <form>
		        <header><span class="thank">Thank You</span></header>
                <fieldset>
                        <p>In order to allowe people to register for you seminar please use the following link: </p><br />
                        <?php 
                            echo "<a href='http://www.computing.northampton.ac.uk/~13432616/CSY2028/project/PHP_pages/register.php?seminar_id=$seminar'>http://www.computing.northampton.ac.uk/~13432616/CSY2028/project/PHP_pages/register.php?seminar_id=$seminar</a>" ;
                        ?>
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