<?php
session_start();
include 'config.php';

if (!isset($_SESSION['account'])) {
  echo '<script>alert("Anda Harus Login");</script>';
  echo '<script>location="login.php";</script>';
  exit();
}
$sql = "SELECT * FROM akun WHERE id_akun='$_GET[id]'";
$result = mysqli_query($conn, $sql);
$account = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta
    name="viewport"
    content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>Epull Rental</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/feather/feather.css" />
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css" />
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css" />
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link
    rel="stylesheet"
    href="vendors/datatables.net-bs4/dataTables.bootstrap4.css" />
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css" />
  <link
    rel="stylesheet"
    type="text/css"
    href="js/select.dataTables.min.css" />
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/vertical-layout-light/style.css" />
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div
        class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="index.php">
          <h3>Epull Rental</h3>
        </a>
        <a class="navbar-brand brand-logo-mini" href="index.php">
          <h3>ER</h3>
        </a>
      </div>
      <div
        class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button
          class="navbar-toggler navbar-toggler align-self-center"
          type="button"
          data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-profile dropdown">
            <a
              class="nav-link dropdown-toggle"
              href="#"
              data-toggle="dropdown"
              id="profileDropdown">
              <img src="images/person.jpg" alt="profile" />
            </a>
            <div
              class="dropdown-menu dropdown-menu-right navbar-dropdown"
              aria-labelledby="profileDropdown">
              <a href="logout.php" class="dropdown-item">
                <i class="ti-power-off text-primary"></i>
                Logout
              </a>
            </div>
          </li>
        </ul>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="./">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="account.php">
              <i class="ti-user menu-icon"></i>
              <span class="menu-title">Account</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="vehicle.php">
              <i class="ti-car menu-icon"></i>
              <span class="menu-title">Vechile</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="rent.php">
              <i class="ti-money menu-icon"></i>
              <span class="menu-title">Rental</span>
            </a>
          </li>
        </ul>
      </nav>
      <!--content-wrapper start -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="card">
            <div class="card-body">
              <h3 class="font-weight-bold mb-3">Update Account</h3>
              <form class="forms-sample" method="POST">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">National ID Card</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" value="<?= $account['id_akun'] ?>" name="nik" placeholder="National ID Card">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Name</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" value="<?= $account['nama'] ?>" name="nama" placeholder="Name">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Email</label>
                  <div class="col-sm-9">
                    <input type="email" class="form-control" value="<?= $account['email'] ?>" name="email" placeholder="Email">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Phone Number</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" value="<?= $account['no_telp'] ?>" name="telp" placeholder="Phone Number">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Username</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" value="<?= $account['username'] ?>" name="username" placeholder="Username">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Password</label>
                  <div class="col-sm-9">
                    <input type="password" class="form-control" name="password" placeholder="Password">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Role</label>
                  <div class="col-sm-9">
                    <select name="role" class="form-control">
                      <option value="pengguna" <?= $account['role'] == "pengguna" ? 'selected' : '' ?>>User</option>
                      <option value="admin" <?= $account['role'] == "admin" ? 'selected' : '' ?>>Admin</option>
                    </select>
                  </div>
                </div>
                <button name="update" class="btn btn-success mr-2">Submit</button>
                <a href="account.php" class="btn btn-danger">Cancel</a>
              </form>
              <?php
              if (isset($_POST['update'])) {
                $nik = $_POST['nik'];
                $nama = $_POST['nama'];
                $telp = $_POST['telp'];
                $email = $_POST['email'];
                $username = $_POST['username'];
                $password = $_POST['password'];
                $md5Pass = md5($password);
                $role = $_POST['role'];

                if (!empty($password)) {
                  $sql = "UPDATE akun SET id_akun='$nik', nama='$nama', no_telp='$telp', email='$email', username='$username', password='$md5Pass', role='$role' WHERE id_akun='$_GET[id]'";
                  $query = mysqli_query($conn, $sql);
                  if ($query) {
                    echo "
                                        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                                        <script>
                                            Swal.fire({
                                                title: 'Success!',
                                                text: 'Account has updated.',
                                                icon: 'success',
                                                timer: 3000,
                                                showConfirmButton: false
                                            }).then(() => {
                                                window.location.href = 'account.php';
                                            });
                                        </script>                                    
                                        ";
                  } else {
                    echo "
                                        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                                        <script>
                                            Swal.fire({
                                                title: 'Error!',
                                                text: 'Account failed to updated.',
                                                icon: 'error',
                                                timer: 3000,
                                                showConfirmButton: false
                                            });
                                        </script>                                    
                                        ";
                  }
                } else {
                  $sql = "UPDATE akun SET id_akun='$nik', nama='$nama', no_telp='$telp', email='$email', username='$username', role='$role' WHERE id_akun='$_GET[id]'";
                  $query = mysqli_query($conn, $sql);
                  if ($query) {
                    echo "
                                        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                                        <script>
                                            Swal.fire({
                                                title: 'Success!',
                                                text: 'Account has updated.',
                                                icon: 'success',
                                                timer: 3000,
                                                showConfirmButton: false
                                            }).then(() => {
                                                window.location.href = 'account.php';
                                            });
                                        </script>                                    
                                        ";
                  } else {
                    echo "
                                        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                                        <script>
                                            Swal.fire({
                                                title: 'Error!',
                                                text: 'Account failed to updated.',
                                                icon: 'error',
                                                timer: 3000,
                                                showConfirmButton: false
                                            });
                                        </script>                                    
                                        ";
                  }
                }
              }
              ?>
            </div>
          </div>
        </div>
        <footer class="footer">
          <div
            class="d-sm-flex justify-content-center justify-content-sm-between">
            <span
              class="text-muted text-center text-sm-left d-block d-sm-inline-block">&copy; 152023146 Rizki Saepul Aziz</span>
        </footer>
      </div>
    </div>
  </div>

  <!-- plugins:js -->
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="vendors/chart.js/Chart.min.js"></script>
  <script src="vendors/datatables.net/jquery.dataTables.js"></script>
  <script src="vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
  <script src="js/dataTables.select.min.js"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <script src="js/settings.js"></script>
  <script src="js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="js/dashboard.js"></script>
  <script src="js/Chart.roundedBarCharts.js"></script>
  <!-- End custom js for this page-->
</body>

</html>