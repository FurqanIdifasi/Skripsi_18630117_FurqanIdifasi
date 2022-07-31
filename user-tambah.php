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
            <h1>Halaman Tambah User</h1>
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
          <form action="" method="post" role="form">
             <div class="form-group">
              <label>Karyawan</label>
              <select class="form-control  col-sm-4" name="karyawan_id" required="">
                <option value="">Pilih Karyawan</option>
                <?php
                  include('koneksi.php'); //memanggil file koneksi
                  $datas = mysqli_query($koneksi, "select * from karyawan where karyawan.id NOT IN (SELECT karyawan_id FROM user)") or die(mysqli_error($koneksi));
                  while($row = mysqli_fetch_assoc($datas)) {
                ?> 
                <option value="<?= $row['id'] ?>"><?= $row['nama'] ?> / <?= $row['jabatan'] ?></option>
              <?php } ?>
              </select>
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
    
        if (isset($_POST['submit'])) {
          //menampung data dari inputan
          $karyawan_id = $_POST['karyawan_id'];
          $username = $_POST['username'];
          $password = $_POST['password'];

          $datas = mysqli_query($koneksi, "insert into user (karyawan_id,username,password)values('$karyawan_id','$username','$password')") or die(mysqli_error($koneksi));

          echo "<script>alert('data berhasil disimpan.');window.location='user-index.php';</script>";
        }
        ?>
  <?php
    include('templates/footer.php');
  ?>

