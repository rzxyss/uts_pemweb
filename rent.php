<?php
session_start();
include 'config.php';

if (!isset($_SESSION['account'])) {
    echo '<script>alert("Anda Harus Login");</script>';
    echo '<script>location="login.php";</script>';
    exit();
}
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
                            <div class="d-flex align-items-center justify-content-between pb-2">
                                <h3 class="font-weight-bold">Rental</h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Plate Number</th>
                                            <th>Transaction Date</th>
                                            <th>Rent Price</th>
                                            <th>Rental Length</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $query = mysqli_query($conn, "SELECT sewa.id_sewa, sewa.id_kendaraan, sewa.id_akun, sewa.tgl_transaksi, sewa.tarif, sewa.lama_sewa, sewa.status, akun.nama FROM sewa JOIN akun ON akun.id_akun = sewa.id_akun JOIN kendaraan ON kendaraan.id_kendaraan = sewa.id_kendaraan");
                                        while ($rent = mysqli_fetch_assoc($query)) {
                                        ?>
                                            <tr>
                                                <td><?= $no ?></td>
                                                <td><?= $rent['nama'] ?></td>
                                                <td><?= $rent['id_kendaraan'] ?></td>
                                                <td><?= $rent['tgl_transaksi'] ?></td>
                                                <td><?= $rent['tarif'] ?></td>
                                                <td><?= $rent['lama_sewa'] ?></td>
                                                <td><?= $rent['status'] == 1 ? "<label class='badge badge-success'>Completed</label>" : "<label class='badge badge-danger'>Uncompleted</label>" ?></td>
                                                <td><button onclick="updateStatus('<?= addslashes($rent['id_sewa']) ?>')" class="btn btn-warning btn-xs ml-1">Update</button></td>
                                            </tr>
                                        <?php
                                            $no++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function updateStatus(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "This rental is complete?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, it's done"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "update_rent.php?id=" + id;
                }
            });
        }
    </script>

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