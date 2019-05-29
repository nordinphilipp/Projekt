<?php
    //Loggar in användaren med email och lösenord
    function login($email, $password){
        
        //connect to db
        //använder variabeln $connection
        include('include/process/connect_process.php');
        
        $email = mysqli_real_escape_string($connection, $_POST['email']);
        $password = mysqli_real_escape_string($connection, $_POST['password']);
        
        //hämta raden med korrekt email
        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = $connection->query($sql);

        //skapa associativ array av resultatet
        $row = $result->fetch_assoc();

        //hämta hash och salt
        $hashedPw = $row['pwhash'];
        $salt = $row['salt'];

        //verifiera lösenord
        if(password_verify($salt . $password, $hashedPw))
        {
            //spara sessionsvariabler
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $row['username'];
            $_SESSION['userID'] = $row['userID'];
            $_SESSION['img'] = $row['img'];

            $connection->close();
            header("Location: index.php"); //Redirect till index           
        }
        else
        {
            $connection->close();
            echo "Wrong password or username";
        } 
    } 

    //registrerar användare med email, användarnamn, salt och hash
    function regUser($email, $username, $salt, $hash){
        //kolla om användarnamn eller email redan finns i db
        if(checkUser($username, $email)){
            //connect to db
            include('include/process/connect_process.php');

            $username = mysqli_real_escape_string($connection, $username);
            $email = mysqli_real_escape_string($connection, $email);
            $salt = mysqli_real_escape_string($connection, $salt);
            $hash = mysqli_real_escape_string($connection, $hash);
            
            $sql = "INSERT INTO users(username, email, salt, pwhash) VALUES ('$username', '$email','$salt', '$hash')";

            if(mysqli_query($connection, $sql))
            {
                $connection->close();
                header('location: login.php');
            } else {
                $connection->close();
                echo "Insertion error";
            } 
        }        
    }

    function checkUser($username, $email){
        //connect to db
        include('include/process/connect_process.php');

        $username = mysqli_real_escape_string($connection, $username);
        $email = mysqli_real_escape_string($connection, $email);

        //hämta alla rader där username eller email finns i db
        $sql = "SELECT username, email FROM users WHERE (username = '$username' OR email = '$email')";

        $result=$connection->query($sql);
        if(!$result){
            trigger_error('invalid query: ' . $connection->error);
        }
        //return true om email och username inte finns
        if($result->num_rows == 0){
            $connection->close();
            return true;
        }else{
            $connection->close();
            echo 'User already exists';
            return false;
        }
    }

    function fetchUser($userID){
        //connect to db
        include('include/process/connect_process.php');
        
        //fetch relevant data
        $query = "SELECT username, email, img FROM users WHERE userID = '$userID'";
        $result = $connection->query($query);
        if($connection->query($query) !== FALSE) {
            $connection->close();
            //return associative array with query result
            return mysqli_fetch_assoc($result);
        }else{
            echo "Error: " . $query . "<br>" . $connection->error;
            $connection->close();
        }
    }

    function changeUserImg($dir){

        include('include/process/connect_process.php');

        $username = mysqli_real_escape_string($connection, $_SESSION['username']);
        $dir = mysqli_real_escape_string($connection, $dir);
        
        $query = "UPDATE users SET img='$dir' WHERE username= '$username'";

        $result = $connection->query($query);
        if($connection->query($query) !== FALSE){
            echo 'Din rofilbild har ändrats';
            $connection->close();
        }else{
            echo 'Någonting gick fel';
            $connection-close();
        }
    }
?>