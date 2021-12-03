<?php
    //예약관리 업데이트
	include '../DB/db.php';
       
    $res_id = $_POST['update_res_id_input'];
    $updaet_start_date = $_POST['update_start_date'];
    $update_end_date = $_POST['update_end_date'];
    $update_res_pay = $_POST['update_res_pay_input'];
    

    $sql = "UPDATE reservation SET res_start='".$updaet_start_date."', res_end='".$update_end_date."', res_pay = '".$update_res_pay."' WHERE res_id = ".$res_id.";";    
    $res_update = mysqli_query($mysqli, $sql);
    if($res_update === true){
    ?>
<script>
    alert("예약변경 완료!")
    history.back();
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

?>