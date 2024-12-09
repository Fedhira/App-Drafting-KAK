<?php
require '../../database/config.php';
require '../../controllers/UserController.php';
require '../../controllers/DaftarController.php';
require '../../models/DaftarModel.php';
require '../cek.php';
checkLoginAndRole('supervisor');

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Drafting KAK - BAKTI</title>
  <meta
    content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
    name="viewport" />
  <link
    rel="icon"
    href="../../assets/img/kaiadmin/favicon.ico"
    type="image/x-icon" />
  <link rel="stylesheet" href="../../assets/css/style.css">


  <!-- Fonts and icons -->
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

  <!-- Load Font Awesome 6 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

  <!-- SweetAlert -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- CSS Files -->
  <link rel="stylesheet" href="../../assets/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../../assets/css/plugins.min.css" />
  <link rel="stylesheet" href="../../assets/css/kaiadmin.min.css" />

  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link rel="stylesheet" href="../../asasets/css/demo.css" />
  <style>
    .btn {
      padding: 10px;
      font-size: 16px;
      border-radius: 5px;
      display: inline-block;
      text-align: center;
    }

    .btn-ubah {
      background-color: #FFA726;
      color: black;
    }

    .btn-hapus {
      background-color: #E57373;
      color: white;
    }
  </style>

</head>

