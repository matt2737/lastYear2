<?php
/**
 *@author John Powers <powers96@students.rowan.edu>
 *Login page for the site.
 */
session_start();
ob_start();
include_once("Gatherer.php");

$error = False;
$isLoggedIn = False;

if(isset($_SESSION['id'])){
    header('Location: summary.php');
    $isLoggedIn = True;
}
if(isset($_POST['username']) && isset($_POST['password'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $gatherer = new Gatherer();
    $result = $gatherer->login($username, $password);
    if($result){
        $_SESSION['id'] = $result[id];
        $isLoggedIn = True;
        header('Location: summary.php');
    }
    else{
        $error = True;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel=styleSheet href="css/bootstrap.min.css" type="text/css" />
        <link rel=styleSheet href="css/site.css" type="text/css" /> 
    </head>
    <body>
        <div class="container-fluid">
            <div class="navbar">
                <div class="navbar-inner">
                    <a class="brand" href="#">NuVista</a>
                    <ul class="nav">
                        <li><a href="#">Health Summary</a></li>
                        <li><a href="#">Demographics</a></li>
                        <li><a href="#">Progress Notes</a></li>
                        <?php if($isLoggedIn): ?>
                        <li><a href="logout.php">Log Out</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span3"></div>
                <div class="span6">
                    <div class="login">
                        <h1>Login</h1><br>
                        <form action="Login.php" method="post">
                            <fieldset>
                                <input type="text" placeholder="Username" name="username"><br>
                                <input type="password" placeholder="Password" name="password"><br>
                                <?php if($error): ?>
                                <div class="alert alert-error">
                                    Invalid username and password
                                </div>
                                <?php endif; ?>
                                <button type="submit" class="btn login">Log In</button><br>
                                <a href="Register.php">Click here to register an account</a>
                            </fieldset>
                        </form>
                    </div>
                </div>
                <div class="span3"></div>
            </div>
        </div>
    </body>
</html>