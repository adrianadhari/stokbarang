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
    <title>Barang Masuk</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">

</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="index.html">PT. Mitra Harun Gasindo</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
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
                    <h1 class="mt-4">Barang Masuk</h1>
                    <div class="card mb-4">
                        <div class="card-header">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                Tambah Barang Masuk
                            </button>
                            <a href="exportmasuk.php" class="btn btn-info">Export Data Masuk</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Tanggal Input Ke Sistem </th>
                                            <th>Nama Barang</th>
                                            <th>Invoice</th>
                                            <th>Harga Satuan</th>
                                            <th>Nama Supplier</th>
                                            <th>Quantity</th>
                                            <th>Total Harga</th>
                                            <th>Tanggal Masuk Barang</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $ambilsemuadata = mysqli_query($conn, "select * from masuk m, stok s where s.idbarang = m.idbarang");
                                        while ($data = mysqli_fetch_array($ambilsemuadata)) {
                                            $tanggal = $data['tanggal'];
                                            $namabarang = $data['namabarang'];
                                            $hargasatuan = $data['hargasatuan'];
                                            $namasupplier = $data['namasupplier'];
                                            $qty = $data['qty'];
                                            $totalharga = $data['totalharga'];
                                            $idb = $data['idbarang'];
                                            $idm = $data['idmasuk'];
                                            $tanggalmasuk = $data['tanggalmasuk'];
                                            $invoice = $data['invoice'];
                                            $tanggalmasuk_indo = TanggalIndo($tanggalmasuk);
                                        ?>

                                            <tr>
                                                <td><?= $tanggal ?></td>
                                                <td><?= $namabarang ?></td>
                                                <td><?= $invoice ?></td>
                                                <td><?= $hargasatuan ?></td>
                                                <td><?= $namasupplier ?></td>
                                                <td><?= $qty ?></td>
                                                <td><?= $totalharga ?></td>
                                                <td><?= $tanggalmasuk_indo ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?= $idm; ?>">
                                                        Edit
                                                    </button>

                                                </td>
                                            </tr>
                                            <!--Edit Modal -->
                                            <div class="modal fade" id="edit<?= $idm; ?>">
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
                                                                <input type="hidden" name="idb" value="<?= $idb; ?>">
                                                                <input type="hidden" name="idm" value="<?= $idm; ?>">
                                                                Tanggal Masuk Barang :
                                                                <input type="date" name="tanggalmasuk_" id="tanggalmasuk_<?= $idm; ?>" value="<?= $tanggalmasuk; ?>" class="form-control datepicker" required><br>
                                                                Nama Barang :
                                                                <div class="form-control"><?= $namabarang; ?></div><br>
                                                                Invoice :
                                                                <input type="text" name="invoice" value="<?= $invoice; ?>" class="form-control" required><br>
                                                                Harga Satuan : <br>
                                                                <input type="number" name="hargasatuan" value="<?= $hargasatuan; ?>" class="form-control" required><br>
                                                                Nama Supplier : <br>
                                                                <input type="text" name="namasupplier" value="<?= $namasupplier; ?>" class="form-control" required><br>
                                                                Quantity : <br>
                                                                <input type="number" name="qty" value="<?= $qty; ?>" class="form-control" required><br>
                                                                <button type="submit" class="btn btn-primary" name="updatebarangmasuk">Submit</button>
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


    <script>
        $(function() {
            $('[id^="tanggalmasuk_"]').datepicker({
                dateFormat: "dd/mm/yy",
                dateMonth: true,
                dateYear: true
            });
        });
    </script>
</body>
<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Tambah Barang Masuk</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <form method="post">
                <div class="modal-body">
                    <input type="date" name="tanggalmasuk" id="tanggalmasuk" class="form-control datepicker" placeholder="Tanggal Masuk Barang" required><br>
                    <select name="barangnya" class="form-control">
                        <?php
                        $ambilsemuadatanya = mysqli_query($conn, "select * from stok");
                        while ($fetcharray = mysqli_fetch_array($ambilsemuadatanya)) {
                            $namabarangnya = $fetcharray['namabarang'];
                            $idbarangnya = $fetcharray['idbarang'];
                        ?>
                            <option value="<?= $idbarangnya; ?>"><?= $namabarangnya; ?></option>
                        <?php
                        }
                        ?>

                    </select>
                    <br>
                    <input type="text" name="invoice" class="form-control" placeholder="Invoice"><br>
                    <select name="supplier2" class="form-control">
                        <?php
                        $ambilsemuadata = mysqli_query($conn, "select * from supplier");
                        while ($fetcharray = mysqli_fetch_array($ambilsemuadata)) {
                            $namasupplier = $fetcharray['namasupplier'];
                            $idsupplier = $fetcharray['idsupplier'];
                        ?>
                            <option value="<?= $idsupplier; ?>"><?= $namasupplier; ?></option>
                        <?php
                        }
                        ?>

                    </select>
                    <br>
                    <input type="number" name="qty" class="form-control" placeholder="Quantity" required><br>
                    <input type="number" name="hargasatuan" class="form-control" placeholder="Harga Satuan" required><br>
                    <button type="submit" class="btn btn-primary" name="barangmasuk">Submit</button>
                </div>
            </form>

        </div>
    </div>
</div>

<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<!-- <script src="https://code.jquery.com/jquery-3.6.0.js"></script> -->
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

<script>
    $(function() {
        $("#tanggalmasuk").datepicker({
            dateFormat: "dd/mm/yy",
            dateMonth: true,
            dateYear: true

        });
    });
</script>

</html>

<?php
//menambah barang masuk
if (isset($_POST['barangmasuk'])) {
    $barangnya = $_POST['barangnya'];
    $supplier2 = $_POST['supplier2'];
    $qty = $_POST['qty'];
    $hargasatuan = $_POST['hargasatuan'];
    $tgl_msk = $_POST['tanggalmasuk'];
    $invoice = $_POST['invoice'];

    //konversi tanggal masuk ke database
    // $tanggalmasuk = InputTgl($tgl_msk);

    $tanggalmasuk = date('Y-m-d', strtotime($tgl_msk));

    //mengambil nama supplier
    $getSupplierInfo = mysqli_query($conn, "SELECT * FROM supplier WHERE idsupplier = '$supplier2'");
    $supplierInfo = mysqli_fetch_assoc($getSupplierInfo);

    // Mendapatkan idsupplier dan namasupplier
    $idsupplier = $supplierInfo['idsupplier'];
    $namasupplier = $supplierInfo['namasupplier'];


    //langkah menyamakan atau mengupdate qty stok yang di input dengan yang ada di stok
    $cekstoksekarang = mysqli_query($conn, "select * from stok where idbarang='$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstoksekarang);

    $stoksekarang = $ambildatanya['jmlhstok'];
    $tambahkanstoksekarangdenganquantity = $stoksekarang + $qty;

    //langkah menyamakan inputan supplier


    //hitung total harga
    $totalharga = $qty * $hargasatuan;

    $addtomasuk = mysqli_query($conn, "insert into masuk (idbarang, qty, hargasatuan,totalharga, idsupplier, namasupplier, tanggalmasuk, invoice) values ('$barangnya', '$qty','$hargasatuan','$totalharga','$idsupplier','$namasupplier','$tanggalmasuk','$invoice')");
    $updatestokmasuk = mysqli_query($conn, "update stok set jmlhstok='$tambahkanstoksekarangdenganquantity' where idbarang='$barangnya'");

    if ($addtomasuk && $updatestokmasuk) {
        echo '<script type="text/javascript">      
        Swal.fire({
            position: "center",
            icon: "success",
            title: "Data Telah Ditambahkan",
            showConfirmButton: false,
            timer: 1500
        });
        setTimeout(function () { 
        window.location.href = "masuk.php"; 
        }, 1500);
        </script>';
    } else {
        echo 'Gagal';
        header('location:masuk.php');
    }
};
?>
<?php
// Update info barang
if (isset($_POST['updatebarangmasuk'])) {
    $idb = $_POST['idb'];
    $idm = $_POST['idm'];
    $hargasatuan = $_POST['hargasatuan'];
    $qty = $_POST['qty'];
    $namasupplier = $_POST['namasupplier'];
    $tgl_msk = $_POST['tanggalmasuk_'];
    $invoice = $_POST['invoice'];

    //Mengambil tanggal sebelumnya

    // $tanggalmasuk = EditTgl($tgl_msk);

    $tanggalmasuk = date('Y-m-d', strtotime($tgl_msk));

    // Mengambil stok sebelumnya
    $lihatstok = mysqli_query($conn, "SELECT jmlhstok FROM stok WHERE idbarang='$idb'");
    $stoknya = mysqli_fetch_array($lihatstok);
    $stoksebelumnya = $stoknya['jmlhstok'];

    // Mengambil qty sebelumnya
    $lihatqty = mysqli_query($conn, "SELECT qty FROM masuk WHERE idmasuk='$idm'");
    $qtynya = mysqli_fetch_array($lihatqty);
    $qtysblm = $qtynya['qty'];

    // Menghitung selisih qty
    $selisih_qty = $qty - $qtysblm;

    // Memperbarui stok berdasarkan selisih qty
    $stok_baru = $stoksebelumnya + $selisih_qty;

    // Update stok
    $update_stok = mysqli_query($conn, "UPDATE stok SET jmlhstok='$stok_baru' WHERE idbarang='$idb'");

    // Update informasi barang masuk
    $update_masuk = mysqli_query($conn, "UPDATE masuk SET qty='$qty', hargasatuan='$hargasatuan', namasupplier='$namasupplier', tanggalmasuk='$tanggalmasuk', invoice='$invoice' WHERE idmasuk='$idm'");

    if ($update_stok && $update_masuk) {
        echo '<script type="text/javascript">      
        Swal.fire({
            position: "center",
            icon: "success",
            title: "Data Telah Diedit",
            showConfirmButton: false,
            timer: 1500
        });
        setTimeout(function () { 
        window.location.href = "masuk.php"; 
        }, 1500);
        </script>';
    } else {
        echo 'Gagal';
        header('location:masuk.php');
    }
}


//fungsi tanngal masuk
function InputTgl($tanggal)
{
    $pisah = explode('/', $tanggal);
    $lari = array($pisah[2], $pisah[1], $pisah[0]);
    $satukan = implode("-", $lari);

    return $satukan;
}
//fungsi edit tanngal masuk
function EditTgl($tanggal)
{
    $pisah = explode('/', $tanggal);
    $lari = array($pisah[2], $pisah[1], $pisah[0]);
    $satukan = implode("-", $lari);

    return $satukan;
}
//agar berurutan tanggalnya dan muncul bulannya
function TanggalIndo($tgl)
{
    $tanggal = substr($tgl, 8, 2);
    $bulan = Bulan(substr($tgl, 5, 2));
    $tahun = substr($tgl, 0, 4);

    return $tanggal . " " . $bulan . " " . $tahun;
}

function Bulan($bln)
{
    if ($bln == "01") {
        return "Januari";
    } elseif ($bln == "02") {
        return "Februari";
    } elseif ($bln == "03") {
        return "Maret";
    } elseif ($bln == "04") {
        return "April";
    } elseif ($bln == "05") {
        return "Mei";
    } elseif ($bln == "06") {
        return "Juni";
    } elseif ($bln == "07") {
        return "Juli";
    } elseif ($bln == "08") {
        return "Agustus";
    } elseif ($bln == "09") {
        return "September";
    } elseif ($bln == "10") {
        return "Oktober";
    } elseif ($bln == "11") {
        return "November";
    } elseif ($bln == "12") {
        return "Desember";
    }
}
?>