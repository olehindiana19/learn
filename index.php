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
    <title>ADD MANAGMENT MAIN PAGE</title>
    <link href="css/style.css" rel="stylesheet" type="text/css"/>
</head>
<body id="index">
<?php
//pagination---------------------------------------------
$select = mysqli_query($link, "SELECT * FROM `contacts` ");
$itemCount = itemCount;
$rowCount = mysqli_num_rows($select);
$pagesCount = $rowCount / $itemCount;
if ($rowCount % $itemCount > 0) {
    $pagesCount=$pagesCount+1;
}
$page=0;
for ($i = 1; $i <= $pagesCount; $i++) {
    ?>
    <a href=index.php?page=<?php echo $i ?> ><?php echo $i ?>  </a>
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
    <h3>ADD MANAGMENT MAIN PAGE</h3>

    <p><a class="add" href="registration.php">ADD</a></p>
    <table width="100%" id="mytable" class="tabl" border="0">
        <tr>
            <td><b>Last</b> <a href="index.php?field=last&order=ASC"><b>&darr;</b></a> <a
                    href="index.php?field=last&order=DESC"><b>&UpArrow;</b></a></td>
            <td><b>First</b><a href="index.php?field=first&order=ASC"><b>&darr;</b></a> <a
                    href="index.php?field=first&order=DESC"><b>&UpArrow;</b></a></td>
            <td>Email</td>
            <td>Best Phone</td>
            <td>Edit/view</td>
            <td>Delete</td>
        </tr>
        <?php


        while ($row = mysqli_fetch_array($ContactItem)) {

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
            ?>
            <tr>
                <td> <?php echo $row['last'] ?> </td>
                <td> <?php echo $row['first'] ?> </td>
                <td> <?php echo $row['email'] ?></td>
                <td> <?php echo $best ?></td>
                <td><a href=update.php?id=<?php echo $row['id'] ?> > edit/view </a></td>
                <td><a href=delete.php?id=<?php echo $row['id'] ?> > delete </a></td>
            </tr>
        <?php
        }

        ?>
    </table>
    <p><a class="add" href="registration.php">ADD</a></p>

    <p><a class="goto" href="selection.php">GO TO SELECTION MAIN PAGE</a></p>

    <form action="index.php" method="post">
        <input name="logout" type="submit" value="Log out">
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