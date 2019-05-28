<?php 
    //endast om sidan nås med POST
    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {        
        //inkludera databasmetoder och valideringsmetoder
        include('include/methods/db.php');
        include('include/methods/validation.php');

        $email = $_POST['email'];
        $username = $_POST['loginname'];
        $password = $_POST['password'];
        
        //regex för giltiga format på input
        $emailFormat = '/^[a-zA-Z]+[a-zA-Z0-9_.-]*@[a-zA-Z0-9-.]+\.[a-zA-Z.]{2,5}$/';
        $userFormat = '/^[a-zA-Z0-9_.-]{3,20}$/';
        $pwFormat = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/';

        //validera enligt 'include/methods/validation.php'
        if(validate($email, $emailFormat) && validate($username, $userFormat) && validate($password, $pwFormat)){
            
            //skapa salt från 'include/methods/validation.php'
            $salt=salt();

            //skapa hash med salt och lösenord
            $hash = password_hash($salt . $password, PASSWORD_DEFAULT);

            //registrera användare med 'include/methods/db.php'
            regUser($email, $username, $salt, $hash);
        }
    }
?>