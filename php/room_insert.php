<?php
    include '../DB/db.php';
    session_start();


    $room_name = $_POST['insert_room_name'];    
    $room_text= $_POST['insert_room_text'];
    $room_info= $_POST['insert_room_info'];
    $room_type= $_POST['insert_room_type'];
    $room_price= $_POST['insert_room_price'];

    //base64중 앞에 데이터타입 부분 분리->[1]에 저장
    $room_img1= explode(',',$_POST['insert_room_img1_base64']);
    $room_img2= explode(',',$_POST['insert_room_img2_base64']);
    $room_img3= explode(',',$_POST['insert_room_img3_base64']);
    $room_img4= explode(',',$_POST['insert_room_img4_base64']);
    $room_img5= explode(',',$_POST['insert_room_img5_base64']);
    

    $room_insert_sql = "INSERT INTO room SET
    user_id= '".$_SESSION['user_id']."',
    room_name = '".$room_name."', 
    room_text = '".$room_text."', 
    room_info = '".$room_info."', 
    room_type = '".$room_type."',  
    room_price = '".$room_price."'";
   

    //이미지는 NULL일경우 쿼리안타게 (기존 이미지 보즌을 위해서)        
    if(empty($room_img1[1])){//true(비어있을떄)
    }else{$room_insert_sql = $room_insert_sql.", room_img1 = FROM_BASE64('".$room_img1[1]."')";}
    if(empty($room_img2[1])){        
    }else{$room_insert_sql = $room_insert_sql.", room_img2 = FROM_BASE64('".$room_img2[1]."')";}
    if(empty($room_img3[1])){        
    } else{$room_insert_sql = $room_insert_sql.", room_img3 = FROM_BASE64('".$room_img3[1]."')";}
    if(empty($room_img4[1])){            
    }else{$room_insert_sql = $room_insert_sql.", room_img4 = FROM_BASE64('".$room_img4[1]."')";}
    if(empty($room_img5[1])){            
    } else{$room_insert_sql = $room_insert_sql.", room_img5 = FROM_BASE64('".$room_img5[1]."')";}
    $room_insert_sql = $room_insert_sql.";";


    if($_SESSION['usergroups']=='business'){ 
        //상품 등록자일떄
        
        $room_insert_result = mysqli_query($mysqli, $room_insert_sql);
        
        if($room_insert_result === true){
        ?>
            <script>
                alert("상품정보가 등록 되었습니다!")
                location.href = document.referrer;
            </script>
        <?php
        } else {            
            ?>
                <script>
                    alert("상품 등록 실패!<?=mysqli_error($mysqli); ?> ")                    
                    location.href = document.referrer;
                </script>
            <?php
        } 
        
    } else if($_SESSION['usergroups']=='admin'){
        //관리자일떄
        
        $room_insert_result = mysqli_query($mysqli, $room_insert_sql);
        
        if($room_insert_result === true){
        ?>
            <script>
                alert("상품정보가 등록 되었습니다!")
                location.href = document.referrer;
            </script>
        <?php
        } else {
            ?>
                <script>
                    alert("상품 등록 실패!")
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