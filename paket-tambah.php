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
            <h1>Halaman Tambah Paket</h1>
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
              <label>Nama</label>
              <input type="text" name="nama" required="" class="form-control col-sm-4" autofocus="">
            </div>
            <div class="form-group">
              <label>Jenis</label>
              <select class="form-control  col-sm-4" name="jenis" required="">
                <option value="">Pilih</option>
                <option value="1P">1P</option>
                <option value="2P">2P</option>
                <option value="3P">3P</option>
              </select>
            </div>
            <div class="form-group">
              <label>Speed</label>
              <select class="form-control  col-sm-4" name="speed" required="">
                <option value="">Pilih</option>
                <option value="20mb">20mb</option>
                <option value="30mb">30mb</option>
                <option value="50mb">50mb</option>
                <option value="100mb">100mb</option>
              </select>
            </div>
            <div class="form-group">
              <label>Harga</label>
              <input type="number" name="harga" required="" class="form-control col-sm-4" >
            </div>
            <div class="form-group">
              <label>Detail</label>
              <textarea class="textarea" name="detail"></textarea>
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
          $jenis = $_POST['jenis'];
          $nama = $_POST['nama'];
          $speed = $_POST['speed'];
          $harga = $_POST['harga'];
          $status = 'aktif';
          $detail = $_POST['detail'];

          $datas = mysqli_query($koneksi, "insert into paket (jenis,nama,speed,status,harga,detail)values('$jenis','$nama','$speed','$status','$harga','$detail')") or die(mysqli_error($koneksi));

          echo "<script>alert('data berhasil disimpan.');window.location='paket-index.php';</script>";
        }
        ?>
  <?php
    include('templates/footer.php');
  ?>

