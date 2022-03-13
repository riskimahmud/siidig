<?= $this->extend('layout/frontend'); ?>

<?= $this->section('content'); ?>
<!--Start Header -->
<header class="nav-bg-b main-header navfix fixed-top menu-white">
    <div class="container-fluid m-pad">
        <div class="menu-header">
            <div class="dsk-logo"><a class="nav-brand" href="./">
                    <img src="/assets/img/logo-white.png" alt="Logo" class="mega-white-logo" />
                    <img src="/assets/img/logo-purple.png" alt="Logo" class="mega-darks-logo" />
                </a>
            </div>
            <div class="custom-nav" role="navigation">
                <ul class="nav-list onepge">
                    <li><a href="#home" class="menu-links">Home</a></li>
                    <li><a href="#stat" class="menu-links">Statistik</a></li>
                    <li><a href="#info" class="menu-links">Info</a></li>
                    <li><a href="#about" class="menu-links">Tentang</a></li>
                    <li><a href="#course" class="menu-links">Pelatihan</a></li>
                    <li><a href="#news" class="menu-links">Berita</a></li>
                    <li><a href="#contact" class="menu-links">Kontak</a></li>
                </ul>
                <!-- mobile + desktop - sidebar menu- dark mode witch and button -->
                <ul class="nav-list right-end-btn">
                    <li class="hidedesktop darkmodeswitch">
                        <div class="switch-wrapper"> <label class="switch" for="niwax"> <input type="checkbox" id="niwax" /> <span class="slider round"></span> </label> </div>
                    </li>
                    <li class="navm- hidedesktop"> <a class="toggle" href="#"><span></span></a></li>
                </ul>
            </div>
        </div>

        <!--Mobile Menu-->
        <nav id="main-nav">
            <ul class="first-nav">
                <li><a href="#home" class="menu-links">Home</a></li>
                <li><a href="#stat" class="menu-links">Statistik</a></li>
                <li><a href="#info" class="menu-links">Info</a></li>
                <li><a href="#about" class="menu-links">Tentang</a></li>
                <li><a href="#course" class="menu-links">Pelatihan</a></li>
                <li><a href="#news" class="menu-links">Berita</a></li>
                <li><a href="#contact" class="menu-links">Kontak</a></li>
            </ul>
        </nav>
    </div>
</header>
<!--End Header -->

<!--Start Hero-->
<section class="hero-slider hero-style" id="home">
    <div class="swiper-container">
        <!-- start swiper-wrapper -->
        <div class="swiper-wrapper">
            <?php if ($header) : ?>
                <?php foreach ($header as $h) : ?>
                    <div class="swiper-slide">
                        <div class="slide-inner slide-bg-image" data-background="uploads/header/<?= $h['gambar']; ?>">
                            <div class="container">
                                <div data-swiper-parallax="300" class="slide-title">
                                    <h2><?= $h['title'] ?></h2>
                                </div>
                                <div data-swiper-parallax="400" class="slide-text">
                                    <p><?= $h['subtitle'] ?></p>
                                </div>
                                <div class="clearfix"></div>
                                <?php if ($h['link'] != "") : ?>
                                    <div data-swiper-parallax="500" class="slide-btns">
                                        <a href="<?= $h['link'] ?>" class="btn-main bg-btn lnk">Kunjungi <i class="fas fa-chevron-right fa-icon"></i><span class="circle"></span></a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <!--slider 1 start -->
            <?php else : ?>
                <div class="swiper-slide">
                    <div class="slide-inner slide-bg-image" data-background="assets_front/images/hero/3.png">
                        <div class="container">
                            <div data-swiper-parallax="300" class="slide-title">
                                <h2>Sistem Informasi Industri Gorontalo</h2>
                            </div>
                            <div data-swiper-parallax="400" class="slide-text">
                                <p>We are enabling digital transformation for our clients since 1999 by providing tailored solutions</p>
                            </div>
                            <div class="clearfix"></div>
                            <div data-swiper-parallax="500" class="slide-btns">
                                <a href="/login" class="btn-main bg-btn lnk">Login <i class="fas fa-chevron-right fa-icon"></i><span class="circle"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <!--slider 1 end -->
        </div>
        <!-- end swiper-wrapper -->
        <!-- swipper controls -->
        <div class="swiper-pagination"></div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <!-- swipper controls -->
    </div>
