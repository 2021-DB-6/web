<?php
	session_start();
    if($_SESSION['userId'] == null) {
        echo "<script>window.alert('로그인 하세요.');</script>";
        echo "<script>window.location=('../index.php');</script>";
        exit;
    }
    
?>