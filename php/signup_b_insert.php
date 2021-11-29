<?php
    include '../DB/db.php';


    $userpasswd1_hashed = password_hash($_POST['password1'], PASSWORD_DEFAULT);

    $name = $_POST['name'];
    $email = $_POST['email'];
    $tell = $_POST['tell'];   
    $address = $_POST['address'];
    $addr_num = $_POST['addr_num'];
    $user_business_num = $_POST['business_num'];

    $insert_users="
    INSERT INTO users SET
    user_name = '".$name."',
    user_email = '".$email."',
    user_password = '".$userpasswd1_hashed."',
    user_tell = '".$tell."',
    user_addr = '".$address."',
    user_addr_num = '".$addr_num."',
    user_business_num = '".$user_business_num."',
    user_groups = 'business'
    ";
    


    $result = mysqli_query($mysqli, $insert_users);

    if ($result === false) {
        echo "회원가입에 문제가 생겼습니다. 관리자에게 문의해주세요.";
        echo mysqli_error($mysqli);
    } else {
?>
    <script>
        alert("회원가입이 완료되었습니다");
        location.href = "../index.php";
    </script>
<?php
}
?>