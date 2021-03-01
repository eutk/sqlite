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
    $pdo = new PDO('sqlite:manage.db');
    if (isset($_POST['save'])){
        $name = $_POST['add_user'];
        $location = $_POST['add_location'];
        $run = $pdo->query("INSERT INTO user (name, location) VALUES ('$name', '$location')");
    }
    ?>
    <form action="index.php" method="post">
        <input type="text" name="add_user" placeholder="Add User Name">
        <input type="text" name="add_location" placeholder="Add Location">
        <input type="submit" name="save" value="Save">
    </form>
    <table border="1" width="30%" align="center">
        <thead>
            <tr align="center">
                <td colspan="4">All User</td>
            </tr>
            <tr>
                <td>Id</td>
                <td>User Name</td>
                <td>Location</td>
                <td>action</td>
            </tr>
        </thead>
        <tbody>
            <?php

            $run = $pdo->query("SELECT user.id, user.name, user.location FROM user");
            $row = $run->fetchAll(PDO::FETCH_ASSOC);
            $id = 0;
            foreach ($row as $key=>$value){
            ?>
            <tr>
                <td><?php echo $id+=1; ?></td>
                <td><?php echo $value['name']; ?></td>
                <td><?php echo $value['location']; ?></td>
                <td>
                    <a href="edit.php?action=edit&id=<?php echo $value['id']; ?>">Edit</a> |
                    <a href="delete.php?action=delete&id=<?php echo $value['id']; ?>">Delete</a>
                </td>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</body>
</html>