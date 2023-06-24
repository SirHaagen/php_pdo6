<?php
  $host= 'localhost';
  $user= 'root';
  $password= '';
  $dbname= 'pdoposts';

  $dsn= 'mysql:host='. $host. ';dbname='. $dbname;

  //Create new PDO instance
  $pdo= new PDO($dsn, $user, $password);

  $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
  $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

  //SEARCH DATA

  $search= '%post%';    //To get the rows with the word between % %
  $limit= 2;

  $sql= 'SELECT * FROM posts WHERE title LIKE ?';
  $stmt= $pdo->prepare($sql);
  $stmt->execute([$search]);

  $posts= $stmt->fetchAll();

  foreach($posts as $post){
    echo $post->title. " ". $post->author. "<br>";
  }

  //SPECIFING A NUMBER FOR LIST AS VARAIBLE. IN ORDER TO DO SO, DISABLE PDO EMULATION MODE (line 13)

  $sql= 'SELECT * FROM posts WHERE title LIKE ? LIMIT ?';
  $stmt= $pdo->prepare($sql);
  $stmt->execute([$search, $limit]);

  $posts= $stmt->fetchAll();

  foreach($posts as $post){
    echo $post->author. " ". $post->body. "<br> ";
  }
  
?>