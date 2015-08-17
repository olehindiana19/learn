<?php
session_start();
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: login.php");
}
if ($_SESSION['status'] == 'login') {
include('includes/db.php');
include('includes/functions.php');
$id = $_GET['id'];
$ContactItem = mysqli_query($link, "SELECT * FROM `contacts` WHERE id = '$id' ");
$row = mysqli_fetch_array($ContactItem);
/*check best phone */
$best = $row['best_phone'];
$home = "home";
$work = "work";
$cell = "cell";
switch ($best) {
    case $home:
        $home = "checked";
        break;
    case $work:
        $work = "checked";
        break;
    case $cell:
        $cell = "checked";
        break;
}
/*check best phone */
if (isset($_POST['go'])) {
    $id = $_POST['hid_id'];
    $form = getFormElements();
    $best = getBestPhone($_POST['best'], $form['3'], $form['4'], $form['5']);
    $ContactItemUpd = mysqli_query($link, "UPDATE `contacts` SET last='$form[0]',  first='$form[1]', email='$form[2]',
home='$form[3]', work='$form[4]', cell='$form[5]', address1='$form[6]', address2='$form[7]',
city='$form[8]', state='$form[9]', zip = '$form[10]', country='$form[11]', birthday='$form[12]',
best_phone='$best' WHERE id='$id' ");
    ?>
    <script type="text/javascript">
        location.replace("index.php");
    </script>
<?php
}
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title></title>
    <link href="css/style.css" rel="stylesheet" type="text/css"/>
</head>
<body id="index">
<div align="center" class="main">
    <h3>Contact details</h3>

    <form action="update.php" method="post" name="update">
        <table border="0">
            <tr>
                <td>Last</td>
                <td></td>
                <td><input name="last" value="<?php echo $row['last']; ?>" type="text" size="150px" maxlength="30"/>
                </td>
            </tr>
            <tr>
                <td>First</td>
                <td></td>
                <td><input name="first" value="<?php echo $row['first']; ?>" type="text" size="150px" maxlength="30"/>
                </td>
            </tr>
            <tr>
                <td>Email</td>
                <td></td>
                <td><input name="email" value="<?php echo $row['email']; ?>" type="text" size="150px" maxlength="30"/>
                </td>
            </tr>
            <tr>
                <td>Home</td>
                <td><input name="best" type="radio" <?php echo $home ?>  value="home"></td>
                <td><input name="home" value="<?php echo $row['home']; ?>" type="text" size="150px" maxlength="30"/>
                </td>
            </tr>
            <tr>
                <td>Work</td>
                <td><input name="best" type="radio" <?php echo $work ?>  value="work"></td>
                <td><input name="work" value="<?php echo $row['work']; ?>" type="text" size="150px" maxlength="30"/></td>

            </tr>
            <tr>
                <td>Cell</td>
                <td><input name="best" type="radio" <?php echo $cell ?> value="cell"></td>
                <td><input name="cell" value="<?php echo $row['cell']; ?>" type="text" size="150px" maxlength="30"/>
                </td>
            </tr>
            <tr>
                <td>Address 1</td>
                <td></td>
                <td><input name="address1" value="<?php echo $row['address1']; ?>" type="text" size="150px"
                           maxlength="30"/></td>
            </tr>
            <tr>
                <td>Address 2</td>
                <td></td>
                <td><input name="address2" value="<?php echo $row['address2']; ?>" type="text" size="150px"
                           maxlength="30"/></td>
            </tr>
            <tr>
                <td>City</td>
                <td></td>
                <td><input name="city" value="<?php echo $row['city']; ?>" type="text" size="150px" maxlength="30"/>
                </td>
            </tr>
            <tr>
                <td>State</td>
                <td></td>
                <td><input name="state" value="<?php echo $row['state']; ?>" type="text" size="150px" maxlength="30"/>
                </td>
            </tr>
            <tr>
                <td>Zip</td>
                <td></td>
                <td><input name="zip" value="<?php echo $row['zip']; ?>" type="text" size="150px" maxlength="30"/></td>
            </tr>
            <tr>
                <td>Country</td>
                <td></td>
                <td><input name="country" value="<?php echo $row['country']; ?>" type="text" size="150px"
                           maxlength="30"/>
                </td>
            </tr>
            <tr>
                <td>Birthday</td>
                <td></td>
                <td><input name="birthday" value="<?php echo $row['birthday']; ?>" type="text" size="150px"
                           maxlength="30"/></td>
            </tr>
            <input name="hid_id" type="hidden" value="<?php echo $id ?> "/>
            <tr>
                <td>
                    <a class="goto" href="index.php">GO TO MANAGMENT MAIN PAGE</a>
                </td>
                <td></td>
                <td align="right">
                    <input name="go" type="submit" value="Done"/>
                </td>
            </tr>
        </table>
    </form>
    <?php
    }
    else {
        header("Location: login.php");
    }
    ?>
</div>
</body>
</html>