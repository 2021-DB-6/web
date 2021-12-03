<?php
include '../DB/db.php';

session_start();

$room_id = $_GET['room_id'];


if ($_SESSION['usergroups'] == 'business') {    //업주가 삭제할떄
    //예약테이블의 room_id를 0으로 바꾸고 삭제
    $room_delete_sql1 = "UPDATE reservation SET room_id = 0 WHERE reservation.room_id = ".$room_id.";";
    $room_d1 = mysqli_query($mysqli, $room_delete_sql1);
    if($room_d1===true){
        $room_delete_sql2 = "DELETE FROM room WHERE room_id=" . $room_id . " AND user_id = " . $_SESSION['user_id'] . ";";
        $room_d = mysqli_query($mysqli, $room_delete_sql2);
        if ($room_d === true) {
            ?>
            <script>
                alert("상품 삭제 되었습니다!")
                history.back();
            </script>
            <?php
        } else {
        ?>
            <script>
                alert("상품 삭제 실패2!")
                history.back();
            </script>
        <?php
        }
    } else{
        ?>
        <script>
            alert("상품 삭제 실패1!")
            history.back();
        </script>
        <?php        
    }
   
} else if ($_SESSION['usergroups'] == 'admin') {    //관리자가 삭제할떄
   //예약테이블의 room_id를 0으로 바꾸고 삭제
    $room_delete_sql1 = "UPDATE reservation SET room_id = 0 WHERE reservation.room_id = ".$room_id.";";
    $room_d1 = mysqli_query($mysqli, $room_delete_sql1);
    if($room_d1===true){
        $room_delete_sql2 = "DELETE FROM room WHERE room_id=" . $room_id . ";";
        $room_d = mysqli_query($mysqli, $room_delete_sql2);
        if ($room_d === true) {
            ?>
            <script>
                alert("상품 삭제 되었습니다!")
                history.back();
            </script>
            <?php
        } else {
        ?>
            <script>
                alert("상품 삭제 실패!")
                history.back();
            </script>
        <?php
        }
    } else{
        ?>
        <script>
            alert("상품 삭제 실패!")
            history.back();
        </script>
        <?php        
    }
} else {
    ?>
    <script>
        alert("비정상 접근!")
        history.back();
    </script>
    <?php 
}
?>