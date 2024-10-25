<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

require 'database/config.php'; // Sesuaikan path

if (isset($_POST['login'])) {
  $email = mysqli_real_escape_string($koneksi, $_POST['email']);
  $password = $_POST['password'];

  // Query database untuk cek user
  $cekdatabase = mysqli_query($koneksi, "SELECT * FROM login WHERE email='$email'");
  $data = mysqli_fetch_assoc($cekdatabase);

  // Verifikasi password
  if ($data && password_verify($password, $data['password'])) {
    // Set session
    $_SESSION['log'] = 'True';
    $_SESSION['level'] = $data['level'];
    $_SESSION['email'] = $email;

    // Redirect sesuai level user
    switch ($data['level']) {
      case 'admin':
        header('Location: ../views/admin/index.php');
        break;
      case 'user':
        header('Location: ../views/user/index.php');
        break;
      case 'supervisor':
        header('Location: ../views/supervisor/index.php');
        break;
    }
    exit();
  } else {
    header('Location: ../login.php?error=invalid');
    exit();
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
  <link rel="stylesheet" href="assets/css/login.css" />
  <title>Drafting KAK - BAKTI</title>
  <link rel="icon" href="assets/img/kaiadmin/favicon.ico" type="image/x-icon" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
  
  <style>
    .container {
      width: 100%;
      max-width: 800px;
      margin: 0 auto;
      display: flex;
      justify-content: space-between;
      padding: 20px;
    }

    .form-container {
      width: 100%;
      max-width: 400px;
    }

    .toggle-container {
      width: 100%;
      max-width: 400px;
    }
  </style>
</head>

<body>
  <div class="container" id="container">
    <div class="form-container sign-up">
      <form></form>
    </div>
    <div class="form-container sign-in">
      <form action="controllers/usercontroller.php" method="POST"> <!-- Updated action -->
        <h1>Sign In</h1>
        <div class="social-icons"></div>

        <div class="input-container">
          <i class="fa fa-envelope fa-icon"></i>
          <input type="email" name="email" id="inputEmail" placeholder="Email" required />
        </div>

        <div class="input-container">
          <i class="fa fa-lock fa-icon"></i>
          <input type="password" name="password" placeholder="Password" id="inputPassword" required />
          <i class="fas fa-eye-slash eye-icon" id="togglePassword"></i>
        </div>

        <a href="#" style="font-weight: bold; text-decoration: underline; float: right" data-toggle="modal" data-target="#lupaRowModal">Lupa Password</a>
        <button type="submit" name="login">Login</button>
      </form>
    </div>

    <div class="toggle-container">
      <div class="toggle">
        <div class="toggle-panel toggle-left"></div>
        <div class="toggle-panel toggle-right">
          <img src="assets/img/kaiadmin/logo_bakti.png" alt="Logo BAKTI" class="logo-image" />
          <h1>Drafting KAK</h1>
          <h3>(Kerangka Acuan Kerja)</h3>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Lupa Password -->
  <div class="modal fade" id="lupaRowModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header border-0">
          <h5 class="modal-title">
            <span class="fw-mediumbold">Lupa Password</span>
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body" style="max-height: 400px; overflow-y: auto;">
          <form>
            <div class="form-group form-group-default">
              <label>Masukkan email anda</label>
              <input type="text" class="form-control" placeholder="example@gmail.com" />
            </div>
          </form>
        </div>

        <div class="modal-footer border-0">
          <button type="button" class="btn btn-primary">Kirim</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <script>
    const togglePassword = document.querySelector("#togglePassword");
    const password = document.querySelector("#inputPassword");

    togglePassword.addEventListener("click", function() {
      const type = password.getAttribute("type") === "password" ? "text" : "password";
      password.setAttribute("type", type);
      this.classList.toggle("fa-eye");
      this.classList.toggle("fa-eye-slash");
    });
  </script>
</body>

</html>