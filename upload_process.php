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
    if($check !== false){
        echo "Detta är en bild - " . $check["mime"];
        $uploadOK = 1;
    } else {
        echo "Detta är inte en bild";
        $uploadOK = 0;
    }

    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "enbart .jpg, .jpeg, .png and .gif är tillåtet";
        $uploadOK=0;
    }

    if($uploadOK == 0){
        echo "Filen kunde inte laddas upp";
    } else {
        if(move_uploaded_file($_FILES['uploadFile']['tmp_name'], $file)) {
            echo "Filen " . basename($_FILES['uploadFile']['name']) . " har laddats upp.";
            $filedir = $dir . $_FILES['uploadFile']['name'];

            changeUserImg($filedir);
        } else {
            echo "någonting blev fel";
        }
    }
}
?>