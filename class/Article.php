<?php
class Article {

    public static function getAllDate($conn){
        $sql = "SELECT * FROM leviathan.zametki";    
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

    

}