</section>
<!--End Hero-->


<!--Start About-->
<section class="about-sec-app pad-tb pt60 dark-bg2" id="stat">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="common-heading text-l">
                    <h2 class="mb30"><span class="text-second text-bold">Statistik</span> Industri Di Provinsi Gorontalo</h2>
                    <p class="mt3"> <span class="text-bold">Lorem Ipsumis simply dummy text of the printing and typesetting industry. Simply dummy text of the printing and typesetting industry. </span></p>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="funfact">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-6 col-6">
                            <div class="tilt-outer" data-tilt data-tilt-max="20" data-tilt-speed="1000">
                                <div class="funfct tilt-inner">
                                    <img src="/assets_front/images/icons/house.svg" alt="niwax app development template">
                                    <span class="services-cuntr counter">
                                        <?= round(singkat_angka($count->unit_usaha, 'angka')); ?>
                                    </span>
                                    <span class="services-cuntr"><?= singkat_angka($count->unit_usaha, 'simbol'); ?>+</span>
                                    <p>Unit Usaha</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-6">
                            <div class="tilt-outer" data-tilt data-tilt-max="20" data-tilt-speed="1000">
                                <div class="funfct tilt-inner">
                                    <img src="/assets_front/images/icons/teama.svg" alt="niwax app development template">
                                    <span class="services-cuntr counter">
                                        <?= round(singkat_angka($count->tenaga_kerja, 'angka')); ?>
                                    </span>
                                    <span class="services-cuntr"><?= singkat_angka($count->tenaga_kerja, 'simbol'); ?>+</span>
                                    <p>Tenaga Kerja</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-6">
                            <div class="tilt-outer" data-tilt data-tilt-max="20" data-tilt-speed="1000">
                                <div class="funfct tilt-inner">
                                    <img src="/assets_front/images/icons/money.svg" alt="niwax app development template">
                                    <span class="services-cuntr counter">
                                        <?= round(singkat_angka($count->nilai_investasi . "000", 'angka')); ?>
                                    </span>
                                    <span class="services-cuntr"><?= singkat_angka($count->nilai_investasi . "000", 'simbol'); ?>+</span>
                                    <p>Nilai Investasi</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-6">
                            <div class="tilt-outer" data-tilt data-tilt-max="20" data-tilt-speed="1000">
                                <div class="funfct tilt-inner">
                                    <img src="/assets_front/images/icons/money-growth.svg" alt="niwax app development template">
                                    <span class="services-cuntr counter">
                                        <?= round(singkat_angka($count->nilai_produksi . "000", 'angka')); ?>
                                    </span>
                                    <span class="services-cuntr"><?= singkat_angka($count->nilai_produksi . "000", 'simbol'); ?>+</span>
                                    <p>Nilai Produksi</p>
                                </div>
                            </div>
                        </div>

                        <div class="-cta-btn mt70">
                            <div class="free-cta-title v-center  wow zoomInDown" data-wow-delay=".9s">
                                <a href="#" class="btn-main bg-btn2 lnk">Selengkapnya... <i class="fas fa-chevron-right fa-icon"></i><span class="circle"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--End About-->

