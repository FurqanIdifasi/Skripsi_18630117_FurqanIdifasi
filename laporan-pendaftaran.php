<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">  
  <title>lap</title>

  <!-- Normalize or reset CSS with your favorite library -->
  <link rel="stylesheet" href="assets/dist/css/normalize.min.css">
  <!-- Load paper.css for happy printing -->
  <link rel="stylesheet" href="assets/dist/css/paper.css">
  <link rel="stylesheet" href="assets/dist/css/bs.css">

  <!-- Set page size here: A5, A4 or A3 -->
  <!-- Set also "" if you need -->
  <style>
  body {
    background: #666;
  }

  @page { size: A4 landscape}
* {
  font-family: "Arial";
  -webkit-print-color-adjust: exact !important;
}
.text-center {
  text-align: center;
}
h1 {
  font-size: 20px;
}
h3 {
  font-size: 14px;
  font-weight: normal;
  margin-top: -8px;
}
h4 {
  margin-top: 20px;
  text-transform: uppercase;
  margin-bottom: -10px;
}
td {
  padding: 5px !important;
  text-align: center;
  vertical-align: middle !important;
 /* border-color: #fff !important;
  padding: 5px !important;*/
  /*text-transform: capitalize;*/
}
</style>
</head>
    <?php
    if(isset($_GET['bulan'])) {
                    $bul = date("m", strtotime($_GET['bulan']));
                    $tah = date("Y", strtotime($_GET['bulan']));
                }
     ?>
<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->
<body class="A4 landscape">
   
  <!-- Each sheet element should have the class "sheet" -->
  <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25- Email : pantiasuhan@gmail.com -->
  <section class="sheet padding-10mm " style="height: auto;font-size: 10px;">
    <img src="assets/gambar/logo.png" style="width: 80px;float: left;margin-right: 10px;"  class="text-center">
    <h1 class="text-left">TELKOM AKSES</h1>
    <h3 class="text-left" style="font-size: 13px;">Karang Mekar, Kec. Banjarmasin Tim., Kota Banjarmasin, Kalimantan Selatan 70236 - (0511) 3255551</h3>
    <br>
    <h3 class="text-left"></h3><div style="width: 100%;height: 2px;background-color: #3d3d3d;-webkit-print-color-adjust: exact;"></div>
    <h4 class="text-center">Laporan Pendaftaran PSB <?= date("M", strtotime($_GET['bulan']));  ?> <?= date("y", strtotime($_GET['bulan']));  ?></h4>
<hr>
        <table class="table table-bordered nowrap"  id="example2">
          <thead>
            <tr>
              <th>No</th>
              <th>No Pendaftaran</th>
              <th>Jenis</th>
              <th>Tanggal</th>
              <th>Nama Pelanggan</th>
              <th>Alamat</th>
              <th>No Internet</th>
              <th>No Voice</th>
              <th>Paket</th>
              <th>Status Daftar</th>
              <th>Ket</th>
              </tr>
          </thead>
          <tbody>
            <?php
              include('koneksi.php'); //memanggil file koneksi
             /* if($_SESSION['hak_akses'] == 'pelanggan') { 
                 $id = $_SESSION['user_id'];
                  $datas = mysqli_query($koneksi, "select pendaftaran.*, pelanggan.nama,pelanggan.alamat from pendaftaran JOIN pelanggan ON pelanggan.id = pendaftaran.pelanggan_id WHERE pelanggan.id = '$id' group by pendaftaran.id") or die(mysqli_error($koneksi));

              } else {*/

                  $datas = mysqli_query($koneksi, "select pendaftaran.*, pelanggan.nama,pelanggan.alamat, paket.nama as nama_paket from pendaftaran JOIN pelanggan ON pelanggan.id = pendaftaran.pelanggan_id join paket on paket.id = pendaftaran.paket_id   WHERE pendaftaran.jenis_psb ='PASANG BARU' AND YEAR(pendaftaran.tgl_psb) = '$tah' AND MONTH(pendaftaran.tgl_psb) = '$bul' group by pendaftaran.id") or die(mysqli_error($koneksi)); 
              /*}
*/
              $no = 1;//untuk pengurutan nomor

              //melakukan perulangan
              while($row = mysqli_fetch_assoc($datas)) {
            ?>  

          <tr>
            <td><?= $no; ?></td>
            <td><?= $row['no_psb']; ?></td>
            <td><?= $row['jenis_psb']; ?></td>
            <td><?= format_tanggal($row['tgl_psb']); ?></td>
            <td><?= $row['nama']; ?></td>
            <td><?= $row['alamat']; ?></td>
            <td><?= $row['no_internet']; ?></td>
            <td><?= $row['no_voice']; ?></td>
            <td><?= $row['nama_paket']; ?></td>
            <td><?= $row['status_pemasangan']; ?> </td>
            <td><?= $row['ket']; ?></td>
          </tr>

            <?php $no++; } ?>
          </tbody>
        </table>
        <table class="table table-bordered" style="width: 200px;font-size: 11px;float:right;margin-top: 20px;">
                    <tr>
                      <th colspan="2">Banjarmasin, <?= date('Y-m-d'); ?></th>
                    </tr>
                    <tr style="height: 100px;">
                      <td style="width: 50%">
                        
                      </td>
                    </tr>
                    <tr>
                      <td>
                        Mengetahui,
                      </td>
                    </tr>
                </table>
  </section>

</body>
</html>
