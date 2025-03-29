<?php

 class connectionDb{


      public function getConnect(){
      try{
         
         $PDO = new Pdo("mysql:host=localhost;dbname=library", 'root', 'pass1234');
         $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         return $PDO;

      }catch(PDOException $e) {
         echo "Connection error: " . $e->getMessage();
         return $PDO;
      }
      
      
   }
   
}

  

   



