<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SQLite3</title>
</head>
<body>
    <?php
    session_start();
    $pdo = new PDO('sqlite:manage.db');
    if (isset($_GET['action']) && $_GET['action'] == 'edit'){
        $id = $_GET['id'];
        $_SESSION['id'] = $id;
    }
    $id = $_SESSION['id'];
    $run = $pdo->query("SELECT * FROM user WHERE id='$id'");
    $fetch = $run->fetchAll(PDO::FETCH_ASSOC);
    $info  = $fetch[0];
    if (isset($_POST['update'])){
        $name = $_POST['name'];
        $location = $_POST['location'];
        $run = $pdo->query("UPDATE user SET name='$name', location='$location' WHERE id='$id'");
        session_destroy();
        session_unset();
        header('location: index.php');
    }
    ?>
    <form action="edit.php" method="post">
        <input type="text" placeholder="User Name" name="name" value="<?php echo $info['name'];?>">
        <input type="text" placeholder="location" name="location" value="<?php echo $info['location'];?>">
        <input type="submit" name="update" value="Update">
    </form>
</body>
</html>