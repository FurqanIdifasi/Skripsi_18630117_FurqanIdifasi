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
                <h5 class="card-title m-0">Progres Pemasangan dari NIK : </h5>
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
              <th>Tgl Daftar</th>
              <th>Tgl Selesai</th>
              <th>No. Daftar</th>
              <th>Jenis Daftar</th>
              <th>No. Internet</th>
              <th>No. Voice</th>
              <th>Paket</th>
              <th>Status Daftar</th>
              <th>Status Pemasangan</th>
              <th>Ket.</th>
            </tr>
          </thead>
          <tbody>
            <?php
              include('koneksi.php'); //memanggil file koneksi
              $datas = mysqli_query($koneksi, "select pelanggan.*, pendaftaran.no_psb, pendaftaran.jenis_psb,pendaftaran.no_internet, pendaftaran.no_voice, pendaftaran.tgl_psb, pemasangan.tgl_selesai, pemasangan.keterangan, pendaftaran.status_pemasangan, pendaftaran.ket, paket.nama as nama_paket, pemasangan.status_pasang from pelanggan join pendaftaran on pendaftaran.pelanggan_id = pelanggan.id join paket on paket.id = pendaftaran.paket_id left join pemasangan on pendaftaran.id = pemasangan.pendaftaran_id  where pelanggan.nik = '$nik'") or die(mysqli_error($koneksi));

              //melakukan perulangan
              while($row = mysqli_fetch_assoc($datas)) {
            ?>  

          <tr  style="white-space: nowrap !important;">
            <td><?= $row['nama']; ?></td>
            <td><?= format_tanggal($row['tgl_psb']); ?></td>



            <?php if ($row['tgl_selesai'] == null) { ?>
            <td>
                      <h6>-</h6>
            </td>

            <?php } else { ?>
            <td>
                      
                      <span ><?= $row['tgl_selesai']; ?></span>
            </td>

            <?php } ?>


            <td><?= $row['no_psb']; ?></td>
            <td><?= $row['jenis_psb']; ?></td>
            <td><?= $row['no_internet']; ?></td>
            <td><?= $row['no_voice']; ?></td>

            <td><span class="badge badge-danger badge-pill"><?= $row['nama_paket']; ?></span></td>

            <td><span class="badge badge-dark badge-pill"><?= $row['status_pemasangan']; ?></span>
            </td>

            <?php if ($row['status_pasang'] == null) { ?>
            <td>
                      <h6>-</h6>
            </td>

            <?php } else { ?>
            <td>
                      
                      <span class="badge badge-dark badge-pill"><?= $row['status_pasang']; ?></span>
            </td>

            <?php } ?>

          
            <?php if ($row['keterangan'] == null) { ?>
            <td>
                      <h6>-</h6>
            </td>

            <?php } else { ?>
            <td>
                      
                      <span class="badge badge-dark badge-pill"><?= $row['keterangan']; ?></span>
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