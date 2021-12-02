<?php
    include '../DB/db.php';	

	//예약변경시 가격차이 해결을 위해 기존예약 취소후 결제페이지로 이동
    $u_i = $_POST['u_list_i'];
    $update_start_date = $_POST['update_start_date'.$u_i];
    $update_end_date = $_POST['update_end_date'.$u_i];
    $u_res_id = $_POST['u_res_id'];
    $u_room_id = $_POST['u_room_id'];
    

    //기존 주문 
    session_start();

	$res_d_sql ="DELETE FROM reservation WHERE res_id=".$u_res_id." AND user_id = ".$_SESSION['user_id'].";";
    $res_d = mysqli_query($mysqli ,$res_d_sql);
    if($res_d === true){
    ?>
        <script>
            alert("변경된 날짜로 재결제합니다");
            //새결제창 연결
            location.href = "../web/checkout.php?room_id=<?=$u_room_id?>&u_start_date=<?=$update_start_date?>&u_end_date=<?=$update_end_date?>";
        </script>
    <?php
    } else{
        ?>
            <script>
                alert("예약변경 실패!")
                history.back();
            </script>
        <?php
    }
?>