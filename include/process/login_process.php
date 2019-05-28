<?php
    $password = "";
    $email = "";

    //om email och lösenord har skickats
    if(isset($_POST['email'], $_POST['password']))
    {
        //inkludera databasmetoder
        include('include/methods/db.php');
        //inkludera valideringsmetoder
        include('include/methods/validation.php');

        $email = $_POST['email'];
        $password = $_POST['password'];
        
        //regex för giltigt emailformat
        $emailFormat = '/^[a-zA-Z]+[a-zA-Z0-9_.-]*@[a-zA-Z0-9-.]+\.[a-zA-Z.]{2,5}$/';
        
        //regex för giltigt lösenord
        $pwFormat = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/';

        //validering från 'include/methods/validation.php'
        if(validate($email, $emailFormat) && validate($password, $pwFormat)){
            //login från 'include/methods/db.php'
            login($email, $password);
        }
    }
?>
