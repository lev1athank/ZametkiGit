
<?php
require "class/DataBase.php";
require "class/Article.php";
$data = new DataBase;
$conn = $data->getConn();
if($_SERVER["REQUEST_METHOD"] == "GET") {
    if($_GET && $_GET["id"]) {
        $article = new Article;
        $article->deleteItem($conn, $_GET["id"]);
        unset($_GET);
        header("Location: ".$_SERVER['PHP_SELF']);
    }
}
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $article = new Article;
    $a = $article->save($conn, $_POST);
    unset($_POST);
    header("Location: ".$_SERVER['PHP_SELF']);
}

$objects = Article::getAllDate($conn);




?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <script src="https://kit.fontawesome.com/192a6d13e1.js" crossorigin="anonymous"></script>

  
    <title>Document</title>
</head>
<body>
    <div class="panel">
        <header><button class="redactBtn" id="addTask"><i class="fas fa-plus"></i></i></button></header>
        <main>
            <?php foreach($objects as $object) {
            echo
            '<div class="task">
                <div class="title">'. $object["content"]. '</div>
                <div class="date">'
                
                .join(".", array_reverse(explode("-", $object["date"]))).'<span style="font-weight: bold;">'.join(":", explode(":", $object["time"], -1)).'</span> 
                </div>
                <input type="hidden" name="id" id="id" value="' .$object["id"] .'">

            </div>';
            
            }
            ?>
            
            
        </main>

    </div>
    <div class="info">

        <header> 
            <button class="redactBtn" id="redactBtn"><i class="fas fa-edit" ></i></button>
            <a href="index.php?id=" class="redactBtn" id="delEl"><i class="fas fa-trash-alt"></i></a>
        </header>
        <div class="infoblock"  >
            <div class="dataAndtime" >
                
                
            </div>
            <div class="content" ></div>
        </div>
        
        <div class="createORcorect" hidden>
            <form method="post">
            <div class="dataAndtime" >
                Заплонировано на <input required type="date" name="date" id="date" min="2022-01-01">  в <input required type="time" name="time" id="time">
                
            </div>
            <div class="content">
                <textarea required name="content" id="contentArea"></textarea>
            </div>

            <div class="saveBtn">
            <button  class="redactBtn"><i class="fas fa-save"></i></button>
            </div>
            <input type="hidden" name="id" id="idForm">
        </div>

    <script src="script.js"></script>

</body>
</html>