<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
    <meta charset="utf-8" />
    <title>SIIDIG - SISTEM INFORMASI INDUSTRI GORONTALO</title>
    <meta name="description" content="Creative Agency, Marketing Agency Template">
    <meta name="keywords" content="Creative Agency, Marketing Agency">
    <meta name="author" content="rajesh-doot">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="#2e2a8f">
    <!--plugin-css-->
    <link href="/assets_front/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets_front/css/plugin.min.css" rel="stylesheet">
    <link href="/assets_front/css/swiper.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- template-style-->
    <link href="/assets_front/css/style.css" rel="stylesheet">
    <link href="/assets_front/css/responsive.css" rel="stylesheet">
    <link href="/assets_front/css/darkmode.css" rel="stylesheet">

    <?= $this->renderSection('css') ?>
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body>
    <!--Start Preloader -->
    <div class="onloadpage" id="page_loader">
        <div class="pre-content">
            <div class="logo-pre"><img src="/assets/img/logo-small.png" alt="Logo" class="img-fluid" /></div>
            <div class="pre-text- text-radius text-light text-animation bg-b">SIIDIG - Sistem Informasi Industri Gorontalo</div>
        </div>
    </div>
    <!--End Preloader -->

    <?= $this->renderSection('content'); ?>

    <!--Start Footer-->
    <footer class="footerdez footerdex dark-footer pt50 pb80">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-6 col-sm-12 pt40">
                    <div class="footerdez-a">
                        <h2 class="h4">DINAS KOPERASI UMKM PERINDUSTRIAN DAN PERDAGANGAN PROVINSI GORONTALO</h2>
                        <p class="mt10">Feel free to reach out if you want to collaborate with us, or simply have a call.</p>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="row fttlnks flexend">
                        <div class="col-lg-4 col-sm-6 pt60">
                            <h5>Follow Us</h5>
                            <div class="ff-social-icons mt30">
                                <a href="javascript:void(0)" target="blank"><i class="fab fa-facebook"></i></a>
                                <a href="javascript:void(0)" target="blank"><i class="fab fa-twitter"></i></a>
                                <a href="javascript:void(0)" target="blank"><i class="fab fa-linkedin"></i></a>
                                <a href="javascript:void(0)" target="blank"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-6 pt60">
                            <div class="footer-copyrights-">
                                <p>© 2020-2022. All Rights Reserved By <a href="https://gorontaloprov.go.id" target="blank">pemprov</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--End Footer-->
    <!-- js placed at the end of the document so the pages load faster -->
    <script src="/assets_front/js/vendor/modernizr-3.5.0.min.js"></script>
    <script src="/assets_front/js/jquery.min.js"></script>
    <script src="/assets_front/js/bootstrap.bundle.min.js"></script>
    <script src="/assets_front/js/plugin.min.js"></script>
    <script src="/assets_front/js/swiper.min.js"></script>
    <script src="/assets_front/js/preloader.js"></script>
    <!-- <script src="/assets_front/js/tweenmax.min.js"></script> -->
    <!-- <script src="/assets_front/js/gdprcookies.js"></script> -->
    <script src="/assets_front/js/dark-mode.js"></script>
    <!--common script file-->
    <script src="/assets_front/js/main.js"></script>

    <?= $this->renderSection('script'); ?>
</body>

</html>