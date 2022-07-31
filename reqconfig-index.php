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
            <h1>Halaman Req Config</h1>
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
              <th>No PSB</th>
              <th>No Indihome</th>
              <th>No Voice</th>
              <th>Nama Pelanggan</th>
              <th>Nama Teknisi</th>
              <th>Status Config</th>
              </tr>
          </thead>
          <tbody>
            <?php
              include('koneksi.php'); //memanggil file koneksi
           /*   if($_SESSION['hak_akses'] == 'pelanggan') { 
                 $id = $_SESSION['user_id'];
                  $datas = mysqli_query($koneksi, "select pemasangan.*, pendaftaran.no_psb, pelanggan.nama,pelanggan.alamat, pendaftaran.tgl_psb, karyawan.nama as nama_teknisi from pemasangan JOIN pendaftaran ON pendaftaran.id = pemasangan.pendaftaran_id JOIN pelanggan ON pelanggan.id = pendaftaran.pelanggan_id LEFT JOIN karyawan ON karyawan.id = pemasangan.teknisi_id WHERE pelanggan.id = '$id' group by pemasangan.id") or die(mysqli_error($koneksi));

              } else {*/

                  $datas = mysqli_query($koneksi, "select pemasangan.*, pendaftaran.no_psb, pendaftaran.tgl_psb, pendaftaran.no_internet, pendaftaran.no_voice, pelanggan.nama,pelanggan.alamat, karyawan.nama as nama_teknisi from pemasangan JOIN pendaftaran ON pendaftaran.id = pemasangan.pendaftaran_id JOIN pelanggan ON pelanggan.id = pendaftaran.pelanggan_id LEFT JOIN karyawan ON karyawan.id = pemasangan.teknisi_id  where pemasangan.status_config = 'HD OGP' group by pemasangan.id") or die(mysqli_error($koneksi)); 
             /* }*/

              $no = 1;//untuk pengurutan nomor

              //melakukan perulangan
              while($row = mysqli_fetch_assoc($datas)) {
            ?>  

          <tr>
            <td><?= $no; ?></td>
            <td><?= $row['no_psb']; ?></td>
            <td><?= $row['no_internet']; ?></td>
            <td><?= $row['no_voice']; ?></td>
            <td><?= $row['nama']; ?></td>
            <td><?= $row['nama_teknisi']; ?></td>
            <td>
            <form action="" method="post" role="form" enctype="multipart/form-data">
                 <div class="input-group input-group-sm">
                  <input type="hidden"  name="id" value="<?= $row['id']; ?>">
                  <input type="text" class="form-control" name="ket_config" placeholder="keterangan">
                  <span class="input-group-append">
                    <button type="submit" name="submit" value="submit" class="btn btn-danger btn-flat">Done!</button>
                  </span>
                </div>
              </form>
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

        //melakukan pengecekan jika button submit diklik maka akan menjalankan perintah simpan dibawah ini
        if (isset($_POST['submit'])) {
          //menampung data dari inputan
          $id = $_POST['id'];
          $ket_config = $_POST['ket_config'];
          $status_config = 'DONE';

          $datas = mysqli_query($koneksi, "update pemasangan set status_config = '$status_config',ket_config = '$ket_config'  where id = '$id'") or die(mysqli_error($koneksi));
            echo "<script>alert('Berhasil Config.');window.location='reqconfig-index.php';</script>";
        }
        
        ?>

  <?php
    include('templates/footer.php');
  ?>
