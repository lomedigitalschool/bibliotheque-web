<?php 

class book {


    protected string $title;
    protected string $author;
    protected string $publish_at;
    protected bool $available = true;
    // protected $pdo;

    public function __construct()
    {
        
    } 

    public function getTitle(){
        return $this->title;
    }

    public function getAuthor(){
        return $this->author;
    }

    public function getPublishDate()
    {
        return $this->publish_at;
    }

    public function getAvailable(){
        return $this->available;
    }
    
    public function setTitle($title){
        $this->title = $title;
        return $this->title;
    }

    public function setAuthor($author){
        $this->author = $author;
        return $this->author;
    }

    public function setPublishDate($publish_at){
    $this->publish_at = $publish_at;
    return $this->publish_at;
    }

    public function setAvailable($available){
        $this->available = $available;
        return $this->available;
    }

    public function addBook($pdo){
        $sql = 
            "INSERT INTO books (title, author, publish_at, available) 
            VALUES (:title, :author ,:publish_at, :available)";

        $req = $pdo->prepare($sql);
       
        $res = $req->execute([":title" => $this->title,
                            ":author" => $this->author,
                            ":publish_at" => $this->publish_at,
                            ":available" => $this->available]);
        

        if($res > 0){
            return true;
         }else{
            return false;
        }
                            

    }

    public function updateBook($pdo,$id){
        $sql = 
            "UPDATE books SET 
                            title = :title,
                            author = :author, 
                            publish_at = :publish_at,
                            available = :available
                        
                    WHERE books.id = $id";
            
    
        $prepareSql = $pdo->prepare($sql);
        $req = $prepareSql->execute([":title" => $this->title,
                                     ":author" => $this->author,
                                     ":publish_at" => $this->publish_at,
                                     ":available" => $this->available]);

        if($req > 0){
            return true;
        }else{
            return false;
        }
    
    }
    
       

    public function getAllBook($pdo){
        $sql = "SELECT * FROM books";
        $req = $pdo->query($sql);

        
        return $req;
    
    }

    public function deleteBook($pdo){
        $sql = "DELETE FROM books WHERE title = :title";
        $prepareSql = $pdo->prepare($sql);
        $req = $prepareSql->execute(['title' => $this->title]);

        if($req){
            return true;
        }else{
            return false;
        }


    }

        
    




     

    

}