<!--로그인후 회원정보 페이지-->
<?php
session_start(); //세션
include '../DB/db.php';

#여기서 회원정보 출력시키고 회원탈퇴도 가능하게 하기
//회원 정보
$sql_res_count = "SELECT COUNT(*) AS cnt FROM reservation WHERE user_id=" . $_SESSION['user_id'] . ";";
$res_count = mysqli_query($mysqli, $sql_res_count);
$res_count_rows = mysqli_fetch_array($res_count);

//회원 예약 목록
$sql_user_res = "SELECT reservation.*, room.room_name FROM reservation,room WHERE reservation.user_id=" . $_SESSION['user_id'] . " AND room.room_id=reservation.room_id ORDER BY res_pay_date DESC LIMIT 20;";
$res_list = mysqli_query($mysqli, $sql_user_res);
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
                            <li><a class="dropdown-item" href="room_list.php">팬션</a></li>
                            <li><a class="dropdown-item" href="room_list.php">호텔</a></li>
                            <li><a class="dropdown-item" href="room_list.php">모텔</a></li>
                            <li><a class="dropdown-item" href="room_list.php">풀빌라</a></li>
                            <li><a class="dropdown-item" href="room_list.php">리조트/콘도</a></li>
                        </ul>
                    </li>
                </ul>
                <form class="d-flex ms-1">
                    <?php
                    if ($_SESSION['userId'] == null) { //로그인전
                    ?>
                        <button class="btn btn-outline-dark" type="button" onclick="location.href='login.php'">
                            <i class="bi bi-box-arrow-in-right me-1"></i>
                            LOGIN
                        </button>
                        <script>
                            //접근차단
                            alert("로그인이 필요합니다!");
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
    <section class="py-5">
        <div class="container">

            <div class="row align-items-md-stretch mb-4">
                <!--회원정보-->
                <div class="col-md-6">
                    <div class="p-5 text-white bg-dark rounded-3">
                        <p><?= $_SESSION['userId']; ?> 님 반가워요!</p>
                        <p>총 예약 수 : <?= $res_count_rows['cnt']; ?> 건</p>
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
            <div class="p-5 mb-4 bg-light border rounded-3">
                <div class="h-100 p-3 bg-light rounded-3">
                    <h4>예약현황<span class="fs-6">(최근20건)</span></h4>
                    <!--결제 내역 정보(수정, 취소(삭제))-->
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>숙소이름</th>
                                <th>결제일</th>
                                <th>예약시작일</th>
                                <th>예약종료일</th>
                                <th>결제가격</th>
                                <th>변경</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $list_i = 0;
                            while ($res_list_row = $res_list->fetch_array()) {
                                $list_i = $list_i + 1;
                            ?>
                                <tr>
                                    <th scope="row"><?= $list_i ?></th>
                                    <td><a href="room_view.php?room_id=<?= $res_list_row['room_id'] ?>"><?= $res_list_row['room_name'] ?></a></td>
                                    <td><?= $res_list_row['res_pay_date'] ?></td>
                                    <td><?= $res_list_row['res_start'] ?></td>
                                    <td><?= $res_list_row['res_end'] ?></td>
                                    <td><?= $res_list_row['res_pay'] ?></td>
                                    <td><button type="button" class="btn btn-light btn-outline-dark" id="res_update_<?= $list_i ?>btn" data-bs-toggle="modal" data-bs-target="#res_update_modal<?= $list_i ?>">예약 변경</button></td>
                                    <!--예약 모달-->
                                    <script>var today = new Date().toISOString().substring(0, 10);</script>
                                    <div class="modal fade" id="res_update_modal<?= $list_i ?>" tabindex="-1" aria-labelledby="res_update_modal<?= $list_i ?>_Label" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="res_update_modal<?= $list_i ?>_Label">예약 변경</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>예약변경</p>
                                                    <hr>
                                                    <p>결제창에서 결제까지 진행해야 변경이 완료됩니다!</p>
                                                    <form id="res_update_form_<?= $list_i ?>" method="post" action="../php/res_update.php">
                                                        <div class="col-md-6 mb-3">
                                                            <label for="update_start_date<?= $list_i ?>">변경 입실 날짜</label>
                                                            <input type="date" class="form-control" id="update_start_date<?= $list_i ?>" name="update_start_date<?= $list_i ?>" onchange="get_start_date(this.value)" placeholder="" value="<?=$res_list_row['res_start'];?>" required="">
                                                            <div class="invalid-feedback">
                                                                Valid first name is required.ㅜ
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label for="update_end_date<?= $list_i; ?>">변경 퇴실 날짜</label>
                                                            <input type="date" class="form-control" id="update_end_date<?= $list_i ?>" name="update_end_date<?= $list_i ?>" onchange="get_end_date(this.value)" placeholder="" value="<?=$res_list_row['res_end']?>" required="">
                                                        </div>
                                                        <input type="hidden" name="u_res_id" value="<?=$res_list_row['res_id'];?>">
                                                        <input type="hidden" name="u_room_id" value="<?=$res_list_row['room_id'];?>">
                                                        <input type="hidden" name="u_list_i" value="<?= $list_i;?>">
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">닫기</button>
                                                    <button type="button" class="btn btn-primary" form="res_update_form_<?= $list_i ?>" id="res_update_btn" onclick=res_update_form_<?= $list_i ?>.submit()>예약변경</button>
                                                    <button type="button" class="btn btn-danger" onclick="location.href='../php/res_delete.php?res_id=<?= $res_list_row['res_id'] ?>';">예약취소</button>
                                                    <script>
                                                        function get_start_date(getdate) {
                                                            date1 = getdate;
                                                            date1_str = date1.split("-");
                                                            date1_time = new Date(date1_str[0], date1_str[1], date1_str[2]).getTime();
                                                            if (date1 <= today) {
                                                                alert("날짜가 올바르지 않습니다.");
                                                                document.getElementById("update_start_date<?= $list_i ?>").value = today;
                                                            } else if (date1 > date2) {
                                                                alert("날짜가 올바르지 않습니다.");
                                                                document.getElementById("update_start_date<?= $list_i ?>").value = today;
                                                            } else {}
                                                        }
                                                        function get_end_date(getdate) {
                                                            date2 = getdate;
                                                            date2_str = date2.split("-");
                                                            date2_time = new Date(date2_str[0], date2_str[1], date2_str[2]).getTime();

                                                            if (date2 <= today) {
                                                                alert("날짜가 올바르지 않습니다.");
                                                                document.getElementById("update_end_date<?= $list_i ?>").value = today;
                                                            } else if (date2 <= date1) {
                                                                alert("날짜가 올바르지 않습니다.");
                                                                document.getElementById("update_end_date<?= $list_i ?>").value = today;
                                                            } else {

                                                            }
                                                        }
                                                        const res_update_form_<?= $list_i ?> = document.querySelector("#res_update_form_<?= $list_i ?>");
                                                        const res_update_btn = document.querySelector("#res_update_btn");
                                                        res_update_btn.addEventListener("click", function(e) {
                                                                res_update_form_<?= $list_i ?>.submit();                                                          
                                                        });
                                                    </script>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
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
</body>

</html>