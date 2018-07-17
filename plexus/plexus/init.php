<?php
include 'database/connection.php';
include 'classes/user.php';
include 'classes/post.php';
include 'classes/follow.php';

global $pdo;
session_start();

$getFromU=new User($pdo);
$getFromP=new Post($pdo);
$getFromF=new Follow($pdo);

define("BASE_URL","http://localhost/plexus/");
?>