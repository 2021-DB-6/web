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
                            <li><a class="dropdown-item" href="room_list.php?type=pension">펜션</a></li>
                            <li><a class="dropdown-item" href="room_list.php?type=hotel">호텔</a></li>
                            <li><a class="dropdown-item" href="room_list.php?type=motel">모텔</a></li>
                            <li><a class="dropdown-item" href="room_list.php?type=poolvilla">풀빌라</a></li>
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
                                    <button class="btn btn-sm btn-outline-secondary">Share</button>
                                    <button class="btn btn-sm btn-outline-secondary">Export</button>
                                </div>
                            </div>
                        </div>
                        <h2>신규회원 현황</h2>
                        <div class="table-responsive">
                            <table class="table table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>고유번호</th>
                                        <th>이메일</th>
                                        <th>이름</th>
                                        <th>구분</th>
                                        <th>관리</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    ?>
                                    <tr>
                                        <td>1,001</td>
                                        <td>Lorem</td>
                                        <td>ipsum</td>
                                        <td>dolor</td>
                                        <td>드롭다운관리</td>
                                    </tr>
                                    <?php

                                    ?>
                                </tbody>
                            </table>
                        </div>
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
                                    $res_block_cnt = 15;
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
                                            <td><?= $res_page_list['room_name'] ?>_(<?= $res_page_list['room_id'] ?>)</td>
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


                    <?php

                    } else if ($view === "user") {
                    ?>

                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2">고객관리</h1>
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