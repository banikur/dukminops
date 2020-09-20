<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>E - DATADUKMINOPS SOPS MABES POLRI</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicons -->
    <link href="{{url('front_layout/img/favicon.png')}}" rel="icon">
    <link href="{{url('front_layout/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">

    <!-- Bootstrap CSS File -->
    <link href="{{url('front_layout/lib/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Libraries CSS Files -->
    <link href="{{url('front_layout/lib/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{url('front_layout/lib/animate/animate.min.css')}}" rel="stylesheet">
    <link href="{{url('front_layout/lib/ionicons/css/ionicons.min.css')}}" rel="stylesheet">
    <link href="{{url('front_layout/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{url('front_layout/lib/lightbox/css/lightbox.min.css')}}" rel="stylesheet">

    <!-- Main Stylesheet File -->
    <link href="{{url('front_layout/css/style.css')}}" rel="stylesheet">

</head>

<body>

<!--==========================
Header
============================-->
<header id="header" class="fixed-top">
    <div class="container">

        <div class="logo float-left">
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <h1 class="text-light"><a href="#header"><span>NewBiz</span></a></h1> -->
            <a href="{{route('login')}}" class="scrollto"><img src="{{url('front_layout/img/minerba/logo-o.png')}}" alt="" class="img-fluid"></a>
        </div>
        <nav class="main-nav float-right d-none d-lg-block">
            <ul>
                <li class="active"><a href="#intro">Beranda</a></li>
                <li class="nav-item lain dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Tentang Dukminops
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" id="dok-manual" href="#organisasi" target="_blank">Struktur Organisasi</a>
                      <a class="dropdown-item" id="dok-lsp" href="#jobdesk" target="_blank">Job Desk</a>
                      <a class="dropdown-item" id="dok-lsp" href="#callcenter" target="_blank">Call Center</a>
                    </div>
                  </li>
                <li><a href="#layanan">Layanan Dukminops</a></li>
                <li><a href="#clients">Internal Dukminops</a></li>
                <li><a href="#contact">Kontak Kami</a></li>
                 <!--<li><a href="{{route('login')}}">Masuk</a></li>-->
            </ul>
        </nav><!-- .main-nav -->

    </div>
</header><!-- #header -->

<!--==========================
  Intro Section
============================-->
<section id="intro" class="clearfix">
    <div class="container">
        <div class="intro-img">
            <!-- <img src="front_layout/img/intro-img.svg" alt="" class="img-fluid"> -->
        </div>

        <div class="intro-info">
            <h1 style="color:#000000;"><b>SELAMAT DATANG DI APLIKASI E-DATADUKMINOPS<br>SOPS MABES POLRI</b></h1>
            <!-- <a href="{{url('/Costumer/costumer-table')}}" class="btn btn-lg btn-outline-dark">Pesan Sekarang &nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-right"></i/></a> -->
            <a href="{{route('login')}}" class="btn btn-lg btn-outline-dark">Masuk<i class="fa fa-arrow-right"></i/></a>
        </div>

    </div>
</section>
<section id="layanan">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <img src="front_layout/img/judul_layanan.png" alt="SARPAS UNRAS" class="img-fluid">
            </div>
            <div class="col-md-4">
                <img src="front_layout/img/layanan1.png" alt="SARPAS UNRAS" class="img-fluid">
            </div>
            <div class="col-md-4">
                <img src="front_layout/img/layanan2.png" alt="SARPAS KONTIJENSI" class="img-fluid">
            </div>
            <div class="col-md-4">
                <img src="front_layout/img/layanan3.png" alt="SARPAS BENCANA" class="img-fluid">
            </div>
        </div>
    </div>
</section>
<hr>
<section id="organisasi">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center" style="margin-left: 55px;">
                <img src="front_layout/img/judul_organisasi.png" alt="Struktur Organisasi" class="img-fluid">
            </div>
        </div>
    </div>
</section>
<hr>
<section id="jobdesk">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <img src="front_layout/img/judul_jobdesk.png" alt="Job Desk" class="img-fluid">
                <div class="message">
                    <h3><b>Call Center Polri 110</b></h3>
                    <p>
                    Dalam rangka lebih cepat memberikan pelayanan kepada masyarakat,
                    Polri telah bekerjasama dengan PT Telekomunikasi Indonesia (Telkom) untuk melaksanakan Layanan Contact Center 110.
                    <br><br>
                    Kehadiran Layanan Contact Center 110 POLRI ditujukan untuk memenuhi harapan dan kebutuhan masyarakat terhadap terselenggaranya layanan keamanan publik.
                    Dalam penyelenggaraan layanan contact center, telah disiapkan sebuah sistem aplikasi yang dapat memungkinkan pencatatan /perekaman setiap interaksi Polri & masyarakat,
                    sehingga dimungkinkan pengendalian response kebutuhan masyarakat terhadap Polri.
                    <br><br>
                    Sistem tersebut direncanakan akan membuka saluran via : telepon, sms, email, fax dan media sosial yang didukung oleh jaringan Telkom Group di Indonesia.
                    <br><br>
                    Masyarakat yang nantinya melakukan panggilan ke nomor akses 110 akan langsung terhubung ke agen yang akan memberikan layanan berupa informasi, pelaporan (kecelakaan, bencana, kerusuhan, dll) dan pengaduan (penghinaan, ancaman, tindak kekerasan dll).
                    <br><br>
                    Masyarakat bisa menggunakan layanan Contact Center 110 secara gratis. Namun demikian, Polri menghimbau agar layanan 110 ini tidak dibuat main-main, karena jika nantinya terjadi seperti itu, pihak Polri tentu akan melacak masyarakat yang membuat laporan bohong.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<hr>
