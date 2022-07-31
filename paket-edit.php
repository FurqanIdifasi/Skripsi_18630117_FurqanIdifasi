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
            <h1>Halaman Edit Paket</h1>
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

          $id = $_GET['id']; //mengambil id paket yang ingin diubah

          //menampilkan paket berdasarkan id
          $data   = mysqli_query($koneksi, "select * from paket where id = '$id'");
          $row  = mysqli_fetch_assoc($data);
          ?>
          <form action="" method="post" role="form" enctype="multipart/form-data">
            <input type="hidden" name="id" required="" value="<?= $row['id']; ?>">
            <div class="form-group">
              <label>Nama</label>
              <input type="text" name="nama" required="" class="form-control col-sm-4" autofocus="" value="<?= $row['nama']; ?>" >
            </div>
            <div class="form-group">
              <label>Jenis</label>
              <select class="form-control  col-sm-4" name="jenis" required="">
                <option value="">Pilih</option>
                <option value="1P" <?= ($row['jenis'] == '1P') ? 'selected' : ''; ?>>1P</option>
                <option value="2P" <?= ($row['jenis'] == '2P') ? 'selected' : ''; ?>>2P</option>
                <option value="3P" <?= ($row['jenis'] == '3P') ? 'selected' : ''; ?>>3P</option>
              </select>
            </div>
            <div class="form-group">
              <label>Speed</label>
              <select class="form-control  col-sm-4" name="speed" required="">
                <option value="">Pilih</option>
                <option value="20mb" <?= ($row['speed'] == '20mb') ? 'selected' : ''; ?>>20mb</option>
                <option value="30mb" <?= ($row['speed'] == '30mb') ? 'selected' : ''; ?>>30mb</option>
                <option value="50mb" <?= ($row['speed'] == '50mb') ? 'selected' : ''; ?>>50mb</option>
                <option value="100mb" <?= ($row['speed'] == '100mb') ? 'selected' : ''; ?>>100mb</option>
              </select>
            </div>
            <div class="form-group">
              <label>Harga</label>
              <input type="number" name="harga" required="" class="form-control col-sm-4" value="<?= $row['harga']; ?>"  >
            </div>
            <div class="form-group">
              <label>Detail</label>
              <textarea name="detail" class="textarea"><?= $row['detail']; ?></textarea>
            </div>  
            <div class="form-group">
              <label>Status</label>
              <select class="form-control  col-sm-4" name="status" required="">
                <option value="">Pilih</option>
                <option value="aktif" <?= ($row['status'] == 'aktif') ? 'selected' : ''; ?>>aktif</option>
                <option value="nonaktif" <?= ($row['status'] == 'nonaktif') ? 'selected' : ''; ?>>nonaktif</option>
              </select>
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
             $jenis = $_POST['jenis'];
          $nama = $_POST['nama'];
          $speed = $_POST['speed'];
          $harga = $_POST['harga'];
          $status = $_POST['status'];
          $detail = $_POST['detail'];

          mysqli_query($koneksi, "update paket set jenis='$jenis',nama='$nama',speed='$speed',harga='$harga',status='$status',detail='$detail' where id ='$id'") or die(mysqli_error($koneksi));

          //redirect ke halaman index.php
          echo "<script>alert('data berhasil diupdate.');window.location='paket-index.php';</script>";
        }
        ?>
  <?php
    include('templates/footer.php');
  ?>

