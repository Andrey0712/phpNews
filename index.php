<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>ТСН</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">
</head>
<body>
<?php
include"navbar.php"
?>

<div class="container">
    <h1 class="text-center">Avtodor News</h1>
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
       <th scope="col">Action</th>

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
            <td>
                       
                        <a href='#' class='btn btn-danger btnDelete' data-id='{$row['id']}'>Видалити</a>
                         <a href='/update.php?id=${row['id']}' class='btn btn-success' ><i class='fa fa-edit'></i> </a>
                    </td>
        </tr>";
    }
    ?>

    </tbody>
</table>
</div>
<?php include "modal_delete.php"; ?>



<script src="js/bootstrap.bundle.min.js"></script>
<script src="/js/axios.min.js"></script>

<script>
    var myModal = new bootstrap.Modal(document.getElementById("myModal"), {});

    window.addEventListener('load', function () {
        const list = document.querySelectorAll(".btnDelete");
        let removeId=0; //id element delete
        for (let i = 0; i < list.length; i++) {
            list[i].addEventListener("click", function (e) {
                e.preventDefault();
                removeId = e.currentTarget.dataset.id;
                myModal.show();
            });
        }
        //Нажали кнопку видалити
        document.querySelector("#btnDeleteNews").addEventListener("click", function()
        {
            const formData = new FormData();
            formData.append("id", removeId);
            axios.post("/delete.php", formData)
                .then(resp => {
                    location.reload();
                });
        });
    });


</script>
</body>
</html>
