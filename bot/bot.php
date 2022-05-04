<?php 

require "../class/DataBase.php";
require "../class/Article.php";

$token = "5104688774:AAFZr02MVqTE3shadMVbxQ9c-t9JIWOo_BE";
$url = 'https://api.telegram.org/bot' . $token . '/sendMessage';
$data = new DataBase;
$conn = $data->getConn();
$objects = Article::getAllDate($conn, 'WHERE date = ' . '"20' . date("y-m-d") . '"');
foreach ($objects as $task) {
    $razniza = explode(".", date ("H.i", strtotime($task['time']) - strtotime(date("H:i:s"))));
    $H = intval($razniza[0])-4;
    $i = intval($razniza[1]);
    if($H < 0) {
        Article::setSend($conn, $task['id'], 2);
        
    }
    if($H == 0 && $i < 30 && $task['sendToUser'] == 0) {
        $params = [
            'chat_id' => 804206736,
            'text' => sprintf("на сегодня в %s запланировано \n«%s»", join(":", explode(":", $task["time"], -1)), $task['content'])
        ];
        $url .= '?' . http_build_query($params);
    
        file_get_contents($url);
        $url = 'https://api.telegram.org/bot' . $token . '/sendMessage';

        Article::setSend($conn, $task['id']);
        
    }


    
}



