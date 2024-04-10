<?php

class SignupContr {

    private $uid;
    private $pwd;
    private $pwdR;


    public function __construct($uid, $pwd, $pwdR) {
        $this->uid = $uid;
        $this->pwd = $pwd;
        $this->pwdR = $pwdR;
    }

    private function signupUser() {
        if($this->emptyInput() == false) {
            header("location index.php?error=emptyinput")
            exit();
        }
        if($this->invalidUid() == false) {
            header("location index.php?error=emptyinput")
            exit();
        }
        if($this->pwdMatch() == false) {
            header("location index.php?error=emptyinput")
            exit();
        }

        $this->setUser();
    }

    private function emptyInput() {
        $result;
        if(empty($this->uid) || empty($this->pwd ) || empty($this->pwdR)) {
            $result = false;
        } else {
            $result = true;
        }

        return $result;
    }

    private function invalidUid() {
        if(!preg_match("/^[a-zA-Z0-9]*$/"), $this->uid) {

            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function pwdMatch() {
        $result;
        if($this->pwd != $this->pwdR) {
            $result = false;
        } else {
            $result = true;
        }

        return $result;
    }

    private function pwdMatch() {
        $result;
        if($this->checkUser($this->$uid)) {
            $result = false;
        } else {
            $result = true;
        }

        return $result;
    }
}