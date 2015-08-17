<?php
session_start();
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: login.php");
}
if ($_SESSION['status'] == 'login') {
include('includes/db.php');
include('includes/functions.php');
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset = windows-1251"/>
    <title>SELECTION MAIN PAGE</title>
    <link href="css/style.css" rel="stylesheet" type="text/css"/>
</head>
<body id="index">
<?php
$ContactItem = mysqli_query($link, "SELECT * FROM `contacts` ");
$count = mysqli_query($link, "SELECT MAX(id) FROM `contacts` ");
$count = mysqli_fetch_array($count);
$count = $count[0];



//pagination---------------------------------------------
$select = mysqli_query($link, "SELECT * FROM `contacts` ");
$itemCount = 3;
$rowCount = mysqli_num_rows($select);
$pagesCount = $rowCount / $itemCount;
if ($rowCount % $itemCount > 0) {
    $pagesCount=$pagesCount+1;
}
$page=0;
for ($i = 1; $i <= $pagesCount; $i++) {
    ?>
    <a href=selection.php?page=<?php echo $i ?> ><?php echo $i ?>  </a>
<?php
}
if (isset($_GET['page'])) {
    if (!isset($_SESSION['field'])) {
        $_SESSION['field']="last";
        $_SESSION['order']="asc";
    }
    $field = $_SESSION['field'];
    $order =  $_SESSION['order'];
    $page = $_GET['page'];
    $page = $page * $itemCount - $itemCount;
    $ContactItem = getOrderPage ($link, $field, $order, $page, $itemCount);
}
else {
    $ContactItem = mysqli_query($link, "SELECT * FROM `contacts` LIMIT 0, $itemCount ");
}
//pagination---------------------------------------------

//get ordering---------------------------------------------
if (isset($_GET['field']) and isset($_GET['order']) ) {
    $field=$_GET['field'];
    $order=$_GET['order'];
    $_SESSION['field']=$field;
    $_SESSION['order']=$order;
    $ContactItem = getOrderPage ($link, $field, $order, $page, $itemCount);
}

//get ordering---------------------------------------------







?>
<div class="main">
    <form action="mail.php" method="post">
        <p><strong> SELECTION MAIN PAGE</strong></p>
        <p><input type="submit" value="SEND"></p>
        <table width="100%" id="mytable" class="tabl" border="0">
            <tr>
                <td align="left">
                    <input type="checkbox" name='sel_all'
                           onChange='for (i in this.form.elements) this.form.elements[i].checked = this.checked'/>All
                </td>
                <td onclick="sort(this)"><b>Last</b></td>
                <td onclick="sort(this)"><b>First</b></a></td>
                <td>Email</td>
                <td>Best Phone</td>
            </tr>
            <?php
            while (($row = mysqli_fetch_array($ContactItem)) ) {
                switch ($row['best_phone']) {
                    case "home":
                        $best = $row['home'];
                        break;
                    case "work":
                        $best = $row['work'];
                        break;
                    case "cell":
                        $best = $row['cell'];
                        break;
                }
                echo "<tr><td align=left>";
                echo "<input id=\"item\" type=\"checkbox\" name=\"$row[id]\" value=\"$row[id]\"  /></td><td>";
                echo $row['last'] . "</td><td>";
                echo $row['first'] . "</td><td>";
                echo $row['email'] . "</td><td>";
                echo $best . "</td></tr>";
                echo "<input name=\"hid_id\" type=\"hidden\" value=\"$count \" />";
            }
            ?>
        </table>
        <p><input type="submit" value="SEND"></p>
    </form>
    <p><a class="goto" href="index.php">GO TO MANAGMENT MAIN PAGE</a></p>
    <form action="selection.php" method="post">
        <input name="logout" type="submit" value="logout">
    </form>
</div>
<?php
}
else {
    header("Location: login.php");
}
?>
</body>
</html>





