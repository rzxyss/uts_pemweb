<?php
session_start();
include 'config.php';

if(!isset($_SESSION['account'])){
  echo '<script>alert("Anda Harus Login");</script>';
  echo '<script>location="login.php";</script>';
  exit();
}
$sql = "SELECT * FROM kendaraan WHERE id_kendaraan='$_GET[id]'";
$result = mysqli_query($conn, $sql);
$vehicle = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <title>Epull Rental</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="vendors/feather/feather.css" />
    <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css" />
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css" />
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link
      rel="stylesheet"
      href="vendors/datatables.net-bs4/dataTables.bootstrap4.css"
    />
    <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css" />
    <link
      rel="stylesheet"
      type="text/css"
      href="js/select.dataTables.min.css"
    />
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
          class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center"
        >
          <a class="navbar-brand brand-logo mr-5" href="index.php"
            ><h3>Epull Rental</h3></a>
          <a class="navbar-brand brand-logo-mini" href="index.php"
            ><h3>ER</h3></a>
        </div>
        <div
          class="navbar-menu-wrapper d-flex align-items-center justify-content-end"
        >
          <button
            class="navbar-toggler navbar-toggler align-self-center"
            type="button"
            data-toggle="minimize"
          >
            <span class="icon-menu"></span>
          </button>
          <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
              <a
                class="nav-link dropdown-toggle"
                href="#"
                data-toggle="dropdown"
                id="profileDropdown"
              >
                <img src="images/person.jpg" alt="profile" />
              </a>
              <div
                class="dropdown-menu dropdown-menu-right navbar-dropdown"
                aria-labelledby="profileDropdown"
              >
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
          </ul>
        </nav>
        <!--content-wrapper start -->
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="card">
                    <div class="card-body">
                        <h3 class="font-weight-bold mb-3">Update Vehicle</h3>
                        <form class="forms-sample" method="POST">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Plate Number</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="<?= $vehicle['id_kendaraan'] ?>" name="id" placeholder="Plate Number">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Vehicle Type</label>
                                <div class="col-sm-9">
                                    <select name="jenis" class="form-control">
                                        <option value="Motor" <?= $vehicle['jenis_kendaraan'] == "Motor" ? 'selected' : '' ?>>Motor</option>
                                        <option value="Mobil" <?= $vehicle['jenis_kendaraan'] == "Mobil" ? 'selected' : '' ?>>Mobil</option>
                                        <option value="Bus" <?= $vehicle['jenis_kendaraan'] == "Bus" ? 'selected' : '' ?>>Bus</option>
                                        <option value="Elf" <?= $vehicle['jenis_kendaraan'] == "Elf" ? 'selected' : '' ?>>Elf</option>
                                        <option value="Hiace" <?= $vehicle['jenis_kendaraan'] == "Hiace" ? 'selected' : '' ?>>Hiace</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Vehicle Brand</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="<?= $vehicle['merk_kendaraan'] ?>" name="merk" placeholder="Vehicle Brand">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Vehicle Model</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="<?= $vehicle['model_kendaraan'] ?>" name="model" placeholder="Vehicle Model">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Rent Price <span>/day</span></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="<?= $vehicle['tarif'] ?>" name="tarif" placeholder="Rent Price">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Status</label>
                                <div class="col-sm-9">
                                    <select name="status" class="form-control">
                                        <option value="1" <?= $vehicle['status'] == 1 ? 'selected' : '' ?>>Available</option>
                                        <option value="0" <?= $vehicle['status'] == 0 ? 'selected' : '' ?>>Not Available</option>
                                    </select>
                                </div>
                            </div>
                            <button name="update" class="btn btn-success mr-2">Submit</button>
                            <a href="vehicle.php" class="btn btn-danger">Cancel</a>
                        </form>
                        <?php
                            if (isset($_POST['update'])) {
                                $id = $_POST['id'];
                                $jenis = $_POST['jenis'];
                                $merk = $_POST['merk'];
                                $model = $_POST['model'];
                                $tarif = $_POST['tarif'];
                                $status = $_POST['status'];

                                $sql = "UPDATE kendaraan SET id_kendaraan='$id', jenis_kendaraan='$jenis', merk_kendaraan='$merk', model_kendaraan='$model', tarif='$tarif', status='$status' WHERE id_kendaraan='$_GET[id]'";
                                $query = mysqli_query($conn, $sql);
                                if($query){
                                    echo "
                                    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                                    <script>
                                        Swal.fire({
                                            title: 'Success!',
                                            text: 'Vehicle has updated.',
                                            icon: 'success',
                                            timer: 3000,
                                            showConfirmButton: false
                                        }).then(() => {
                                            window.location.href = 'vehicle.php';
                                        });
                                    </script>                                    
                                    ";
                                }else{
                                    echo "
                                    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                                    <script>
                                        Swal.fire({
                                            title: 'Error!',
                                            text: 'Vehicle failed to updated.',
                                            icon: 'error',
                                            timer: 3000,
                                            showConfirmButton: false
                                        });
                                    </script>                                    
                                    ";
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
            <footer class="footer">
                <div
                class="d-sm-flex justify-content-center justify-content-sm-between"
                >
                <span
                    class="text-muted text-center text-sm-left d-block d-sm-inline-block"
                    >&copy; 152023146 Rizki Saepul Aziz</span
                >
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

    <!-- Sweet Alert -->

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