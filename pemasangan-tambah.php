<?php
  include('templates/header.php');
  include('templates/sidebar.php');
?>
 <?php
                  include('koneksi.php');
                  ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Halaman Tambah Pemasangan</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Tambah Data</h3>
        </div>
        <div class="card-body">
          <form action="" method="post" role="form" enctype="multipart/form-data">
            <div class="form-group">
              <label>Tgl Rencana Pemasangan</label>
              <input type="date" name="tgl_rencana_pasang" required="" class="form-control col-sm-4"  >
            </div>
            <div class="form-group">
              <label>No. Tiket PSB</label>
              <select class="form-control  col-sm-4" name="pendaftaran_id" required="">
                <option value="">Pilih Tiket PSB</option>
                <?php
                  $datas = mysqli_query($koneksi, "select pendaftaran.*, pelanggan.nama from pendaftaran join pelanggan on pelanggan.id = pendaftaran.pelanggan_id WHERE pendaftaran.id NOT IN (SELECT pendaftaran_id FROM pemasangan) and pendaftaran.status_pemasangan = 'DISETUJUI'") or die(mysqli_error($koneksi));
                  while($row = mysqli_fetch_assoc($datas)) {
                ?> 
                <option value="<?= $row['id'] ?>"><?= $row['no_psb'] ?> | Pelanggan : <?= $row['nama'] ?></option>
              <?php } ?>
              </select>
            </div>  
              
          <!--  -->
             <div class="form-group">
              <label>Teknisi</label>
              <select class="form-control  col-sm-4" name="teknisi_id" required="">
                <option value="">Pilih Teknisi</option>
                <?php
                  $datas = mysqli_query($koneksi, "select * from karyawan where jabatan ='teknisi'") or die(mysqli_error($koneksi));
                  while($row = mysqli_fetch_assoc($datas)) {
                ?> 
                <option value="<?= $row['id'] ?>"><?= $row['nama'] ?></option>
              <?php } ?>
              </select>
            </div>   

            
            <!-- <div class="form-group">
              <label>Keterangan</label>
              <input type="text" name="keterangan" required="" class="form-control"  >
            </div>
            <div class="form-group">
              <label>Foto</label>
              <input type="file" name="foto"  class="form-control col-sm-4" >
            </div>
 -->
            
            <button type="submit" class="btn btn-primary" name="submit" value="simpan">Simpan data</button>
          </form>
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
        
          $pendaftaran_id = $_POST['pendaftaran_id'];
          $tgl_rencana_pasang = $_POST['tgl_rencana_pasang'];
          $teknisi_id = $_POST['teknisi_id'];
          $status_pasang = 'SEDANG ANTRIAN';

          $datas = mysqli_query($koneksi, "insert into pemasangan (pendaftaran_id,teknisi_id,status_pasang,tgl_rencana_pasang)values('$pendaftaran_id','$teknisi_id','$status_pasang','$tgl_rencana_pasang')") or die(mysqli_error($koneksi));

          echo "<script>alert('data berhasil disimpan.');window.location='pemasangan-index.php';</script>";
        }
        ?>
  <?php
    include('templates/footer.php');
  ?>

