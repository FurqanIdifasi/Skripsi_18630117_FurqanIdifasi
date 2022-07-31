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
            <h1>Halaman Pelanggan</h1>
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
        <table class="table table-bordered" id="example2">
          <thead>
            <tr style="white-space: nowrap !important;">
              <th>No</th>
              <th>Kode Pel.</th>
              <th>Nama</th>
              <th>No Hp</th>
              <th>Alamat</th>
              <th>Kepemilikan Rumah</th>
              <th>Latlong</th>
              <th>Foto Pelanggan</th>
              <th>Foto KTP</th>
              <th>Foto Selfie</th>
              <th>Foto Rumah</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
              include('koneksi.php'); //memanggil file koneksi
              $datas = mysqli_query($koneksi, "select * from pelanggan") or die(mysqli_error($koneksi));

              $no = 1;//untuk pengurutan nomor

              //melakukan perulangan
              while($row = mysqli_fetch_assoc($datas)) {
            ?>  

          <tr  style="white-space: nowrap !important;">
            <td ><?= $no; ?></td>
            <td><?= $row['kode']; ?></td>
            <td><?= $row['nama']; ?></td>
            <td><?= $row['hp']; ?></td>
            <td><?= $row['alamat']; ?></td>
            <td><?= $row['status_rumah']; ?></td>
            <td><?= $row['latitude']; ?>, <?= $row['longitude']; ?></td>
            <td><a href="assets/gambar/<?= $row['foto_pelanggan'];?>" target="_blank"><img src="assets/gambar/<?= $row['foto_pelanggan'];?>" width="100"></a></td>
            <td><a href="assets/gambar/<?= $row['foto_ktp'];?>" target="_blank"><img src="assets/gambar/<?= $row['foto_ktp'];?>" width="100"></a></td>
            <td><a href="assets/gambar/<?= $row['foto_selfie'];?>" target="_blank"><img src="assets/gambar/<?= $row['foto_selfie'];?>" width="100"></a></td>
            <td><a href="assets/gambar/<?= $row['foto_rumah'];?>" target="_blank"><img src="assets/gambar/<?= $row['foto_rumah'];?>" width="100"></a></td>
            <td style="text-align: center;">
                <a href="pelanggan-edit.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-danger">Edit</a>
                <a href="pelanggan-index.php?id=<?= $row['id']; ?>&status=hapus" class="btn btn-sm btn-danger" onclick="return confirm('anda yakin ingin hapus data ini?');">Hapus</a>
            </td>
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
      $datas = mysqli_query($koneksi, "delete from pelanggan where id ='$id'") or die(mysqli_error($koneksi));
      //alert dan redirect ke index.php
      echo "<script>alert('data berhasil dihapus.');window.location='pelanggan-index.php';</script>";
   }
  ?>

