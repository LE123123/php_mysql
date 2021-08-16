<?php
    $conn = mysqli_connect('localhost', 'root', 'gustj486!!', 'opentutorials_php_mysql');
    
    $filtered = array(
        'name' => mysqli_real_escape_string($conn, $_POST['name']),
        'profile' => mysqli_real_escape_string($conn, $_POST['profile']),
        'id' => mysqli_real_escape_string($conn, $_POST['id'])

    );

    $sql = "update author
                set
                    name = '{$filtered['name']}',
                    profile = '{$filtered['profile']}'
                where
                    id = '{$filtered['id']}'
            ";


    $result = mysqli_query($conn, $sql);
    if ($result === false) {
        echo '저장하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요';
        // 이건 아파치서버의 error.log -> /var/log/apache2/error.log에서 볼 수 있다.
        error_log(mysqli_error($conn));
    } else {
        header('Location: /~ihyeonseo/author.php?id='.$filtered['id']);
    }
    echo $sql;
    
    
?>