<section id="callcenter">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <img src="front_layout/img/judul_callcenter.png" alt="Call Center" class="img-fluid">
                <div class="message">
                    <ol>
                        <li>memelihara keamanan dan ketertiban masyarakat;</li>
                        <li>menegakkan hukum; dan</li>
                        <li>memberikan perlindungan, pengayoman, dan pelayanan kepada masyarakat.</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- #intro -->

<main id="main" style="display:none">

    <!--==========================
      About Us Section
    ============================-->
  
    <!--==========================
      Services Section
    ============================-->
  
    <!--==========================
      Why Us Section
    ============================-->
    
    <!--==========================
      Contact Section
    ============================-->
    
</main>

<!--==========================
  Footer
============================-->
<footer id="footer">
    <!-- <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 footer-info">
                    <h3>MINERBA ESDM</h3>
                    <p>Terwujudnya ketahanan dan kemandirian energi batubara, peningkatan nilai tambah mineral yang berwawasan lingkungan untuk memberikan manfaat yang sebesar-besarnya bagi kemakmuran rakyat.</p>
                </div>

                <div class="col-lg-2 col-md-6 footer-links">
                    <h4>Link Terkait</h4>
                    <ul>
                        <li><a href="https://www.esdm.go.id">ESDM MINERBA</a></li>
                        <li><a href="https://www.miners.esdm.go.id">ESDM MINERS</a></li>
                        <li><a href="https://modi.minerba.esdm.go.id/">ESDM MODI</a></li>
                        <li><a href="https://moms.esdm.go.id/">ESDM MOMS</a></li>
                        <li><a href="https://ems.esdm.go.id/">ESDM EMS</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 footer-contact">
                    <h4>Kontak Kami</h4>
                    <p>
                        Jl. Prof. DR. Soepomo No.10, RT.1/RW.3, <br>
                        Menteng Dalam, Kec. Tebet <br>
                        Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12870 <br>

                        <strong>Phone :</strong> +1 5589 55488 55<br>
                        <strong>Email :</strong> mail@esdm.go.id<br>
                    </p>

                </div>

                <div class="col-lg-3 col-md-6 footer-newsletter">
                    <h4>Misi</h4>
                    <p>Direktorat Jenderal Mineral dan Batubara mempunyai tugas menyelenggarakan perumusan dan pelaksanaan kebijakan di bidang pembinaan, pengendalian, dan pengawasan kegiatan mineral dan batubara. Dalam melaksanakan tugas sebagaimana dimaksud</p>
                </div>

            </div>
        </div>
    </div> -->

    <div class="container">
        <div class="copyright">
            &copy; Copyright <strong>SOPS MABES POLRI</strong>. All Rights Reserved
        </div>
    </div>
</footer>

<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
<!-- Uncomment below i you want to use a preloader -->
<!-- <div id="preloader"></div> -->

<!-- JavaScript Libraries -->
<script src="{{url('front_layout/lib/jquery/jquery.min.js')}}"></script>
<script src="{{url('front_layout/lib/jquery/jquery-migrate.min.js')}}"></script>
<script src="{{url('front_layout/lib/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{url('front_layout/lib/easing/easing.min.js')}}"></script>
<script src="{{url('front_layout/lib/mobile-nav/mobile-nav.js')}}"></script>
<script src="{{url('front_layout/lib/wow/wow.min.js')}}"></script>
<script src="{{url('front_layout/lib/waypoints/waypoints.min.js')}}"></script>
<script src="{{url('front_layout/lib/counterup/counterup.min.js')}}"></script>
<script src="{{url('front_layout/lib/owlcarousel/owl.carousel.min.js')}}"></script>
<script src="{{url('front_layout/lib/isotope/isotope.pkgd.min.js')}}"></script>
<script src="{{url('front_layout/lib/lightbox/js/lightbox.min.js')}}"></script>
<!-- Contact Form JavaScript File -->
<script src="{{url('front_layout/contactform/contactform.js')}}"></script>

<!-- Template Main Javascript File -->
<script src="{{url('front_layout/js/main.js')}}"></script>

</body>
</html>

