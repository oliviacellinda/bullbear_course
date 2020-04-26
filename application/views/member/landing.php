<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bullbear Course</title>

    <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" rel="stylesheet" />
    <link href="<?=base_url('assets/creative/css/styles.css');?>" rel="stylesheet" />
</head>

<body id="page-top">

    <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="#page-top">Bullbear Course</a><button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto my-2 my-lg-0">
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#services">Services</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#portfolio">Portfolio</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#contact">Contact</a></li>
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
                    <p class="text-white-75 font-weight-light mb-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    <a href="<?=base_url('member');?>" class="btn btn-success btn-xl">Continue</a>
                </div>
            </div>
        </div>
    </header>

    <section class="page-section bg-success" id="about">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="text-white mt-0">We've got what you need!</h2>
                    <hr class="divider light my-4" />
                    <p class="text-white-75 mb-4">Start Bootstrap has everything you need to get your new website up and running in no time! Choose one of our open source, free to download, and easy to use themes! No strings attached!</p>
                    <a class="btn btn-light btn-xl js-scroll-trigger" href="#services">Get Started!</a>
                </div>
            </div>
        </div>
    </section>

    <section class="page-section" id="services">
        <div class="container">
            <h2 class="text-center mt-0">At Your Service</h2>
            <hr class="divider my-4" />
            <div class="row">
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="mt-5">
                        <i class="fas fa-4x fa-gem text-success mb-4"></i>
                        <h3 class="h4 mb-2">Sturdy Themes</h3>
                        <p class="text-muted mb-0">Our themes are updated regularly to keep them bug free!</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="mt-5">
                        <i class="fas fa-4x fa-laptop-code text-success mb-4"></i>
                        <h3 class="h4 mb-2">Up to Date</h3>
                        <p class="text-muted mb-0">All dependencies are kept current to keep things fresh.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="mt-5">
                        <i class="fas fa-4x fa-globe text-success mb-4"></i>
                        <h3 class="h4 mb-2">Ready to Publish</h3>
                        <p class="text-muted mb-0">You can use this design as is, or you can make changes!</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="mt-5">
                        <i class="fas fa-4x fa-heart text-success mb-4"></i>
                        <h3 class="h4 mb-2">Made with Love</h3>
                        <p class="text-muted mb-0">Is it really open source if it's not made with love?</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="portfolio">
        <div class="container-fluid p-0">
            <div class="row no-gutters">
                <div class="col-lg-4 col-sm-6">
                    <a class="portfolio-box" href="<?=base_url('assets/creative/assets/img/portfolio/fullsize/1.jpg');?>"
                        ><img class="img-fluid" src="<?=base_url('assets/creative/assets/img/portfolio/thumbnails/1.j');?>pg" alt="" />
                        <div class="portfolio-box-caption">
                            <div class="project-category text-white-50">Category</div>
                            <div class="project-name">Project Name</div>
                        </div></a
                    >
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a class="portfolio-box" href="<?=base_url('assets/creative/assets/img/portfolio/fullsize/2.jpg');?>"
                        ><img class="img-fluid" src="<?=base_url('assets/creative/assets/img/portfolio/thumbnails/2.j');?>pg" alt="" />
                        <div class="portfolio-box-caption">
                            <div class="project-category text-white-50">Category</div>
                            <div class="project-name">Project Name</div>
                        </div></a
                    >
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a class="portfolio-box" href="<?=base_url('assets/creative/assets/img/portfolio/fullsize/3.jpg');?>"
                        ><img class="img-fluid" src="<?=base_url('assets/creative/assets/img/portfolio/thumbnails/3.j');?>pg" alt="" />
                        <div class="portfolio-box-caption">
                            <div class="project-category text-white-50">Category</div>
                            <div class="project-name">Project Name</div>
                        </div></a
                    >
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a class="portfolio-box" href="<?=base_url('assets/creative/assets/img/portfolio/fullsize/4.jpg');?>"
                        ><img class="img-fluid" src="<?=base_url('assets/creative/assets/img/portfolio/thumbnails/4.j');?>pg" alt="" />
                        <div class="portfolio-box-caption">
                            <div class="project-category text-white-50">Category</div>
                            <div class="project-name">Project Name</div>
                        </div></a
                    >
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a class="portfolio-box" href="<?=base_url('assets/creative/assets/img/portfolio/fullsize/5.jpg');?>"
                        ><img class="img-fluid" src="<?=base_url('assets/creative/assets/img/portfolio/thumbnails/5.j');?>pg" alt="" />
                        <div class="portfolio-box-caption">
                            <div class="project-category text-white-50">Category</div>
                            <div class="project-name">Project Name</div>
                        </div></a
                    >
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a class="portfolio-box" href="<?=base_url('assets/creative/assets/img/portfolio/fullsize/6.jpg');?>"
                        ><img class="img-fluid" src="<?=base_url('assets/creative/assets/img/portfolio/thumbnails/6.j');?>pg" alt="" />
                        <div class="portfolio-box-caption p-3">
                            <div class="project-category text-white-75">Category</div>
                            <div class="project-name">Project Name</div>
                        </div></a
                    >
                </div>
            </div>
        </div>
    </section>

    <section class="page-section" id="contact">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="mt-0">Let's Get In Touch!</h2>
                    <hr class="divider my-4" />
                    <p class="text-muted mb-5">Ready to start your next project with us? Give us a call or send us an email and we will get back to you as soon as possible!</p>
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
        <div class="container"><div class="small text-center text-muted">Copyright © 2020 - Bullbear Course</div></div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    <script src="<?=base_url('assets/creative/js/scripts.js');?>"></script>

</body>
</html>