<?php
	include '../DB/db.php';
    //파라미터값을 받아서 sql을 실행뒤 restapi마냥 json으로 출력!
    $get_room_id = $_GET['room_id'];
    $room_select_sql = "SELECT * FROM room WHERE room_id=".$get_room_id.";";

    $room_select_row = mysqli_query($mysqli, $room_select_sql);
    $room_array = array();

    while($row = mysqli_fetch_array($room_select_row)){
         array_push($room_array, array('room_id'=>$row[0],'user_id'=>$row[1],'room_price'=>$row[2],'room_name'=>$row[3],'room_text'=>$row[4],'room_type'=>$row[5],'room_info'=>$row[6],'room_img1'=>base64_encode($row[7]),'room_img2'=>base64_encode($row[8]),'room_img3'=>base64_encode($row[9]),'room_img4'=>base64_encode($row[10]),'room_img5'=>base64_encode($row[11])));
    }
    echo json_encode(array("result"=>$room_array),JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
?>