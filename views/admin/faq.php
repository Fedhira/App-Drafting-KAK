<?php
require '../../database/config.php';
require '../cek.php';

// Check if the user is logged in
$username = isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Guest';
$email = isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : 'guest@example.com'; // Default email
?>

<!DOCTYPE html>
<html lang="en">
</body>
<!-- Bagian Head -->
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Drafting KAK - BAKTI</title>

<!-- Link ke file CSS utama -->
<link rel="stylesheet" href="../../assets/css/style.css">

<!-- Link ke file JS utama -->
<script src="../../assets/js/app.js"></script>

<!-- SweetAlert -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Favicon -->
<link
    rel="icon"
    href="../../assets/img/kaiadmin/favicon.ico"
    type="image/x-icon" />

<!-- Fonts dan Ikon -->
<script src="../../assets/js/plugin/webfont/webfont.min.js"></script>
<script>
    WebFont.load({
        google: {
            families: ["Public Sans:300,400,500,600,700"]
        },
        custom: {
            families: ["simple-line-icons"],
            urls: ["../../assets/css/fonts.min.css"],
        },
        active: function() {
            sessionStorage.fonts = true;
        },
    });
</script>

<!-- Ikon dari Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<!-- CSS File lainnya -->
<link rel="stylesheet" href="../../assets/css/bootstrap.min.css" />
<link rel="stylesheet" href="../../assets/css/plugins.min.css" />
<link rel="stylesheet" href="../../assets/css/kaiadmin.min.css" />
<link rel="stylesheet" href="../../assets/css/demo.css" />

<!-- CSS Kustom untuk Accordion dan elemen lain -->
<style>
    .accordion-item {
        margin-bottom: 10px;
        /* Jarak antar item accordion */
    }

    .accordion-body {
        padding: 15px;
        /* Padding di dalam body accordion */
    }
</style>
</head>