<!--Start Service-->
<section class="service-section service-2 pad-tb" id="info">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="common-heading">
                    <span>Informasi</span>
                    <h2 class="mb30">Informasi Penting</h2>
                </div>
            </div>
        </div>
        <div class="row upset link-hover">
            <div class="col-lg-6 col-sm-6 mt30 wow fadeInUp" data-wow-delay=".2s">
                <div class="wide-block service-img1" data-tilt data-tilt-max="2" data-tilt-speed="600">
                    <div class="block-space-">
                        <!-- <span>PPC</span> -->
                        <h4>Syarat Kemasan</h4>
                        <a href="javascript:void(0)">Selengkapnya... <i class="fas fa-chevron-right fa-icon"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-sm-6 mt30  wow fadeInUp" data-wow-delay=".4s">
                <div class="wide-block service-img2" data-tilt data-tilt-max="2" data-tilt-speed="600">
                    <div class="block-space-">
                        <!-- <span>MARKETING </span> -->
                        <h4>Syarat Halal</h4>
                        <a href="javascript:void(0)">Selengkapnya... <i class="fas fa-chevron-right fa-icon"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-sm-6 mt30  wow fadeInUp" data-wow-delay=".6s">
                <div class="wide-block service-img3" data-tilt data-tilt-max="2" data-tilt-speed="600">
                    <div class="block-space-">
                        <!-- <span>SEO</span> -->
                        <h4>Syarat PKP</h4>
                        <a href="javascript:void(0)">Selengkapnya... <i class="fas fa-chevron-right fa-icon"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-sm-6 mt30  wow fadeInUp" data-wow-delay=".8s">
                <div class="wide-block service-img4" data-tilt data-tilt-max="2" data-tilt-speed="600">
                    <div class="block-space-">
                        <!-- <span>WEB DESIGN</span> -->
                        <h4>Syarat HKI</h4>
                        <a href="javascript:void(0)">Selengkapnya... <i class="fas fa-chevron-right fa-icon"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="-cta-btn mt70">
            <div class="free-cta-title v-center  wow zoomInDown" data-wow-delay=".9s">
                <p>Let's Start A <span>New Project Together</span></p>
                <a href="#" class="btn-main bg-btn2 lnk">Request A Quote <i class="fas fa-chevron-right fa-icon"></i><span class="circle"></span></a>
            </div>
        </div> -->
    </div>
</section>
<!--End Service-->

<!--why choose-->
<section class="why-choos-lg-nx pad-tb deep-dark bg-gradient10" id="about">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="common-heading text-l">
                    <span>Tentang Kami</span>
                    <h2 class="mb20">DINAS KOPERASI UMKM PERINDUSTRIAN DAN PERDAGANGAN PROVINSI GORONTALO</h2>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                    <div class="itm-media-object mt40 tilt-3d">
                        <div class="media">
                            <div class="img-ab- base" data-tilt data-tilt-max="20" data-tilt-speed="1000"><img src="/assets_front/images/icons/computers.svg" alt="icon" class="layer"></div>
                            <div class="media-body">
                                <h4>Streamlined Project Management</h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc aliquet ligula nec leo elementum semper. Mauris aliquet egestas metus.</p>
                            </div>
                        </div>
                        <div class="media mt40">
                            <div class="img-ab- base" data-tilt data-tilt-max="20" data-tilt-speed="1000"><img src="/assets_front/images/icons/worker.svg" alt="icon" class="layer"></div>
                            <div class="media-body">
                                <h4>A Dedicated Team of Experts</h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc aliquet ligula nec leo elementum semper. Mauris aliquet egestas metus.</p>
                            </div>
                        </div>
                        <div class="media mt40">
                            <div class="img-ab- base" data-tilt data-tilt-max="20" data-tilt-speed="1000"> <img src="/assets_front/images/icons/deal.svg" alt="icon" class="layer"></div>
                            <div class="media-body">
                                <h4>Completion of Project in Given Time</h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc aliquet ligula nec leo elementum semper. Mauris aliquet egestas metus.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div data-tilt data-tilt-max="5" data-tilt-speed="1000" class="single-image wow fadeIn" data-wow-duration="2s"><img src="/assets_front/images/custom/kantor.jpeg" alt="image" class="w-100"></div>
                <p class="text-center mt30">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                <div class="cta-card mt60 text-center">
                    <h3 class="mb20">Let's Start a <span class="text-second text-bold">New Project</span> Together</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc aliquet ligula nec leo elementum semper.</p>
                    <a href="#" class="btn-outline lnk mt30">Request A Quote <i class="fas fa-chevron-right fa-icon"></i><span class="circle"></span></a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--End why choose-->

<!--Start Portfolio-->
<section class="portfolio-section-nx pad-tb" id="course">
    <div class="container">
        <div class="row justify-content-center ">
            <div class="col-lg-8">
                <div class="common-heading">
                    <span>Pelatihan</span>
                    <h2 class="mb0">Pelatihan Yang Kami Laksanakan</h2>
                </div>
            </div>
        </div>
        <div class="row mt60">

            <div class="row justify-content-center">
                <?php if ($pelatihan) : ?>
                    <?php foreach ($pelatihan as $pel) : ?>
                        <div class="col-lg-4 col-sm-6 shape-loc wow fadeIn" data-wow-delay=".2s">
                            <div class="office-card hoshd">
                                <div class="landscp">
                                    <img src="/uploads/pelatihan/thumb_<?= $pel['gambar']; ?>" alt="pelatihan" class="img-fluid" />
                                </div>
                                <div class="info-text-div">
                                    <h4><?= $pel['title']; ?></h4>
                                    <ul class="-address-list mt10">
                                        <li><i class="fas fa-map-marker-alt"></i> <?= $pel['lokasi'] ?></li>
                                        <li><i class="fas fa-calendar-alt"></i> <?= tgl_indonesia($pel['tgl_pelaksanaan']) ?> </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="bg-gradient pt60 pb60 mt30 mb30 text-center">
                        <h4><i class="fas fa-meh"></i> Maaf. Belum ada pelatihan.</h4>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </div>
