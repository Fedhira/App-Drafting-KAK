<?php
require '../../database/config.php';
require '../../models/CategoryModel.php';
require '../../controllers/UserController.php';
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
            <h3 class="fw-bold mb-3">Kelola User</h3>
          </div>
          <div class="row">

            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <div class="d-flex align-items-center">
                    <button
                      class="btn btn-primary btn-round me-4"
                      data-bs-toggle="modal"
                      data-bs-target="#addRowModal" style="width: 167px;">
                      <i class="fa fa-user-plus"></i>
                      Tambah User
                    </button>

                    <form method="GET" action="users.php">
                      <div class="d-flex">
                        <div class="input-group me-4">
                          <span class="input-group-text">From</span>
                          <input type="date" class="form-control" name="fromDate" />
                        </div>
                        <div class="input-group me-4">
                          <span class="input-group-text">To</span>
                          <input type="date" class="form-control" name="toDate" />
                        </div>
                        <button type="submit" class="btn btn-primary btn-round  me-2" style="width: 167px;">Filter</button>
                        <a href="users.php" class="btn btn-danger btn-round me-2" style="width: 167px;">Clear</a>
                      </div>
                    </form>
                  </div>
                </div>
                <div class="card-body">
                  <!-- Modal Tambah -->
                  <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header border-0">
                          <h5 class="modal-title">
                            <span class="fw-mediumbold">Tambah User</span>
                          </h5>
                          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form method="POST" action="../../models/UserModel.php">
                            <div class="row">
                              <div class="col-sm-12">
                                <div class="form-group form-group-default">
                                  <label>Nama</label>
                                  <input type="text" name="username" class="form-control" placeholder="fill name" required />
                                </div>
                              </div>
                              <div class="col-md-6 pe-0">
                                <div class="form-group form-group-default">
                                  <label>Email</label>
                                  <input type="email" name="email" class="form-control" placeholder="fill email" required />
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group form-group-default">
                                  <label for="role">Role</label>
                                  <select id="role" name="role" class="form-control" required>
                                    <option value="">Pilih Role</option>
                                    <?php
                                    $roles = mysqli_query($koneksi, "SELECT DISTINCT role FROM user");
                                    if ($roles) {
                                      while ($data = mysqli_fetch_array($roles)) {
                                        echo "<option value='" . htmlspecialchars($data['role']) . "'>" . htmlspecialchars($data['role']) . "</option>";
                                      }
                                    } else {
                                      echo "<option value=''>Failed to retrieve roles</option>";
                                    }
                                    ?>
                                  </select>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group form-group-default">
                                  <label>NIK</label>
                                  <input type="text" name="nik" class="form-control" placeholder="fill NIK" required />
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group form-group-default">
                                  <label>Password</label>
                                  <input type="password" name="password" class="form-control" placeholder="fill password" required />
                                </div>
                              </div>
                              <div class="col-sm-12">
                                <div class="form-group form-group-default">
                                  <label>Kategori</label>
                                  <select id="kategori_id" name="kategori_id" class="form-control" required>
                                    <option value="">Pilih Kategori</option>
                                    <?php
                                    $categories = fetchAllKategori($koneksi);
                                    if (!empty($categories)) {
                                      foreach ($categories as $category) {
                                        echo '<option value="' . htmlspecialchars($category['kategori_id']) . '">' . htmlspecialchars($category['nama_divisi']) . '</option>';
                                      }
                                    } else {
                                      echo '<option value="">Tidak ada kategori tersedia</option>';
                                    }
                                    ?>
                                  </select>
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
                  </div>



                  <!-- Modal Ubah -->
                  <div class="modal fade" id="editRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header border-0">
                          <h5 class="modal-title">
                            <span class="fw-mediumbold"> Edit User</span>
                          </h5>
                          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form method="POST" action="../../models/UserModel.php">
                            <div class="row">
                              <div class="col-sm-12">
                                <div class="form-group form-group-default">
                                  <input type="hidden" name="user_id" id="editUserId" />
                                  <label>Nama</label>
                                  <input type="text" name="username" id="editUsername" class="form-control" placeholder="fill name" required />
                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="form-group form-group-default">
                                  <label>Email</label>
                                  <input type="email" name="email" id="editEmail" class="form-control" placeholder="fill email" required />
                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="form-group form-group-default">
                                  <label for="role">Role</label>
                                  <select id="editRole" name="role" class="form-control" required>
                                    <option value="">Pilih Role</option>
                                    <?php
                                    // Fetch all roles from 'users' table
                                    $roles = mysqli_query($koneksi, "SELECT DISTINCT role FROM user");

                                    // Check if the query was successful
                                    if ($roles) {
                                      // Loop through the result and create an option for each role
                                      while ($data = mysqli_fetch_array($roles)) {
                                        // Assuming 'role' is the field name in your 'users' table
                                        echo "<option value='" . htmlspecialchars($data['role']) . "'>" . htmlspecialchars($data['role']) . "</option>";
                                      }
                                    } else {
                                      // Handle the case where the query failed
                                      echo "<option value=''>Failed to retrieve roles</option>";
                                    }
                                    ?>
                                  </select>
                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="form-group form-group-default">
                                  <label>NIK</label>
                                  <input type="text" name="nik" id="editNIK" class="form-control" placeholder="fill NIK" required />
                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="form-group form-group-default">
                                  <label>Kategori</label>
                                  <select name="kategori_id" id="editKategori" class="form-control" required>
                                    <option value="">Select Kategori</option>
                                    <?php
                                    // Fetch all categories from 'kategori_program' table
                                    $kategori = mysqli_query($koneksi, "SELECT * FROM kategori_program");

                                    // Check if the query was successful
                                    if ($kategori) {
                                      // Loop through the result and create an option for each category
                                      while ($data = mysqli_fetch_array($kategori)) {
                                        // Option to retain selected category during edit
                                        echo "<option value='" . htmlspecialchars($data['kategori_id']) . "'>" . htmlspecialchars($data['nama_divisi']) . "</option>";
                                      }
                                    } else {
                                      // Handle the case where the query failed
                                      echo "<option value=''>Failed to retrieve categories</option>";
                                    }
                                    ?>
                                  </select>
                                </div>
                              </div>
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
                  // Function to fetch users from the database with optional date filtering
                  function fetchUsers($koneksi, $fromDate = null, $toDate = null)
                  {
                    // Start building the SQL query
                    $sql = "SELECT * FROM user";

                    // Add date filtering if both fromDate and toDate are provided
                    if ($fromDate && $toDate) {
                      $sql .= " WHERE DATE(created_at) BETWEEN ? AND ?";
                      $stmt = $koneksi->prepare($sql);
                      $stmt->bind_param("ss", $fromDate, $toDate);
                    } else {
                      $stmt = $koneksi->prepare($sql);
                    }

                    // Execute the query
                    $stmt->execute();
                    $result = $stmt->get_result();

                    // Check if there are users in the database
                    if ($result->num_rows > 0) {
                      // Loop through each user and output the data into table rows
                      while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                        <td>" . htmlspecialchars($row['username']) . "</td>
                        <td>" . htmlspecialchars($row['email']) . "</td>
                        <td>" . htmlspecialchars($row['nik']) . "</td>
                        <td>" . htmlspecialchars($row['role']) . "</td>
                        <td>" . htmlspecialchars($row['created_at']) . "</td>
                        <td>" . htmlspecialchars($row['updated_at']) . "</td>
                        <td>
                            <div class='form-button-action'>
                                <button class='btn btn-warning btn-round me-2' style='width: 100px;' 
                                        data-bs-toggle='modal' data-bs-target='#editRowModal' 
                                        onclick='populateEditModal(" . json_encode($row) . ")'>
                                    <i class='fa fa-edit'></i> Ubah
                                </button>
                                <button class='btn btn-danger btn-round' style='width: 100px' 
                                        onclick='confirmDelete(" . $row['user_id'] . ")'>
                                    <i class='fa fa-trash'></i> Hapus
                                </button>
                            </div>
                        </td>
                    </tr>";
                      }
                    } else {
                      echo "<tr><td colspan='7'>No users found</td></tr>";
                    }

                    // Close the statement
                    $stmt->close();
                  }

                  ?>

                  <!-- HTML Table Code -->
                  <div class="table-responsive">
                    <table id="add-row" class="display table table-striped table-hover">
                      <thead>
                        <tr>
                          <th>Nama</th>
                          <th>Email</th>
                          <th>NIK</th>
                          <th>Role</th>
                          <th>Tanggal Dibuat</th>
                          <th>Tanggal Diperbarui</th>
                          <th style="width: 10%">Aksi</th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <th>Nama</th>
                          <th>Email</th>
                          <th>NIK</th>
                          <th>Role</th>
                          <th>Tanggal Dibuat</th>
                          <th>Tanggal Diperbarui</th>
                          <th>Aksi</th>
                        </tr>
                      </tfoot>
                      <tbody>
                        <?php fetchUsers($koneksi, $fromDate, $toDate); ?>
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
    function populateEditModal(user) {
      document.getElementById('editUserId').value = user.user_id;
      document.getElementById('editUsername').value = user.username;
      document.getElementById('editEmail').value = user.email;
      document.getElementById('editRole').value = user.role;
      document.getElementById('editNIK').value = user.nik;
      document.getElementById('editKategori').value = user.kategori_id;
      // document.getElementById('editUpdatedAt').value = user.updated_at; // Untuk tampilan konfirmasi
    }
  </script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      window.confirmDelete = function(userId) {
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            // Submit form for deletion
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '../../models/UserModel.php';

            const userIdInput = document.createElement('input');
            userIdInput.type = 'hidden';
            userIdInput.name = 'user_id';
            userIdInput.value = userId;

            const actionInput = document.createElement('input');
            actionInput.type = 'hidden';
            actionInput.name = 'action';
            actionInput.value = 'delete';

            form.appendChild(userIdInput);
            form.appendChild(actionInput);

            document.body.appendChild(form);
            form.submit();
          }
        });
      };
    });
  </script>

  <script>
    // Cek URL parameter
    const urlParams = new URLSearchParams(window.location.search);
    const status = urlParams.get('status');
    const action = urlParams.get('action');

    // Tampilkan SweetAlert berdasarkan status dan action
    if (status === 'success' && action === 'add') {
      Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: 'Data berhasil ditambahkan.',
        confirmButtonText: 'OK'
      });
    } else if (status === 'success' && action === 'update') {
      Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: 'Data berhasil diubah.',
        confirmButtonText: 'OK'
      });
    } else if (status === 'error' && action === 'add') {
      Swal.fire({
        icon: 'error',
        title: 'Gagal!',
        text: 'Terjadi kesalahan saat menambahkan data.',
        confirmButtonText: 'OK'
      });
    } else if (status === 'error' && action === 'update') {
      Swal.fire({
        icon: 'error',
        title: 'Gagal!',
        text: 'Terjadi kesalahan saat mengubah data.',
        confirmButtonText: 'OK'
      });
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


</body>

</html>