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
            <h1 class="m-0"> Pasang Baru </h1>
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
              <div class="card-body">
   
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
              <th>Alamat</th>
              <th>Latlong</th>
              <th>Tgl Pendaftaran</th>
              <th>No. Pendaftaran</th>
              <th>No. Internet</th>
              <th>No. Voice</th>
              <th>Paket</th>
              <th>Status Pendaftaran</th>
              <th>Status Pemasangan</th>
              <th>Ket.</th>
            </tr>
          </thead>
          <tbody>
            <?php
              include('koneksi.php'); //memanggil file koneksi
              $datas = mysqli_query($koneksi, "select pelanggan.*, pendaftaran.no_psb, pendaftaran.no_internet, pendaftaran.no_voice, pendaftaran.tgl_psb, pendaftaran.status_pemasangan, pendaftaran.ket, paket.nama as nama_paket, pemasangan.status_pasang from pelanggan join pendaftaran on pendaftaran.pelanggan_id = pelanggan.id join paket on paket.id = pendaftaran.paket_id left join pemasangan on pendaftaran.id = pemasangan.pendaftaran_id where pelanggan.nik = '$nik'") or die(mysqli_error($koneksi));

              //melakukan perulangan
              while($row = mysqli_fetch_assoc($datas)) {
            ?>  

          <tr  style="white-space: nowrap !important;">
            <td><?= $row['kode']; ?></td>
            <td><?= $row['nik']; ?></td>
            <td><?= $row['nama']; ?></td>
            <td><?= $row['hp']; ?></td>
            <td><?= $row['alamat']; ?></td>
            <td><?= $row['latitude']; ?>, <?= $row['longitude']; ?></td>
            <td><?= format_tanggal($row['tgl_psb']); ?></td>
            <td><?= $row['no_psb']; ?></td>
            <td><?= $row['no_internet']; ?></td>
            <td><?= $row['no_voice']; ?></td>
            <td><span class="badge badge-danger badge-pill"><?= $row['nama_paket']; ?></span></td>
            <td><span class="badge badge-dark badge-pill"><?= $row['status_pemasangan']; ?></span></td>
            <td><span class="badge badge-dark badge-pill"><?= $row['status_pasang']; ?></span></td>
            <td><?= $row['ket']; ?></td>
          </tr>

            <?php  } ?>
          </tbody>
        </table>
      </div>

          </div>
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title m-0">Daftar</h5>
              </div>
              <div class="card-body">
                   <?php
              $datas = mysqli_query($koneksi, "select * from paket where status='aktif'") or die(mysqli_error($koneksi));
               while($row = mysqli_fetch_assoc($datas)) {
              ?>
                <div class="col-md-12">
                 <div class="card ">
                    <div class="card-header bg-danger">
                      <h5 class="card-title m-0"><?= $row['nama']; ?></h5>
                    </div>
                    <div class="card-body">
                      <span class="badge badge-danger badge-pill "><?= $row['jenis']; ?></span>
                      <span class="badge badge-danger badge-pill "><?= $row['speed']; ?></span>
                      <span class="badge badge-danger badge-pill ">Rp <?= $row['harga']; ?></span>
                      <p class="card-text"><?= $row['detail']; ?></p>
                      <a href="pendaftaran-paket.php?id=<?= $row['id']; ?>" class="btn btn-danger badge-pill float-right">Daftar Sekarang</a>
                    </div>
                  </div>
                  </div>
                   <?php  } ?>
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