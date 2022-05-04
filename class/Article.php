<?php
class Article {

    public static function getAllDate($conn, $mettod = ""){
        $sql = "SELECT * FROM leviathan.zametki " . $mettod;    

        $results = $conn->query($sql);
        return $results->FetchAll(PDO::FETCH_ASSOC);
    }

    
    public function save($conn, $post){
        if($post["id"])
            $sql = "UPDATE leviathan.zametki SET date= '".$post["date"]."', time= '".$post["time"]."', content= '". $post["content"]."'  WHERE id = " . $post["id"] . ";";
        else
            $sql = "INSERT INTO leviathan.zametki (time, date, content, sendToUser) VALUES ('". $post["time"]."', '".$post["date"]."', '". $post["content"]."', 0)";
        $stmt = $conn->prepare($sql);

        $stmt->execute();   
    }

    public function deleteItem($conn, $id){
        $sql = "DELETE FROM leviathan.zametki WHERE id=$id";
        $stmt = $conn->prepare($sql);
        $stmt->execute();  
    }

    public static function setSend($conn, $id) {
        $sql = "UPDATE leviathan.zametki SET sendToUser = 1  WHERE id = " . $id . ";";
        $stmt = $conn->prepare($sql);

        $stmt->execute();   
    }

    

}