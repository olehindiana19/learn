<?php
include('includes/db.php');
include('includes/functions.php');
for ($i=0; $i<=12; $i++) {
    $form[$i]="";
}
if (isset($_POST['go'])) {
    $form = getFormElements();
    $best = getBestPhone($_POST['best']);

    if (empty($form[13])) {
        $ContactItemIns = mysqli_query($link, "INSERT INTO `contacts`
	(last,	first,	email,	home, 	work,	cell,	address1, 	address2,	city,	state, 	zip , 	country,
	birthday, best_phone)	values ('$form[0]',   '$form[1]',  '$form[2]', '$form[3]', '$form[4]',
	'$form[5]', '$form[6]', '$form[7]', '$form[8]', '$form[9]', '$form[10]', '$form[11]',
	'$form[12]', '$best') ");
        ?>
        <script type="text/javascript">
            location.replace("index.php");
        </script>
    <?php
    } else {
             echo "Check your <b>" . $form[13]."</b>";
    }
}
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title></title>
    <link href="../css/style.css" rel="stylesheet" type="text/css"/>
</head>
<body id="index">
<div class="main" align="center">
    <h3> Registration </h3>

    <form action="registration.php" method="post" name="update">
        <table border="0">
            <tr>
                <td>Last*</td>
                <td></td>
                <td><input name="last" value="<?php echo $form[0]; ?>" type="text" size="150px" maxlength="30"/>
                </td>
            </tr>
            <tr>
                <td>First*</td>
                <td></td>
                <td><input name="first" value="<?php echo $form[1]; ?>" type="text" size="150px" maxlength="30"/>
                </td>
            </tr>
            <tr>
                <td>Email*</td>
                <td></td>
                <td><input name="email" value="<?php echo $form[2]; ?>" type="text" size="150px" maxlength="30"/>
                </td>
            </tr>
            <tr>
                <td>Home</td>
                <td><input name="best" type="radio"  value="home"  ></td>
                <td><input name="home" value="<?php echo $form[3]; ?>" type="text" size="150px" maxlength="30"/>
                </td>
            </tr>
            <tr>
                <td>Work</td>
                <td><input name="best" type="radio"  value="work"></td>
                <td><input name="work" value="<?php echo $form[4]; ?>" type="text" size="150px" maxlength="30"/></td>
            </tr>
            <tr>
                <td>Cell*</td>
                <td><input name="best" type="radio" value="cell" checked></td>
                <td><input name="cell" value="<?php echo $form[5]; ?>" type="text" size="150px" maxlength="30"/>
                </td>
            </tr>
            <tr>
                <td>Address 1</td>
                <td></td>
                <td><input name="address1" value="<?php echo $form[6]; ?>" type="text" size="150px"
                           maxlength="30"/></td>
            </tr>
            <tr>
                <td>Address 2</td>
                <td></td>
                <td><input name="address2" value="<?php echo $form[7]; ?>" type="text" size="150px"
                           maxlength="30"/></td>
            </tr>
            <tr>
                <td>City</td>
                <td></td>
                <td><input name="city" value="<?php echo $form[8]; ?>" type="text" size="150px" maxlength="30"/>
                </td>
            </tr>
            <tr>
                <td>State</td>
                <td></td>
                <td><input name="state" value="<?php echo $form[9]; ?>" type="text" size="150px" maxlength="30"/>
                </td>
            </tr>
            <tr>
                <td>Zip</td>
                <td></td>
                <td><input name="zip" value="<?php echo $form[10]; ?>" type="text" size="150px" maxlength="30"/></td>
            </tr>
            <tr>
                <td>Country</td>
                <td></td>
                <td><input name="country" value="<?php echo $form[11]; ?>" type="text" size="150px"
                           maxlength="30"/>
                </td>
            </tr>

            <tr>
                <td>Birthday</td>
                <td></td>
                <td><input name="birthday" value="<?php echo $form[12]; ?>" type="text" size="150px"
                           maxlength="30"/></td>
            </tr>
            <tr>
                <td colspan="2">
                <td align="right">
                    <input name="go" type="submit" value="Done"/>
                </td>
            </tr>
        </table>
    </form>
</div>


</body>
</html>