<body>
  <div class="wrapper">
    <!-- Sidebar -->
    <div class="sidebar" data-background-color="light">
      <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" style="justify-content: center">
          <a href="index.php" class="logo">
            <img
              src="../../assets/img/kaiadmin/logo_bakti_light.svg"
              alt="navbar brand"
              class="navbar-brand"
              height="60" />
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
        <!-- End Logo Header -->
      </div>
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
            <li class="nav-item active">
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

    <div class="main-panel">
      <div class="main-header">
        <div class="main-header-logo">
          <!-- Logo Header -->
          <div class="logo-header" data-background-color="light-blue">
            <a href="../index.html" class="logo">
              <img
                src="..../../assets/img/kaiadmin/logo_bakti_light.svg"
                alt="navbar brand"
                class="navbar-brand"
                height="20" />
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
          <!-- End Logo Header -->
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
        <!-- End Navbar -->
      </div>

      <div class="container">
        <div class="page-inner">
          <div class="page-header">
            <h3 class="fw-bold mb-3">Daftar KAK</h3>
          </div>
          <div class="row">

            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <div class="d-flex align-items-center">

                    <!-- Date Picker From and To -->
                    <form method="GET" action="daftar.php">
                      <div class="d-flex">
                        <div class="input-group me-4">
                          <span class="input-group-text">From</span>
                          <input type="date" class="form-control" name="fromDate" value="<?php echo htmlspecialchars($fromDate); ?>" />
                        </div>
                        <div class="input-group me-4">
                          <span class="input-group-text">To</span>
                          <input type="date" class="form-control" name="toDate" value="<?php echo htmlspecialchars($toDate); ?>" />
                        </div>
                        <button type="submit" class="btn btn-primary btn-round me-2" style="width: 167px;">Filter</button>
                        <a href="daftar.php" class="btn btn-danger btn-round me-2" style="width: 167px;">Clear</a>
                      </div>
                    </form>
                  </div>
                </div>
                <div class="card-body">

                  <!-- Modal Detail -->
                  <div class="modal fade" id="detailRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header border-0">
                          <h5 class="modal-title">
                            <span class="fw-mediumbold">Detail Daftar KAK</span>
                          </h5>
                          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>

                        <!-- Modal Body with Scroll -->
                        <div class="modal-body" style="max-height: 400px; overflow-y: auto;">
                          <form>
                            <div class="row">
                              <div class="col-sm-12">
                                <div class="form-group form-group-default">
                                  <label>No Doc</label>
                                  <input type="text" class="form-control" placeholder="fill" />
                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="form-group form-group-default">
                                  <label>Judul KAK</label>
                                  <input type="text" class="form-control" placeholder="fill" />
                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="form-group form-group-default">
                                  <label>Kategori Program</label>
                                  <input type="text" class="form-control" placeholder="fill" />
                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="form-group form-group-default">
                                  <label>Latar Belakang</label>
                                  <label>A. Dasar Hukum</label>
                                  <input type="text" class="form-control" placeholder="fill " />
                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="form-group form-group-default">
                                  <label>B. Gambaran Umum</label>
                                  <input type="text" class="form-control" placeholder="fill" />
                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="form-group form-group-default">
                                  <label>Tujuan</label>
                                  <input type="text" class="form-control" placeholder="fill" />
                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="form-group form-group-default">
                                  <label>Target/Sasaran</label>
                                  <input type="text" class="form-control" placeholder="fill" />
                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="form-group form-group-default">
                                  <label>Unit Kerja Pelaksana</label>
                                  <input type="text" class="form-control" placeholder="fill" />
                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="form-group form-group-default">
                                  <label>Ruang Lingkup, Lokasi & Fasilitas Penunjang</label>
                                  <input type="text" class="form-control" placeholder="fill" />
                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="form-group form-group-default">
                                  <label>Produk/Jasa yang dihasilkan (Deliverable)</label>
                                  <input type="text" class="form-control" placeholder="fill" />
                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="form-group form-group-default">
                                  <label>Waktu Pelaksana</label>
                                  <input type="text" class="form-control" placeholder="fill" />
                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="form-group form-group-default">
                                  <label>Tenaga Ahli/Terampil</label>
                                  <input type="text" class="form-control" placeholder="fill" />
                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="form-group form-group-default">
                                  <label>Peralatan</label>
                                  <input type="text" class="form-control" placeholder="fill" />
                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="form-group form-group-default">
                                  <label>Metode Kerja</label>
                                  <input type="text" class="form-control" placeholder="fill" />
                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="form-group form-group-default">
                                  <label>Manajemen Resiko</label>
                                  <input type="text" class="form-control" placeholder="fill" />
                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="form-group form-group-default">
                                  <label>Laporan Pengajuan Pekerjaan</label>
                                  <input type="text" class="form-control" placeholder="fill" />
                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="form-group form-group-default">
                                  <label>Sumber Dana & Prakiraan Biaya</label>
                                  <input type="text" class="form-control" placeholder="fill" />
                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="form-group form-group-default">
                                  <label>Penutup</label>
                                  <input type="text" class="form-control" placeholder="fill" />
                                </div>
                              </div>
                            </div>
                          </form>
                        </div>

                        <!-- Modal Footer with Fixed Buttons -->
                        <div class="modal-footer border-0">
                          <button type="button" class="btn btn-success">Disetujui</button>
                          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Modal Ditolak -->
                  <div class="modal fade" id="tolakRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header border-0">
                          <h5 class="modal-title">
                            <span class="fw-mediumbold">Form Penolakan KAK</span>
                          </h5>
                          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>

                        <!-- Modal Body with Scroll -->
                        <div class="modal-body" style="max-height: 500px; overflow-y: auto;">
                          <form method="POST" action="../../models/DaftarModel.php">
                            <div class="row">
                              <div class="col-sm-12">
                                <div class="form-group form-group-default">
                                  <label>No Doc</label>
                                  <input type="text" name="no_doc_mak" class="form-control" readonly />
                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="form-group form-group-default">
                                  <label>Judul KAK</label>
                                  <input type="text" name="judul" class="form-control" readonly />
                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="form-group form-group-default">
                                  <label>Kategori Program</label>
                                  <input type="text" name="kategori" class="form-control" readonly />
                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="form-group form-group-default">
                                  <label>Alasan Penolakan</label>
                                  <textarea name="alasan_penolakan" class="form-control" placeholder="Masukkan alasan penolakan" required></textarea>
                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="form-group form-group-default">
                                  <label>Saran/Revisi</label>
                                  <textarea name="saran" class="form-control" placeholder="Masukkan saran atau revisi" required></textarea>
                                </div>
                              </div>
                              <!-- Hidden input for kak_id -->
                              <input type="hidden" name="kak_id" value="" />
                              <input type="hidden" name="user_id" value="" />
                              <input type="hidden" name="kategori_id" value="" />
                            </div>
                            <div class="modal-footer border-0">
                              <button type="submit" name="submit_penolakan" class="btn btn-primary">Simpan</button>
                              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                            </div>
                          </form>

                        </div>
                      </div>
                    </div>
                  </div>


                  <?php
                  // Ambil dan sanitasi parameter input
                  $fromDate = isset($_GET['fromDate']) ? mysqli_real_escape_string($koneksi, $_GET['fromDate']) : null;
                  $toDate = isset($_GET['toDate']) ? mysqli_real_escape_string($koneksi, $_GET['toDate']) : null;

                  // Query dasar
                  $query = "
