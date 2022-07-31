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
            <h1>Halaman Pemasangan</h1>
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
          <?php if($_SESSION['hak_akses'] != 'teknisi') { ?>
            <a href="pemasangan-tambah.php" class="btn btn-sm btn-success float-right">+ Tambah Data</a>
          <?php } ?>
        </div>
        <div class="card-body">
          <div class="table-responsive">
        <table class="table table-bordered nowrap"  id="example2">
          <thead>
            <tr>
              <th>No</th>
              <th>No PSB</th>
              <th>Nama Pelanggan</th>
              <th>Nama Teknisi</th>
              <th>Status</th>
              <th>Keterangan</th>
              <th>Tgl Daftar</th>
              <th>Tgl Rencana Pasang</th>
              <th>Tgl Selesai</th>
              <th>Foto</th>
              <th>Req. Config</th>
              <th>Ket. Config</th>
                <?php if($_SESSION['hak_akses'] != 'pelanggan') { ?>
              <th>Aksi</th>
                <?php } ?>
              </tr>
          </thead>
          <tbody>
            <?php
              include('koneksi.php'); //memanggil file koneksi
           /*   if($_SESSION['hak_akses'] == 'pelanggan') { 
                 $id = $_SESSION['user_id'];
                  $datas = mysqli_query($koneksi, "select pemasangan.*, pendaftaran.no_psb, pelanggan.nama,pelanggan.alamat, pendaftaran.tgl_psb, karyawan.nama as nama_teknisi from pemasangan JOIN pendaftaran ON pendaftaran.id = pemasangan.pendaftaran_id JOIN pelanggan ON pelanggan.id = pendaftaran.pelanggan_id LEFT JOIN karyawan ON karyawan.id = pemasangan.teknisi_id WHERE pelanggan.id = '$id' group by pemasangan.id") or die(mysqli_error($koneksi));

              } else {*/

                  $datas = mysqli_query($koneksi, "select pemasangan.*, pendaftaran.no_psb, pendaftaran.tgl_psb, pelanggan.nama,pelanggan.alamat, karyawan.nama as nama_teknisi from pemasangan JOIN pendaftaran ON pendaftaran.id = pemasangan.pendaftaran_id JOIN pelanggan ON pelanggan.id = pendaftaran.pelanggan_id LEFT JOIN karyawan ON karyawan.id = pemasangan.teknisi_id group by pemasangan.id ") or die(mysqli_error($koneksi)); 
             /* }*/

              $no = 1;//untuk pengurutan nomor

              //melakukan perulangan
              while($row = mysqli_fetch_assoc($datas)) {
            ?>  

          <tr>
            <td><?= $no; ?></td>
            <td><?= $row['no_psb']; ?></td>
            <td><?= $row['nama']; ?></td>
            <td><?= $row['nama_teknisi']; ?></td>
            <td><?= $row['status_pasang']; ?></td>
            <td><?= $row['keterangan']; ?></td>

            <td><?= format_tanggal($row['tgl_psb']); ?></td>
            <td><?= format_tanggal($row['tgl_rencana_pasang']); ?></td>
            <td>
              <?php if($row['tgl_selesai'] != null) { ?>
                <?= format_tanggal($row['tgl_selesai']); ?>
              
              <?php } ?>

            </td>
            <td>
               <?php if($row['foto'] != null) { ?>
               
              <img src="assets/gambar/<?= $row['foto'];?>" width="100">
              
              <?php } ?>
            </td>

            <td>
          
              <?php if($row['status_config'] == null) { ?>
              -
              <?php } else if($row['status_config'] == 'HD OGP') { ?>
                HD OGP
              <?php } else if($row['status_config'] == 'DONE') { ?>
                DONE
              <?php } ?>
            </td>
            <td>
          
              <?php if($row['status_config'] == null) { ?>
              -
              <?php } else if($row['status_config'] == 'HD OGP') { ?>
                -
              <?php } else if($row['status_config'] == 'DONE') { ?>
               <?php 
               echo($row['ket_config'])
                ?>
              <?php } ?>
            </td>
              <?php if($_SESSION['hak_akses'] != 'pelanggan') { ?>
            <td>
              <?php if($row['status_config'] == null & $_SESSION['hak_akses'] == 'teknisi') { ?>
                <a href="reqconfig.php?id=<?= $row['id']; ?>" class="btn btn-danger">Minta Config</a>
              <?php }  ?>

               <?php if($row['status_pasang'] == 'SELESAI') { ?>
                Sudah selesai.
               <?php } else { ?>


                <a href="pemasangan-edit.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                <?php if($_SESSION['hak_akses'] == 'admin') { ?>
                <a href="pemasangan-index.php?id=<?= $row['id']; ?>&status=hapus"  class="btn btn-sm btn-danger" onclick="return confirm('anda yakin ingin hapus data ini?');">Hapus</a>
              <?php } ?>
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
      $datas = mysqli_query($koneksi, "delete from pemasangan where id ='$id'") or die(mysqli_error($koneksi));
      //alert dan redirect ke index.php


      echo "<script>alert('data berhasil dihapus.');window.location='pemasangan-index.php';</script>";
   }
  ?>