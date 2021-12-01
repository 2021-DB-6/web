<?php
    include '../DB/db.php';	

    $userid = $_POST['userid'];
    $roomid =$_POST['roomid'];
    $start_date =$_POST['start_date'];
    $end_date = $_POST['end_date'];
    $res_pay = $_POST['res_pay'];
    
    $sql_checkout_insert = "INSERT INTO reservation SET
    user_id = '".$userid."',
    room_id = '".$roomid."',
    res_start = '".$start_date."',
    res_end = '".$end_date."',
    res_pay = '".$res_pay."'";

    $result = mysqli_query($mysqli, $sql_checkout_insert);
    
    if ($result === false) {
        echo "예약에 문제가 생겼습니다. 관리자에게 문의해주세요.";
        echo mysqli_error($mysqli);
    } else {
?>
    <script>
        alert("예약이 완료되었습니다");
        location.href = "mypage.php";
    </script>
?>