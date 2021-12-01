<?php
include '../DB/db.php';

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE user_email ='{$email}'";


$result = mysqli_query($mysqli, $sql);

$row = mysqli_fetch_array($result);
$hashedPassword = $row['user_password'];
$row['user_email'];

foreach ($row as $key => $r) {
    //echo "{$key} : {$r} <br>";
}
// echo $row['email'];
// DB 정보를 가져왔으니 
// 비밀번호 검증 로직을 실행하면 된다.
$passwordResult = password_verify($password, $hashedPassword);
if ($passwordResult === true) {
    // 로그인 성공
    // 세션에 id 저장
    session_start();
    $_SESSION['userId'] = $row['user_email'];
    print_r($_SESSION);
    //echo $_SESSION['userId'];
    $_SESSION['usergroups'] = $row['user_groups'];
    $_SESSION['user_id'] = $row['user_id'];

?>
    <script>
        alert("로그인에 성공하였습니다.")
        location.href = "../index.php";
    </script>
<?php
} else {
    // 로그인 실패 
?>
    <script>
        alert("로그인에 실패하였습니다");
        location.href = "../web/login.php"
    </script>
<?php
}
?>