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
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <div class="content">
      <div class="container">
   <?php 
          if (isset($_POST['cari'])) {
              $nik = $_POST['nik'];
            } else {
              $nik = null;
            }

          ?>
        <div class="row">
          <!-- /.col-md-6 -->
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title m-0"> Silahkan Klik "Cari" untuk memberikan penilaian</h5>
              </div>
              <div class="card-body">
                <form action="" method="post" role="form" enctype="multipart/form-data">
                  
            <div class="form-group">
              <input type="text" name="nik" required="" class="form-control" value="<?= $_SESSION['nik_kar']; ?>" autofocus="" readonly="">
            </div>
            <button type="submit" class="btn btn-danger" name="cari" value="simpan">Cari</button>
            <a href="login-index-migrasi.php" class="btn btn-dark" ><i class="fa fa-times"></i></a>
          </form>
       


           <div class="table-responsive mt-4" style="display:<?= ($nik == null ? 'none' : 'block') ?>">
        <table class="table table-bordered" id="example2">
          <thead>
            <tr>
              <th colspan="18">Hasil Pencarian : <?= $nik; ?></th>
            </tr>
            <tr style="white-space: nowrap !important;">
              <th>Nama</th>
              <th>No Hp</th>
              <th>No Hp</th>
              <th>No Pemasangan</th>
              <th>Paket</th>
              <th>Keterangan</th>
            </tr>
          </thead>
          <tbody>
            <?php
              include('koneksi.php'); //memanggil file koneksi
              $datas = mysqli_query($koneksi, "select pelanggan.*, pendaftaran.no_psb, pendaftaran.no_internet, pendaftaran.no_voice, pendaftaran.tgl_psb, pemasangan.id, pendaftaran.status_pemasangan, pendaftaran.ket, paket.nama as nama_paket, pemasangan.status_pasang , pemasangan.p1, pemasangan.p2, pemasangan.p3 from pelanggan join pendaftaran on pendaftaran.pelanggan_id = pelanggan.id join paket on paket.id = pendaftaran.paket_id left join pemasangan on pendaftaran.id = pemasangan.pendaftaran_id where pelanggan.nik = '$nik'") or die(mysqli_error($koneksi));

              //melakukan perulangan
              while($row = mysqli_fetch_assoc($datas)) {
            ?>  

          <tr  style="white-space: nowrap !important;">

            <td><?= $row['nama']; ?></td>
            <td><?= $row['hp']; ?></td>
            <td><?= $row['id']; ?></td>

            <td>
                      <h6><?= $row['no_psb']; ?></h6>
            </td>
            <td><span class="badge badge-danger badge-pill"><?= $row['nama_paket']; ?></span></td>
            <?php if ($row['status_pasang'] == 'SELESAI' && $row['p1'] == null && $row['p2'] == null && $row['p3'] == null) { ?>
            <td>
                      <a href="hasil-penilaian.php?id=<?= $row['id']; ?>" class="btn btn-danger ">Nilai Sekarang</a>
            </td>

            <?php } else if ($row['status_pasang'] == 'SELESAI' && $row['p1'] != null && $row['p2'] != null && $row['p3'] != null) { ?>

            <td>
                      <h6>Terimakasih Sudah Memebrikan penilaian</h6>
            </td>

            <?php } else { ?>
            <td>
                      <h6>Belum bisa memberikan penialain</h6>
            </td>

            <?php } ?>
          </tr>

            <?php  } ?>
          </tbody>
        </table>
      </div>

          </div>
            </div>

          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
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