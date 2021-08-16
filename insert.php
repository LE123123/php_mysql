<?php
    $conn = mysqli_connect('localhost', 'root', 'gustj486!!', 'opentutorials_php_mysql');
    $sql = "insert into topic(title, description, created) values('MySQL', 'MySQL is ...', NOW())";
    $result = mysqli_query($conn, $sql);
    if($result === false) {
        echo mysqli_error($conn);
    }

?>