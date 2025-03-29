<?php
require 'book.php';
require 'config.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset = utf8");
header("Access-Control-Allow-Methods: POST");


if($_SERVER['REQUEST_METHOD'] === "POST")
{

    //instantiation de la base de donnée
        $connect = new connectionDb;
        $connect = $connect->getConnect();

        
        $book = new Book();
        $datasBook = $_GET;
        $datascount =  count($datasBook);
        // var_dump(count($data));
        //verificaton des données reçus et ajout du livre a la base de données
        if(!empty($datasBook) &&  $datascount === 3){
    
                $book->setTitle(htmlspecialchars($datasBook['title']));
                $book->setAuthor(htmlspecialchars($datasBook['author']));
                $book->setPublishDate(htmlspecialchars($datasBook['publish_at']));
          
            
            
            $req = $book->addBook($connect);

            if($req){
                echo json_encode(['Message' => 'livre ajouté']);
            }else{
                echo json_encode(['Message' => 'impossible d\'ajouter le livre']);
            }
            
        }else{
            echo json_encode(['Message' => 'les données ne sont pas au complet']); 
        }
        


}else{
    echo json_encode(["Message" => "la methode n'est pas authorisé"]);
}



