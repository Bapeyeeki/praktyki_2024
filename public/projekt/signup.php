<?php
if(isset($_POST['sumbit'])) {

    $uid = $_POST['uid'];
    $pwd = $_POST['pwd'];
    $pwdR = $_POST['pwdR'];

    // include
    include "singup-contr.php";
    include "singup-class.php";

    // Signup control
    $signup = new SignupContr($uid,$pwd,$pwdR) 

    
}



