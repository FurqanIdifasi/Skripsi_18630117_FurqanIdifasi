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
            <h1>Halaman Tambah Karyawan</h1>
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
              <label>Nik</label>
              <input type="text" name="nik" required="" class="form-control col-sm-4" autofocus="">
            </div>
            <div class="form-group">
              <label>Nama</label>
              <input type="text" name="nama" required="" class="form-control col-sm-4" >
            </div>
            <div class="form-group">
              <label>Jabatan</label>
              <select class="form-control  col-sm-4" name="jabatan" required="">
                <option value="">Pilih</option>
               <!--  <option value="pimpinan">Pimpinan</option> -->
                <option value="teknisi">Teknisi</option>
                <option value="admin">Admin</option>
              </select>
            </div>
            <div class="form-group">
              <label>No Hp</label>
              <input type="text" name="no_hp" required="" class="form-control col-sm-4" >
            </div>
            <div class="form-group">
              <label>Alamat</label>
              <input type="text" name="alamat" required="" class="form-control" >
            </div>
            <div class="form-group">
              <label>Tim</label>
              <input type="text" name="tim" required="" class="form-control col-sm-4" >
            </div>
            <div class="form-group">
              <label>Area</label>
              <input type="text" name="area" required="" class="form-control col-sm-4" >
            </div>
            <div class="form-group">
              <label>Foto</label>
              <input type="file" name="foto" class="form-control col-sm-4" >
            </div>

            <div class="form-group">
              <label>Username</label>
              <input type="text" name="username" required="" class="form-control" >
            </div>
            <div class="form-group">
              <label>Password</label>
              <input type="password" name="password" required="" class="form-control" >
            </div>

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
        include('koneksi.php');
        
        //melakukan pengecekan jika button submit diklik maka akan menjalankan perintah simpan dibawah ini
        if (isset($_POST['submit'])) {
          //menampung data dari inputan
          $nik = $_POST['nik'];
          $nama = $_POST['nama'];
          $area = $_POST['area'];
          $jabatan = $_POST['jabatan'];
          $no_hp = $_POST['no_hp'];
          $alamat = $_POST['alamat'];
          $tim = $_POST['tim'];
          $username = $_POST['username'];
          $password = $_POST['password'];
          $nama_gambar1   = $_FILES['foto']['name'];
          $file_tmp1    = $_FILES['foto']['tmp_name'];   
          $acak1      = rand(1,99999);

          if($nama_gambar1 != "") {
            $nama_unik1     = $acak1.$nama_gambar1;
            move_uploaded_file($file_tmp1,'assets/gambar/'.$nama_unik1);
          } else {
            $nama_unik1 = NULL;
          }
          
          $foto = $nama_unik1;

          $datas = mysqli_query($koneksi, "insert into karyawan (nik,nama,area,jabatan,no_hp,alamat,tim,foto,username,password)values('$nik','$nama','$area','$jabatan','$no_hp','$alamat','$tim','$foto','$username','$password')") or die(mysqli_error($koneksi));

          echo "<script>alert('data berhasil disimpan.');window.location='karyawan-index.php';</script>";
        }
        ?>
  <?php
    include('templates/footer.php');
  ?>

