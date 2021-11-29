<!--비지니스회원 전용 페이지-->

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
        <?php
            include 'DB/db.php';
            
        ?>
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
                            <li><a class="dropdown-item" href="room_list.php">전체 숙소 목록</a></li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li><a class="dropdown-item" href="room_list.php?roomtpye='#'">팬션</a></li>
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
                    <button class="btn btn-outline-dark" type="button" onclick="location.href='login.php'">
                    <i class="bi bi-box-arrow-in-right me-1"></i>
                    LOGIN
                    </button>
                </form>
            </div>
        </div>
    </nav>
        <!-- Section-->
        <section class="py-5">
           <div>
               <?php
                    include '../DB/db.php';
               ?>
            </div>
            <div>
                <div class="container px-4 px-lg-5 my-5">
                    <div class="row gx-4 gx-lg-5 align-items-center">
                        <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0 center-block"
                                src="https://dummyimage.com/600x700/dee2e6/6c757d.jpg" alt="..." id="content_preview_img"></div>
                        <div class="col-md-6">
                            <div class="small mb-1"><span id="content_author">판매자 이름</span></div>
                            <h1 class="display-5 fw-bolder">
                                <p id="content_title"></p>
                            </h1>
                            <div class="fs-5 mb-5">
                                <span class="text-decoration-line-through">
                                    <a id="content_price0">---</a>원
                                </span>
                                <span>
                                    <a id="content_price1">---</a>원
                                </span>
                            </div>
                            <div>
                                배송 : <span id="content_shipping"></span>&nbsp;<span id="content_shipping_price"></span>
                            </div>
                            <p class="lead" id="content_content">상품 간락 설명</p>
                            <div class="d-flex">
                                <input class="form-control text-center me-3" id="inputQuantity" type="num" value="1"
                                    style="max-width: 3rem">
                                <button class="btn btn-outline-dark flex-shrink-0" type="button"  onclick=paypage()>
                                    <i class="bi-cart-fill me-1"></i>
                                    구매하기
                                </button>
                            </div>
                        </div>
                    </div>
                    <br>
                    <hr>
                    <br>
                    <div>
                       
                    </div>
                </div>
            </div>
            
        </section>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2021</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <
        <!-- Core theme JS-->
        <script src="../js/scripts.js"></script>
    </body>
</html>
