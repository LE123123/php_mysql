<?php
    $conn = mysqli_connect('localhost', 'root', 'gustj486!!', 'opentutorials_php_mysql');
    $sql = 'select * from topic';
    $result = mysqli_query($conn, $sql);
    // var_dump($result -> num_rows);
    // $row = mysqli_fetch_array($result);

    // 연관 배열을 사용해보자
    // echo '<h2>'.$row['title'].'</h2>';
    // echo $row['description'];

    // $row = mysqli_fetch_array($result);
    // echo '<h2>'.$row['title'].'</h2>';
    // echo $row['description'];

    // $row = mysqli_fetch_array($result);
    // echo '<h2>'.$row['title'].'</h2>';
    // echo $row['description'];

    echo "<h1>multi row</h1>";
    
    while($row = mysqli_fetch_array($result)) {
        echo '<h2>'.$row['title'].'</h2>';
        echo $row['description'];
    }

?>