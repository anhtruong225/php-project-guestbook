<?php
require __DIR__ . '/inc/db-connect.php';
require __DIR__ .'/inc/functions.php';

if(!empty($_POST)) {
    /*
    $title = '';
    if(isset($_POST['title'])){
        $title = @(string) $_POST['title'];
    } 
    
    $name = '';
    if(isset($_POST['name'])){
        $name = @(string) $_POST['name'];
    } 
    

    $content = '';
    if(isset($_POST['content'])){
        $content = @(string) $_POST['content'];
    } 
        */

    
        $title = @(string) ($_POST['title'] ?? '');
        $content = @(string) ($_POST['content'] ?? '');
        $name = @(string) ($_POST['name'] ?? '');
    
    if(!empty($title) && !empty($name) && !empty($content) ){
        $stmt = $pdo->prepare('INSERT INTO entries (`name`, `title`, `content`) VALUES (:name, :title, :content)');
        $stmt->bindValue('name', $name);
        $stmt->bindValue('title', $title);
        $stmt->bindValue('content', $content);
        $stmt->execute();

        header('Location: index.php?success=1');
        die();
    }

}
$errorMessage= 'Es ist ein Fehler auftreten...';
require __DIR__. '/index.php';