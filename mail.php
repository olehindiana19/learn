<?php
include('includes/db.php');
include('includes/functions.php');
?>
<html>
<head>
    <link href="css/style.css" rel="stylesheet" type="text/css"/>
</head>
<body id="index">
<div class="main">
    <?php
    if (isset ($_POST['add'])) {
        $count = $_POST['count'];
        for ($i = 1; $i <= $count; $i++) {
            if (!empty($_POST["$i"])) {
                echo $id = $_POST["$i"];
                $ContactItem = mysqli_query($link, "INSERT INTO `contacts` ( `email` ) values ('$id') ");
            }
        }
        ?>
        <script type="text/javascript">
            location.replace("index.php");
        </script>
    <?php
    }
    if (isset ($_POST['sent'])) {
        $goto = $_POST['goto'];
        $title = $_POST['title'];
        $message = $_POST['message'];
        $headers = "Invite.com";
        $real_adreses = explode(",", $goto);
        $mails = $_POST['start_adreses'];
        $start_adreses = explode(",", $mails);
        foreach ($real_adreses as $value) {
            mail($value, $title, $message, $headers);
        }
        $diff = array_diff($real_adreses, $start_adreses);
        if (!empty($diff)) {
            $count = count($diff);
            $i = 1;
            ?>
            <div class="main">
                <p>This addresses is not in your contact manager!</p>

                <p> Chek if you want to add some </p>

                <form action="mail.php" method="post">
                    <?php
                    foreach ($diff as $value) {
                        echo "<input type=\"checkbox\" name=\"$i\" value=\"$value\"  />" . $value . "<br>";
                        $i++;
                    }
                    ?>
                    <input type="hidden" name="count" value="<?php echo $count ?>"/>
                    <input name="add" value="Add" type="submit">
                </form>
            </div>
        <?php
        }
        else {
        echo "<h3 align=\"center\">Sent seccsesfully</h3>";
        ?>
            <script language='javascript'>
                var delay = 1800;
                setTimeout("document.location.href='index.php'", delay);
            </script>
        <?php
        }
    }
    else {
    $count = $_POST['hid_id'];
    for ($i = 1; $i <= $count; $i++) {
        if (!empty($_POST["$i"])) {
            $id = $_POST["$i"];
            $ContactItem = mysqli_query($link, "SELECT email FROM `contacts` where id=$id ");
            $mail = mysqli_fetch_array($ContactItem);
            $goto[] = $mail[0];
        }
    }
    $mails = implode(",", $goto);
    ?>
    <h3> Send Invitation </h3>

    <form action="mail.php" method="post" name="send_mail">
        <table width="200" border="0">
            <tr>
                <td align="right">Recivers</td>
                <td><input type="text" name="goto" size="100" value="<?php echo $mails ?>"/></td>
            </tr>
            <tr>
                <td align="right">Title</td>
                <td><input name="title" type="text" size="100"/></td>
            </tr>
            <tr>
                <td align="right">Message</td>
                <td><textarea name="message" cols="102" rows="15"></textarea></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td align="right"><input name="sent" type="submit" value="Send mail"/></td>
            </tr>
        </table>
        <a class="goto" href="index.php">GO TO MANAGMENT MAIN PAGE</a>
        <input type="hidden" name="start_adreses" value="<?php echo $mails ?>"/>
    </form>

</div>
<?php
}
?>
</body>
</html>