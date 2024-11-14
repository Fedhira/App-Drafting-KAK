<?php
require '../../database/config.php';
require '../../controllers/UserController.php';
require '../../controllers/DaftarController.php';
require '../cek.php';
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

  <!-- SweetAlert -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Load Font Awesome 6 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

  <!-- CSS Files -->
  <link rel="stylesheet" href="../../assets/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../../assets/css/plugins.min.css" />
  <link rel="stylesheet" href="../../assets/css/kaiadmin.min.css" />

  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link rel="stylesheet" href="../../assets/css/demo.css" />
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
          <a href="index.html" class="logo">
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
                          <button type="button" class="btn btn-primary">Simpan</button>
                          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                        </div>
                      </div>
                    </div>
                  </div>


                  <?php
                  // Check if query returned results
                  if ($result && mysqli_num_rows($result) > 0) {
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
                          <?php
                          // Fetch and display each row of data
                          while ($row = mysqli_fetch_assoc($result)) {
                            // Define the status label class based on the document status
                            $statusClass = '';
                            switch ($row['status']) {
                              case 'approved':
                                $statusClass = 'status-disetujui';
                                break;
                              case 'pending':
                                $statusClass = 'status-pending';
                                break;
                              case 'rejected':
                                $statusClass = 'status-ditolak';
                                break;
                              case 'draft':
                                $statusClass = 'status-draft';
                                break;
                            }
                            echo "<tr>
                  <td>{$row['no_doc_mak']}</td>
                  <td>{$row['judul']}</td>
                  <td>{$row['kategori_program']}</td>
                  <td><span class='status {$statusClass}'>" . ucfirst($row['status']) . "</span></td>
                  <td>{$row['tanggal_dibuat']}</td>
                  <td>{$row['tanggal_diperbarui']}</td>
                  <td>
                    <div class='form-button-action'>
                      <button class='btn btn-dark btn-round me-2' style='width: 100px;' data-bs-toggle='modal' data-bs-target='#detailRowModal'>
                        <i class='fas fa-eye'></i> Detail
                      </button>
                    </div>
                  </td>
                </tr>";
                          }
                          ?>
                        </tbody>
                      </table>
                    </div>
                  <?php
                  } else {
                    echo "<p>No data available</p>";
                  }
                  ?>


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
</body>

</html>