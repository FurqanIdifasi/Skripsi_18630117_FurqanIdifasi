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
            <h1> Pengajuan Migrasi </h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>


    <!-- Main content -->
    <div class="content">
      <div class="container">

        <div class="row">
          <!-- /.col-md-6 -->
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title m-0"></h5>
              </div>
              <div class="card-body">
                   <?php
              include('koneksi.php'); //memanggil file koneksi
              $id = $_GET['id'];
              $data   = mysqli_query($koneksi, "select pelanggan.*, pendaftaran.no_psb, pendaftaran.no_internet, pendaftaran.no_voice, pendaftaran.paket_id, pendaftaran.tgl_psb, pendaftaran.status_pemasangan, pendaftaran.ket, paket.nama as nama_paket, pemasangan.status_pasang from pelanggan join pendaftaran on pendaftaran.pelanggan_id = pelanggan.id join paket on paket.id = pendaftaran.paket_id left join pemasangan on pendaftaran.id = pemasangan.pendaftaran_id where pelanggan.id = '$id'");
              $row  = mysqli_fetch_assoc($data);



              ?>
                <div class="col-md-12">
                 <div class="card ">
                    <div class="card-header bg-danger">
                      <h5 class="card-title m-0">Form Pengajuan Migrasi</h5>
                    </div>
                    <div class="card-body">
                     <form action="" method="post" role="form" enctype="multipart/form-data">

            
            <div class="form-group">
              <label>Apakah anda merasa senang dengan kecepatan progres kami ?</label>
              <select class="form-control  col-sm-4" name="p1" required="">
                <option value="">Pilih</option>
                <option value="SENANG">SENANG</option>
                <option value="CUKUP">CUKUP</option>
                <option value="KECEWA">KECEWA</option>
              </select>
            </div>
            <div class="form-group">
              <label>Apakah anda senang dengan pelayanan dari TIM kami ?</label>
              <select class="form-control  col-sm-4" name="p2" required="">
                <option value="">Pilih</option>
                <option value="SENANG">SENANG</option>
                <option value="CUKUP">CUKUP</option>
                <option value="KECEWA">KECEWA</option>
              </select>
            </div>
            <div class="form-group">
              <label>Apakah senang dengan keseluruhan pelayanan yang kami berikan ?</label>
              <select class="form-control  col-sm-4" name="p3" required="">
                <option value="">Pilih</option>
                <option value="SENANG">SENANG</option>
                <option value="CUKUP">CUKUP</option>
                <option value="KECEWA">KECEWA</option>
              </select>
            </div>


                        <button type="submit" class="btn btn-danger" name="submit" value="simpan">Simpan data</button>
                      </form>

                    </div>
                  </div>
                  </div>
              
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

        
        //melakukan pengecekan jika button submit diklik maka akan menjalankan perintah simpan dibawah ini
        if (isset($_POST['submit'])) {
          //menampung data dari inputan
          $p1 = $_POST['p1'];
          $p2 = $_POST['p2'];
          $p3 = $_POST['p3'];
         /*$data_cek   = mysqli_query($koneksi, "select * from pelanggan where nik = '$nik'");
          $row_cek  = mysqli_fetch_assoc($data_cek);

          if($row_cek > 0) {
          echo "<script>alert('data sudah ada.');window.location='pelanggan-index.php';</script>";
        } else {*/

          // $datas = mysqli_query($koneksi, "insert into pelanggan (tgl_daftar)values('$tgl_daftar')") or die(mysqli_error($koneksi));

// $data_cek   = mysqli_query($koneksi, "select pelanggan.*,pendaftaran.jenis_psb from pelanggan join pendaftaran on pendaftaran.pelanggan_id = pelanggan_id where pendaftaran.jenis_psb = 'MIGRASI' AND pelanggan.nik = '$nik'");
//           $row_cek  = mysqli_fetch_assoc($data_cek);

//           if($row_cek > 0) {
//           echo "<script>alert('Pengajuan MIGRASI Sudah ada');window.location='login-index-migrasi.php';</script>";
//         } else {

          $datas = mysqli_query($koneksi, "update pemasangan set p1='$p1' ,p2='$p2' ,p3='$p3' where id ='$id'") or die(mysqli_error($koneksi));

          echo "<script>alert('Berhasil Mendaftar, silahkan cek di kolom pendaftaran.');window.location='penilaian-index.php';</script>";
          // }
        }
        /*}*/
        ?>
<?php
  include('templates2/footer.php');
?>