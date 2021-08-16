<?php
    $conn = mysqli_connect('localhost', 'root', 'gustj486!!', 'opentutorials_php_mysql');
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
    <p><a href="index.php">topic</a></p>
    <p><a href="author.php">create author</a></p>
    <table id="container" border="1">
        <th>id</th>
        <th>name</th>
        <th>profile</th>
        <th></th>
        <th></th>
        <?php
            $sql = "select * from author";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_array($result)) {
                $filtered = array(
                    'id' => htmlspecialchars($row['id']),
                    'name' => htmlspecialchars($row['name']),
                    'profile' => htmlspecialchars($row['profile'])
                );
        ?>
            <tr>
                <td><?= $filtered['id']; ?></td>
                <td><?= $filtered['name']; ?></td>
                <td><?= $filtered['profile']; ?></td>
                <td><a href="author.php?id=<?= $filtered['id']; ?>">update</a></td>
                <td>
                    <form action="process_delete_author.php" method="post" onsubmit="
                        if(!confirm('really delete <?=$filtered['name'];?>')){
                            return false
                        }"
                    >
                        <input type="hidden" name="id" value="<?= $filtered['id']; ?>">
                        <input type="submit" value="delete">
                    </form>
                </td>
            </tr>
            <?php 
            }
            ?>
    </table>

    <style>
        table {
            border: 1;
        }
    </style>

    <?php
        $escaped = array(
            'name' => '',
            'profile' => ''
        );
        $label_submit = 'Create_author';
        $form_action = 'process_create_author.php';
        $form_id = '';
        if(isset($_GET['id'])) {
            $filtered_id = mysqli_real_escape_string($conn, $_GET['id']);
            settype($filtered_id, 'integer');

            $sql = "select * from author where id = {$filtered_id}";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result);
            $escaped['name'] = $row['name'];
            $escaped['profile'] = $row['profile'];
            $label_submit = 'Update author';
            $form_action = 'process_update_author.php';
            $form_id = '<input type="hidden" name="id" value="'.$_GET['id'].'">';
        }
    ?>

    <form action="<?= $form_action; ?>" method="post">
        <?= $form_id; ?>
        <p><input type="text" name="name" placeholder="name" value="<?= $escaped['name']; ?>"></p>
        <p><textarea name="profile" placeholder="profile"><?= $escaped['profile']; ?></textarea></p>
        <p><input type="submit" value="<?= $label_submit; ?>"></p>
    </form>
</body>
</html>