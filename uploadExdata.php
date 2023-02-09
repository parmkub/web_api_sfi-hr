<?php
$section = $_GET['section'];

@mkdir("upload/$section");
if(is_uploaded_file($_FILES['upload_file']['tmp_name'])){
    $target = "upload/$section/" . $_FILES['upload_file']['name'];
    move_uploaded_file($_FILES['upload_file']['tmp_name'],$target);
    echo "Uploaded Finish";
}else{
    echo "Uploaded Error";
}

?>