<?php
# Memulakan fungsi session dan memanggil fail header.php
session_start();
include('header.php');
?>

<!-- Bahagian Borang(form) Login dengan Peningkatan Visual -->
<div style="display: flex; justify-content: center; margin-top: 20px;">
    <div style="width: 400px; padding: 20px; border: 1px solid #ccc; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        <h3 style="text-align: center; color: #333;">Pendaftaran Pembeli Baru (SIGN UP)</h3>
        <p style="text-align: center; color: #555;">Sila Lengkapkan Maklumat di Bawah</p>
        <form action='' method='POST'>
            <div style="margin-bottom: 15px;">
                <label for="idcus" style="display: block; margin-bottom: 5px; font-weight: bold;">IDCUSTOMER</label>
                <input required type='text' id='idcus' name='idcus' style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;">
            </div>
            <div style="margin-bottom: 15px;">
                <label for="nama" style="display: block; margin-bottom: 5px; font-weight: bold;">NAMA</label>
                <input required type='text' id='nama' name='nama' style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;">
            </div>
            <div style="margin-bottom: 15px;">
                <label for="alamat" style="display: block; margin-bottom: 5px; font-weight: bold;">ALAMAT</label>
                <input required type='text' id='alamat' name='alamat' style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;">
            </div>
            <div style="margin-bottom: 15px;">
                <label for="notel" style="display: block; margin-bottom: 5px; font-weight: bold;">NOTEL</label>
                <input required type='text' id='notel' name='notel' style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;">
            </div>
            <div style="margin-bottom: 20px;">
                <label for="pass" style="display: block; margin-bottom: 5px; font-weight: bold;">KATALALUAN</label>
                <input required type='password' id='pass' name='pass' style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;">
            </div>
            <div style="text-align: center;">
                <input type='submit' value='Sign Up' style="padding: 10px 20px; border: none; border-radius: 5px; background-color: #28a745; color: #fff; cursor: pointer; font-size: 16px;">
            </div>
        </form>
    </div>
</div>

<?php
# Bahagian proses login
# Menyemak kewujudan data POST
if (!empty($_POST)) {
    # Memanggil fail connection 
    include('connection.php');

    # Mengambil data daripada borang (form)                              
    $idcus = $_POST['idcus'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $notel = $_POST['notel'];
    $katalaluan = $_POST['pass'];

    # Data validation: had atas 
    if (strlen($idcus) > 4) {
        die("<script>alert('IDPELANGGAN MELEBIHI 4 HURUF'); location.href='signup.php';</script>");
    }

    # Data validation: had bawah
    if (strlen($idcus) < 2) {
        die("<script>alert('IDPELANGGAN KURANG 2 HURUF'); location.href='signup.php';</script>");
    }

    # Semak idcus dah wujud atau belum
    $sql_semak = "SELECT idcus FROM pelanggan WHERE idcus = '$idcus'";
    $laksana_semak = mysqli_query($condb, $sql_semak);
    if (mysqli_num_rows($laksana_semak) == 1) {
        die("<script>alert('IDPELANGGAN telah digunakan. Sila pilih yang baru.'); location.href='signup.php';</script>");
    }

    # Proses menyimpan data 
    $sql_simpan = "INSERT INTO pelanggan (idcus, nama, alamat, notel, pass, tahap) VALUES ('$idcus', '$nama', '$alamat', '$notel', '$katalaluan', 'PELANGGAN')";
    $laksana = mysqli_query($condb, $sql_simpan);

    # Pengujian proses menyimpan data
    if ($laksana) {
        echo "<script>alert('Pendaftaran berjaya'); location.href='login.php';</script>";
    } else {
        echo "<p style='color:red;'>Pendaftaran gagal</p>";
        echo $sql_simpan . mysqli_error($condb);
    }
}
?>

<?php include('footer.php'); ?>


	
		