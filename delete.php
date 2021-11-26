
<?php
if($_SERVER["REQUEST_METHOD"]=="POST") {
    include "connection_database.php";
    $sql = "SELECT `image` FROM `news` WHERE `Id` =" .$_POST['id'];
    $data = $dbh->query($sql);
    $Image = $data->fetchAll()[0]["image"];
    $path= $_SERVER['DOCUMENT_ROOT']. '/images/'.$Image;
    if(unlink($path)) {
        $sql = "DELETE FROM `news` WHERE `news`.`Id` = ?";
        $dbh->prepare($sql)->execute([$_POST['id']]);
        echo "id = " . $_POST['id'];
    }

}