</section>
<!--End Portfolio-->



<!--Start work-category-->
<section class="work-category pad-tb" id="industry">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="common-heading ptag">
                    <span>Industri</span>
                    <h2>Industri Yang Kami Naungi</h2>
                    <p>Successfully delivered digital products Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                </div>
            </div>
        </div>
        <div class="row mt30">
            <div class="col-lg-3 col-sm-6 col-6 wow fadeIn" data-wow-delay="0.1s">
                <div class="industry-workfor hoshd">
                    <img src="/assets_front/images/icons/house.svg" alt="img">
                    <h6>Sandang</h6>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-6 wow fadeIn" data-wow-delay="0.1s">
                <div class="industry-workfor hoshd">
                    <img src="/assets_front/images/icons/groceries.svg" alt="img">
                    <h6>Pangan</h6>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-6 wow fadeIn" data-wow-delay="0.1s">
                <div class="industry-workfor hoshd">
                    <img src="/assets_front/images/icons/healthcare.svg" alt="img">
                    <h6>Kimia & Bahan Bangunan</h6>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-6 wow fadeIn" data-wow-delay="0.1s">
                <div class="industry-workfor hoshd">
                    <img src="/assets_front/images/icons/video-tutorials.svg" alt="img">
                    <h6>Kerajinan</h6>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-6 wow fadeIn" data-wow-delay="0.1s">
                <div class="industry-workfor hoshd">
                    <img src="/assets_front/images/icons/mobile-app.svg" alt="img">
                    <h6>Logam & Elektronik</h6>
                </div>
            </div>
        </div>
    </div>
</section>
<!--End  work-category-->

