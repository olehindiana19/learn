<?php

function fieldEmpty($field)
{
    return (empty($field)) ? TRUE : FALSE;
}

function checkField($login, $pass)
{
    if (fieldEmpty($login) or fieldEmpty($pass)) {
        return FALSE;
    } else {

        return TRUE;
    }
}

function getUser($link, $login, $pass)
{
    $login = htmlspecialchars(trim($login));
    $pass = htmlspecialchars(trim($pass));
    $pass=md5($pass);
    $user = mysqli_query($link, "SELECT * FROM `users` WHERE `login`='$login'
and `pass` = '$pass' and `rule` = '1' ");
    if (mysqli_num_rows($user) > 0) {
        return TRUE;

    } else {
        return FALSE;
    }
}

function formElements()
{
    $form = array('last', 'first', 'email', 'home', 'work', 'cell', 'address1',
        'address2', 'city', 'state', 'zip', 'country', 'birthday');
    return $form;
}


function getFormElements()
{
    $form = formElements();
    foreach ($form as $value) {
        $newform[] = htmlspecialchars(trim($_POST[$value]));
    }
    /*
    for ($i = 0; $i <= 12; $i++) {
        $newform[$i] = htmlspecialchars(trim($_POST[$form[$i]]));
    }
    */

    if (!checkMail($_POST['email'])){
        $formErrors="email";
    }

    if (!checkPhone($_POST['cell'])){
        $formErrors="cell";
    }

    if (!checkName($_POST['last'], $_POST['first'])){
        $formErrors="last or first";
    }
   array_push($newform, $formErrors);
    return $newform;
}

function checkMail($mail)
{
    if (fieldEmpty($mail)) {
        return FALSE;
    } else {
        $template = "/^\w+([\.\w]+)*\w@\w((\.\w)*\w+)*\.\w{2,3}$/";
        if (!(preg_match($template, $mail))) {
            return FALSE;
        }
        else {
            return TRUE;
        }
    }

}

function checkPhone($cell)
{
    if (fieldEmpty($cell)) {
        return FALSE;
    } else {
        if (!is_numeric($cell)) {
            return FALSE;
        }
        else {
            return TRUE;
        }
    }
}

function getBestPhone($id)
{
    switch ($id) {
        case "home":
            $best = "home";
            break;
        case "work":
            $best = "work";
            break;
        case "cell":
            $best = "cell";
            break;
    }
    return $best;
}

function checkName($name, $last)
{
    if (fieldEmpty($name) or fieldEmpty($last) ) {
        return FALSE;
    }
    else {
        if (is_numeric($name) or is_numeric($last)) {
            return FALSE;
        }
        else {
            return TRUE;
        }
    }
}


function getOrder($link, $field, $order)
{
    $ContactItem = mysqli_query($link, "SELECT * FROM `contacts` ORDER BY $field $order ");
    return $ContactItem;

}

function getOrderPage ($link, $field, $order, $page, $itemCount) {
    $ContactItem = mysqli_query($link, "SELECT * FROM `contacts` ORDER BY $field $order LIMIT $page, $itemCount ");
    return $ContactItem;
}