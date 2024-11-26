<?php
require '../../database/config.php';
require '../../controllers/UserController.php';
require '../../models/CategoryModel.php';
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
            <li class="nav-item active">
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

    <div class="main-panel">
      <div class="main-header">
        <div class="main-header-logo">
          <!-- Logo Header -->
          <div class="logo-header" data-background-color="light-blue">
            <a href="../index.html" class="logo">
              <img
                src="../../assets/img/kaiadmin/logo_bakti_light.svg"
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
            <h3 class="fw-bold mb-3">Kelola Kategori Program</h3>
          </div>
          <div class="row">

            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <div class="d-flex align-items-center">
                    <button
                      class="btn btn-primary btn-round me-4"
                      data-bs-toggle="modal"
                      data-bs-target="#addRowModal">
                      <i class="fa fa-plus"></i>
                      Tambah Kategori
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <!-- Modal Tambah -->
                  <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header border-0">
                          <h5 class="modal-title">
                            <span class="fw-mediumbold"> Tambah Kategori Divisi</span>
                          </h5>
                          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form method="POST" action="../../models/CategoryModel.php">
                            <input type="hidden" name="action" value="add" /> <!-- Menambahkan input hidden untuk action -->
                            <div class="row">
                              <div class="col-sm-12">
                                <div class="form-group form-group-default">
                                  <label>Nama Kategori Divisi</label>
                                  <input type="text" name="nama_divisi" class="form-control" placeholder="fill kategori divisi" required />
                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="form-group form-group-default">
                                  <label>Status</label>
                                  <select name="status" class="form-control" required>
                                    <option value="">Pilih Status</option>
                                    <?php
                                    // Pastikan variabel $koneksi sudah terdefinisi
                                    if (isset($koneksi)) {
                                      $statusOptions = fetchStatusOptions($koneksi);
                                      if (!empty($statusOptions)) {
                                        foreach ($statusOptions as $status) {
                                          echo "<option value='" . htmlspecialchars($status) . "'>" . htmlspecialchars($status) . "</option>";
                                        }
                                      } else {
                                        echo "<option value=''>Tidak ada opsi status</option>";
                                      }
                                    } else {
                                      echo "<option value=''>Koneksi database tidak tersedia</option>";
                                    }
                                    ?>
                                  </select>
                                </div>
                              </div>
                            </div>
                        </div>
                        <div class="modal-footer border-0">
                          <button type="submit" class="btn btn-primary">Tambah</button>
                          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                        </div>
                        </form>
                      </div>
                    </div>
                  </div>



                  <!-- Modal Ubah -->
                  <div class="modal fade" id="editRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header border-0">
                          <h5 class="modal-title">
                            <span class="fw-mediumbold"> Edit Kategori</span>
                          </h5>
                          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form method="POST" action="../../models/CategoryModel.php">
                            <input type="hidden" name="action" value="update" />
                            <input type="hidden" name="kategori_id" id="edit_kategori_id" />
                            <div class="row">
                              <div class="col-sm-12">
                                <div class="form-group form-group-default">
                                  <label>Nama Kategori Divisi</label>
                                  <input id="edit_nama_divisi" type="text" name="nama_divisi" class="form-control" placeholder="fill kategori divisi" required />
                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="form-group form-group-default">
                                  <label for="edit_status">Status</label>
                                  <select id="edit_status" name="status" class="form-control" required>
                                    <option value="">Pilih Status</option>
                                    <?php
                                    $statusOptions = fetchStatusOptions($koneksi);
                                    foreach ($statusOptions as $status) {
                                      echo "<option value='" . htmlspecialchars($status) . "'>" . htmlspecialchars($status) . "</option>";
                                    }
                                    ?>
                                  </select>
                                </div>                              </div>
                            </div>
                            <div class="modal-footer border-0">
                              <button type="submit" class="btn btn-primary">Simpan</button>
                              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>



                  <?php
                  // Function to fetch all categories from the database
                  function fetchCategories($koneksi)
                  {
                    $sql = "SELECT kp.kategori_id, kp.nama_divisi, kp.status, COUNT(u.user_id) AS jumlah_user
            FROM kategori_program kp
            LEFT JOIN user u ON kp.kategori_id = u.kategori_id
            GROUP BY kp.kategori_id";

                    $result = $koneksi->query($sql);

                    if ($result->num_rows > 0) {
                      while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                    <td>" . htmlspecialchars($row['nama_divisi']) . "</td>
                    <td>" . htmlspecialchars($row['status']) . "</td>
                    <td>" . htmlspecialchars($row['jumlah_user']) . "</td>
                    <td>
                        <div class='form-button-action'>
                            <button class='btn btn-warning me-2 btn-round' style='width: 100px;' 
                                    data-bs-toggle='modal' data-bs-target='#editRowModal' 
                                    onclick='populateEditModal(" . json_encode($row) . ")'>
                                <i class='fa fa-edit'></i> Ubah
                            </button>
                            <button class='btn btn-danger btn-round' style='width: 100px;' 
                                    onclick='confirmDeleteKategori(" . $row['kategori_id'] . ")'>
                                <i class='fa fa-trash'></i> Hapus
                              </button>
                        </div>
                    </td>
                </tr>";
                      }
                    } else {
                      echo "<tr><td colspan='4'>No categories found</td></tr>";
                    }
                  }

                  ?>

                  <!-- HTML Table Code -->
                  <div class="table-responsive">
                    <table id="add-row" class="display table table-striped table-hover">
                      <thead>
                        <tr>
                          <th>Nama Kategori Divisi</th>
                          <th>Status</th>
                          <th>Jumlah User</th> <!-- Ini akan otomatis dihitung dari query -->
                          <th style="width: 10%">Aksi</th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <th>Nama Kategori Divisi</th>
                          <th>Status</th>
                          <th>Jumlah User</th>
                          <th>Aksi</th>
                        </tr>
                      </tfoot>
                      <tbody>
                        <?php fetchCategories($koneksi); ?>
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
    $(document).ready(function() {
      $('#addKategoriForm').submit(function(e) {
        e.preventDefault(); // Prevent form from submitting the usual way

        $.ajax({
          url: '../../models/CategoryModel.php', // File backend untuk handle insert
          type: 'POST',
          data: $(this).serialize(), // Kirim data form
          success: function(response) {
            if (response === 'success') {
              alert('Kategori berhasil ditambah');
              location.reload(); // Reload halaman untuk memperbarui tabel
            } else {
              alert('Gagal menambah kategori: ' + response); // Tampilkan error dari server
            }
          },
          error: function(xhr, status, error) {
            alert('AJAX error: ' + error); // Menampilkan error jika terjadi kesalahan dalam proses AJAX
          }
        });
      });
    });
  </script>

  <script>
    function populateEditModal(data) {
      document.getElementById('edit_kategori_id').value = data.kategori_id;
      document.getElementById('edit_nama_divisi').value = data.nama_divisi;
      document.getElementById('edit_status').value = data.status;
    }
  </script>

  <script>
    function confirmDeleteKategori(kategori_id) {
      Swal.fire({
        title: 'Are you sure?',
        text: "Do you really want to delete this category?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          // Lakukan form submit untuk hapus data
          let form = document.createElement('form');
          form.method = 'POST';
          form.action = '../../models/CategoryModel.php';

          let inputAction = document.createElement('input');
          inputAction.type = 'hidden';
          inputAction.name = 'action';
          inputAction.value = 'delete';
          form.appendChild(inputAction);

          let inputKategoriId = document.createElement('input');
          inputKategoriId.type = 'hidden';
          inputKategoriId.name = 'kategori_id';
          inputKategoriId.value = kategori_id;
          form.appendChild(inputKategoriId);

          document.body.appendChild(form);
          form.submit();
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
        if (action === 'add') {
          Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'Kategori berhasil ditambahkan.',
            confirmButtonText: 'OK'
          });
        } else if (action === 'update') {
          Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'Kategori berhasil diupdate.',
            confirmButtonText: 'OK'
          });
        } else if (action === 'delete') {
          Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'Kategori berhasil dihapus.',
            confirmButtonText: 'OK'
          });
        }
      } else if (status === 'error') {
        Swal.fire({
          icon: 'error',
          title: 'Gagal!',
          text: 'Terjadi kesalahan saat memproses permintaan.',
          confirmButtonText: 'OK'
        });
      }
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