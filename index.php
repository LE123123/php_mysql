<?php
    $conn = mysqli_connect('localhost', 'root', 'gustj486!!', 'opentutorials_php_mysql');

    $sql = 'select * from topic';
    $result = mysqli_query($conn, $sql);
    $list = '';
    $author = '';

    while($row = mysqli_fetch_array($result)) {
        $escaped_title = htmlspecialchars($row['title']);
        $list =  $list."<li><a href=\"index.php?id=".$row['id']."\">".$escaped_title."</a></li>";
    }

    $article = array(
        "title" => 'Welcome',
        "description" => "Hello, web"
    );
    $update_link = '';
    $delete_link = '';

    if (isset($_GET['id'])) {
        // prevent some sql injection
        $filtered_id =  mysqli_real_escape_string($conn, $_GET['id']);
        $sql = "select * from topic left join author on topic.author_id = author.id where topic.id={$filtered_id}";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        $article['title'] = htmlspecialchars($row['title']);
        $article['description'] = htmlspecialchars($row['description']);
        $article['name'] = htmlspecialchars($row['name']);
        $update_link = '<a href="update.php?id='.$_GET['id'].'">update</a>';
        $delete_link = '
            <form action="process_delete.php" method="post">
                <input type="hidden" name="id" value="'.$_GET['id'].'">
                <input type="submit" value="delete">
            </form>
        
        ';
        $author = "<p>by {$article['name']}</p>";
    } 
    
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
    <a href="author.php">author</a>
    <ol>
        <?= $list; ?>
    </ol>

    <a href="create.php">create</a>
    <?= $update_link; ?>
    <?= $delete_link; ?>

    <h2><?= $article['title']; ?></h2>
    <?= $article['description'] ?>
    <?= $author; ?>
</body>
</html>