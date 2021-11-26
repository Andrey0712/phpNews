<?php
include "connection_database.php";
if($_SERVER["REQUEST_METHOD"]=="GET") {
    $id=$_GET['id'];
    $sql = "SELECT * FROM `news` WHERE `Id` =" .$id;
    $data = $dbh->query($sql)->fetchAll()[0];
    $change_name = $data['name'];
    $change_description = $data['description'];
    $change_image = $data['image'];
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name=$_POST["name"];
    $description=$_POST["description"];

    $filename = uniqid().'.jpg';//рандомное имя
    $filesavepath=$_SERVER['DOCUMENT_ROOT'].'/images/'.$filename;
    move_uploaded_file($_FILES['image']['tmp_name'],$filesavepath);//сохраняем фотку из темпа в images
        $sqll = "UPDATE `news` SET name=?, description=?, image=? WHERE `id` =" . $_GET['id'];
        $dbh->prepare($sqll)->execute([$name, $description, $filename]);//сохранение в БД
        header("Location: /");//redirect
        exit();

}
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <title>Редагування</title>
</head>
<body>
<?php include "navbar.php" ?>

<div class="container">
    <div class="row">
        <div class="offset-2 col-md-8 mt-3">
            <h1 class="text-center">Редагувати новину <?= $change_name ?></h1>
            <form method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name" class="form-label">Назва</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Введите название новости">
                </div>
                <div class="mb-3" class="form-label">
                    <label for="description">Опис</label>
                    <textarea class="form-control" rows="10" cols="35" id="description"  name="description"
                              placeholder="Опишите проблему"></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="image">
                        <img width="120" id="imageLab" src="<?= 'images/'. $change_image ?>" />
                    </label>
                    <input type="file" name="image" id="image" class="form-control"/>
                </div>
                <button type="submit" class="btn btn-primary">Зберегти</button>
            </form>
        </div>
    </div>
</div>
<script src="/js/bootstrap.bundle.min.js"></script>
</body>
</html>
