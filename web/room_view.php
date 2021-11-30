<!--숙소 상세 페이지-->

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
                        <?php
                    } else {  //로그인후
                        if ($_SESSION['usergroups'] == 'user') { //일반유저일떄
                        ?>
                            <button class="btn btn-outline-dark ms-2" type="button" onclick="location.href='web/mypage.php'">
                                <?php echo $_SESSION['userId'] ?>&nbsp;님
                            </button>
                            <button class="btn btn-outline-dark ms-1" type="button" onclick="location.href='php/logout.php'">
                                <i class="bi bi-box-arrow-in-right me-1"></i>
                                LOGOUT
                            </button>
                        <?php
                        } else if ($_SESSION['usergroups'] == 'business') { //비지니스회원일떄
                        ?>
                            <button class="btn btn-outline-dark ms-2" type="button" onclick="location.href='web/business.php'">
                                <?php echo $_SESSION['userId'] ?>&nbsp;님
                            </button>

                            <button class="btn btn-outline-dark ms-1" type="button" onclick="location.href='php/logout.php'">
                                <i class="bi bi-box-arrow-in-right me-1"></i>
                                LOGOUT
                            </button>
                        <?php
                        } else { //관리자일때
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
        <div>
            <?php
            include '../DB/db.php';
            $roomid = $_GET['room_id'];
            $sql_room_buiss_view = "SELECT * FROM room,users WHERE room.user_id=users.user_id AND room.room_id=$roomid;";
            $room_result = mysqli_query($mysqli, $sql_room_buiss_view);
            $row = mysqli_fetch_assoc($room_result);

            ?>
        </div>
        <div>
            <div class="container px-4 px-lg-5 my-5">
                <div class="row gx-4 gx-lg-5 align-items-center">
                    <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0 center-block" src="<?php echo 'data:image/bmp;base64,' . base64_encode($row['room_img1']) ?>" alt="..." id="content_preview_img">
                    </div>
                    <div class="col-md-6">
                        <div class="small mb-1"><span id="content_author">
                                <?php if ($row['room_type'] == 'resort') {
                                    echo "리조트";
                                } elseif ($row['room_type'] == 'pension') {
                                    echo "펜션";
                                } elseif ($row['room_type'] == 'hotel') {
                                    echo "호텔";
                                } elseif ($row['room_type'] == 'motel') {
                                    echo "모텔";
                                } elseif ($row['room_type'] == 'poolvilla') {
                                    echo "풀빌라";
                                } elseif ($row['room_type'] == 'pension') {
                                    echo "펜션";
                                } else {
                                    echo "기타";
                                }
                                ?>
                            </span></div>
                        <span>
                            <?= $row['user_name']; ?>
                        </span>
                        <h1 class="display-5 fw-bolder">
                            <p>
                                <?= $row['room_name']; ?>
                            </p>
                        </h1>
                        <div class="fs-5 mb-5">
                            <span>
                                <a>
                                    <?= $row['room_price']; ?>
                                </a>원
                            </span>
                        </div>
                        <div>
                            편의시설 :&nbsp;
                            <?= $row['room_info'] ?>
                        </div>
                        <p class="lead">
                            <?= $row['room_name'] ?>
                        </p>
                        <div>
                            <!--여기에 달력넣어서 예약현황 표시-->
                        </div>
                        <div class="d-flex">
                            <input class="form-control text-center me-3" id="inputQuantity" type="num" value="1" style="max-width: 3rem">
                            <button class="btn btn-outline-dark flex-shrink-0" type="button" onclick="location.href='checkout.php?room_id=<?= $roomid; ?>'">
                                <i class="bi-cart-fill me-1"></i>
                                예약하기
                            </button>
                        </div>
                    </div>
                </div>
                <br>
                <hr>
                <br>
                <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
                <script>
                    $('.carousel').carousel({
                                interval: 2000 //기본 5초 }) 
                </script>
                <div>
                    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <?php
                            for ($i = 2; $i < 6; $i = $i + 1) {
                                $img_num = "room_img$i";
                                if(isset($row[$img_num])){
                                    
                            ?>
                                <div class="carousel-item active">
                                    <img src="<?php echo 'data:image/bmp;base64,' . base64_encode($row[$img_num]) ?>" class="d-block w-100" alt="...">
                                </div>
                            <?php
                                } else{
                                    
                                }
                            }
                            ?>

                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
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
</body>

</html>