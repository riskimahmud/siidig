<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>

    <link rel="stylesheet" href="assets_front/vegas/vegas.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <style>
        .bg-purple {
            background-color: #6f42c1;
        }
    </style>
</head>

<body>
    <main class="text-white">
        <div class="px-4 py-5 my-5 text-center">
            <img class="d-block mx-auto mb-4" src="/assets/img/logo-provinsi.png" alt="" width="100">
            <h1 class="display-1 fw-bold">Selamat Datang</h1>
            <div class="col-lg-6 mx-auto">
                <p class="display-6 mb-4">Sistem Informasi Industri Gorontalo</p>
                <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                    <a href="/home" class="px-4 py-2 rounded rounded-pill bg-purple text-decoration-none h5 text-white"><i class="bi bi-box-arrow-in-right"></i> Selengkapnya</a>
                </div>
            </div>
        </div>
    </main>

    <script src="http://code.jquery.com/jquery.min.js"></script>
    <script src="assets_front/vegas/vegas.min.js"></script>
    <script>
        $("#example, body").vegas({
            delay: 7000,
            timer: false,
            shuffle: true,
            color: '#000',
            firstTransition: 'fade',
            firstTransitionDuration: 5000,
            transition: ['fade2', 'zoomOut2', 'slideDown2'],
            transitionDuration: 2000,
            animation: ['kenburnsUp', 'kenburnsDown', 'kenburnsLeft', 'kenburnsRight'],
            slides: [{
                    src: "/assets_front/img/1.jpg"
                },
                {
                    src: "/assets_front/img/2.jpg"
                },
                {
                    src: "/assets_front/img/3.jpg"
                },
                {
                    src: "/assets_front/img/4.jpg"
                }
            ],
            // overlay: '/assets_front/vegas/overlays/03.png'
        });
    </script>
</body>

</html>