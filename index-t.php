<html>
<head>
	<title>Hello goorm</title>
</head>
<body>
	<h1>Hello goorm</h1>
	<?php
        echo '<p>Hello PHP</p>';
        echo "PHP 파서의 버전은 :" . phpversion();
        include 'DB/db.php';
        if($mysqli){
            echo "<br>connect : 성공<br>";
        }
        else{
            echo "<br>disconnect : 실패<br>";
        }
         
    ?>
</body>
</html>