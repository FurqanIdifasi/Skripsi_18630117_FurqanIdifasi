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
                <h5 class="card-title m-0">Pengajuan Migrasi dengan NIK : </h5>
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
              <th>Kode Pel.</th>
              <th>Kode Pel.</th>
              <th>NIK</th>
              <th>Nama</th>
              <th>No Hp</th>
              <th>Paket</th>
              <th>Alamat </th>
              <th>Status pengajuan</th>
              <th>Keterangan</th>
            </tr>
          </thead>
          <tbody>
            <?php
              include('koneksi.php'); //memanggil file koneksi
              $datas = mysqli_query($koneksi, "select pelanggan.*, pendaftaran.no_psb, pendaftaran.no_internet, pendaftaran.no_voice, pendaftaran.tgl_psb, pendaftaran.status_pemasangan, pendaftaran.ket, paket.nama as nama_paket, pemasangan.status_pasang from pelanggan join pendaftaran on pendaftaran.pelanggan_id = pelanggan.id join paket on paket.id = pendaftaran.paket_id left join pemasangan on pendaftaran.id = pemasangan.pendaftaran_id where pendaftaran.jenis_psb = 'PASANG BARU' AND pelanggan.nik = '$nik'") or die(mysqli_error($koneksi));

              //melakukan perulangan
              while($row = mysqli_fetch_assoc($datas)) {
            ?>  

          <tr  style="white-space: nowrap !important;">
            <td><?= $row['id']; ?></td>
            <td><?= $row['kode']; ?></td>
            <td><?= $row['nik']; ?></td>
            <td><?= $row['nama']; ?></td>
            <td><?= $row['hp']; ?></td>
            <td><span class="badge badge-danger badge-pill"><?= $row['nama_paket']; ?></span></td>
            <td><?= $row['alamat']; ?></td>
            <?php if ($row['status_pasang'] == 'SELESAI') { ?>
            <td>
                      <h6>Sudah bisa mengajukan</h6>
            </td>
            <td>
                      <a href="pendaftaran-paket-migrasi.php?id=<?= $row['id']; ?>" class="btn btn-danger ">Ajukan Sekarang</a>
            </td>

            <?php } else { ?>
            <td>
                      <h6>Belum bisa mengajukan</h6>
            </td>
            <td>
                      <h6>Pasang baru belum Selesai</h6>
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