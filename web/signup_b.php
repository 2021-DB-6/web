<?php
    include '../DB/db.php';
    $useremail;
    $userpasswd0;
    $userpasswd1;
    $useraddr;
    $username;
    $sql = "SELECT user_email FROM users WHERE user_email = '$useremail' "
    

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
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="../index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">숙소 상품</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="room_view.php">전체 숙소 목록</a></li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li><a class="dropdown-item" href="room_view.php?roomtpye='#'">팬션</a></li>
                            <li><a class="dropdown-item" href="#!">호텔</a></li>
                            <li><a class="dropdown-item" href="#!">모텔</a></li>
                            <li><a class="dropdown-item" href="#!">풀빌라</a></li>
                            <li><a class="dropdown-item" href="#!">리조트/콘도</a></li>
                        </ul>
                    </li>
                </ul>
                <form class="d-flex">
                    <button class="btn btn-outline-dark" type="submit">
                        <i class="bi-cart-fill me-1"></i>
                        Cart
                        <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                    </button>
                </form>
                <form class="d-flex ms-1">
                    <button class="btn btn-outline-dark" type="button" onclick="location.href='signup.php'">
                    <i class="bi bi-box-arrow-in-right me-1"></i>
                    LOGIN
                    </button>
                </form>
            </div>
        </div>
    </nav>
    <!-- Header-->
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">비지니스 회원가입</h1>
            </div>
        </div>
    </header>
    <!-- Section-->
    <section class="py-5">
        <div>
            <div class="container">
                <div class="input-form-backgroud row">
                    <div class="input-form col-md-12 mx-auto">
                        <form class="validation-form" id="signupform" method="post" action="../php/signup_b_insert.php" novalidate >
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name">회사명</label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="" value="" required />
                                    <div class="invalid-feedback">상호을 입력해주세요.</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email">대표이메일</label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="you@example.com" required />
                                    <div class="invalid-feedback">로그인 이메일을 입력해주세요.</div>
                                </div>                                
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="password">비밀번호</label>
                                    <input type="password" class="form-control" name="password0" id="password0" placeholder="" value="" required />
                                    <div class="invalid-feedback">비밀번호을 입력해주세요.</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="password">비밀번호 재입력</label>
                                    <input type="password" class="form-control" name="password1" id="password1" placeholder="" value="" required />
                                    <div class="invalid-feedback">비밀번호을 입력해주세요.</div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="address">사업지 주소</label>
                                <input type="text" class="form-control" name="address" id="address" placeholder="서울특별시 강남구" required />
                                <div class="invalid-feedback">주소를 입력해주세요.</div>
                            </div>
                            <div class="mb-3">
                                <label for="addr_num">사업지 우편번호</label>
                                <input type="text" class="form-control"name="addr_num" id="addr_num" placeholder="우편번호5자리" />
                            </div>
                            <div class="mb-3">
                                <label for="tell">대표 전화번호</label>
                                <input type="text" class="form-control" name="tell" id="tell" placeholder="전화번호 입력(-제외)" />
                            </div>
                            <div class="mb-3">
                                <label for="tell">사업자등록번호</label>
                                <input type="text" class="form-control" name="business_num" id="user_business_num" placeholder="사업자번호 입력(-제외)" />
                            </div>
                            <hr class="mb-4" />
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="aggrement" required />
                                <label class="custom-control-label" for="aggrement">개인정보 수집 및 이용에 동의합니다.</label>
                            </div>
                            <div class="mb-4"></div>
                            <button class="btn btn-primary btn-lg btn-block" type="button" id="signupbtn">
                                가입 완료
                            </button>
                        </form>
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
        <script>
        const signupForm = document.querySelector("#signupform");
        const signupButton = document.querySelector("#signupbtn");
        const password0 = document.querySelector("#password0");
        const password1 = document.querySelector("#password1");
        signupButton.addEventListener("click", function(e) {
            if(password0.value&& password0.value === password1.value){
                
            signupForm.submit();
            }else{
                alert("비밀번호가 서로 일치하지 않습니다");
            }
        });
    </script>
</body>

</html>