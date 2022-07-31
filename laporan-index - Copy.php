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
            <h1>Halaman Laporan</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
<?php
                  include('koneksi.php');

                  ?>

      <!-- Default box -->
      <div class="card">
        <div class="card-body">
          <table class="table table-bordered table-striped">
            <tr class="bg-asd">
              <th>Nama Laporan</th>
              <th>Button Cetak</th>
            </tr>

<!-- ADMIN -->

          <?php if($_SESSION['hak_akses'] == 'admin') { ?>

            <tr>
              <th style="vertical-align: middle;">Laporan Detail Pemasangan Pelanggan</th>
              <th>
                <form method="get" action="laporan-pelanggan.php" class="form-inline">
                    <select class=" form-control-sm select2bs4" name="pelanggan_id" required="">
                      <option value="">Ketikkan Nik Pelanggan</option>
                      <?php
                        $datas = mysqli_query($koneksi, "select * from pelanggan") or die(mysqli_error($koneksi));
                        while($row = mysqli_fetch_assoc($datas)) {
                      ?> 
                      <option value="<?= $row['id'] ?>">Nik : <?= $row['nik'] ?> // Nama : <?= $row['nama'] ?></option>
                    <?php } ?>
                    </select>
                
                    <button type="submit" class="btn btn-secondary btn-sm" name="submit" value="cetak-absen">Cetak!</button>
                </form>
                </th>
            </tr>

            <tr>
              <th style="vertical-align: middle;">Laporan Pendaftaran</th>
              <th><form method="get" action="laporan-pendaftaran.php" class="form-inline">
                    <input type="month" class="form-control form-control-sm" name="bulan" required >
                    <button type="submit" class="btn btn-secondary btn-sm" name="submit" value="cetak-absen">Cetak!</button>
                </form></th>
            </tr>

            <tr>
              <th style="vertical-align: middle;">Laporan Pemasangan</th>
              <th><form method="get" action="laporan-pemasangan.php" class="form-inline">
                    <input type="month" class="form-control form-control-sm" name="bulan" required >
                    <button type="submit" class="btn btn-secondary btn-sm" name="submit" value="cetak-absen">Cetak!</button>
                </form></th>
            </tr>
            <tr>
              <th style="vertical-align: middle;">Laporan Pemasangan - Kendala</th>
              <th><form method="get" action="laporan-pemasangan-kendala.php" class="form-inline">
                   <!--  <input type="month" class="form-control form-control-sm" name="bulan" required > -->
                    <button type="submit" class="btn btn-secondary btn-sm" name="submit" value="cetak-absen">Cetak!</button>
                </form></th>
            </tr>

            <tr>
              <th style="vertical-align: middle;">Laporan Pemasangan - Teknisi</th>
              <th>
                <form method="get" action="laporan-pemasangan-teknisi.php" class="form-inline">
                    <select class="form-control form-control-sm col-sm-4" name="teknisi" required="">
                      <option value="">Pilih Karyawan</option>
                      <?php
                        $datas = mysqli_query($koneksi, "select * from karyawan where jabatan='teknisi'") or die(mysqli_error($koneksi));
                        while($row = mysqli_fetch_assoc($datas)) {
                      ?> 
                      <option value="<?= $row['id'] ?>">Teknisi : <?= $row['nama'] ?></option>
                    <?php } ?>
                    </select>
                
                    <button type="submit" class="btn btn-secondary btn-sm" name="submit" value="cetak-absen">Cetak!</button>
                </form>
                </th>
            </tr>

            <tr>
              <th style="vertical-align: middle;">Laporan Potensi Migrasi</th>
              <th><form method="get" action="laporan-potensi-migrasi.php" class="form-inline">
                    <input type="month" class="form-control form-control-sm" name="bulan" required >
                    <button type="submit" class="btn btn-secondary btn-sm" name="submit" value="cetak-absen">Cetak!</button>
                </form></th>
            </tr>
            <tr>
              <th style="vertical-align: middle;">Laporan Pengajuan Migrasi</th>
              <th><form method="get" action="laporan-pendaftaran.php" class="form-inline">
                    <input type="month" class="form-control form-control-sm" name="bulan" required >
                    <button type="submit" class="btn btn-secondary btn-sm" name="submit" value="cetak-absen">Cetak!</button>
                </form></th>
            </tr>

            <tr>
              <th style="vertical-align: middle;">Laporan Pemasangan Migrasi</th>
              <th><form method="get" action="laporan-pemasangan.php" class="form-inline">
                    <input type="month" class="form-control form-control-sm" name="bulan" required >
                    <button type="submit" class="btn btn-secondary btn-sm" name="submit" value="cetak-absen">Cetak!</button>
                </form></th>
            </tr>

            <tr>
              <th style="vertical-align: middle;">Laporan Migrasi - Kendala</th>
              <th><form method="get" action="laporan-pemasangan-kendala.php" class="form-inline">
                   <!--  <input type="month" class="form-control form-control-sm" name="bulan" required > -->
                    <button type="submit" class="btn btn-secondary btn-sm" name="submit" value="cetak-absen">Cetak!</button>
                </form></th>
            </tr>

            <tr>
              <th style="vertical-align: middle;">Laporan Config - Helpdesk</th>
              <th>
                <form method="get" action="laporan-pemasangan-teknisi.php" class="form-inline">
                    <select class="form-control form-control-sm col-sm-4" name="teknisi" required="">
                      <option value="">Pilih Karyawan</option>
                      <?php
                        $datas = mysqli_query($koneksi, "select * from karyawan where jabatan='teknisi'") or die(mysqli_error($koneksi));
                        while($row = mysqli_fetch_assoc($datas)) {
                      ?> 
                      <option value="<?= $row['id'] ?>">Teknisi : <?= $row['nama'] ?></option>
                    <?php } ?>
                    </select>
                
                    <button type="submit" class="btn btn-secondary btn-sm" name="submit" value="cetak-absen">Cetak!</button>
                </form>
                </th>
            </tr>
         <?php } ?>



<!-- PELANGGAN -->

          <?php if($_SESSION['hak_akses'] == 'pelanggan') { ?>



   <?php {

              $nik_pel = $_SESSION['nik_kar'];


          ?>
          <?php } ?>


            <tr>
              <th style="vertical-align: middle;">Pilih NIK</th>
              <th>
                <form method="get" action="laporan-pelanggan.php" class="form-inline">

                <input type="text" name="nik" value="<?= $_SESSION['nik_kar']; ?>" readonly>
                    <label>
                     
                  </label>
                
                    <button type="submit" class="btn btn-secondary btn-sm" name="submit" value="cetak-absen">Cetak!</button>
                </form>
                </th>
            </tr>


         <?php } ?>


          </table>
        </div>
        <!-- /.card-body -->
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php
    include('templates/footer.php');
  ?>
