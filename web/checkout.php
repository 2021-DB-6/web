<!--결제 페이지-->

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
                            <li><a class="dropdown-item" href="room_list.php?type=pension">팬션</a></li>
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
                    <button class="btn btn-outline-dark ms-1" type="button" onclick="location.href='../php/logout.php'">
                        <i class="bi bi-box-arrow-in-right me-1"></i>
                        LOGOUT
                    </button>
                    <?php            
                                }else if($_SESSION['usergroups']=='business'){ //비지니스회원일떄
                                ?>
                    <button class="btn btn-outline-dark ms-2" type="button" onclick="location.href='business.php'">
                        <?php echo $_SESSION['userId'] ?>&nbsp;님
                    </button>

                    <button class="btn btn-outline-dark ms-1" type="button" onclick="location.href='../php/logout.php'">
                        <i class="bi bi-box-arrow-in-right me-1"></i>
                        LOGOUT
                    </button>
                    <?php
                                }else { //관리자일때
                                ?>
                    <button class="btn btn-outline-dark ms-2" type="button" onclick="location.href='admin.php'">
                        <?php echo $_SESSION['userId'] ?>&nbsp;님
                    </button>
                    <button class="btn btn-outline-dark ms-1" type="button" onclick="location.href='../php/logout.php'">
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
        <div class="container">
            <div class="row">
                <div class="col-md-4 order-md-2 mb-4">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">선택한 숙소</span>
                    </h4>
                    <ul class="list-group mb-3">
                        <?php 
                            include '../php/loginchck.php'; //로그인확인
                        
                            include '../DB/db.php';
                            $roomid = $_GET['room_id'];
                            $timestamp = strtotime("+1 days");
                            $timestamp2 = strtotime("+2 days");
                            if(isset($_GET['u_start_date'])){
                                $u_start_date =$_GET['u_start_date'];
                            } else {
                                $u_start_date = date("Y-m-d", $timestamp);
                            }
                            if(isset($_GET['u_end_date'])){
                                $u_end_date =$_GET['u_end_date'];
                            } else {
                                $u_end_date = date("Y-m-d", $timestamp2);
                            }
                        
                            $sql_room = "SELECT room.*, users.user_name FROM room, users WHERE room.room_id=$roomid and room.user_id=users.user_id";
                            $room_result = mysqli_query($mysqli, $sql_room);
                            $row = mysqli_fetch_assoc($room_result);
                            

                        ?>
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0"><?=$row['room_name'];?></h6>
                                <small class="text-muted"><?=$row['user_name']?></small>
                            </div>
                            <span class="text-muted">1박 <?=$row['room_price'];?>₩</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">최근 예약현황</h6>
                                
                                <ul>
                                    <?php
                                        $sql_room_res ="SELECT * FROM reservation WHERE room_id=$roomid ORDER BY res_pay_date DESC LIMIT 30;";
                                        $room_res_result = mysqli_query($mysqli, $sql_room_res);
                                        $res_list_count = 0;
                                            while($res_row = $room_res_result->fetch_array()){
                                                $res_list_count = $res_list_count + 1;
                                                ?>
                                            <li>
                                                <small class="text-muted"><?=$res_list_count;?> 번 - <?=$res_row['res_start']?> ~ <?=$res_row['res_end'];?></small>
                                            </li>

                                        <?php
                                            }
                                        ?>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-md-8 order-md-1">
                    <h4 class="mb-3">CheckOut</h4>
                    <form class="needs-validation" id="checkoutform" method="post" action="../php/checkout_insert.php" novalidate>
                        <input type="hidden" name="roomid" value="<?=$roomid?>">
                        <input type="hidden" name="userid" value="<?=$_SESSION['user_id']?>">
                        <div class="row">
                            <script>
                                var today = new Date().toISOString().substring(0, 10);
                                
                            </script>
                            <div class="col-md-6 mb-3">
                                <label for="start_date">입실 날짜</label>
                                <input type="date" class="form-control" id="start_date" name="start_date" onchange="get_start_date(this.value)" min="" max=""  placeholder="" value="<?=$u_start_date?>" required="">
                                <div class="invalid-feedback">
                                    Valid first name is required.
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="end_date">퇴실 날짜</label>
                                <input type="date" class="form-control" id="end_date" name="end_date" onchange="get_end_date(this.value)" min="" max="" placeholder="" value="<?=$u_end_date?>"
                                    required="">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email">결제내용 수신 이메일 <span class="text-muted">(Optional)</span></label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com">
                            <div class="invalid-feedback">
                                Please enter a valid email address for shipping updates.
                            </div>
                        </div>

                        <hr class="mb-4">
                        
                        <div>
                            <h5 class="mb-3">최종 결제 금액 : <a name="res_pay_show" id="res_pay_show" value=""></a>원</h5>
                            <input type="hidden" name="res_pay" id="res_pay" value=""> 
                        </div>
                        
                        <hr class="mb-4">

                        <h4 class="mb-3">결제 수단</h4>

                        <div class="d-block my-3">
                            <div class="custom-control custom-radio">
                                <input id="credit" name="paymentMethod" type="radio" class="custom-control-input disabled" required="" disabled>
                                <label class="custom-control-label" for="credit">신용카드</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input id="debit" name="paymentMethod" type="radio" class="custom-control-input" required="" checked="">
                                <label class="custom-control-label" for="debit">계좌이체</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required="" disabled>
                                <label class="custom-control-label" for="paypal">간편결제</label>
                            </div>
                        </div>

                        <hr class="mb-4">
                        <button class="btn btn-primary btn-lg btn-block" type="button" id="res_btn">예약 결제</button>
                    </form>
                </div>
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
    <script>
        //결제금액 계산
        var date1;
        var date1_str; //배열로저장
        var date1_time; //배열에서 date이용 형 변경
        var date2;
        var date2_1;
        var date2_time;

        var pay_price = 0;

        function get_start_date(getdate){
            date1 = getdate;
            date1_str = date1.split("-");
            date1_time = new Date(date1_str[0],date1_str[1],date1_str[2]).getTime();
            if(date1 <= today){
                alert("날짜가 올바르지 않습니다.");
                document.getElementById("start_date").value = today;
            } else if(date1 > date2){
                alert("날짜가 올바르지 않습니다.");
                document.getElementById("start_date").value = today;
            }else if(date1 < date2){
                //end를 바꾸고 start를 다시 바꿀떄 계산처리
                var count_day = (date2_time-date1_time)/(1000*60*60*24);
                pay_price = <?=$row['room_price']?>*count_day;
                document.getElementById("res_pay_show").innerText = pay_price;
                document.getElementById("res_pay").value = pay_price;                                        
            } else {                                        
            }
        }
        function get_end_date(getdate){
            date2= getdate;
            date2_str = date2.split("-");
            date2_time = new Date(date2_str[0],date2_str[1],date2_str[2]).getTime();

            if(date2 <= today){
                alert("날짜가 올바르지 않습니다.");
                document.getElementById("end_date").value = today;
            } else if(date2 <= date1) {
                alert("날짜가 올바르지 않습니다.");
                document.getElementById("end_date").value = today;
            } else{                                                                             
                //날짜 카운트 가격처리
                var count_day = (date2_time-date1_time)/(1000*60*60*24);
                pay_price = <?=$row['room_price']?>*count_day;
                document.getElementById("res_pay_show").innerText = pay_price;
                document.getElementById("res_pay").value = pay_price;
            }
        }  
        
        
        const start_date = document.querySelector("#start_date");
        const end_date = document.querySelector("#end_date");
        const res_pay = document.querySelector("#res_pay");
        res_btn.addEventListener("click", function(e) {
            if(start_date.value == "" || start_date.value == null || start_date.value == undefined || (start_date.value != null && typeof start_date.value == "object" && !Object.keys(start_date.value).length)){
                alert("입실 날짜가 입력되지 않았습니다!");
            } else if(end_date.value == "" || end_date.value == null || end_date.value == undefined || (end_date.value != null && typeof end_date.value == "object" && !Object.keys(end_date.value).length)){
                alert("퇴실 날짜가 입력되지 않았습니다!");
            } else if(res_pay.value == "" || res_pay.value == null || res_pay.value == undefined || (res_pay.value != null && typeof res_pay.value == "object" && !Object.keys(res_pay.value).length)){
                alert("결제금액 오류!");
            } else{
                checkoutform.submit();
            }
        });
        get_start_date("<?=$u_start_date?>");
        get_end_date("<?=$u_end_date?>");
    </script>
</body>

</html>