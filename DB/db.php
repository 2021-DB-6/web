<?php
    #db서버연결(구름IDE DB)
    $host = '127.0.0.1';
    $user = 'dbproject';
    $pw = '1q2w3e4r';
    $dbName = 'booking';
    $mysqli = new mysqli($host, $user, $pw, $dbName);
?>