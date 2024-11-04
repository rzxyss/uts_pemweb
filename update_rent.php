<?php
session_start();
include 'config.php';

if (!isset($_SESSION['account'])) {
    echo '<script>alert("Anda Harus Login");</script>';
    echo '<script>location="login.php";</script>';
    exit();
}
$sql = "UPDATE sewa SET status=1 WHERE id_sewa='$_GET[id]'";
$query = mysqli_query($conn, $sql);
if ($query) {
    echo "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Delete Account</title>
            <link rel='stylesheet' href='vendors/feather/feather.css' />
            <link rel='stylesheet' href='vendors/ti-icons/css/themify-icons.css' />
            <link rel='stylesheet' href='vendors/css/vendor.bundle.base.css' />
            <!-- endinject -->
            <!-- Plugin css for this page -->
            <link
            rel='stylesheet'
            href='vendors/datatables.net-bs4/dataTables.bootstrap4.css'
            />
            <link rel='stylesheet' href='vendors/ti-icons/css/themify-icons.css' />
            <link
            rel='stylesheet'
            type='text/css'
            href='js/select.dataTables.min.css'
            />
            <!-- End plugin css for this page -->
            <!-- inject:css -->
            <link rel='stylesheet' href='css/vertical-layout-light/style.css' />
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        </head>
        <body>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Rental has been update.',
                        icon: 'success',
                        timer: 3000,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.href = 'rent.php'; // Redirect to the accounts page
                    });
                });
            </script>
        </body>
        </html>";
} else {
    echo "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Delete Account</title>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        </head>
        <body>
            <script>
                Swal.fire({
                    title: 'Error!',
                    text: 'Failed to update the rental. Please try again.',
                    icon: 'error',
                    timer: 3000,
                    showConfirmButton: false
                }).then(() => {
                    window.location.href = 'rent.php'; // Redirect to the accounts page
                });
            </script>
        </body>
        </html>";
}
