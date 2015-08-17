<?php
include('includes/db.php');
include('includes/functions.php');
$login="";
if (isset($_POST['go'])) {

if(checkField($_POST['login'], $_POST['pass'] ) ) {

    if (getUser ($link, $_POST['login'], $_POST['pass'] )) {
        session_start();
        $_SESSION['status'] = 'login';
        header("Location: index.php");
    }
    else {
        echo "Wrong login or password";
        $login=$_POST['login'];

    }
}
    else {
        echo "Empty fields";

    }

}
?>
    <html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=windows-1251"/>
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <title>Contact manager Login</title>
    </head>
    <body>
    <form action="login.php" method="post">
        <table class="login">
            <tr valign=center>
                <td align="center">
                    <table width="300" class="logintabl" border="0">
                        <tr>
                            <td align="right">Login</td>
                            <td><input name="login" value="<?php echo $login ?>"  type="text" size="30" maxlength="50"/></td>
                        </tr>
                        <tr>
                            <td align="right">Password</td>
                            <td><input name="pass" type="password" size="30" maxlength="50"/></td>
                        </tr>
                        <tr>
                            <td><a href="registration.php">Register</a></td>
                            <td align="right"><input name="go" type="submit" value="SIGN IN"/></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </form>
    </body>
    </html>
