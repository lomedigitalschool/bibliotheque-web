<?php


require 'book.php';
require 'config.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset = utf8");
header("Access-Control-Allow-Methods: DELETE");


if($_SERVER['REQUEST_METHOD'] === "DELETE")
{

    //instantiation de la base de donnée
        $connect = new connectionDb;
        $connect = $connect->getConnect();

        //instantiation d'un livre et ajout du livre a la base de donnés
        $book = new Book();
        $datasBookObject = json_decode(file_get_contents("php://input"));
        $datasBookArray = (array) $datasBookObject;
        $datasCount =  count($datasBookArray);
        //verificaton des données reçus et ajout du livre a la base de données
        if(!empty($datasBookObject) &&  $datasCount === 1){
    
                $book->setTitle(htmlspecialchars($datasBookObject->title));
          
            
            
            $req = $book->deleteBook($connect);

            if($req){
                echo json_encode(['Message' => 'livre supprimé']);
            }else{
                echo json_encode(['Message' => 'impossible de supprimer le livre']);
            }
            
        }else{
            echo json_encode(['Message' => 'les données ne sont pas au complet']); 
        }


}else{
    echo json_encode(['Message' => 'la methode nést pas authorisé']);
}




