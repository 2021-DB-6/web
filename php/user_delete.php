<?php
    //탈퇴시 예약기록의 user_id를 0으로 바꾸고 해당 유저 칼럼 삭제 실행
    include '../DB/db.php';
    session_start();

    $res_user_id_update = "UPDATE reservation SET user_id = 0 WHERE user_id = ".$_SESSION['user_id'].";";
    $res_user_update = mysqli_query($mysqli,$res_user_id_update);
    
    $room_user_id_update = "UPDATE room SET user_id = 0 WHERE user_id = ".$_SESSION['user_id'].";";
    $room_user_update = mysqli_query($mysqli,$room_user_id_update);

	$user_d_sql ="DELETE FROM users WHERE user_id = ".$_SESSION['user_id'].";";
    $user_d = mysqli_query($mysqli ,$user_d_sql);
    if($user_d === true){
        session_destroy();
    ?>
        <script>
            alert("탈퇴 되었습니다!")
            location.href = "../index.php";
        </script>
    <?php
    } else{
        ?>
            <script>
                alert("회원탈퇴 실패!")
                history.back();
            </script>
        <?php
    }
?>