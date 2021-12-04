<?php
    include '../DB/db.php';
    session_start();

    $room_id = $_POST['u_room_id'];   
    $room_name = $_POST['update_room_name'];    
    $room_text= $_POST['update_room_text'];
    $room_info= $_POST['update_room_info'];
    $room_type= $_POST['update_room_type'];
    $room_price= $_POST['update_room_price'];

    //base64중 앞에 데이터타입 부분 분리->[1]에 저장
    $room_img1= explode(',',$_POST['update_room_img1_base64']);
    $room_img2= explode(',',$_POST['update_room_img2_base64']);
    $room_img3= explode(',',$_POST['update_room_img3_base64']);
    $room_img4= explode(',',$_POST['update_room_img4_base64']);
    $room_img5= explode(',',$_POST['update_room_img5_base64']);
    //이미지는 NULL일경우 쿼리안타게 (기존 이미지 보즌을 위해서)
        
    $room_update_sql = "UPDATE room SET room_name = '".$room_name."', room_text = '".$room_text."', room_info = '".$room_info."', room_type = '".$room_type."',  room_price = '".$room_price."'";
    if(empty($room_img1[1])){//true(비어있을떄)
    }else{$room_update_sql = $room_update_sql.", room_img1 = FROM_BASE64('".$room_img1[1]."')";}
    if(empty($room_img2[1])){        
    }else{$room_update_sql = $room_update_sql.", room_img2 = FROM_BASE64('".$room_img2[1]."')";}
    if(empty($room_img3[1])){        
    } else{$room_update_sql = $room_update_sql.", room_img3 = FROM_BASE64('".$room_img3[1]."')";}
    if(empty($room_img4[1])){            
    }else{$room_update_sql = $room_update_sql.", room_img4 = FROM_BASE64('".$room_img4[1]."')";}
    if(empty($room_img5[1])){            
    } else{$room_update_sql = $room_update_sql.", room_img5 = FROM_BASE64('".$room_img5[1]."')";}
    $room_update_sql = $room_update_sql." WHERE room_id = ".$room_id.";";


    if($_SESSION['usergroups']=='business'){ 
        //상품 등록자일떄
        
        $room_update_result = mysqli_query($mysqli, $room_update_sql);
        
        if($room_update_result === true){
        ?>
            <script>
                alert("상품정보가 수정 되었습니다!")
                location.href = document.referrer;
            </script>
        <?php
        } else {            
            ?>
                <script>
                    alert("상품 수정 실패!<?=mysqli_error($mysqli); ?> ")                    
                    location.href = document.referrer;
                </script>
            <?php
        } 
        
    } else if($_SESSION['usergroups']=='admin'){
        //관리자일떄
        
        $room_update_result = mysqli_query($mysqli, $room_update_sql);
        
        if($room_update_result === true){
        ?>
            <script>
                alert("상품정보가 수정 되었습니다!")
                location.href = document.referrer;
            </script>
        <?php
        } else {
            ?>
                <script>
                    alert("상품 수정 실패!")
                    location.href = document.referrer;
                </script>
            <?php
        } 
    } else {
        ?>
        <script>
            alert("비정상접근!")
            location.href = document.referrer;
        </script>
        <?php
    }
?>