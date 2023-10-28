<?php
require 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Stok Barang</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">

</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="index.html">PT. Mitra Harun Gasindo</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 " id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                            Stok Barang
                        </a>
                        <a class="nav-link" href="masuk.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-parachute-box"></i></div>
                            Barang Masuk
                        </a>
                        <a class="nav-link" href="keluar.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-truck"></i></div>
                            Barang Keluar
                        </a>
                        <a class="nav-link" href="supplier.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                            Daftar Supplier
                        </a>
                        <a class="nav-link" href="logout.php">
                            Logout
                        </a>
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <h1 class="mt-4">Data Supplier</h1>
                    <div class="card mb-4">
                        <div class="card-header">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal2">
                                Tambah Data Supplier
                            </button>
                            <a href="exportsupplier.php" class="btn btn-info">Export Data Supplier</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Supplier</th>
                                            <th>Keterangan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $ambilsemuadata = mysqli_query($conn, "select * from supplier");
                                        $i = 1;
                                        while ($data = mysqli_fetch_array($ambilsemuadata)) {
                                            $namasupplier = $data['namasupplier'];
                                            $keterangan = $data['keterangan'];
                                            $ids = $data['idsupplier'];
                                        ?>

                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $namasupplier ?></td>
                                                <td><?= $keterangan ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?= $ids; ?>">
                                                        Edit
                                                    </button>
                                                    <input type="hidden" name="idbarangygingindihapus" value="<?= $idb; ?>">
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?= $ids; ?>">
                                                        Delete
                                                    </button>
                                                </td>
                                            </tr>
                                            <!--Edit Modal -->
                                            <div class="modal fade" id="edit<?= $ids; ?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">

                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Edit Data Barang</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>

                                                        <!-- Modal body -->
                                                        <form method="post">
                                                            <div class="modal-body">
                                                                Nama Supplier : <br>
                                                                <input type="text" name="namasupplier" value="<?= $namasupplier; ?>" class="form-control" required><br>
                                                                Keterangan : <br>
                                                                <input type="text" name="keterangan" value="<?= $keterangan; ?>" class="form-control" required><br>
                                                                <input type="hidden" name="ids" value="<?= $ids; ?>">
                                                                <button type="submit" class="btn btn-primary" name="updatesupplier">Submit</button>
                                                            </div>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>

                                            <!--Delete Modal -->
                                            <div class="modal fade" id="delete<?= $ids; ?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">

                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Hapus Data?</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>

                                                        <!-- Modal body -->
                                                        <form method="post">
                                                            <div class="modal-body">
                                                                Apakah Anda yakin ingin menghapus <?= $namasupplier; ?>?
                                                                <input type="hidden" name="ids" value="<?= $ids; ?>">
                                                                <br><br>
                                                                <button type="submit" class="btn btn-danger" name="hapussupplier">Hapus</button>
                                                            </div>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>

                                        <?php
                                        };

                                        ?>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2020</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/datatables-demo.js"></script>
</body>

<!-- The Modal -->
<div class="modal fade" id="myModal2">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Supplier</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <form method="post">
                <div class="modal-body">
                    <input type="text" name="supplier" placeholder="Input Supplier" class="form-control" required><br>
                    <input type="text" name="keterangan" placeholder="Keterangan" class="form-control" required><br>
                    <button type="submit" class="btn btn-primary" name="addnewsupplier">Submit</button>
                </div>
            </form>

        </div>
    </div>
</div>

</html>

<?php
//menambah supplier baru
if (isset($_POST['addnewsupplier'])) {
    $supplier = $_POST['supplier'];
    $keterangan = $_POST['keterangan'];

    $addtotable2 = mysqli_query($conn, "INSERT INTO supplier (`namasupplier`, `keterangan`) VALUES ('$supplier', '$keterangan')");
    if ($addtotable2) {
        echo '<script type="text/javascript">      
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "Data Telah Ditambahkan",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        setTimeout(function () { 
                        window.location.href = "supplier.php"; 
                        }, 1500);
                        </script>';
    } else {
        echo 'Gagal';
        header('location:supplier.php');
    }
};
?>

<?php
//Update info supplier
if (isset($_POST['updatesupplier'])) {
    $ids = $_POST['ids'];
    $namasupplier = $_POST['namasupplier'];
    $keterangan = $_POST['keterangan'];

    $update = mysqli_query($conn, "update supplier set namasupplier='$namasupplier', keterangan='$keterangan' where idsupplier='$ids'");
    if ($update) {
        echo '<script type="text/javascript">      
        Swal.fire({
            position: "center",
            icon: "success",
            title: "Data Telah Diedit",
            showConfirmButton: false,
            timer: 1500
        });
        setTimeout(function () { 
        window.location.href = "supplier.php"; 
        }, 1500);
        </script>';
    } else {
        echo 'Gagal';
        header('location:supplier.php');
    }
}
//Hapus supplier
if (isset($_POST['hapussupplier'])) {
    $ids = $_POST['ids'];

    $hapus = mysqli_query($conn, "delete from supplier where idsupplier='$ids'");
    if ($hapus) {
        echo '<script type="text/javascript">      
        Swal.fire({
            position: "center",
            icon: "success",
            title: "Data Berhasil Dihapus",
            showConfirmButton: false,
            timer: 1500
        });
        setTimeout(function () { 
        window.location.href = "supplier.php"; 
        }, 1500);
        </script>';
    } else {
        echo 'Gagal';
        header('location:supplier.php');
    }
}
?>