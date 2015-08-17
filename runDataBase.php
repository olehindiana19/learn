<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1251"/>
    <title>my_database</title>
    <link href="style.css" rel="stylesheet" type="text/css"/>
</head>
<body>

<?php

$host = "localhost";
$user = "root";
$pass = "";

$link = mysqli_connect($host, $user, $pass)
or die("Cannot connect to localhost");

if (mysqli_query($link, "CREATE DATABASE contact"))

    mysqli_select_db($link, "contact");

mysqli_query($link, " CREATE TABLE `users`
(`id` INT(2) NOT NULL AUTO_INCREMENT, `login` VARCHAR( 50 ), `pass` VARCHAR( 50 ), `rule` VARCHAR( 15 ), PRIMARY KEY(`id`)

 ) ");

$pass=md5('admin');
mysqli_query($link, "INSERT INTO `users` ( `login`, `pass`, `rule` ) values ('admin', '$pass', '1') ");
echo "<p>Created user with login <b>admin</b> and password <b>admin</b><p>";



mysqli_query($link, "CREATE TABLE `contacts` (`id` INT(2) NOT NULL AUTO_INCREMENT, `last` VARCHAR( 50 ),
`first` VARCHAR( 50 ), `email` VARCHAR( 50 ), `home` INT( 50 ), `work` INT( 50 ), `cell` INT( 50 ),
`address1` VARCHAR( 50 ), `address2` VARCHAR( 50 ), `city` VARCHAR( 50 ), `state` VARCHAR( 50 ), `zip` INT( 50 ),
`country` VARCHAR( 50 ), `birthday` INT( 50 ), `best_phone` VARCHAR ( 50 ), PRIMARY KEY(`id`) ) ");




mysqli_query($link, "INSERT INTO `contacts` ( `last`, `first`, `email`, `home`, `work`, `cell`, `best_phone` )
values ('Jones', 'Indiana', 'indi@gmail.com', '04512135', '4889778979', '4812231',  'cell' ) ");

mysqli_query($link, "INSERT INTO `contacts` ( `last`, `first`, `email`, `home`, `work`, `cell`, `best_phone` )
values ('Vader', 'Darth', 'evil@gmail.com', '666666', '777', '777', 'cell') ");

mysqli_query($link, "INSERT INTO `contacts` ( `last`, `first`, `email`, `home`, `work`, `cell`, `best_phone` )
values ('Rebmo', 'John', 'rembo@gmail.com', '555', '444', '3333', 'cell') ");

mysqli_query($link, "INSERT INTO `contacts` ( `last`, `first`, `email`, `home`, `work`, `cell`, `best_phone` )
values ('Mcclane', 'John', 'diehard@gmail.com', '4564', '7897', '2315', 'cell') ");

            echo "Was added some contacts<br>";

mysqli_close($link);
?>

<a href="index.php"> Go to Login page </a>


</body>
</html>