<!--Start Blogs-->
<section class="blogs-section pb50 pt120" id="news">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="common-heading">
                    <span class="text-effect">Berita</span>
                    <h2 class="mb30">Berita Terbaru</h2>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <?php if ($berita) : ?>
                <?php foreach ($berita as $ber) : ?>
                    <div class="col-lg-4 col-sm-6 mt30">
                        <div class="single-blog-post- up-hor shdo">
                            <div class="single-blog-img-">
                                <a href="#"><img src="/uploads/berita/thumb_<?= $ber['gambar']; ?>" alt="gambar" class="img-fluid" /></a>
                                <div class="entry-blog-post dg-bg2">
                                    <span class="bypost-"><a href="javascript:void(0)"><i class="fas fa-user fa-fw"></i> <?= $ber['penulis'] ?></a></span>
                                    <span class="posted-on-">
                                        <a href="javascript:void(0)"><i class="fas fa-clock"></i> <?= tgl_indonesia_short($ber['created_at']) ?></a>
                                    </span>
                                </div>
                            </div>
                            <div class="blog-content-tt">
                                <div class="single-blog-info-">
                                    <h4><a href="#"><?= $ber['title']; ?></a></h4>
                                    <p><?= $ber['excerpt'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

                <div class="-cta-btn mt70">
                    <div class="free-cta-title v-center  wow zoomInDown" data-wow-delay=".9s">
                        <a href="/berita" class="btn-main bg-btn lnk">Selengkapnya... <i class="fas fa-chevron-right fa-icon"></i><span class="circle"></span></a>
                    </div>
                </div>
            <?php else : ?>
                <div class="bg-gradient pt60 pb60 mt30 mb30 text-center">
                    <h4><i class="fas fa-meh"></i> Maaf. Belum ada berita.</h4>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php if ($aplikasi) : ?>
    <div class="weworkfor pb20 dark-bg2">
        <div class="container">
            <div class="logo-weworkfor owl-carousel">
                <?php foreach ($aplikasi as $app) : ?>
                    <div class="items">
                        <a href="<?= $app['link']; ?>">
                            <img src="/uploads/aplikasi/<?= $app['gambar']; ?>" alt="<?= $app['nama_aplikasi'] ?>" class="img100w">
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endif; ?>
<!--End Blogs-->
<!--Start contact-->
<section class="contact--block bg-gradient1 pad-tb" id="contact">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="common-heading text-l text-wt">
                    <h2 class="mb0">Hubungi Kami</h2>
                    <p>Silahkan hubungi kami melalui akses dibawah ini</p>
                </div>
                <div class="contact-fields">
                    <div class="connect-block mt40">
                        <a href="mailto:info@abcd.com" tabindex="-1">
                            <div class="icon-fld-nx v-center">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="text-fld-nx v-center">
                                <span class="small-text rows">Hubungi Kami Lewat Email</span>
                                <span class="large-text rows">diskumperindag@gorontaloprov.go.id</span>
                            </div>
                        </a>
                    </div>
                    <div class="connect-block mt30">
                        <a href="tel:12345679" class="transition" tabindex="-1">
                            <div class="icon-fld-nx v-center">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <div class="text-fld-nx v-center">
                                <span class="small-text rows">Nomor Telepon</span>
                                <span class="large-text rows">(91) 123 456 7890</span>
                            </div>
                        </a>
                    </div>
                    <div class="text-fieds- mt40">
                        <h4>& What's you will get :</h4>
                        <ul class="list-style- mt10">
                            <li> Excellent Customer Support</li>
                            <li>Project Consulting by Experts</li>
                            <li>On-Time Project Delivery</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="contact-form-card-pr contact-block-btm">
                    <div class="form-block">
                        <form action="#" id="quotes-form" method="post">
                            <div class="fieldsets row">
                                <div class="col-md-6 form-group floating-label">
                                    <input type="text" placeholder=" " required="required" class="floating-input">
                                    <label>Full Name*</label>
                                </div>
                                <div class="col-md-6 form-group floating-label">
                                    <input type="email" placeholder=" " required="required" class="floating-input">
                                    <label>Email Address*</label>
                                </div>
                            </div>
                            <div class="fieldsets row">
                                <div class="col-md-6 form-group floating-label">
                                    <input type="tel" placeholder=" " required="required" class="floating-input">
                                    <label>Mobile Number*</label>
                                </div>
                                <div class="col-md-6 form-group floating-label">
                                    <select required="required" class="floating-select">
                                        <option value="">&nbsp;</option>
                                        <option value="Graphic Design">Graphic Design</option>
                                        <option value="Web Design">Web Design</option>
                                        <option value="App Design">App Design</option>
                                        <option value="Other">Other</option>
                                    </select>
                                    <label>Interested In*</label>
                                </div>
                            </div>
                            <div class="fieldsets row">
                                <div class="col-md-6 form-group floating-label">
                                    <select required="required" class="floating-select">
                                        <option value="">&nbsp;</option>
                                        <option value="#">Less than $500</option>
                                        <option value="#">$500 - $1000</option>
                                        <option value="#">$1000 - $2000</option>
                                        <option value="#">$2000 - $300</option>
                                        <option value="#">$3000+ </option>
                                    </select>
                                    <label>Your Budget*</label>
                                </div>
                                <div class="col-md-6 form-group floating-label">
                                    <input type="text" placeholder=" " required="required" class="floating-input">
                                    <label>Skype ID/Whatsapp No.*</label>
                                </div>
                            </div>
                            <div class="fieldsets row">
                                <div class="col-md-12 form-group floating-label">
                                    <textarea placeholder=" " required="required" class="floating-input"></textarea>
                                    <label>Message*</label>
                                </div>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customCheck" name="example1" checked="checked">
                                <label class="custom-control-label" for="customCheck">I agree to the <a href="javascript:void(0)">Terms &amp; Conditions</a> of Business Name.</label>
                            </div>
                            <div class="fieldsets mt20"> <button type="submit" name="submit" class="lnk btn-main bg-btn">Submit <i class="fas fa-chevron-right fa-icon"></i><span class="circle"></span></button> </div>
                            <p class="trm"><i class="fas fa-lock"></i>We hate spam, and we respect your privacy.</p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>