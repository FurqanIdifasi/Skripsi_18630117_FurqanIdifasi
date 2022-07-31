<?php
  include('templates/header.php');
  include('templates/sidebar.php');
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Halaman Pendaftaran</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Data</h3>
        </div>
        <div class="card-body">
          <div class="table-responsive">
        <table class="table table-bordered nowrap"  id="example2">
          <thead>
            <tr>
              <th>No</th>
              <th>No Pendaftaran</th>
              <th>Jenis Pendaftaran</th>
              <th>Tanggal</th>
              <th>Nama Pelanggan</th>
              <th>Alamat</th>
              <th>Kepemilikan Rumah</th>
              <th>No Internet</th>
              <th>No Voice</th>
              <th>Paket</th>
              <th>Status Daftar</th>
              <th>Ket</th>
                <?php if($_SESSION['hak_akses'] != 'pelanggan') { ?>
              <th>Aksi</th>
                <?php } ?>
              </tr>
          </thead>
          <tbody>
            <?php
              include('koneksi.php'); //memanggil file koneksi
             /* if($_SESSION['hak_akses'] == 'pelanggan') { 
                 $id = $_SESSION['user_id'];
                  $datas = mysqli_query($koneksi, "select pendaftaran.*, pelanggan.nama,pelanggan.alamat from pendaftaran JOIN pelanggan ON pelanggan.id = pendaftaran.pelanggan_id WHERE pelanggan.id = '$id' group by pendaftaran.id") or die(mysqli_error($koneksi));

              } else {*/

                  $datas = mysqli_query($koneksi, "select pendaftaran.*, pelanggan.nama,pelanggan.alamat,pelanggan.status_rumah, paket.nama as nama_paket from pendaftaran JOIN pelanggan ON pelanggan.id = pendaftaran.pelanggan_id join paket on paket.id = pendaftaran.paket_id group by pendaftaran.id desc") or die(mysqli_error($koneksi)); 
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
            <td><?= $row['status_rumah']; ?></td>
            <td><?= $row['no_internet']; ?></td>
            <td><?= $row['no_voice']; ?></td>
            <td><?= $row['nama_paket']; ?></td>
            <td><?= $row['status_pemasangan']; ?> </td>
            <td><?= $row['ket']; ?></td>
              <?php if($_SESSION['hak_akses'] != 'pelanggan') { ?>
            <td>
                <a href="pendaftaran-edit.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-danger">Edit</a>
                <?php if($_SESSION['hak_akses'] == 'admin') { ?>
                <a href="pendaftaran-index.php?id=<?= $row['id']; ?>&status=hapus"  class="btn btn-sm btn-danger" onclick="return confirm('anda yakin ingin hapus data ini?');">Hapus</a>
              <?php } ?>
            </td>
              <?php } ?>
          </tr>

            <?php $no++; } ?>
          </tbody>
        </table>
      </div>
      </div>
    </div>
        <!-- /.card-body -->
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php
    include('templates/footer.php');
  ?>

  <?php
   if ((isset($_GET['status'])) && ($_GET['status'] == 'hapus')) {
      $id = $_GET['id']; //menampung id

      //query hapus
      $datas = mysqli_query($koneksi, "delete from pendaftaran where id ='$id'") or die(mysqli_error($koneksi));
      //alert dan redirect ke index.php


      echo "<script>alert('data berhasil dihapus.');window.location='pendaftaran-index.php';</script>";
   }
  ?>