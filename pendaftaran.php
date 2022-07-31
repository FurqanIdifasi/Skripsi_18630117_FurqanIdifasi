<?php
  include('templates2/header.php');
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="min-height: 395px;">
    <!-- Content Header (Page header) -->
  <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> Halaman Pendaftaran</h1>
          </div><!-- /.col -->
       
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">

        <div class="row">
          <!-- /.col-md-6 -->
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title m-0">Daftar</h5>
              </div>
              <div class="card-body">
                   <?php
              include('koneksi.php'); //memanggil file koneksi
              $datas = mysqli_query($koneksi, "select * from paket where status='aktif'") or die(mysqli_error($koneksi));
               while($row = mysqli_fetch_assoc($datas)) {
              ?>
                <div class="col-md-4">
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