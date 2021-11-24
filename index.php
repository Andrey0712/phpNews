<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>ТСН</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
</head>
<body>
<?php
include"navbar.php"
?>

<div class="container">
    <h1 align="center">Avtodor News</h1>
    <?php
    include "connection_database.php";
    $sql = "SELECT * FROM news";
    $reader = $dbh->query($sql);
    ?>
<table class="table">
   <thead>
   <tr>
       <th scope="col">id</th>
       <th scope="col">Image</th>
       <th scope="col">Name</th>
       <th scope="col">Description</th>

   </tr>
   </thead>
    <tbody>
    <?php
    foreach($reader as $row){
        echo"
        <tr>
            <th>{$row['id']}</th>
            <td>
                <img src='/images/{$row['image']}' alt='no foto' width='100'/>
            </td>
            <td>{$row['name']}</td>
            <td>{$row['description']}</td>
            
        </tr>";
    }
    ?>
    </tbody>
</table>
</div>
<script src="js/bootstrap.bundle.min.js"></script>

</body>
</html>
