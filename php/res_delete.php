<?php
    include '../DB/db.php';
    session_start();

    $d_res_id = $_GET['res_id'];


	$res_d_sql ="DELETE FROM reservation WHERE res_id=".$d_res_id." AND user_id = ".$_SESSION['user_id'].";";
    $res_d = mysqli_query($mysqli ,$res_d_sql);
    if($res_d === true){
    ?>
        <script>
            alert("예약 취소 되었습니다!")
            history.back();
        </script>
    <?php
    } else{
        ?>
            <script>
                alert("예약취소 실패!")
                history.back();
            </script>
        <?php
    }
?>