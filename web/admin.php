<!--사이트관리 페이지-->
<?php
include '../DB/db.php';
$view;
if (isset($_GET['view'])) {
    $view = $_GET['view'];
} else {
    $view = "main";
}
if (isset($_GET['num'])) {
    $num = $_GET['num'];
} else {
    $num = 1;
}

//누적 예약수   
$main_res_cnt_sql = "SELECT COUNT(*) AS cnt FROM reservation";
$main_res_cnt_row = mysqli_fetch_array(mysqli_query($mysqli, $main_res_cnt_sql));
//총 방문한 고객수(중복예약 제외)
$main_user_cnt_sql = "SELECT COUNT(*) AS cnt FROM users";
$main_user_cnt = mysqli_num_rows(mysqli_query($mysqli, $main_user_cnt_sql));


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
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">숙소 상품</a>
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
                    if ($_SESSION['userId'] == null) { //로그인전
                    ?>
                        <button class="btn btn-outline-dark" type="button" onclick="location.href='login.php'">
                            <i class="bi bi-box-arrow-in-right me-1"></i>
                            LOGIN
                        </button>
                        <script>
                            //접근차단
                            alert("로그인이 필요합니다.");
                            location.href = "login.php";
                        </script>
                        <?php
                    } else {  //로그인후
                        if ($_SESSION['usergroups'] == 'user') { //일반유저일떄
                        ?>
                            <button class="btn btn-outline-dark ms-2" type="button" onclick="location.href='mypage.php'">
                                <?php echo $_SESSION['userId'] ?>&nbsp;님
                            </button>
                            <button class="btn btn-outline-dark ms-1" type="button" onclick="location.href='../php/logout.php'">
                                <i class="bi bi-box-arrow-in-right me-1"></i>
                                LOGOUT
                            </button>
                            <script>
                                //접근차단
                                alert("잘못된접근입니다.");
                                history.back();
                            </script>
                        <?php
                        } else if ($_SESSION['usergroups'] == 'business') { //비지니스회원일떄
                        ?>
                            <button class="btn btn-outline-dark ms-2" type="button" onclick="location.href='business.php'">
                                <?php echo $_SESSION['userId'] ?>&nbsp;님
                            </button>

                            <button class="btn btn-outline-dark ms-1" type="button" onclick="location.href='../php/logout.php'">
                                <i class="bi bi-box-arrow-in-right me-1"></i>
                                LOGOUT
                            </button>
                            <script>
                                //접근차단
                                alert("잘못된접근입니다.");
                                history.back();
                            </script>
                        <?php
                        } else { //관리자일때
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
    <section>
        <div class="container">
            <div class="row">
                <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                    <div class="sidebar-sticky">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link active" href="admin.php?view=main">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                    </svg>
                                    관리자 대시보드 <span class="sr-only"></span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="admin.php?view=res">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file">
                                        <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="13 2 13 9 20 9"></polyline>
                                    </svg>
                                    예약관리
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="admin.php?view=room">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart">
                                        <circle cx="9" cy="21" r="1"></circle>
                                        <circle cx="20" cy="21" r="1"></circle>
                                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6">
                                        </path>
                                    </svg>
                                    상품관리
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="admin.php?view=user">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users">
                                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="9" cy="7" r="4"></circle>
                                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                    </svg>
                                    유저관리
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>

                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

                    <div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                        <div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                            <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                        </div>
                        <div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                            <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                        </div>
                    </div>

                    <?php
                    if ($view === "main") {
                    ?>
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2">Dashboard</h1>
                            <div class="btn-toolbar mb-2 mb-md-0">
                                <div class="btn-group mr-2">
                                    <button class="btn btn-sm btn-outline-secondary" onclick="location.href='mypage.php'">계정 마이페이지</button>
                                </div>
                            </div>
                        </div>
                            <div class="row align-items-md-stretch mb-4">
                                <!--회원정보-->
                                <div class="col-md-6">
                                    <div class="p-4 text-white bg-dark rounded-3">
                                        <p><?= $_SESSION['user_name']; ?> 님 반가워요!</p>
                                        <p>누적 총 예약 수 : <?= $main_res_cnt_row['cnt']; ?> 건</p>
                                        <p>총 회원 수 : <?= $main_user_cnt ; ?> 명</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="p-5 bg-light border rounded-3 d-grid gap-2 mx-auto">
                                        <!--회원 탈퇴, 비밀번호 변경-->
                                        <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#passwd_modal">비밀번호 변경</button>
                                        <!--비밀번호 변경 Modal -->
                                        <div class="modal fade" id="passwd_modal" tabindex="-1" aria-labelledby="passwd_modal_Label" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="passwd_modal_Label">비밀번호 변경</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <form method="POST" action="../php/passwd_update.php" id="passwd_update-form" class="validation-form">
                                                                <div class="md-6 mb-3">
                                                                    <label for="old_password">기존 비밀번호</label>
                                                                    <input type="password" class="form-control" name="old_password" id="old_password" placeholder="" value="" required />
                                                                    <div class="invalid-feedback">비밀번호을 입력해주세요.</div>
                                                                </div>
                                                                <div class="md-6 mb-3">
                                                                    <label for="new_password0">변경할 비밀번호</label>
                                                                    <input type="password" class="form-control" name="new_password0" id="new_password0" placeholder="" value="" required />
                                                                    <div class="invalid-feedback">비밀번호을 입력해주세요.</div>
                                                                </div>
                                                                <div class="md-6 mb-3">
                                                                    <label for="new_password1">변경할 비밀번호 재입력</label>
                                                                    <input type="password" class="form-control" name="new_password1" id="new_password1" placeholder="" value="" required />
                                                                    <div class="invalid-feedback">비밀번호을 입력해주세요.</div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">닫기</button>
                                                        <button type="button" class="btn btn-primary" id="passwd_btn">비밀번호 변경</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#user_delete_modal">서비스 탈퇴</button>
                                        <!--탈퇴 모달-->
                                        <div class="modal fade" id="user_delete_modal" tabindex="-1" aria-labelledby="user_delete_modal_Label" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="user_delete_modal_Label">서비스 탈퇴</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h4>서비스를 탈퇴 하시겠습니까?</h4>
                                                        <hr>
                                                        <P>서비스 탈퇴 후 예약기록을 포함한 모든 회원기록은 복구할수 없습니다!</P>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">닫기</button>
                                                        <button type="button" class="btn btn-danger" onclick="location.href='../php/user_delete.php';">서비스 탈퇴</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <h2>신규회원 현황</h2>
                        <div class="table-responsive">
                            <table class="table table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>고유번호</th>
                                        <th>이메일</th>
                                        <th>이름</th>
                                        <th>구분</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    //메인최근 회원가입 현황
                                    $sql_main_user10 = "SELECT * FROM users ORDER BY user_id DESC LIMIT 10;";

                                    $main_user10_result = mysqli_query($mysqli, $sql_main_user10);
                                    while ($user10_list = $main_user10_result->fetch_array()) {
                                        if($user10_list['user_groups'] === 'user'){
                                            $user_groups = "일반회원";
                                        } else if($user10_list['user_groups'] === 'business'){
                                            $user_groups = "비지니스회원";
                                        } else if($user10_list['user_groups'] === 'admin'){
                                            $user_groups = "관리자";
                                        }
                                    ?>
                                        <tr>
                                            <td><?= $user10_list['user_id'] ?></td>
                                            <td><?= $user10_list['user_email'] ?></td>
                                            <td><?= $user10_list['user_name'] ?></td>
                                            <td><?= $user_groups ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <script>
                            const passwd_update_form = document.querySelector("#passwd_update-form");
                            const passwd_btn = document.querySelector("#passwd_btn");
                            const old_password = document.querySelector("#old_password");
                            const new_password0 = document.querySelector("#new_password0");
                            const new_password1 = document.querySelector("#new_password1");
                            passwd_btn.addEventListener("click", function(e) {
                                if (new_password0.value && new_password0.value === new_password1.value) {

                                    passwd_update_form.submit();
                                } else {
                                    alert("비밀번호가 서로 일치하지 않습니다");
                                }
                            });
                        </script>
                    <?php
                    } else if ($view === "res") {

                    ?>
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2">전체 예약관리</h1>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>예약번호</th>
                                        <th>상품이름_(고유번호)</th>
                                        <th>예약자명(예약자이메일)</th>
                                        <th>예약자전화번호</th>
                                        <th>입실일</th>
                                        <th>퇴실일</th>
                                        <th>결제가격</th>
                                        <th>관리</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    //자사가 소유한 상품(방)의 예약을 모두 출력 및 예약 취소 변경 가능하게 하기!
                                    //페이징
                                    $sql_res_all = "SELECT * FROM reservation;";
                                    $total_res_record = mysqli_num_rows(mysqli_query($mysqli, $sql_res_all)); //레코드 총수 카운트

                                    $res_list = 15; //페이지당 개수
                                    $res_block_cnt = 10;
                                    $res_block_num = ceil($num / $res_block_cnt);
                                    $res_block_start = (($res_block_num - 1) * $res_block_cnt) + 1; // 블록의 시작 번호  ex) 1,6,11 ...
                                    $res_block_end = $res_block_start + $res_block_cnt - 1; // 블록의 마지막 번호 ex) 5,10,15 ...


                                    $res_total_page = ceil($total_res_record / $res_list); //총페이지 갯수 계산
                                    if ($res_block_end > $res_total_page) {
                                        $res_block_end = $res_total_page;
                                    }
                                    $res_total_block = ceil($res_total_page / $res_block_cnt);
                                    $res_page_start = ($num - 1) * $res_list;


                                    //예약정보 가져오기    
                                    $res_15 = "SELECT *,room.room_name,room.room_price,users.user_name,users.user_email,users.user_tell FROM reservation,room,users WHERE reservation.room_id = room.room_id AND reservation.user_id=users.user_id ORDER BY res_pay_date DESC LIMIT " . $res_page_start . ", " . $res_list . ";";
                                    $res_list_result = mysqli_query($mysqli, $res_15);
                                    while ($res_page_list = $res_list_result->fetch_array()) {
                                    ?>
                                        <tr>
                                            <td><?= $res_page_list['res_id'] ?></td>
                                            <td><a href="room_view.php?room_id=<?= $res_page_list['room_id'] ?>"><?= $res_page_list['room_name'] ?>_(<?= $res_page_list['room_id'] ?>)</a></td>
                                            <td><?= $res_page_list['user_name'] ?>(<?= $res_page_list['user_email'] ?>)</td>
                                            <td><?= $res_page_list['user_tell'] ?></td>
                                            <td><?= $res_page_list['res_start'] ?></td>
                                            <td><?= $res_page_list['res_end'] ?></td>
                                            <td><?= $res_page_list['res_pay'] ?> ₩</td>
                                            <td>
                                                <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#res_update_modal" onclick="res_upate_btn(<?= $res_page_list['res_id'] ?>, '<?= $res_page_list['res_start'] ?>' , '<?= $res_page_list['res_end'] ?>', '<?= $res_page_list['room_price'] ?>')">수정</button>
                                                <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#res_delete_modal" onclick="res_delete_btn(<?= $res_page_list['res_id'] ?>)">삭제</button>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>


                                    <!--예약 수정 모달 추가하기-->
                                    <div class="modal fade" id="res_update_modal" tabindex="-1" aria-labelledby="res_update_modal_Label" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="res_update_modal_Label">예약 수정</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <P>예약 변경 후 결제금액에 차액은 별도 처리 요망!</P>
                                                    예약 번호 : <span id="update_modal_res_id"></span> 번
                                                    <br>
                                                    <form id="res_update_form" method="post" action="../php/res_update_b.php">
                                                        <div class="col-md-6 mb-3">
                                                            <label for="update_start_date">변경 입실 날짜</label>
                                                            <input type="date" class="form-control" id="update_start_date" name="update_start_date" onchange="get_start_date(this.value)" placeholder="" value="" required="">
                                                            <div class="invalid-feedback">
                                                                Valid first name is required.
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label for="update_end_date">변경 퇴실 날짜</label>
                                                            <input type="date" class="form-control" id="update_end_date" name="update_end_date" onchange="get_end_date(this.value)" placeholder="" value="" required="">
                                                        </div>
                                                        <div>
                                                            변경된 예약의 금액 : <p id="updaet_res_pay"></p>(차액금 별도처리!)
                                                        </div>
                                                        <input type="hidden" id="update_res_id_input" name="update_res_id_input">
                                                        <input type="hidden" id="update_res_pay_input" name="update_res_pay_input">
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">닫기</button>
                                                    <button type="button" class="btn btn-primary" id="res_update_btn" onclick="">예약 변경</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!--예약 삭제 모달 추가하기-->
                                    <div class="modal fade" id="res_delete_modal" tabindex="-1" aria-labelledby="res_delete_modal_Label" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="res_delete_modal_Label">예약 삭제</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">

                                                    <P><span id="del_res_id"></span> 번 예약을 삭제합니다(고객의 예약 기록에서도 삭제됩니다!)</P>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">닫기</button>
                                                    <button type="button" class="btn btn-danger" id="res_delete_modal_btn" onclick="">예약 삭제</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                        //예약수정 관리버튼
                                        function res_upate_btn(getdate, get_modal_start_date, get_modal_end_date, get_room_price) {
                                            var res_id = getdate;
                                            var res_start_date = get_modal_start_date;
                                            var rse_end_date = get_modal_end_date;
                                            f_room_price = get_room_price;
                                            //수정모달 데이터 수정
                                            document.getElementById("update_modal_res_id").innerText = res_id;
                                            document.getElementById("update_res_id_input").value = res_id;
                                            document.getElementById("update_start_date").value = get_modal_start_date;
                                            document.getElementById("update_end_date").value = get_modal_end_date;

                                            get_start_date(res_start_date);
                                            get_end_date(rse_end_date);

                                        }

                                        //예약삭제 관리버튼
                                        function res_delete_btn(getdate) {
                                            //TODO 파라미터 여러개로 받아서 모달로 수정 받기
                                            var res_id = getdate;
                                            //삭제모달 데이터 수정
                                            document.getElementById("del_res_id").innerText = res_id;
                                            document.getElementById("res_delete_modal_btn").setAttribute("onclick", "location.href='../php/res_delete.php?res_id=" + res_id + "'");

                                        }

                                        //예약수정 처리
                                        var today = new Date().toISOString().substring(0, 10);
                                        var date1;
                                        var date1_str; //배열로저장
                                        var date1_time; //배열에서 date이용 형 변경
                                        var date2;
                                        var date2_1;
                                        var date2_time;

                                        var pay_price = 0;

                                        function get_start_date(getdate) {
                                            date1 = getdate;
                                            date1_str = date1.split("-");
                                            date1_time = new Date(date1_str[0], date1_str[1], date1_str[2]).getTime();

                                            if (date1 <= today) {
                                                alert("이미 지난 날짜입니다!");
                                                document.getElementById("update_start_date").value = today;
                                            } else if (date1 > date2) {
                                                alert("날짜가 올바르지 않습니다.");
                                                document.getElementById("update_start_date").value = today;
                                            } else if (date1 < date2) {
                                                //end를 바꾸고 start를 다시 바꿀떄 계산처리
                                                var count_day = (date2_time - date1_time) / (1000 * 60 * 60 * 24);
                                                pay_price = f_room_price * count_day;
                                                document.getElementById("updaet_res_pay").innerText = pay_price;
                                                document.getElementById("update_res_pay_input").value = pay_price;
                                            } else {}
                                        }

                                        function get_end_date(getdate) {
                                            date2 = getdate;
                                            date2_str = date2.split("-");
                                            date2_time = new Date(date2_str[0], date2_str[1], date2_str[2]).getTime();

                                            if (date2 <= today) {
                                                alert("이미 지난 날짜입니다!");
                                                document.getElementById("update_end_date").value = today;
                                            } else if (date2 <= date1) {
                                                alert("날짜가 올바르지 않습니다.");
                                                document.getElementById("update_end_date").value = today;
                                            } else {
                                                //날짜 카운트 가격처리
                                                var count_day = (date2_time - date1_time) / (1000 * 60 * 60 * 24);
                                                pay_price = f_room_price * count_day;
                                                document.getElementById("updaet_res_pay").innerText = pay_price;
                                                document.getElementById("update_res_pay_input").value = pay_price;
                                            }
                                        }


                                        const update_start_date = document.querySelector("#update_start_date");
                                        const update_end_date = document.querySelector("#update_end_date");
                                        const update_res_pay = document.querySelector("#update_res_pay_input");
                                        res_update_btn.addEventListener("click", function(e) {
                                            if (update_start_date.value == "" || update_start_date.value == null || update_start_date.value == undefined || (update_start_date.value != null && typeof update_start_date.value == "object" && !Object.keys(update_start_date.value).length)) {
                                                alert("입실 날짜가 입력되지 않았습니다!");
                                            } else if (update_end_date.value == "" || update_end_date.value == null || update_end_date.value == undefined || (update_end_date.value != null && typeof update_end_date.value == "object" && !Object.keys(update_end_date.value).length)) {
                                                alert("퇴실 날짜가 입력되지 않았습니다!");
                                            } else if (update_res_pay.value == "" || update_res_pay.value == null || update_res_pay.value == undefined || (update_res_pay.value != null && typeof update_res_pay.value == "object" && !Object.keys(update_res_pay.value).length)) {
                                                alert("금액 오류!");
                                                console.log(update_res_pay);
                                            } else {
                                                res_update_form.submit();
                                            }
                                        });
                                    </script>
                                </tbody>
                            </table>
                        </div>
                        <div>
                            <ul class="pagination justify-content-center">
                                <?php
                                if ($num <= 1) {
                                } else {
                                    echo "<li class='page-item'><a class='page-link' href='admin.php?num=1&view=res'>&laquo;</a></li>";
                                }
                                if ($num <= 1) {
                                } else {
                                    $pre = $num - 1;
                                    echo "<li class='page-item'><a class='page-link' href='admin.php?num=$pre&view=res'>&#60;</a></li>";
                                }

                                for ($i = $res_block_start; $i <= $res_block_end; $i++) {
                                    if ($page == $i) {
                                        echo "<li class='page-item active'><a class='page-link'>$i</a></li>"; //현재페이지
                                    } else {
                                        echo "<li class='page-item'><a class='page-link' href='admin.php?num=$i&view=res'>$i</a></li>";
                                    }
                                }

                                if ($num >= $res_total_page) {
                                    // 빈 값
                                } else {
                                    $next = $num + 1;
                                    echo "<li class='page-item'><a class='page-link' href='admin.php?num=$next&view=res'>&gt;</a></li>";
                                }

                                if ($num >= $res_total_page) {
                                    // 빈 값
                                } else {
                                    echo "<li class='page-item'><a class='page-link' href='admin.php?num=$res_total_page&view=res'>&raquo;</a></li>";
                                }

                                ?>
                            </ul>
                        </div>
                    <?php
                    } else if ($view === "room") {
                    ?>

                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2">상품관리</h1>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>고유번호</th>
                                        <th>이름(방이름)</th>
                                        <th>소유자이름</th>
                                        <th>설명</th>
                                        <th>편의사항</th>
                                        <th>타입</th>
                                        <th>가격</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    //자사가 소유한 상품(방)을 등록 수정
                                    //페이징
                                    $sql_room_all = "SELECT * FROM room ORDER BY room_id DESC;";
                                    $total_room_record = mysqli_num_rows(mysqli_query($mysqli, $sql_room_all)); //레코드 총수 카운트

                                    $room_list = 15; //페이지당 개수
                                    $room_block_cnt = 10;
                                    $room_block_num = ceil($num / $room_block_cnt);
                                    $room_block_start = (($room_block_num - 1) * $room_block_cnt) + 1; // 블록의 시작 번호  ex) 1,6,11 ...
                                    $room_block_end = $room_block_start + $room_block_cnt - 1; // 블록의 마지막 번호 ex) 5,10,15 ...


                                    $room_total_page = ceil($total_room_record / $room_list); //총페이지 갯수 계산
                                    if ($room_block_end > $room_total_page) {
                                        $room_block_end = $room_total_page;
                                    }
                                    $room_total_block = ceil($room_total_page / $room_block_cnt);
                                    $room_page_start = ($num - 1) * $room_list;


                                    //게시글 가져오기    
                                    $room_15 = "SELECT room.*, users.user_name FROM room,users WHERE room.user_id = users.user_id ORDER BY room.room_id DESC LIMIT " . $room_page_start . ", " . $room_list . ";";
                                    $room_list_result = mysqli_query($mysqli, $room_15);
                                    while ($room_page_list = $room_list_result->fetch_array()) {
                                    ?>
                                        <tr>
                                            <td><?= $room_page_list['room_id'] ?></td>
                                            <td><a href="room_view.php?room_id=<?= $room_page_list['room_id'] ?>"><?= $room_page_list['room_name'] ?></a></td>
                                            <td><?=$room_page_list['user_name'] ?></td>
                                            <td><?= mb_substr($room_page_list['room_text'],0,20) ?></td>
                                            <td><?= mb_substr($room_page_list['room_info'],0,10) ?></td>
                                            <td><?= $room_page_list['room_type'] ?></td>
                                            <td><?= $room_page_list['room_price'] ?></td>
                                            <td>
                                                <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#room_update_modal" onclick="room_upate_btn(<?= $room_page_list['room_id'] ?>, `<?= $room_page_list['room_name'] ?>`, `<?= $room_page_list['room_text'] ?>`, `<?= $room_page_list['room_info'] ?>`, '<?= $room_page_list['room_type'] ?>', <?= $room_page_list['room_price'] ?>)">수정</button>
                                                <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#room_delete_modal" onclick="room_delete_modal(<?= $room_page_list['room_id'] ?>)">삭제</button>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    
                                    ?>
                                    
                                    
                                    <!--상품 수정 모달-->
                                    <div class="modal fade" id="room_update_modal" tabindex="-1" aria-labelledby="room_update_modal_Label" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable modal-xl modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="room_update_modal_Label">상품 수정</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    상품 번호 : <span id="update_modal_room_id"></span> 번
                                                    <hr>
                                                    <form id="room_update_form" method="post" action="../php/room_update.php">
                                                        <input type="hidden" id="u_room_id" name="u_room_id">
                                                        <div class="col mb-3">
                                                            <label for="update_room_name">상품(방)이름</label>
                                                            <input type="text" class="form-control" name="update_room_name" id="update_room_name" placeholder="" value="" required />
                                                            <div class="invalid-feedback">이름을 입력해주세요.</div>
                                                        </div>
                                                        <div class="col mb-3">
                                                            <label for="update_room_text">설명</label>
                                                            <textarea class="form-control" name="update_room_text" id="update_room_text" placeholder="" value="" required style="height: 200px"></textarea>
                                                            <div class="invalid-feedback">상품 설명을 입력해주세요.</div>
                                                        </div>
                                                        <div class="col mb-3">
                                                            <label for="update_room_info">편의사항</label>
                                                            <input type="text" class="form-control" name="update_room_info" id="update_room_info" placeholder="" value="" required />
                                                            <div class="invalid-feedback">이름을 입력해주세요.</div>
                                                        </div>
                                                        <div class="col mb-3">
                                                            <label for="update_room_type">타입</label>
                                                            <select class="form-select" aria-label="Floating label select example" name="update_room_type" id="update_room_type"  value="">
                                                                <option selected>숙소 타입(업종)선택</option>
                                                                <option value="pension">펜션</option>
                                                                <option value="hotel">호텔</option>
                                                                <option value="motel">모텔</option>
                                                                <option value="poolvilla">풀빌라</option>
                                                                <option value="resort">리조트</option>
                                                            </select>
                                                        </div>
                                                        <div class="col mb-3">
                                                            <label for="update_room_price">가격</label>
                                                            <input type="num" class="form-control" name="update_room_price" id="update_room_price" placeholder="" value="" required />
                                                            <div class="invalid-feedback">이름을 입력해주세요.</div>
                                                        </div>
                                                        <div class="col mb-3">
                                                            <label for="update_room_img1">메인 이미지</label>
                                                            <div class="col">
                                                                <img class="img-thumbnail mx-auto" id="update_room_img1">
                                                                <input type="file" accept="image/jpeg, image/jpg, image/png" class="form-control" name="update_room_img1_file" id="update_room_img1_file" placeholder="" value="" required />
                                                                <input type="hidden" name="update_room_img1_base64" id="update_room_img1_base64">
                                                            </div>                                                            
                                                        </div>
                                                        <div class="col mb-3">
                                                            <label for="update_room_img2">이미지-2</label>
                                                            <div class="col">
                                                                <img class="img-thumbnail mx-auto" id="update_room_img2">
                                                                <input type="file" accept="image/jpeg, image/jpg, image/png" class="form-control" name="update_room_img2_file" id="update_room_img2_file" placeholder="" value="" required />
                                                                <input type="hidden" name="update_room_img2_base64" id="update_room_img2_base64">
                                                            </div>                                                           
                                                        </div>
                                                        <div class="col mb-3">
                                                            <label for="update_room_img3">이미지-3</label>
                                                            <div class="col">
                                                                <img class="img-thumbnail mx-auto" id="update_room_img3">
                                                                <input type="file" accept="image/jpeg, image/jpg, image/png" class="form-control" name="update_room_img3_file" id="update_room_img3_file" placeholder="" value="" required />
                                                                <input type="hidden" name="update_room_img3_base64" id="update_room_img3_base64">
                                                            </div>                                                         
                                                        </div>
                                                        <div class="col mb-3">
                                                            <label for="update_room_img4">이미지-4</label>
                                                            <div class="col">
                                                                <img class="img-thumbnail mx-auto" id="update_room_img4">
                                                                <input type="file" accept="image/jpeg, image/jpg, image/png" class="form-control" name="update_room_img4_file" id="update_room_img4_file" placeholder="" value="" required />
                                                                <input type="hidden" name="update_room_img4_base64" id="update_room_img4_base64">
                                                            </div>                                                        
                                                        </div>
                                                        <div class="col mb-3">
                                                            <label for="update_room_img5">이미지-5</label>
                                                            <div class="col">
                                                                <img class="img-thumbnail mx-auto" id="update_room_img5">
                                                                <input type="file" accept="image/jpeg, image/jpg, image/png" class="form-control" name="update_room_img5_file" id="update_room_img5_file" placeholder="" value="" required />
                                                                <input type="hidden" name="update_room_img5_base64" id="update_room_img5_base64">
                                                            </div>                                                         
                                                        </div>
                                                    </form> 
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">닫기</button>
                                                    <button type="button" class="btn btn-primary" id="room_update_btn" onclick="">상품 변경</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!--상품 삭제 모달-->
                                    <div class="modal fade" id="room_delete_modal" tabindex="-1" aria-labelledby="room_delete_modal_Label" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="room_delete_modal_Label">상품 삭제</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    
                                                    <P><span id="del_room_id"></span> 번 상품을 삭제합니다</P>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">닫기</button>
                                                    <button type="button" class="btn btn-danger" id="room_delete_modal_btn" onclick="">상품 삭제</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--상품 등록 모달-->
                                    <div class="modal fade" id="room_insert_modal" tabindex="-1" aria-labelledby="room_insert_modal_Label" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable modal-xl modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="room_insert_modal_Label">상품 등록</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">                                                   
                                                    <form id="room_insert_form" method="post" action="../php/room_insert.php">
                                                        <div class="col mb-3">
                                                            <label for="insert_room_name">상품(방)이름</label>
                                                            <input type="text" class="form-control" name="insert_room_name" id="insert_room_name" placeholder="" value="" required />
                                                            <div class="invalid-feedback">이름을 입력해주세요.</div>
                                                        </div>
                                                        <div class="col mb-3">
                                                            <label for="insert_room_text">설명</label>
                                                            <textarea class="form-control" name="insert_room_text" id="insert_room_text" placeholder="" value="" required style="height: 200px"></textarea>
                                                            <div class="invalid-feedback">상품 설명을 입력해주세요.</div>
                                                        </div>
                                                        <div class="col mb-3">
                                                            <label for="insert_room_info">편의사항</label>
                                                            <input type="text" class="form-control" name="insert_room_info" id="insert_room_info" placeholder="" value="" required />
                                                            <div class="invalid-feedback">이름을 입력해주세요.</div>
                                                        </div>
                                                        <div class="col mb-3">
                                                            <label for="insert_room_type">타입</label>
                                                            <select class="form-select" aria-label="Floating label select example" name="insert_room_type" id="insert_room_type"  value="">
                                                                <option selected>숙소 타입(업종)선택</option>
                                                                <option value="pension">펜션</option>
                                                                <option value="hotel">호텔</option>
                                                                <option value="motel">모텔</option>
                                                                <option value="poolvilla">풀빌라</option>
                                                                <option value="resort">리조트</option>
                                                            </select>
                                                        </div>
                                                        <div class="col mb-3">
                                                            <label for="insert_room_price">가격</label>
                                                            <input type="num" class="form-control" name="insert_room_price" id="insert_room_price" placeholder="" value="" required />
                                                            <div class="invalid-feedback">이름을 입력해주세요.</div>
                                                        </div>
                                                        <div class="col mb-3">
                                                            <label for="insert_room_img1">메인 이미지</label>
                                                            <div class="col">
                                                                <img class="img-thumbnail mx-auto" id="insert_room_img1">
                                                                <input type="file" accept="image/jpeg, image/jpg, image/png" class="form-control" name="insert_room_img1_file" id="insert_room_img1_file" placeholder="" value="" required />
                                                                <input type="hidden" name="insert_room_img1_base64" id="insert_room_img1_base64">
                                                            </div>                                                            
                                                        </div>
                                                        <div class="col mb-3">
                                                            <label for="insert_room_img2">이미지-2</label>
                                                            <div class="col">
                                                                <img class="img-thumbnail mx-auto" id="insert_room_img2">
                                                                <input type="file" accept="image/jpeg, image/jpg, image/png" class="form-control" name="insert_room_img2_file" id="insert_room_img2_file" placeholder="" value="" required />
                                                                <input type="hidden" name="insert_room_img2_base64" id="insert_room_img2_base64">
                                                            </div>                                                           
                                                        </div>
                                                        <div class="col mb-3">
                                                            <label for="insert_room_img3">이미지-3</label>
                                                            <div class="col">
                                                                <img class="img-thumbnail mx-auto" id="insert_room_img3">
                                                                <input type="file" accept="image/jpeg, image/jpg, image/png" class="form-control" name="insert_room_img3_file" id="insert_room_img3_file" placeholder="" value="" required />
                                                                <input type="hidden" name="insert_room_img3_base64" id="insert_room_img3_base64">
                                                            </div>                                                         
                                                        </div>
                                                        <div class="col mb-3">
                                                            <label for="insert_room_img4">이미지-4</label>
                                                            <div class="col">
                                                                <img class="img-thumbnail mx-auto" id="insert_room_img4">
                                                                <input type="file" accept="image/jpeg, image/jpg, image/png" class="form-control" name="insert_room_img4_file" id="insert_room_img4_file" placeholder="" value="" required />
                                                                <input type="hidden" name="insert_room_img4_base64" id="insert_room_img4_base64">
                                                            </div>                                                        
                                                        </div>
                                                        <div class="col mb-3">
                                                            <label for="insert_room_img5">이미지-5</label>
                                                            <div class="col">
                                                                <img class="img-thumbnail mx-auto" id="insert_room_img5">
                                                                <input type="file" accept="image/jpeg, image/jpg, image/png" class="form-control" name="insert_room_img5_file" id="insert_room_img5_file" placeholder="" value="" required />
                                                                <input type="hidden" name="insert_room_img5_base64" id="insert_room_img5_base64">
                                                            </div>                                                         
                                                        </div>
                                                    </form> 
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">닫기</button>
                                                    <button type="button" class="btn btn-primary" id="room_insert_modal_btn" onclick="">상품 등록</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                    
                                    
                                    <script>                                        
                                        //상품수정 관리버튼
                                        function room_upate_btn(get_room_id,get_room_name,get_room_text,get_room_info,get_room_type, get_room_price) {
                                            var room_id = get_room_id;
                                            var room_name =get_room_name;
                                            var room_text = get_room_text;
                                            var room_info = get_room_info;                                            
                                            var room_type = get_room_type;
                                            var room_price = get_room_price;                                            
                                            var room_url = "../php/room_select.php?room_id="+room_id;                                        
                                            //여기서 get메소드로 select.php를 호출해서 가져온값을 가공해서 넘겨주자!
                                            fetch(room_url)
                                                .then((res) => res.json())
                                                .then(res => {
                                                    var room_img1 = res.result[0].room_img1;  
                                                    var room_img2 = res.result[0].room_img2;   
                                                    var room_img3 = res.result[0].room_img3;   
                                                    var room_img4 = res.result[0].room_img4;   
                                                    var room_img5 = res.result[0].room_img5;   
   
                                                    //DB에저장된 이미지 삽입
                                                    if( room_img1 == ""){
                                                        document.getElementById("update_room_img1").src = "../src/img/album_noimg.jpg";
                                                    }else{
                                                        document.getElementById("update_room_img1").src = "data:image/bmp;base64,"+room_img1;
                                                    }
                                                    if( room_img2 == ""){
                                                        document.getElementById("update_room_img2").src = "../src/img/album_noimg.jpg";
                                                    }else{
                                                        document.getElementById("update_room_img2").src = "data:image/bmp;base64,"+room_img2;
                                                    }if( room_img3 == ""){
                                                        document.getElementById("update_room_img3").src = "../src/img/album_noimg.jpg";
                                                    }else{
                                                        document.getElementById("update_room_img3").src = "data:image/bmp;base64,"+room_img3;
                                                    }if( room_img4 == ""){
                                                        document.getElementById("update_room_img4").src = "../src/img/album_noimg.jpg";
                                                    }else{
                                                        document.getElementById("update_room_img4").src = "data:image/bmp;base64,"+room_img4;
                                                    }if( room_img5 == ""){
                                                        document.getElementById("update_room_img5").src = "../src/img/album_noimg.jpg";
                                                    }else{
                                                        document.getElementById("update_room_img5").src = "data:image/bmp;base64,"+room_img5;
                                                    }                                                
                                            });                                                                                                           
                                            //수정모달 데이터 수정
                                            document.getElementById("update_modal_room_id").innerText = room_id;
                                            document.getElementById("u_room_id").value = room_id;
                                            document.getElementById("update_room_name").value = room_name;
                                            document.getElementById("update_room_text").value = room_text;
                                            document.getElementById("update_room_info").value = room_info;
                                            document.getElementById("update_room_type").value = room_type;
                                            document.getElementById("update_room_price").value = room_price;
                                        }                                        
                                        //이미지 미리보기
                                        function readImage(input,img_num) {
                                            // 인풋 태그에 파일이 있는 경우
                                            if(input.files && input.files[0]) {
                                                // 이미지 파일인지 검사 (생략)
                                                // FileReader 인스턴스 생성
                                                const reader = new FileReader()
                                                // 이미지가 로드가 된 경우
                                                reader.onload = e => {
                                                    const previewImage = document.getElementById("update_room_img"+img_num)
                                                    previewImage.src = e.target.result
                                                    //post 임시
                                                    document.getElementById("update_room_img"+img_num+"_base64").value = reader.result
                                                }
                                                
                                                // reader가 이미지 읽도록 하기
                                                reader.readAsDataURL(input.files[0])
                                            }
                                        }
                                        // input file에 change 이벤트 부여
                                        const inputImage1 = document.getElementById("update_room_img1_file")
                                        inputImage1.addEventListener("change", e => {
                                            readImage(e.target, 1)                                            
                                        })
                                        const inputImage2 = document.getElementById("update_room_img2_file")
                                        inputImage2.addEventListener("change", e => {
                                            readImage(e.target, 2)
                                        })
                                        const inputImage3 = document.getElementById("update_room_img3_file")
                                        inputImage3.addEventListener("change", e => {
                                            readImage(e.target, 3)
                                        })
                                        const inputImage4 = document.getElementById("update_room_img4_file")
                                        inputImage4.addEventListener("change", e => {
                                            readImage(e.target, 4)
                                        })
                                        const inputImage5 = document.getElementById("update_room_img5_file")
                                        inputImage5.addEventListener("change", e => {
                                            readImage(e.target, 5)
                                        })      
                                        room_update_btn.addEventListener("click", function(e) {
                                            room_update_form.submit();
                                        });                                                                             
                                        

                                        //상품삭제 관리버튼
                                        function room_delete_modal(get_room_id) {
                                            //TODO 파라미터 여러개로 받아서 모달로 수정 받기
                                            var room_id = get_room_id;
                                            //삭제모달 데이터 수정
                                            document.getElementById("del_room_id").innerText = room_id;
                                            document.getElementById("room_delete_modal_btn").setAttribute("onclick" ,"location.href='../php/room_delete.php?room_id="+room_id+"'");
                                            
                                        }                                        
                                                                              
                                        //상품추가 이미지 미리보기
                                        function readImage2(input,img_num) {
                                            // 인풋 태그에 파일이 있는 경우
                                            if(input.files && input.files[0]) {
                                                // 이미지 파일인지 검사 (생략)
                                                // FileReader 인스턴스 생성
                                                const reader = new FileReader()
                                                // 이미지가 로드가 된 경우
                                                reader.onload = e => {
                                                    const previewImage = document.getElementById("insert_room_img"+img_num)
                                                    previewImage.src = e.target.result                                                    
                                                    document.getElementById("insert_room_img"+img_num+"_base64").value = reader.result
                                                }
                                                
                                                // reader가 이미지 읽도록 하기
                                                reader.readAsDataURL(input.files[0])
                                            }
                                        }
                                        // input file에 change 이벤트 부여
                                        const insertImage1 = document.getElementById("insert_room_img1_file")
                                        insertImage1.addEventListener("change", e => {
                                            readImage2(e.target, 1)                                            
                                        })
                                        const insertImage2 = document.getElementById("insert_room_img2_file")
                                        insertImage2.addEventListener("change", e => {
                                            readImage2(e.target, 2)
                                        })
                                        const insertImage3 = document.getElementById("insert_room_img3_file")
                                        insertImage3.addEventListener("change", e => {
                                            readImage2(e.target, 3)
                                        })
                                        const insertImage4 = document.getElementById("insert_room_img4_file")
                                        insertImage4.addEventListener("change", e => {
                                            readImage2(e.target, 4)
                                        })
                                        const insertImage5 = document.getElementById("insert_room_img5_file")
                                        insertImage5.addEventListener("change", e => {
                                            readImage2(e.target, 5)
                                        })
                                        
                                        //상품 추가 모달 제출
                                        room_insert_modal_btn.addEventListener("click", function(e) {
                                            room_insert_form.submit();
                                        });
                                    </script>
                                </tbody>
                            </table>
                        </div>
                        <div>
                            <ul class="pagination justify-content-center">
                                <?php
                                if ($num <= 1) {
                                } else {
                                    echo "<li class='page-item'><a class='page-link' href='admin.php?num=1&view=room'>&laquo;</a></li>";
                                }
                                if ($num <= 1) {
                                } else {
                                    $pre = $num - 1;
                                    echo "<li class='page-item'><a class='page-link' href='admin.php?num=$pre&view=room'>&#60;</a></li>";
                                }

                                for ($i = $room_block_start; $i <= $room_block_end; $i++) {
                                    if ($page == $i) {
                                        echo "<li class='page-item active'><a class='page-link'>$i</a></li>"; //현재페이지
                                    } else {
                                        echo "<li class='page-item'><a class='page-link' href='admin.php?num=$i&view=room'>$i</a></li>";
                                    }
                                }

                                if ($num >= $room_total_page) {
                                    // 빈 값
                                } else {
                                    $next = $num + 1;
                                    echo "<li class='page-item'><a class='page-link' href='admin.php?num=$next&view=room'>&gt;</a></li>";
                                }

                                if ($num >= $room_total_page) {
                                    // 빈 값
                                } else {
                                    echo "<li class='page-item'><a class='page-link' href='admin.php?num=$room_total_page&view=room'>&raquo;</a></li>";
                                }

                                ?>
                            </ul>
                        </div> 


                    <?php

                    } else if ($view === "user") {
                    ?>

                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2">유저관리</h1>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>고객고유번호</th>
                                        <th>고객이름</th>
                                        <th>고객 이메일</th>
                                        <th>고객 전화번호</th>
                                        <th>최근 예약일</th>
                                        <th>누적 예약</th>
                                        <th>누적 금액</th>
                                        <th>관리</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    //페이징
                                    //d유저테이블에서 기본으로 처리
                                    $sql_users_all = "SELECT users.user_id FROM reservation, users WHERE reservation.user_id = users.user_id GROUP BY user_id ORDER BY user_id DESC;";
                                    $total_customer_record = mysqli_num_rows(mysqli_query($mysqli, $sql_users_all)); //레코드 총수 카운트

                                    $customer_list = 15; //페이지당 개수
                                    $customer_block_cnt = 10;
                                    $customer_block_num = ceil($num / $customer_block_cnt);
                                    $customer_block_start = (($customer_block_num - 1) * $customer_block_cnt) + 1; // 블록의 시작 번호  ex) 1,6,11 ...
                                    $customer_block_end = $customer_block_start + $customer_block_cnt - 1; // 블록의 마지막 번호 ex) 5,10,15 ...


                                    $customer_total_page = ceil($total_customer_record / $customer_list); //총페이지 갯수 계산
                                    if ($customer_block_end > $customer_total_page) {
                                        $customer_block_end = $customer_total_page;
                                    }
                                    $customer_total_block = ceil($customer_total_page / $customer_block_cnt);
                                    $customer_page_start = ($num - 1) * $customer_list;


                                    //회원별 예약 정보 가져오기 
                                    $customer_15 ="SELECT users.*, COUNT(reservation.user_id) AS cnt, SUM(reservation.res_pay) AS pay_sum, MAX(reservation.res_pay_date) AS last_pay_day FROM reservation, users WHERE reservation.user_id = users.user_id GROUP BY user_id ORDER BY user_id DESC LIMIT " . $customer_page_start . ", " . $customer_list . ";";                                   
                                    $customer_list_result = mysqli_query($mysqli, $customer_15);
                                    while ($customer_page_list = $customer_list_result->fetch_array()) {
                                    ?>
                                        <tr>
                                            <td><?= $customer_page_list['user_id'] ?></td>
                                            <td><?= $customer_page_list['user_name'] ?></td>
                                            <td><?= $customer_page_list['user_email'] ?></td>
                                            <td><?= $customer_page_list['user_tell'] ?></td>
                                            <td><?= $customer_page_list['last_pay_day'] ?></td>
                                            <td><?= $customer_page_list['cnt'] ?> 건</td>
                                            <td><?= $customer_page_list['pay_sum'] ?> ₩</td>
                                            <td>
                                                <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#customer_select_modal" onclick="customer_upate_btn(<?= $customer_page_list['user_id'] ?>)">자세히</button>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                    
                                    
                                    <!--회원별 상세정보 모달-->
                                    <div class="modal fade" id="customer_select_modal" tabindex="-1" aria-labelledby="customer_select_modal_Label" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="customer_select_modal_Label">상세정보</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    회원 번호 : <span id="select_modal_customer_id"></span> 번
                                                    <br>
                                                                                                        
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">닫기</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <script>                                        
                                        //회원예약기록(자사상품만) 관리버튼
                                        function customer_upate_btn(getdate) {
                                            var customer_id = getdate;
                                            
                                            document.getElementById('select_modal_customer_id').innerText = customer_id;
                                            
                                        }                                    
                                    </script>
                                </tbody>
                            </table>
                        </div>
                        <div>
                            <ul class="pagination justify-content-center">
                                <?php
                                if ($num <= 1) {
                                } else {
                                    echo "<li class='page-item'><a class='page-link' href='business.php?num=1&view=customer'>&laquo;</a></li>";
                                }
                                if ($num <= 1) {
                                } else {
                                    $pre = $num - 1;
                                    echo "<li class='page-item'><a class='page-link' href='business.php?num=$pre&view=customer'>&#60;</a></li>";
                                }

                                for ($i = $customer_block_start; $i <= $customer_block_end; $i++) {
                                    if ($page == $i) {
                                        echo "<li class='page-item active'><a class='page-link'>$i</a></li>"; //현재페이지
                                    } else {
                                        echo "<li class='page-item'><a class='page-link' href='business.php?num=$i&view=customer'>$i</a></li>";
                                    }
                                }

                                if ($num >= $customer_total_page) {
                                    // 빈 값
                                } else {
                                    $next = $num + 1;
                                    echo "<li class='page-item'><a class='page-link' href='business.php?num=$next&view=customer'>&gt;</a></li>";
                                }

                                if ($num >= $customer_total_page) {
                                    // 빈 값
                                } else {
                                    echo "<li class='page-item'><a class='page-link' href='business.php?num=$customer_total_page&view=customer'>&raquo;</a></li>";
                                }

                                ?>
                            </ul>
                        </div>
                    <?php
                    } else {
                        echo "ERROR!";
                    }
                    ?>
                </main>
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
</body>

</html>