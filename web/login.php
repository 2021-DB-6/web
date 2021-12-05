<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>숙소예약하기</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="../src/favicon.ico" />
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
                    <button class="btn btn-outline-dark ms-2" type="button" onclick="location.href='mypage.php'">
                        <?php echo $_SESSION['userId'] ?>&nbsp;님
                    </button>
                    <button class="btn btn-outline-dark ms-1" type="button" onclick="location.href='../php/logout.php'">
                        <i class="bi bi-box-arrow-in-right me-1"></i>
                        LOGOUT
                    </button>
                    <script>
                        alert("이미로그인 되어있습니다")
                        location.href = "../index.php";
                    </script>
                    <?php            
                                }else if($_SESSION['usergroups']=='business'){ //비지니스회원일떄
                                ?>
                    <button class="btn btn-outline-dark ms-2" type="button" onclick="location.href='business.php'">
                        <?php echo $_SESSION['userId'] ?>&nbsp;님
                    </button>

                    <button class="btn btn-outline-dark ms-1" type="button" onclick="location.href='..php/logout.php'">
                        <i class="bi bi-box-arrow-in-right me-1"></i>
                        LOGOUT
                    </button>
                    <script>
                        alert("이미로그인 되어있습니다")
                        location.href = "../index.php";
                    </script>
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
                    <script>
                        alert("이미로그인 되어있습니다")
                        location.href = "../index.php";
                    </script>
                    <?php
                                }
                            }
                        ?>
                </form>
            </div>
        </div>
    </nav>
    <!-- Header-->
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">로그인</h1>
            </div>
        </div>
    </header>
    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row">
                <form method="POST" action="../php/login_select.php" id="login-form" class="validation-form">
                    <div class="form-floating justify-content-center mb-2">
                        <input type="email" class="form-control" name="email" id="floatingemail"
                            placeholder="name@example.com">
                        <label for="floatingemail">이메일</label>
                    </div>
                    <div class="form-floating mb-4">
                        <input type="password" class="form-control" name="password" id="floatingPassword"
                            placeholder="Password">
                        <label for="floatingPassword">비밀번호</label>
                    </div>
                    <div class="row">
                        <div class="d-flex mb-2">
                            <button class="w-100 btn btn-lg btn-primary btn-space" type="submit">로그인</button>
                        </div>
                        <br>
                    </div>
                </form>
                <div class="d-flex mb-2">
                    <button class="w-100 btn btn-lg btn-info btn-space" type="button"
                        onclick="location.href='./signup.php'">회원가입</button>
                </div>
            </div>
        </div>

    </section>
    <!-- Footer-->
    <footer class="py-5 bg-dark fixed-bottom">
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