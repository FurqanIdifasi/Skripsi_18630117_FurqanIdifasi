<?php
  include('templates2/header.php');
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="min-height: 395px;">
    <!-- Content Header (Page header) -->
  <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-12 text-center">
             <img src="assets/gambar/logo.png" alt="AdminLTE Logo" style="width: 300px;">
          </div><!-- /.col -->
       <div class="col-sm-6">
            <h1 class="m-0"> Migrasi </h1>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

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
                <h5 class="card-title m-0">Pindah Alamat</h5>
              </div>
              <div class="card-body">
                <h6 class="card-title"> Masukkan NIK :</h6> </br>
                <form action="" method="post" role="form" enctype="multipart/form-data">
                  
            <div class="form-group">
              <input type="text" name="nik" required="" class="form-control" value="<?= ($nik == null ? '' : $nik) ?>" autofocus="">
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
              <th>NIK</th>
              <th>Nama</th>
              <th>No Hp</th>
              <th>Paket</th>
              <th>Alamat </th>
              <th>Pilihan</th>
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
            <td><?= $row['kode']; ?></td>
            <td><?= $row['nik']; ?></td>
            <td><?= $row['nama']; ?></td>
            <td><?= $row['hp']; ?></td>
            <td><span class="badge badge-danger badge-pill"><?= $row['nama_paket']; ?></span></td>
            <td><?= $row['alamat']; ?></td>
            <td>
                      <a href="pendaftaran-paket-migrasi.php?id=<?= $row['id']; ?>" class="btn btn-danger ">Ajukan Sekarang</a>
            </td>
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
  include('templates2/footer.php');
?>