<?php
include('includes/db.php');
$id = $_GET['id'];
$ContactItemName = mysqli_query($link, "SELECT * FROM `contacts` WHERE id = '$id' ");
$row = mysqli_fetch_array($ContactItemName);
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset = windows-1251"/>
    <title>ADD MANAGMENT MAIN PAGE</title>
   <link href="css/style.css" rel="stylesheet" type="text/css"/>
</head>
<body id="index">
<div class="main">
    Are you shure you want to delete <b><?php echo $row['last'] . " " . $row['first']; ?></b>?
    <form method="post" name="delete">
        <input name="del" type="submit" value="Yes">
        <input name="no" type="submit" value="No">
        <input name="hid_id" type="hidden" value="<?php echo $id ?> "/>
    </form>
</div>
<?php
if (isset ($_POST['del'])) {
    $ContactItem = mysqli_query($link, "DELETE FROM `contacts` WHERE `id`='$id' ");
    ?>
    <script type="text/javascript">
        location.replace("index.php");
    </script>
<?php
} elseif (isset ($_POST['no'])) {
?>
    <script type="text/javascript">
        location.replace("index.php");
    </script>
<?php
}
?>
</div>
</body>
</html>