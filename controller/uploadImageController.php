<?php
/**
 * Created by PhpStorm.
 * User: JacksonM
 * Date: 2017-01-20
 * Time: 11:48 AM
 */
require_once ("../inclusion/inclusion.php");
AllIncludes("functions","dataB","validate","photos","errorsuccess");


$message = new ErrorSuccess();

$target_dir ="../photos/". name().userID();
if(!file_exists($target_dir)){
    //printItemBreak("creating new folder");
    mkdir("../photos/".$target_dir,0777,true);
}else{
   // printItemBreak("folder exits");
}

$target_dir.='/';

$target_file = $target_dir . basename($_FILES["image"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);





if(isset($_POST)){
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
        //echo "File is an image - " . $check["mime"] . ".";

        $uploadOk = 1;
    } else {
       // echo "File is not an image.";
        $message->addTOErrorArray("File is not an image.",12);
        $uploadOk = 0;
    }

}

// Check if file already exists
if (file_exists($target_file)) {
   // echo "Sorry, file already exists.";

    $message->addTOErrorArray("Sorry, file already exists.",12);
    $uploadOk = 0;
}
// Check file size
if ($_FILES["image"]["size"] > 500000) {
    //echo "Sorry, your file is too large.";
    $message->addTOErrorArray("Sorry, your file is too large.",12);
    $uploadOk = 0;
}
// Allow certain file formats
$imageFileType = strtolower($imageFileType);
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
   // echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $message->addTOErrorArray("Sorry, only JPG, JPEG, PNG & GIF files are allowed.",12);
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    //echo "Sorry, your file was not uploaded.";
    $message->addTOErrorArray("Sorry, your file was not uploaded.",12);
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        //printItemBreak($target_file);
        echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";

        $message->addToSuccessArray("The file ". basename( $_FILES["image"]["name"]). " has been uploaded.",12);

        $photos = new Photos($target_file,userID(),"active");
        $photos2=new Photos($target_file,userID(),"deactivated");
        unsetProperties($photos2,"user_id","url");
        var_dump($photos2);
        dataBaseManipulation(SQLUpdate("photos",$photos2,"user_id",userID()," AND status = 'active'"),con(),"result","updating photos",false);
        dataBaseManipulation(SQLInsert("photos",$photos),con(),"result","inserting into photo",false);
    } else {
        echo "Sorry, there was an error uploading your file.";
        $message->addTOErrorArray("Sorry, there was an error uploading your file.",12);
    }

}

$message->addError();
$message->addSuccess();

header("Location: "."../views/settingsView.php");
