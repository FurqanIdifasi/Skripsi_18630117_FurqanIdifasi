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
            <h1>Halaman Edit Karyawan</h1>
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

          $id = $_GET['id']; //mengambil id karyawan yang ingin diubah

          //menampilkan karyawan berdasarkan id
          $data   = mysqli_query($koneksi, "select * from karyawan where id = '$id'");
          $row  = mysqli_fetch_assoc($data);
          ?>
          <form action="" method="post" role="form" enctype="multipart/form-data">
            <input type="hidden" name="id" required="" value="<?= $row['id']; ?>">
            <div class="form-group">
              <label>Nik</label>
              <input type="text" name="nik" required="" class="form-control col-sm-4"  value="<?= $row['nik']; ?>" autofocus="">
            </div>
            <div class="form-group">
              <label>Nama</label>
              <input type="text" name="nama" required="" class="form-control col-sm-4"  value="<?= $row['nama']; ?>" >
            </div>
            <div class="form-group">
              <label>Jabatan</label>
              <select class="form-control  col-sm-4" name="jabatan" required="">
                <option value="">Pilih</option>
               <!--  <option value="pimpinan" <?= ($row['jabatan'] == 'pimpinan') ? 'selected' : ''; ?>>Pimpinan</option> -->
                <option value="teknisi" <?= ($row['jabatan'] == 'teknisi') ? 'selected' : ''; ?>>Teknisi</option>
                <option value="admin" <?= ($row['jabatan'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
              </select>
            </div>
            <div class="form-group">
              <label>No Hp</label>
              <input type="text" name="no_hp" required="" class="form-control col-sm-4" value="<?= $row['no_hp']; ?>"  >
            </div>
            <div class="form-group">
              <label>Alamat</label>
              <input type="text" name="alamat" required="" class="form-control" value="<?= $row['alamat']; ?>" >
            </div>
            <div class="form-group">
              <label>Tim</label>
              <input type="text" name="tim" required="" class="form-control col-sm-4" value="<?= $row['tim']; ?>" >
            </div>
            <div class="form-group">
              <label>Area</label>
              <input type="text" name="area" required="" class="form-control col-sm-4" value="<?= $row['area']; ?>" >
            </div>
            <div class="form-group">
              <label>Foto</label><br>
              <img src="assets/gambar/<?= $row['foto'];?>" width="100" class="mb-3">
              <input type="file" name="foto" class="form-control col-sm-4" >
              <i>(Abaikan jika tidak ingin ganti foto)</i>
            </div>
            <div class="form-group">
              <label>Username</label>
              <input type="text" name="username" required="" class="form-control" value="<?= $row['username']; ?>">
            </div>

            <div class="form-group">
              <label>Password </label>
              <input type="password" name="password" class="form-control" value="<?= $row['password']; ?>" >
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
          $id = $_POST['id'];
          $nik = $_POST['nik'];
          $nama = $_POST['nama'];
          $tim = $_POST['tim'];
          $jabatan = $_POST['jabatan'];
          $no_hp = $_POST['no_hp'];
          $alamat = $_POST['alamat'];
          $area = $_POST['area'];
          $password = $_POST['password'];
          $nama_gambar1   = $_FILES['foto']['name'];
          $file_tmp1    = $_FILES['foto']['tmp_name'];   
          $acak1      = rand(1,99999);
          if($nama_gambar1 != "") {
            $nama_unik1     = $acak1.$nama_gambar1;
            move_uploaded_file($file_tmp1,'assets/gambar/'.$nama_unik1);
          } else {
            $nama_unik1 = $row['foto'];
          }
          $foto = $nama_unik1;

          mysqli_query($koneksi, "update karyawan set nik='$nik',nama='$nama',tim='$tim',jabatan='$jabatan',no_hp='$no_hp',alamat='$alamat',area='$area',foto='$foto' ,password='$password' where id ='$id'") or die(mysqli_error($koneksi));

          //redirect ke halaman index.php
          echo "<script>alert('data berhasil diupdate.');window.location='karyawan-index.php';</script>";
        }
        ?>
  <?php
    include('templates/footer.php');
  ?>

