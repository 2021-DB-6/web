<?php              
    include '../DB/db.php';

    if(isset($_GET['page'])){
        $page = $_GET['page'];
    } else {
         $page = 1;   
    }
    if(isset($_GET['type'])){
        $type = "'" . $_GET['type'] . "'";
        //링크 처리
        $view_url = "room_list.php?page=";
        $view_type_url = "&type=".$_GET['type'];
    } else {
        $type = "NULL";
        $view_url = "room_list.php?page=";
    }
?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>숙소예약하기</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../css/styles.css" rel="stylesheet" />
</head>

<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="../index.php">숙소예약시스템</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">숙소 상품</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="room_list.php">전체 숙소 목록</a></li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li><a class="dropdown-item" href="room_list.php?type=pension">펜션</a></li>
                            <li><a class="dropdown-item" href="room_list.php?type=hotel">호텔</a></li>
                            <li><a class="dropdown-item" href="room_list.php?type=motel">모텔</a></li>
                            <li><a class="dropdown-item" href="room_list.php?type=guest">게스트하우스</a></li>
                            <li><a class="dropdown-item" href="room_list.php?type=resort">리조트/콘도</a></li>
                        </ul>
                    </li>
                </ul>
                <form class="d-flex ms-1">
                    <?php
                            session_start(); //세션
                            if($_SESSION['userId'] == null){ //로그인전
                                ?>
                    <button class="btn btn-outline-dark" type="button" onclick="location.href='login.php'">
                        <i class="bi bi-box-arrow-in-right me-1"></i>
                        LOGIN
                    </button>
                    <?php
                            } else {  //로그인후
                                if($_SESSION['usergroups']=='user'){ //일반유저일떄
                    ?>
                    <button class="btn btn-outline-dark ms-2" type="button" onclick="location.href='web/mypage.php'">
                        <?php echo $_SESSION['userId'] ?>&nbsp;님
                    </button>
                    <button class="btn btn-outline-dark ms-1" type="button" onclick="location.href='php/logout.php'">
                        <i class="bi bi-box-arrow-in-right me-1"></i>
                        LOGOUT
                    </button>
                    <?php            
                                }else if($_SESSION['usergroups']=='business'){ //비지니스회원일떄
                                ?>
                    <button class="btn btn-outline-dark ms-2" type="button" onclick="location.href='web/business.php'">
                        <?php echo $_SESSION['userId'] ?>&nbsp;님
                    </button>

                    <button class="btn btn-outline-dark ms-1" type="button" onclick="location.href='php/logout.php'">
                        <i class="bi bi-box-arrow-in-right me-1"></i>
                        LOGOUT
                    </button>
                    <?php
                                }else { //관리자일때
                                ?>
                    <button class="btn btn-outline-dark ms-2" type="button" onclick="location.href='web/admin.php'">
                        <?php echo $_SESSION['userId'] ?>&nbsp;님
                    </button>
                    <button class="btn btn-outline-dark ms-1" type="button" onclick="location.href='php/logout.php'">
                        <i class="bi bi-box-arrow-in-right me-1"></i>
                        LOGOUT
                    </button>
                    <?php
                                }
                            }
                        ?>
                </form>
            </div>
        </div>
    </nav>
    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

                
                <?php
                    //페이징
                    $sql_room_t = "SELECT * FROM room WHERE room_type = COALESCE($type, room_type);";
                    $total_record = mysqli_num_rows(mysqli_query($mysqli, $sql_room_t)); //레코드 총수 카운트
                    
                    $list = 12; //페이지당 개수
			  		$block_cnt = 10;
			  		$block_num = ceil($page / $block_cnt); 
			  		$block_start = (($block_num - 1) * $block_cnt) + 1; // 블록의 시작 번호  ex) 1,6,11 ...
			    	$block_end = $block_start + $block_cnt - 1; // 블록의 마지막 번호 ex) 5,10,15 ...
			    	
			    	
			    	$total_page = ceil($total_record / $list); //총페이지 갯수 계산
			    	if($block_end > $total_page){ 
			    		$block_end = $total_page; 
			    	}
			    	$total_block = ceil($total_page / $block_cnt);
			    	$page_start = ($page - 1) * $list;

                
                    //게시글 가져오기    
                    $sql2= "SELECT * FROM room WHERE room_type = COALESCE($type, room_type) ORDER BY room_id DESC LIMIT $page_start, $list;";
                    $list_result = mysqli_query($mysqli, $sql2);
                    while($roomlist = $list_result->fetch_array()){
                        ?>
                        <div class="col mb-5">
                            <div class="card h-100">
                                <!-- Product image-->
                                <img class="card-img-top" src="<?php echo 'data:image/bmp;base64,' . base64_encode($roomlist['room_img1']) ?>" alt="..." />
                                <!-- Product details-->
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <!-- Product name-->
                                        <h5 class="fw-bolder"><?=$roomlist['room_name'];?></h5>
                                        <!-- Product price-->
                                        <?=$roomlist['room_price'];?>&nbsp;원
                                    </div>
                                </div>
                                <!-- Product actions-->
                                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                    <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="./room_view.php?room_id=<?=$roomlist['room_id'];?>">상세보기</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                ?>                
            </div>
            
            <div>
                
                 <ul class="pagination justify-content-center">
                    <?php
                        if($page <= 1){

                        } else {
                            echo "<li class='page-item'><a class='page-link' href='$view_url"."1"."$view_type_url'>&laquo;</a></li>";
                        }
                        if($page <= 1){

                        } else {
                            $pre = $page-1;
                            echo "<li class='page-item'><a class='page-link' href='$view_url$pre$view_type_url'>&#60;</a></li>";
                        }
                        
                        for($i = $block_start; $i <= $block_end; $i++){
				    		if($page == $i){
				    			echo "<li class='page-item active'><a class='page-link'>$i</a></li>"; //현재페이지
				    		} else {
				    			echo "<li class='page-item'><a class='page-link' href='$view_url$i$view_type_url'>$i</a></li>";
				    		}
				    	}
				    	
				    	if($page >= $total_page){
				    		// 빈 값
				    	} else {
				    		$next = $page + 1;
				    		echo "<li class='page-item'><a class='page-link' href='$view_url$next$view_type_url'>&gt;</a></li>";
				    	}
					   	
				    	if($page >= $total_page){
				    		// 빈 값
				    	} else {
				    		echo "<li class='page-item'><a class='page-link' href='$view_url$total_page$view_type_url'>&raquo;</a></li>";
				    	}
                    ?>
                </ul>
            </div>
        </div>
    </section>
    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Your Website 2021</p>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="../js/scripts.js"></script>
    <script>console.log(<?= isset($type) ?>);</script>
</body>

</html>