SELECT 
    kak.kak_id,
    kak.no_doc_mak,
    kak.judul,
    kategori_program.nama_divisi AS kategori_program,
    kak.status,
    kak.created_at AS tanggal_dibuat,
    kak.updated_at AS tanggal_diperbarui
FROM 
    kak
LEFT JOIN 
    kategori_program
ON 
    kak.kategori_id = kategori_program.kategori_id
WHERE 
    kak.status IN ('pending', 'disetujui', 'ditolak')
";

                  // Tambahkan filter tanggal jika diberikan
                  if (!empty($fromDate)) {
                    $query .= " AND (DATE(kak.created_at) >= '$fromDate' OR DATE(kak.updated_at) >= '$fromDate')";
                  }

                  if (!empty($toDate)) {
                    $query .= " AND (DATE(kak.created_at) <= '$toDate' OR DATE(kak.updated_at) <= '$toDate')";
                  }

                  // Jalankan query
                  $result = mysqli_query($koneksi, $query);

                  // Periksa error
                  if (!$result) {
                    die("Query failed: " . mysqli_error($koneksi));
                  }
                  ?>


                  <div class="table-responsive">
                    <table id="add-row" class="display table table-striped table-hover">
                      <thead>
                        <tr>
                          <th>No Doc</th>
                          <th>Judul KAK</th>
                          <th>Kategori Program</th>
                          <th>Status Dokumen</th>
                          <th>Tanggal Dibuat</th>
                          <th>Tanggal Diperbarui</th>
                          <th style="width: 10%">Aksi</th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <th>No Doc</th>
                          <th>Judul KAK</th>
                          <th>Kategori Program</th>
                          <th>Status Dokumen</th>
                          <th>Tanggal Dibuat</th>
                          <th>Tanggal Diperbarui</th>
                          <th>Aksi</th>
                        </tr>
                      </tfoot>
                      <tbody>
                        <?php if ($result && mysqli_num_rows($result) > 0): ?>
                          <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <?php
                            // Menentukan kelas untuk status
                            $statusClass = '';
                            switch ($row['status']) {
                              case 'disetujui':
                                $statusClass = 'status-disetujui';
                                break;
                              case 'pending':
                                $statusClass = 'status-pending';
                                break;
                              case 'ditolak':
                                $statusClass = 'status-ditolak';
                                break;
                            }
                            ?>
                            <tr>
                              <td><?= htmlspecialchars($row['no_doc_mak']); ?></td>
                              <td><?= htmlspecialchars($row['judul']); ?></td>
                              <td><?= htmlspecialchars($row['kategori_program']); ?></td>
                              <td>
                                <span class="status <?= $statusClass; ?>">
                                  <?= ucfirst($row['status']); ?>
                                </span>
                              </td>
                              <td><?= htmlspecialchars($row['tanggal_dibuat']); ?></td>
                              <td><?= htmlspecialchars($row['tanggal_diperbarui']); ?></td>
                              <td>
                                <div class="form-button-action d-inline-flex">
                                  <a href="detail_draft.php?kak_id=<?= $row['kak_id']; ?>"
                                    class="btn btn-dark btn-round me-2"
                                    style="width: 110px;">
                                    <i class="fa fa-eye"></i> Detail
                                  </a>
                                  <a href="../../controllers/generate_pdf.php?kak_id=<?= $row['kak_id']; ?>" target="_blank" class="btn btn-dark btn-round me-2" style="width: 110px;">
                                    <i class="fas fa-file-pdf"></i> Preview
                                  </a>
                                  <?php if ($row['status'] === 'pending'): ?>
                                    <button
                                      class="btn btn-danger btn-round me-2"
                                      style="width: 110px;"
                                      data-bs-toggle="modal"
                                      data-bs-target="#tolakRowModal"
                                      onclick="populateModal(<?= $row['kak_id']; ?>)">
                                      <i class="fas fa-xmark"></i> Ditolak
                                    </button>
                                  <?php endif; ?>
                                </div>
                              </td>
                            </tr>
                          <?php endwhile; ?>
                        <?php else: ?>
                          <tr>
                            <td colspan="7" class="text-center">Tidak ada data daftar ditemukan.</td>
                          </tr>
                        <?php endif; ?>
                      </tbody>
                    </table>
                  </div>



                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <footer class="footer">
        <div class="container-fluid d-flex justify-content-between">
          <div class="copyright">
            © Copyright <strong>BAKTI</strong>. All Rights Reserved
          </div>
          <div>
            Designed by
            <a target="_blank" href="">Dwf</a>.
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="../../assets/js/core/jquery-3.7.1.min.js"></script>
  <script src="../../assets/js/core/popper.min.js"></script>
  <script src="../../assets/js/core/bootstrap.min.js"></script>

  <!-- jQuery Scrollbar -->
  <script src="../../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
  <!-- Datatables -->
  <script src="../../assets/js/plugin/datatables/datatables.min.js"></script>
  <!-- Kaiadmin JS -->
  <script src="../../assets/js/kaiadmin.min.js"></script>
  <!-- Kaiadmin DEMO methods, don't include it in your project! -->
  <script src="../../assets/js/setting-demo2.js"></script>
  <script>
    $(document).ready(function() {
      $("#basic-datatables").DataTable({});

      $("#multi-filter-select").DataTable({
        pageLength: 5,
        initComplete: function() {
          this.api()
            .columns()
            .every(function() {
              var column = this;
              var select = $(
                  '<select class="form-select"><option value=""></option></select>'
                )
                .appendTo($(column.footer()).empty())
                .on("change", function() {
                  var val = $.fn.dataTable.util.escapeRegex($(this).val());

                  column
                    .search(val ? "^" + val + "$" : "", true, false)
                    .draw();
                });

              column
                .data()
                .unique()
                .sort()
                .each(function(d, j) {
                  select.append(
                    '<option value="' + d + '">' + d + "</option>"
                  );
                });
            });
        },
      });

      // Add Row
      $("#add-row").DataTable({
        pageLength: 5,
      });

      var action =
        '<td> <div class="form-button-action"> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

      $("#addRowButton").click(function() {
        $("#add-row")
          .dataTable()
          .fnAddData([
            $("#addName").val(),
            $("#addPosition").val(),
            $("#addOffice").val(),
            action,
          ]);
        $("#addRowModal").modal("hide");
      });
    });
  </script>

  <script>
    function populateModal(kakId) {
      fetch(`../../models/DaftarModel.php?kak_id=${kakId}`)
        .then(response => response.json())
        .then(data => {
          document.querySelector("input[name='no_doc_mak']").value = data.no_doc_mak || '';
          document.querySelector("input[name='judul']").value = data.judul || '';
          document.querySelector("input[name='kategori']").value = data.kategori || '';
          document.querySelector("input[name='kak_id']").value = kakId; // Set hidden input kak_id

          // Menambahkan user_id dan kategori_id
          document.querySelector("input[name='user_id']").value = data.user_id || '';
          document.querySelector("input[name='kategori_id']").value = data.kategori_id || '';
        })
        .catch(error => console.error('Error:', error));
    }
  </script>

  <script>
    function approveKAK(kak_id) {
      if (confirm("Apakah Anda yakin ingin menyetujui dokumen ini?")) {
        window.location.href = "../../models/DaftarModel.php?action=approve&kak_id=" + kak_id;
      }
    }
  </script>

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

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const urlParams = new URLSearchParams(window.location.search);
      const status = urlParams.get('status');
      const action = urlParams.get('action');

      if (status === 'success') {
        if (action === 'setuju') {
          Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'KAK berhasil disetujui.',
            confirmButtonText: 'OK'
          });
        } else if (action === 'tolak') {
          Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'KAK berhasil ditolak.',
            confirmButtonText: 'OK'
          });
        } else if (action === 'delete') {
          Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'Draft berhasil dihapus.',
            confirmButtonText: 'OK'
          });
        }
      } else if (status === 'error') {
        Swal.fire({
          icon: 'error',
          title: 'Gagal!',
          text: 'Terjadi kesalahan saat memproses permintaan, Silakan coba lagi.',
          confirmButtonText: 'OK'
        });
      }
    });
  </script>
</body>

</html>