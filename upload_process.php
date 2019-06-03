<!--Följande kod har till stor del hämtats från: 
https://www.w3schools.com/php/php_file_upload.asp-->
<?php
    include('include/bootstrap.php');
    
    $dir = "assets/img/";
    $file = $dir . basename($_FILES['uploadFile']['name']);
    $uploadOK = 1;
    $imageFileType = strtolower(pathinfo($file,PATHINFO_EXTENSION));
if(isset($_POST['submit'])){
    include('include/methods/db.php');
    $check = getimagesize($_FILES["uploadFile"]["tmp_name"]);
    if($check !== false){;
        $uploadOK = 1;
    } else {
        $errormsg = "Detta är inte en bild. ";
        $uploadOK = 0;
    }

    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        $errormsg = $errormsg . "Enbart .jpg, .jpeg, .png and .gif är tillåtet. ";
        $uploadOK=0;
    }

    if($uploadOK == 0){
        $errormsg = $errormsg . "Filen kunde inte laddas upp";
		echo $errormsg;
		header('Location:profile.php');
    } else {
        if(move_uploaded_file($_FILES['uploadFile']['tmp_name'], $file)) {
            echo "Upload complete";
            $filedir = $dir . $_FILES['uploadFile']['name'];

            changeUserImg($filedir);
            header('Location:profile.php');
        } else {
            echo "\nNågonting blev fel";
			header('Location:profile.php');
        }
    }
}
?>