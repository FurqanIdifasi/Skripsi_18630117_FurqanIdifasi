<?php
/*use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;*/
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
            <h1>Halaman Edit Pelanggan</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Edit Data</h3>
        </div>
        <div class="card-body">
          <?php
          include('koneksi.php');

          $id = $_GET['id']; //mengambil id pelanggan yang ingin diubah

          //menampilkan pelanggan berdasarkan id
          $data   = mysqli_query($koneksi, "select * from pelanggan where id = '$id'");
          $row  = mysqli_fetch_assoc($data);
          ?>
          <form action="" method="post" role="form" enctype="multipart/form-data">
            <input type="hidden" name="id" required="" value="<?= $row['id']; ?>">
           
            <div class="form-group">
              <label>Kode</label>
              <input type="text" name="kode"   class="form-control col-sm-4"  value="<?= $row['kode']; ?>" readonly="">
            </div>
            <div class="form-group">
              <label>NIK</label>
              <input type="text" name="nik" required="" class="form-control col-sm-4"  value="<?= $row['nik']; ?>" >
            </div>
            <div class="form-group">
              <label>Nama</label>
              <input type="text" name="nama" required="" class="form-control col-sm-4"  value="<?= $row['nama']; ?>" >
            </div>
         
            <div class="form-group">
              <label>No Hp</label>
              <input type="text" name="hp" required="" class="form-control col-sm-4" value="<?= $row['hp']; ?>"  >
            </div>
            <div class="form-group">
              <label>Alamat</label>
              <input type="text" name="alamat" required="" class="form-control" value="<?= $row['alamat']; ?>" >
            </div>


            <div class="form-group">
              <label>Kepemilikan Rumah</label>
              <select class="form-control  col-sm-4" name="status_rumah" required="">
                <option value="">Pilih</option>
                <option value="MILIK SENDIRI" <?= ($row['status_rumah'] == 'MILIK SENDIRI') ? 'selected' : ''; ?>>MILIK SENDIRI</option>
                <option value="SEWA" <?= ($row['status_rumah'] == 'SEWA') ? 'selected' : ''; ?>>SEWA</option>
              </select>
            </div>


            <div class="form-group">
                          <label>Latlong</label>
                            <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Latitude</span>
                            </div>
                            <div class="custom-file">
                                <input type="text" name="latitude" required="" class="form-control" value="<?= $row['latitude']; ?>" >
                            </div>
                            <div class="input-group-prepend">
                              <span class="input-group-text">Longitude</span>
                            </div>
                            <div class="custom-file">
                                <input type="text" name="longitude" required="" class="form-control" value="<?= $row['longitude']; ?>" >
                            </div>
                          </div>
                          </div>
            <div class="form-group">
              <label>Foto Pelanggan</label><br>
              <img src="assets/gambar/<?= $row['foto_pelanggan'];?>" width="100" class="mb-3">
              <input type="file" name="foto_pelanggan" class="form-control col-sm-4" >
              <i>(Abaikan jika tidak ingin ganti foto)</i>
            </div>
            <div class="form-group">
              <label>Foto KTP</label><br>
              <img src="assets/gambar/<?= $row['foto_ktp'];?>" width="100" class="mb-3">
              <input type="file" name="foto_ktp" class="form-control col-sm-4" >
              <i>(Abaikan jika tidak ingin ganti foto)</i>
            </div>
            <div class="form-group">
              <label>Foto Selfie + KTP</label><br>
              <img src="assets/gambar/<?= $row['foto_selfie'];?>" width="100" class="mb-3">
              <input type="file" name="foto_selfie" class="form-control col-sm-4" >
              <i>(Abaikan jika tidak ingin ganti foto)</i>
            </div>
            <div class="form-group">
              <label>Foto Rumah</label><br>
              <img src="assets/gambar/<?= $row['foto_rumah'];?>" width="100" class="mb-3">
              <input type="file" name="foto_rumah" class="form-control col-sm-4" >
              <i>(Abaikan jika tidak ingin ganti foto)</i>
            </div>
            <button type="submit" class="btn btn-primary" name="submit" value="simpan">Ubah data</button>
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

        //jika klik tombol submit maka akan melakukan perubahan
        if (isset($_POST['submit'])) {

          $kategori = $_POST['kategori'];
          $nik = $_POST['nik'];
          $id = $_POST['id'];
          $nama = $_POST['nama'];
          $hp = $_POST['hp'];
          $alamat = $_POST['alamat'];
          $status_rumah = $_POST['status_rumah'];
          $latitude = $_POST['latitude'];
          $longitude = $_POST['longitude'];
       
          $nama_gambar1   = $_FILES['foto_pelanggan']['name'];
          $file_tmp1    = $_FILES['foto_pelanggan']['tmp_name'];   
          $acak1      = rand(1,99999);
          if($nama_gambar1 != "") {
            $nama_unik1     = $acak1.$nama_gambar1;
            move_uploaded_file($file_tmp1,'assets/gambar/'.$nama_unik1);
          } else {
            $nama_unik1 = $row['foto_pelanggan'];
          }
          $foto_pelanggan = $nama_unik1;

          $nama_gambar2   = $_FILES['foto_ktp']['name'];
          $file_tmp2    = $_FILES['foto_ktp']['tmp_name'];   
          $acak2      = rand(1,99999);
          if($nama_gambar2 != "") {
            $nama_unik2     = $acak2.$nama_gambar2;
            move_uploaded_file($file_tmp2,'assets/gambar/'.$nama_unik2);
          } else {
            $nama_unik2 = $row['foto_ktp'];
          }
          $foto_ktp = $nama_unik2;

          $nama_gambar3   = $_FILES['foto_selfie']['name'];
          $file_tmp3    = $_FILES['foto_selfie']['tmp_name'];   
          $acak3      = rand(1,99999);
          if($nama_gambar3 != "") {
            $nama_unik3     = $acak3.$nama_gambar3;
            move_uploaded_file($file_tmp3,'assets/gambar/'.$nama_unik3);
          } else {
            $nama_unik3 = $row['foto_selfie'];
          }
          $foto_selfie = $nama_unik3;

          $nama_gambar4   = $_FILES['foto_rumah']['name'];
          $file_tmp4    = $_FILES['foto_rumah']['tmp_name'];   
          $acak4      = rand(1,99999);
          if($nama_gambar4 != "") {
            $nama_unik4     = $acak4.$nama_gambar4;
            move_uploaded_file($file_tmp4,'assets/gambar/'.$nama_unik4);
          } else {
            $nama_unik4 = $row['foto_rumah'];
          }
          $foto_rumah = $nama_unik4;

          mysqli_query($koneksi, "update pelanggan set nik='$nik',nama='$nama',hp='$hp',foto_pelanggan='$foto_pelanggan',alamat='$alamat' ,status_rumah='$status_rumah' ,foto_selfie='$foto_selfie' ,foto_ktp='$foto_ktp' ,latitude='$latitude' ,longitude='$longitude' ,foto_rumah='$foto_rumah' where id ='$id'") or die(mysqli_error($koneksi));

          //redirect ke halaman index.php
         echo "<script>alert('data berhasil diupdate.');window.location='pelanggan-index.php';</script>";
        }
        ?>
  <?php
    include('templates/footer.php');
  ?>

