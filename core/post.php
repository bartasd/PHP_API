<?php

class Post{

    private $connection;
    private $table = 'posts';

    public $id;
    public $category;
    public $category_name;
    public $title;
    public $body;
    public $author;
    public $create_at;

    public function __construct($db){
        $this->connection = $db;
    }

    public function insert(){
        $query = 'INSERT INTO ' . $this->table . ' (title, body, author, category) VALUES (:title, :body, :author, :category)';
        $stmt = $this->connection->prepare($query);

        $this->title        =   htmlspecialchars(strip_tags($this->title));
        $this->body         =   htmlspecialchars(strip_tags($this->body)); 
        $this->author       =   htmlspecialchars(strip_tags($this->author));
        $this->category     =   htmlspecialchars(strip_tags($this->category));

        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':body', $this->body);
        $stmt->bindParam(':author', $this->author);
        $stmt->bindParam(':category', $this->category);

        if($stmt->execute()){
            return true;
        }    
        printf("Error %s. \n", $stmt->error);  
        return false;
    }


    public function read(){
        $query = 'SELECT
            c.name as category_name,
            p.id,
            p.category,
            p.title,
            p.body,
            p.author,
            p.create_at
            FROM
            '.$this->table.' p
            LEFT JOIN
                categories c ON p.category = c.id
                ORDER BY p.create_at DESC';
        
        $stmt = $this->connection->prepare($query);
        $stmt->execute();   
        
        return $stmt;
    }

    public function update(){

        $query = 'UPDATE '.$this->table.' SET title = :title, body = :body, author = :author, category = :category
        WHERE id = :id';

        $stmt = $this->connection->prepare($query);
        $this->title        =   htmlspecialchars(strip_tags($this->title));
        $this->body         =   htmlspecialchars(strip_tags($this->body)); 
        $this->author       =   htmlspecialchars(strip_tags($this->author));
        $this->category     =   htmlspecialchars(strip_tags($this->category));
        $this->id           =   htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':body', $this->body);
        $stmt->bindParam(':author', $this->author);
        $stmt->bindParam(':category', $this->category);
        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()){
            return true;
        }

        printf("Error %s. \n", $stmt->error);
        return false;

    }

    public function delete(){

        $query = 'DELETE FROM '. $this->table . ' WHERE id = :id';

        $stmt = $this->connection->prepare($query);

        $this->id           =   htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()){
            return true;
        }

        printf("Error %s. \n", $stmt->error);
        return false;

    }
}