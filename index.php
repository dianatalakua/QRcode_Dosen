<?php
include 'assets/navbar.php';
include 'include/config.php'; // Sertakan file konfigurasi database

// Eksekusi kueri SQL untuk mengambil data dari tabel JadwalMatkul
$query = "SELECT JadwalMatkul.id, matkul.nama_matkul AS matkul_nama, JadwalMatkul.dosen_id, JadwalMatkul.hari, JadwalMatkul.waktumulai, JadwalMatkul.waktuselesai, JadwalMatkul.ruang FROM JadwalMatkul
LEFT JOIN matkul ON JadwalMatkul.matkul_id = matkul.id"; // Menggabungkan tabel JadwalMatkul dan MataKuliah

$result = mysqli_query($conn, $query);

if (!$result) {
    die("Kesalahan dalam kueri SQL: " . mysqli_error($conn));
}

?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <!-- Table Header -->
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Mata Kuliah</th>
                                <th>Dosen</th>
                                <th>Hari</th>
                                <th>Waktu Mulai</th>
                                <th>Waktu Selesai</th>
                                <th>Ruang</th>
                                <th>QR Code</th> <!-- Kolom tambahan untuk QR Code -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Loop melalui hasil kueri dan tampilkan data dalam baris tabel
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<tr>';
                                echo '<td>' . $row['id'] . '</td>';
                                echo '<td>' . $row['matkul_nama'] . '</td>'; // Menampilkan nama mata kuliah
                                echo '<td>' . $row['dosen_id'] . '</td>';
                                echo '<td>' . $row['hari'] . '</td>';
                                echo '<td>' . $row['waktumulai'] . '</td>';
                                echo '<td>' . $row['waktuselesai'] . '</td>';
                                echo '<td>' . $row['ruang'] . '</td>';
                                echo '<td>';
                                echo '<a href="profile_mahasiswa.php"><i class="fas fa-user"></i></a>';
                                echo '<i style="margin-right: 15px;"></i>'; // Menambahkan margin kanan sebesar 15px
                                echo '<a href="generate_qr.php?id=' . $row['id'] . '"><i class="fas fa-qrcode"></i></a>';
                                echo '</td>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<?php include 'assets/footer.php' ?>
