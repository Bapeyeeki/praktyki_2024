<?php

if(isset($_POST['submit'])) {

    $uid = $_POST['uid'];
    $pwd = $_POST['pwd'];
    $pwdrepeat = $_POST['pwdrepeat'];
    $email = $_POST['email'];

    //
    include "../classes/signup.class.php";
    include "../classes/signup-contr.class.php";
    $signup = new SingupContr($uid, $pwd, $pwdRepeat, $email)
}