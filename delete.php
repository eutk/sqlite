<?php

if (isset($_GET['action']) && $_GET['action'] == 'delete'){
    $pdo = $pdo = new PDO('sqlite:manage.db');
    $id = $_GET['id'];
    $run = $pdo->query("DELETE FROM user WHERE id = '$id'");
    header('location: index.php');
}