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
            <h1>Halaman Edit User</h1>
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

          $id = $_GET['id']; 
          $data   = mysqli_query($koneksi, "select user.*, karyawan.nama from user join karyawan on karyawan.id = user.karyawan_id where user.id = '$id'");
          $row  = mysqli_fetch_assoc($data);
          ?>
          <form action="" method="post" role="form">

            <input type="hidden" name="id" required="" value="<?= $row['id']; ?>">
            <div class="form-group">
              <label>Nama User</label>
              <input type="text" name="nama" readonly="" class="form-control" value="<?= $row['nama']; ?>" >
            </div> 
            <div class="form-group">
              <label>Username</label>
              <input type="text" name="username" required="" class="form-control" value="<?= $row['username']; ?>" readonly>
            </div>

            <div class="form-group">
              <label>Password </label>
              <input type="password" name="password" class="form-control" autofocus="" >
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
        include('koneksi.php');
        
        if (isset($_POST['submit'])) {
          //menampung data dari inputan

          $password = $_POST['password'];
          if(empty($password)) {
            $password = $row['password'];
          }
              $datas = mysqli_query($koneksi, "update user set password = '$password' where id = '$id'") or die(mysqli_error($koneksi));
          

            echo "<script>alert('data berhasil diubah.');window.location='user-index.php';</script>";
        }
        ?>
  <?php
    include('templates/footer.php');
  ?>

