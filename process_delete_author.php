<?php
    $conn = mysqli_connect('localhost', 'root', 'gustj486!!', 'opentutorials_php_mysql');
    
    $filtered = array(
        'id' => mysqli_real_escape_string($conn, $_POST['id'])
    );

    $sql = "
        delete
            from topic
            where author_id = {$filtered['id']}
    ";
    mysqli_query($conn, $sql);

    $sql = "delete
                from author
                where id = '{$filtered['id']}'";


    $result = mysqli_query($conn, $sql);
    if ($result === false) {
        echo '삭제하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요';
        // 이건 아파치서버의 error.log -> /var/log/apache2/error.log에서 볼 수 있다.
        error_log(mysqli_error($conn));
    } else {
        header('Location: /~ihyeonseo/author.php');
    }
?>