<body>
    <!-- Bagian Utama Website -->
    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar" data-background-color="light">
            <!-- Logo dan Tombol Toggle -->
            <div class="sidebar-logo">
                <div class="logo-header" style="justify-content: center">
                    <a href="index.html" class="logo">
                        <img src="../../assets/img/kaiadmin/logo_bakti_light.svg" alt="navbar brand" class="navbar-brand" height="60" />
                    </a>
                    <div class="nav-toggle">
                        <button class="btn btn-toggle toggle-sidebar">
                            <i class="gg-menu-right"></i>
                        </button>
                        <button class="btn btn-toggle sidenav-toggler">
                            <i class="gg-menu-left"></i>
                        </button>
                    </div>
                    <button class="topbar-toggler more">
                        <i class="gg-more-vertical-alt"></i>
                    </button>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <div class="sidebar-wrapper scrollbar scrollbar-inner">
                <div class="sidebar-content">
                    <ul class="nav nav-secondary">
                        <li class="nav-item">
                            <a
                                href="index.php">
                                <i class="fas fa-home"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="users.php">
                                <i class="fas fa-user-group"></i>
                                <p>Users</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="kategori.php">
                                <i class="fas fa-border-all"></i>
                                <p>Kategori Program</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="daftar.php">
                                <i class="fa-sharp fa-solid fa-clipboard-list"></i>
                                <p>Daftar KAK</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="laporan.php">
                                <i class="fas fa-file"></i>
                                <p>Laporan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" onclick="logoutConfirm(event)">
                                <i class="fas fa-right-from-bracket"></i>
                                <p>Logout</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Sidebar -->

        <!-- Main Panel -->
        <div class="main-panel">
            <!-- Header Utama -->
            <div class="main-header">
                <div class="main-header-logo">
                    <div class="logo-header" data-background-color="light-blue">
                        <a href="index.html" class="logo">
                            <img src="../../assets/img/kaiadmin/logo_light.svg" alt="navbar brand" class="navbar-brand" height="20" />
                        </a>
                        <div class="nav-toggle">
                            <button class="btn btn-toggle toggle-sidebar"><i class="gg-menu-right"></i></button>
                            <button class="btn btn-toggle sidenav-toggler"><i class="gg-menu-left"></i></button>
                        </div>
                        <button class="topbar-toggler more"><i class="gg-more-vertical-alt"></i></button>
                    </div>
                </div>

                <!-- Navbar Header -->
                <nav
                    class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
                    <div class="container-fluid">

                        <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">

                            <li class="nav-item topbar-user dropdown hidden-caret">
                                <a
                                    class="dropdown-toggle profile-pic"
                                    data-bs-toggle="dropdown"
                                    href="#"
                                    aria-expanded="false">
                                    <div class="avatar-sm">
                                        <img
                                            src="../../assets/img/user.png"
                                            alt="..."
                                            class="avatar-img rounded-circle" />
                                    </div>
                                    <span class="profile-username">
                                        <span class="op-7">Welcome,</span>
                                        <span class="fw-bold"><?= $username ?></span>
                                    </span>
                                </a>
                                <ul class="dropdown-menu dropdown-user animated fadeIn">
                                    <div class="dropdown-user-scroll scrollbar-outer">
                                        <li>
                                            <div class="user-box">
                                                <div class="u-text">
                                                    <h4><?= $username ?></h4> <!-- Display the username -->
                                                    <p class="text-muted"><?= $email ?></p> <!-- Display the email -->
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="faq.php">FAQ</a>
                                        </li>
                                    </div>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>

            <!-- Konten FAQ -->
            <div class="container">
                <div class="page-inner text">
                    <h2 class="text-center">Frequently Asked Questions</h2>
                    <br>
                    <section class="faq-section">
                        <div class="faq__container">
                            <span class="text-center d-block m-auto">Selamat datang di halaman bantuan. Di sini Anda akan menemukan informasi tentang cara menggunakan aplikasi.</span>
                            <br>

                            <!-- Accordion FAQ -->
                            <style>
                                .custom-font-size {
                                    font-size: 16px;
                                    /* Ubah ukuran sesuai keinginan */
                                }
                            </style>

                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button custom-font-size" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Bagaimana cara menambahkan pengguna baru ke sistem?
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body custom-font-size">
                                            Untuk menambahkan pengguna baru ke sistem, pergi ke bagian "Users", klik "Tambah Pengguna", dan isi data yang diperlukan seperti Nama, Email, NIK, Role, Password, dan Kategori.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingTwo">
                                        <button class="accordion-button collapsed custom-font-size" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            Bagaimana cara mengelola kategori pemilik program (PP)?
                                        </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                        <div class="accordion-body custom-font-size">
                                            Di bagian Kategori Pemilik Program (PP), klik Tambah Kategori, isi detail yang diperlukan, seperti Nama Kategori Divisi, dan lalu simpan
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingThree">
                                        <button class="accordion-button collapsed custom-font-size" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            Bagaimana cara melihat laporan aktivitas pengguna?
                                        </button>
                                    </h2>
                                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                        <div class="accordion-body custom-font-size">
                                            Di bagian "Laporan" pada sidebar, Anda dapat melihat aktivitas pengguna terkait pembuatan, pengajuan, dan persetujuan KAK.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingFour">
                                        <button class="accordion-button collapsed custom-font-size" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                            Bagaimana cara mengubah informasi pengguna yang sudah ada?
                                        </button>
                                    </h2>
                                    <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                        <div class="accordion-body custom-font-size">
                                            Untuk mengubah informasi pengguna yang sudah ada, buka menu "Users", cari pengguna yang ingin diubah, lalu klik "Edit" di sebelah nama pengguna tersebut. Setelah itu, Anda bisa memperbarui data yang diperlukan dan menyimpannya. </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingFive">
                                        <button class="accordion-button collapsed custom-font-size" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                            Bagaimana cara menghapus pengguna dari sistem?
                                        </button>
                                    </h2>
                                    <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                                        <div class="accordion-body custom-font-size">
                                            Untuk menghapus pengguna, buka menu "Users", cari pengguna yang ingin dihapus, lalu klik "Hapus". Pastikan Anda mengonfirmasi tindakan ini karena penghapusan bersifat permanen. </div>
                                    </div>
                                </div>





                                <!-- End Accordion -->


                                <!-- Contact Support Box -->
                                <div class="contact-support box">
                                    <h5><strong>Contact Support</strong></h5>
                                    <h6>Jika Anda memerlukan bantuan lebih lanjut, silakan hubungi tim dukungan kami:</h6>
                                    <ul>
                                        <li>
                                            <h6><strong>Email:</strong> <a href="mailto:halobakti@baktikominfo.id">halobakti@baktikominfo.id</a></h6>
                                        </li>
                                        <li>
                                            <h6><strong>Phone:</strong> <a href="tel:021-30205834">021-30205834</a></h6>
                                        </li>
                                    </ul>
                                </div>
                                <!-- End Contact Support -->

                                <!-- CSS untuk membuat kotak -->
                                <style>
                                    .box {
                                        border: 1px solid #ddd;
                                        /* Border dengan warna abu-abu */
                                        padding: 30px;
                                        /* Jarak antara konten dan border */
                                        background-color: #f9f9f9;
                                        /* Warna latar belakang */
                                        border-radius: 8px;
                                        /* Ujung kotak dibuat melengkung */
                                        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                                        /* Memberikan efek shadow */
                                        max-width: 1210px;
                                        /* Maksimal lebar kotak */
                                        margin: auto;
                                        /* Membuat kotak berada di tengah */
                                    }

                                    .box h5 {
                                        margin-bottom: 10px;
                                        /* Jarak bawah heading */
                                    }

                                    .box a {
                                        color: #007bff;
                                        /* Warna tautan */
                                        text-decoration: none;
                                        /* Menghilangkan garis bawah pada tautan */
                                    }

                                    .box a:hover {
                                        text-decoration: underline;
                                        /* Tautan bergaris bawah saat di-hover */
                                    }
                                </style>

                            </div>
                    </section>
                </div>
            </div>
            <!-- End Konten FAQ -->


            <!-- Footer -->
            <footer class="footer" style="margin-top: 0; padding-top: 10px;">
                <div class="container-fluid footer-content d-flex justify-content-between flex-wrap">
                    <div class="copyright text-center text-md-start">© Copyright <strong>BAKTI</strong>. All Rights Reserved</div>
                    <div class="design text-center text-md-end">Designed by <a target="_blank" href="">Dwf</a>.</div>
                </div>
            </footer>
        </div>

        <!-- JS Files -->
        <script src="../../assets/js/core/jquery-3.7.1.min.js"></script>
        <script src="../../assets/js/core/popper.min.js"></script>
        <script src="../../assets/js/core/bootstrap.min.js"></script>
        <script src="../../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
        <script src="../../assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>
        <script src="../../assets/js/plugin/sweetalert/sweetalert.min.js"></script>
        <script src="../../assets/js/kaiadmin.min.js"></script>
        <script src="../../assets/js/setting-demo.js"></script>
        <script src="../../assets/js/demo.js"></script>
    </div>
</body>

<script>
    function logoutConfirm(event) {
        event.preventDefault(); // Prevents the default link action

        Swal.fire({
            title: 'Are you sure you want to logout?',
            text: "You will be logged out of the system.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, logout'
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect to logout.php if confirmed
                window.location.href = '../../login.php';
            }
        });
    }
</script>

</html>