<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bullbear Course</title>

    <link href="https://use.fontawesome.com/releases/v5.13.0/css/all.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" rel="stylesheet" />
    <link href="<?=base_url('assets/creative/css/styles.css');?>" rel="stylesheet" />
    <link href="<?=base_url('assets/Source_Sans_Pro/font.css');?>" rel="stylesheet" />

    <style>
        .btn-with-arrow {
            width: 200px !important;
            padding-left: 43px;
            transition: 1s;
        }
        .btn-with-arrow:hover {
            padding-left: 30px;
        }
        .btn-with-arrow:after {
            font-family: "Font Awesome 5 Free";
            content: "\f061";
            opacity: 0;
            position: relative;
            right: -30px;
            transition: 1s;
        }
        .btn-with-arrow:hover:after {
            opacity: 1;
            right: -15px;
        }
    </style>
</head>

<body id="page-top">

    <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="#page-top">Bullbear Course</a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto my-2 my-lg-0">
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#about">About Us</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#portfolio">Our Best Selection</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#contact">Our Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="masthead">
        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-center text-center">
                <div class="col-lg-10 align-self-end">
                    <h1 class="text-uppercase text-white font-weight-bold">Bullbear Course</h1>
                    <hr class="divider my-4">
                </div>
                <div class="col-lg-8 align-self-baseline">
                    <p class="text-white-75 mb-5">Di Bullbear Course, kami berkomitmen untuk memberikan course trading terbaik.</p>
                    <a href="<?=base_url('member');?>" class="btn btn-success btn-xl btn-with-arrow">Continue</a>
                </div>
            </div>
        </div>
    </header>

    <section class="page-section" id="about">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h2 class="mt-0">About Us</h2>
                    <hr class="divider my-4" />
                    <p class="text-muted mb-5">Bullbear Course menyediakan materi dan konsultasi trading bagi Anda yang masih pemula maupun yang telah memiliki pengalaman sebelumnya. Temukan berbagai pilihan materi trading, mulai dari pengenalan stock trading, teknik analisis dasar, hingga teknik analisis lanjut untuk investasi harian.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mt-5 d-flex">
                        <i class="fas fa-4x fa-user-plus text-success mt-2 mb-4 mr-3"></i>
                        <div>
                            <h3 class="h4 mb-2">Proses Registrasi Mudah</h3>
                            <p class="text-muted mt-3 mb-0">Cukup dengan menyelesaikan formulir registrasi, Anda dapat memperoleh akses daftar berbagai materi trading.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mt-5 d-flex">
                        <div class="fa-4x text-success mr-3">
                            <span class="fa-layers fa-fw">
                                <i class="fas fa-scroll"></i>
                                <i class="fas fa-star fa-inverse" data-fa-transform="shrink-13 up-5"></i>
                                <i class="fas fa-grip-lines fa-inverse font-weight-light" data-fa-transform="shrink-7"></i>
                            </span>
                        </div>
                        <div>
                            <h3 class="h4 mb-2">Materi Berkualitas</h3>
                            <p class="text-muted mt-3 mb-0">Pilihan materi yang luas dan dibahas secara mendalam akan membantu Anda memahami materi yang Anda cari dengan cepat.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mt-5 d-flex">
                        <div class="fa-4x text-success mr-3">
                            <span class="fa-layers fa-fw">
                                <i class="fas fa-book-open" data-fa-transform="shrink-5 up-5"></i>
                                <i class="fas fa-hand-pointer" data-fa-transform="shrink-8 down-5"></i>
                            </span>
                        </div>
                        <div>
                            <h3 class="h4 mb-2">Akses Tak Terbatas</h3>
                            <p class="text-muted mt-3 mb-0">Materi yang telah Anda peroleh akan menjadi milik Anda selamanya dan dapat Anda akses 24/7.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mt-5 d-flex">
                        <i class="fas fa-4x fa-phone-alt text-success mt-2 mb-4 mr-3"></i>
                        <div>
                            <h3 class="h4 mb-2">Layanan Konsultasi</h3>
                            <p class="text-muted mt-3 mb-0">Kesulitan dalam memahami materi? Kami memberikan layanan konsultasi bagi Anda yang membutuhkan penjelasan lebih mendalam.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="portfolio" class="page-section bg-light">
        <div class="container">
            <h2 class="text-center mt-0">Our Best Selection</h2>
            <hr class="divider my-4" />
            <div class="row">
                <div class="col-sm-4">
                    <img class="card-img-top" src="<?=base_url('assets/creative/assets/img/portfolio/fullsize/1.jpg');?>" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <img class="card-img-top" src="<?=base_url('assets/creative/assets/img/portfolio/fullsize/2.jpg');?>" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <img class="card-img-top" src="<?=base_url('assets/creative/assets/img/portfolio/fullsize/3.jpg');?>" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="page-section" id="contact">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h2 class="mt-0">Our Contact</h2>
                    <hr class="divider my-4" />
                    <p class="text-muted mb-5">Untuk konsultasi materi dan informasi lebih lanjut, hubungi kami atau kirimkan pertanyaan Anda ke kontak kami di bawah ini.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 ml-auto text-center mb-5 mb-lg-0">
                    <i class="fas fa-phone fa-3x mb-3 text-muted"></i>
                    <div>+1 (555) 123-4567</div>
                </div>
                <div class="col-lg-4 mr-auto text-center">
                        <i class="fas fa-envelope fa-3x mb-3 text-muted"></i>
                        <a class="d-block" href="mailto:contact@yourwebsite.com">contact@yourwebsite.com</a>
                    </div>
            </div>
        </div>
    </section>

    <footer class="bg-light py-5">
        <div class="container">
            <div class="small text-center text-muted">Copyright © 2020 - Bullbear Course</div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    <script src="<?=base_url('assets/creative/js/scripts.js');?>"></script>

</body>
</html>