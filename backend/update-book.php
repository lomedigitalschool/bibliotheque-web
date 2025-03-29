<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset = utf8");
header("Access-Control-Allow-Methods: PUT");

require 'book.php';
require 'config.php';



if($_SERVER['REQUEST_METHOD'] === "PUT")
{

    //instantiation de la base de donnée
        $connect = new connectionDb;
        $connect = $connect->getConnect();

        //instantiation d'un livre et ajout du livre a la base de donnés
        $book = new Book();
        $datasBookObject = json_decode(file_get_contents("php://input")) ;
        $datasBookArray = (array) $datasBookObject;
        $datasCount =  count($datasBookArray);
        //verificaton des données reçus et ajout du livre a la base de données
        if(!empty($datasBookObject) &&  $datasCount === 5){
    
                $book->setTitle(htmlspecialchars($datasBookObject->title));
                $book->setAuthor(htmlspecialchars($datasBookObject->author));
                $book->setPublishDate(htmlspecialchars($datasBookObject->publish_at));
                $book->setPublishDate(htmlspecialchars($datasBookObject->available));

          
            
            
            $req = $book->updateBook($connect,$datasBookObject->id);

            if($req){
                echo json_encode(['Message' => 'livre modifié']);
            }else{
                echo json_encode(['Message' => 'impossible de modifier le livre']);
            }
            
        }else{
            echo json_encode(['Message' => 'les données ne sont pas au complet']); 
        }
        

}else{
    echo json_encode(["Message" => "la methode nést pas authorisé"]);
}




