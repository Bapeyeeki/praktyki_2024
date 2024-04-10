<?php

class Signup extends Database{

    protected function checkUser($uid) {

        $stmt = $this->connect()->prepare("SELECT login_u FROM user WHERE login_u = ?;");

        if($stmt->exectue(array($uid))) {  
            $stmt = null;
            header("location index.php?error=stmtfailed");
            exit();
        }

        $resultCheck;
        if($stmt->rowCount() > 0) {

            $resultCheck = false;

        } else {
            
            $resultCheck = true;

        }
        return $resultCheck;
    }

}