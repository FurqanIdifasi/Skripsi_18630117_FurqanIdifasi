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
                      <?php
                        $query = mysqli_query($koneksi, "SELECT max(kode) as kodeTerbesar FROM pelanggan");
                        $data = mysqli_fetch_array($query);
                        $kode = $data['kodeTerbesar'];
                         
                        $urutan = (int) substr($kode, 1, 4);
                        $urutan++;
                         
                        $huruf = "P";
                        $kode = $huruf . sprintf("%04s", $urutan);

                        $query2 = mysqli_query($koneksi, "SELECT max(no_psb) as kodeTerbesar FROM pendaftaran");
                        $data2 = mysqli_fetch_array($query2);
                        $kode2 = $data2['kodeTerbesar'];
                         
                        $urutan2 = (int) substr($kode2, 2, 4);
                        $urutan2++;
                         
                        $huruf2 = "SC";
                        $kode2 = $huruf2 . sprintf("%04s", $urutan2);
                    ?>
                     <form action="" method="post" role="form" enctype="multipart/form-data">
                        <div class="form-group">
                          <label>Kode</label>

                          <input type="show" name="paket_id" value="<?= $row['paket_id']; ?>" >

                          <input type="show" name="no_psb" value="<?= $kode2; ?>" >
                          <input type="text" name="kode" value="<?= $row['kode']; ?>" required="" class="form-control col-sm-4" readonly></br>
                          <input type="text" name="jenis_psb" value="MIGRASI"  required="" class="form-control col-sm-4" readonly>
                        </div>

                        <div class="form-group">
                          <label>Id Pelanggan</label>
                          <input type="text" name="id" required="" class="form-control col-sm-4" autofocus value="<?= $row['id']; ?>" readonly="true" >
                        </div>
                        <div class="form-group">
                          <label>No Internet</label>
                          <input type="text" name="no_internet" required="" class="form-control col-sm-4" autofocus value="<?= $row['no_internet']; ?>" readonly="true" >
                        </div>
                        <div class="form-group">
                          <label>No Voice</label>
                          <input type="text" name="no_voice" required="" class="form-control col-sm-4" autofocus value="<?= $row['no_voice']; ?>" readonly="true" >
                        </div>

                        <div class="form-group">
                          <label>Nik</label>
                          <input type="text" name="nik" required="" class="form-control col-sm-4" autofocus value="<?= $row['nik']; ?>" readonly="true" >
                        </div>

                        <div class="form-group">
                          <label>Nama</label>
                          <input type="text" name="nama" required="" class="form-control col-sm-4" value="<?= $row['nama']; ?>" readonly="true" >
                        </div>

                        <div class="form-group">
                          <label>No Hp</label>
                          <input type="text" name="hp" required="" class="form-control col-sm-4" value="<?= $row['hp']; ?>" readonly="true" >
                        </div>
                        <div class="form-group">
                          <label>Alamat</label>
                          <input type="text" name="alamat_baru" required="" class="form-control" >
                        </div>

            <div class="form-group">
              <label>Kepemilikan Rumah</label>
            </div>

            <div class="form-group">
              <select class="form-control  col-sm-4" name="status_rumah_baru" required="">
                <option value="">Pilih</option>
               <!--  <option value="pimpinan">Pimpinan</option> -->
                <option value="MILIK SENDIRI">MILIK SENDIRI</option>
                <option value="SEWA/KONTRAK">SEWA</option>
              </select>
            </div>

                        <div class="form-group">
                          <label>Latlong</label>
                            <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Latitude</span>
                            </div>
                            <div class="custom-file">
                                <input type="text" name="latitude" required="" class="form-control" >
                            </div>
                            <div class="input-group-prepend">
                              <span class="input-group-text">Longitude</span>
                            </div>
                            <div class="custom-file">
                                <input type="text" name="longitude" required="" class="form-control" >
                            </div>
                          </div>
                          </div>


                        <div class="form-group">
                          <label>Foto Rumah</label>
                          <input type="file" name="foto_rumah" class="form-control col-sm-4" >
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
          $id = $_POST['id'];
          $kode = $_POST['kode'];
          $no_internet = $_POST['no_internet'];
          $no_voice = $_POST['no_voice'];
          $nama = $_POST['nama'];
          $nik = $_POST['nik'];
          $hp = $_POST['hp'];
          $alamat_baru = $_POST['alamat_baru'];
          $status_rumah_baru = $_POST['status_rumah_baru'];
          $latitude = $_POST['latitude'];
          $longitude = $_POST['longitude'];
          $no_psb = $_POST['no_psb'];
          $paket_id = $_POST['paket_id'];
          $jenis_psb = $_POST['jenis_psb'];
          $status_pemasangan = 'PROSES PENGECEKKAN';
          $ket = '-';

          $tgl_daftar = date('Y-m-d');

          $tgl_psb = date('Y-m-d');
         /*$data_cek   = mysqli_query($koneksi, "select * from pelanggan where nik = '$nik'");
          $row_cek  = mysqli_fetch_assoc($data_cek);

          if($row_cek > 0) {
          echo "<script>alert('data sudah ada.');window.location='pelanggan-index.php';</script>";
        } else {*/

          $nama_gambar4   = $_FILES['foto_rumah']['name'];
          $file_tmp4    = $_FILES['foto_rumah']['tmp_name'];   
          $acak4      = rand(1,99999);
          if($nama_gambar4 != "") {
            $nama_unik4     = $acak4.$nama_gambar4;
            move_uploaded_file($file_tmp4,'assets/gambar/'.$nama_unik4);
          } else {
            $nama_unik4 = NULL;
          }
          $foto_rumah = $nama_unik4;

          // $datas = mysqli_query($koneksi, "insert into pelanggan (tgl_daftar)values('$tgl_daftar')") or die(mysqli_error($koneksi));

// $data_cek   = mysqli_query($koneksi, "select pelanggan.*,pendaftaran.jenis_psb from pelanggan join pendaftaran on pendaftaran.pelanggan_id = pelanggan_id where pendaftaran.jenis_psb = 'MIGRASI' AND pelanggan.nik = '$nik'");
//           $row_cek  = mysqli_fetch_assoc($data_cek);

//           if($row_cek > 0) {
//           echo "<script>alert('Pengajuan MIGRASI Sudah ada');window.location='login-index-migrasi.php';</script>";
//         } else {

          $datas = mysqli_query($koneksi, "update pelanggan set nik='$nik',nama='$nama',hp='$hp',alamat='$alamat_baru' ,status_rumah='$status_rumah_baru ' ,latitude='$latitude' ,longitude='$longitude' ,foto_rumah='$foto_rumah' where id ='$id'") or die(mysqli_error($koneksi));

          $pelanggan_id = mysqli_insert_id($koneksi);
 
          $datas2 = mysqli_query($koneksi, "insert into pendaftaran (pelanggan_id,no_psb,no_internet,no_voice,paket_id,tgl_psb,status_pemasangan,ket,jenis_psb)values('$id','$no_psb','$no_internet','$no_voice','$paket_id','$tgl_psb','$status_pemasangan','$ket','$jenis_psb')") or die(mysqli_error($koneksi));

          echo "<script>alert('Berhasil Mendaftar, silahkan cek di kolom pendaftaran.');window.location='pengajuan-migrasi-index.php';</script>";
          // }
        }
        /*}*/
        ?>
<?php
  include('templates2/footer.php');
?>