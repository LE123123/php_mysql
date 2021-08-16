<?php
    $conn = mysqli_connect('localhost', 'root', 'gustj486!!', 'opentutorials_php_mysql');

    $sql = 'select * from topic';
    $result = mysqli_query($conn, $sql);
    $list = '';

    while($row = mysqli_fetch_array($result)) {
        $list =  $list."<li><a href=\"index.php?id=".$row['id']."\">".$row['title']."</a></li>";
    }

    $sql = "select * from author";
    $result = mysqli_query($conn, $sql);
    $select_form = '<select name="author_id">';
    while($row = mysqli_fetch_array($result)) {
        $select_form .='<option value="'.$row['id'].'">'.$row['name'].'</option>';
    }
    $select_form .= '</select>';

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
    <h1><a href="index.php">WEB</a></h1>
    <ol>
        <?= $list ?>
    </ol>

    <a href="create.php">create</a>
    
    <form action="process_create.php" method="post">
        <p><input type="text" name="title" placeholder="title"></p>
        <p><textarea name="description" rows="5" placeholder="description"></textarea></p>
        <?= $select_form; ?>
        <p><input type="submit"></p>
        
    </form>

</body>
</html>