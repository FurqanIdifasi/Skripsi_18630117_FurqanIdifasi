<?php
  include('templates2/header.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once "assets/phpmailer/src/Exception.php";
require_once "assets/phpmailer/src/PHPMailer.php";
require_once "assets/phpmailer/src/SMTP.php";
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="min-height: 395px;">
    <!-- Content Header (Page header) -->
  <div class="content-header">
      <div class="container"> 
        <div class="row mb-2">
           <div class="col-sm-12 text-center">
             <img src="assets/gambar/logo.png" alt="AdminLTE Logo" style="width: 300px;">
          </div>
          <div class="col-sm-6">
            <h1 class="m-0">  Pendaftaran</h1>
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
                <h5 class="card-title m-0">Pilihan Paket</h5>
              </div>
              <div class="card-body">
                   <?php
              include('koneksi.php'); //memanggil file koneksi
              $id = $_GET['id'];
              $data   = mysqli_query($koneksi, "select * from paket where id = '$id'");
              $row  = mysqli_fetch_assoc($data);
              ?>
                <div class="col-md-12">
                 <div class="card ">
                    <div class="card-header bg-danger">
                      <h5 class="card-title m-0"><?= $row['nama']; ?></h5>
                    </div>
                    <div class="card-body">
                      <span class="badge badge-danger badge-pill "><?= $row['jenis']; ?></span>
                      <span class="badge badge-danger badge-pill "><?= $row['speed']; ?></span>
                      <span class="badge badge-danger badge-pill ">Rp <?= $row['harga']; ?></span>
                      <p class="card-text"><?= $row['detail']; ?></p>
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
                          <input type="hidden" name="paket_id" value="<?= $id; ?>"  >
                          <input type="hidden" name="no_psb" value="<?= $kode2; ?>" >
                          <input type="text" name="kode" value="<?= $kode; ?>" required="" class="form-control col-sm-4" readonly></br>
                          <input type="text" name="jenis_psb" value="PASANG BARU"  required="" class="form-control col-sm-4" readonly>
                        </div>
                        <div class="form-group">
                          <label>Nik</label>
                          <input type="text" name="nik" required="" class="form-control col-sm-4" autofocus >
                        </div>

                        <div class="form-group">
                          <label>Nama</label>
                          <input type="text" name="nama" required="" class="form-control col-sm-4"  >
                        </div>

                        <div class="form-group">
                          <label>Email</label>
                          <input type="text" name="email" required="" class="form-control col-sm-4"  >
                        </div>

                        <div class="form-group">
                          <label>No Hp</label>
                          <input type="text" name="hp" required="" class="form-control col-sm-4" >
                        </div>
                        <div class="form-group">
                          <label>Alamat</label>
                          <input type="text" name="alamat" required="" class="form-control" >
                        </div>

            <div class="form-group">
              <label>Kepemilikan Rumah</label>
              <select class="form-control  col-sm-4" name="status_rumah" required="">
                <option value="">Pilih</option>
               <!--  <option value="pimpinan">Pimpinan</option> -->
                <option value="MILIK SENDIRI">Milik Sendiri</option>
                <option value="SEWA/KONTRAK">Sewa</option>
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
                          <label>Foto Selfie</label>
                          <input type="file" name="foto_pelanggan" class="form-control col-sm-4" required="" >
                        </div>
                        <div class="form-group">
                          <label>Foto KTP</label>
                          <input type="file" name="foto_ktp" class="form-control col-sm-4" required="" >
                        </div>
                        <div class="form-group">
                          <label>Foto KTP & Selfie</label>
                          <input type="file" name="foto_selfie" class="form-control col-sm-4" required="" >
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
          $kode = $_POST['kode'];
          $nama = $_POST['nama'];
          $email = $_POST['email'];
          $nik = $_POST['nik'];
          $hp = $_POST['hp'];
          $alamat = $_POST['alamat'];
          $status_rumah = $_POST['status_rumah'];
          $latitude = $_POST['latitude'];
          $longitude = $_POST['longitude'];
          $no_psb = $_POST['no_psb'];
          $paket_id = $_POST['paket_id'];
          $status_pemasangan = 'PROSES PENGECEKKAN';
          $no_internet = '-';
          $no_voice = '-';
          $jenis_psb = $_POST['jenis_psb'];
          $jabatan = 'pelanggan';
          $tim = '-';
          $area = '-';

          $tgl_daftar = date('Y-m-d');

          $tgl_psb = date('Y-m-d');

          $nama_gambar1   = $_FILES['foto_pelanggan']['name'];
          $file_tmp1    = $_FILES['foto_pelanggan']['tmp_name'];   
          $acak1      = rand(1,99999);
          if($nama_gambar1 != "") {
            $nama_unik1     = $acak1.$nama_gambar1;
            move_uploaded_file($file_tmp1,'assets/gambar/'.$nama_unik1);
          } else {
            $nama_unik1 = NULL;
          }
          $foto_pelanggan = $nama_unik1;

          $nama_gambar2   = $_FILES['foto_ktp']['name'];
          $file_tmp2    = $_FILES['foto_ktp']['tmp_name'];   
          $acak2      = rand(1,99999);
          if($nama_gambar2 != "") {
            $nama_unik2     = $acak2.$nama_gambar2;
            move_uploaded_file($file_tmp2,'assets/gambar/'.$nama_unik2);
          } else {
            $nama_unik2 = NULL;
          }
          $foto_ktp = $nama_unik2;

          $nama_gambar3   = $_FILES['foto_selfie']['name'];
          $file_tmp3    = $_FILES['foto_selfie']['tmp_name'];   
          $acak3      = rand(1,99999);
          if($nama_gambar3 != "") {
            $nama_unik3     = $acak3.$nama_gambar3;
            move_uploaded_file($file_tmp3,'assets/gambar/'.$nama_unik3);
          } else {
            $nama_unik3 = NULL;
          }
          $foto_selfie = $nama_unik3;

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

$data_cek   = mysqli_query($koneksi, "select * from pelanggan where nik = '$nik'");
          $row_cek  = mysqli_fetch_assoc($data_cek);

          if($row_cek > 0) {
          echo "<script>alert('Pengajuan Pasang Baru sudah ada.');window.location='pelanggan-index.php';</script>";
        } else {

          $datas = mysqli_query($koneksi, "insert into pelanggan (nama,email,hp,alamat,status_rumah,longitude,latitude,kode,foto_pelanggan,foto_ktp,foto_selfie,foto_rumah,nik,tgl_daftar)values('$nama','$email','$hp','$alamat','$status_rumah','$longitude','$latitude','$kode','$foto_pelanggan','$foto_ktp','$foto_selfie','$foto_rumah','$nik','$tgl_daftar')") or die(mysqli_error($koneksi));

          $pelanggan_id = mysqli_insert_id($koneksi);
        }

          $datas2 = mysqli_query($koneksi, "insert into pendaftaran (pelanggan_id,no_psb,paket_id,tgl_psb,status_pemasangan,jenis_psb,no_internet,no_voice)values('$pelanggan_id','$no_psb','$paket_id','$tgl_psb','$status_pemasangan','$jenis_psb','$no_internet','$no_voice')") or die(mysqli_error($koneksi));


          $datas22 = mysqli_query($koneksi, "insert into karyawan (pem_id,nama,nik,no_hp,email_karyawan,alamat,jabatan,tim,area,foto,username,password)values('$pelanggan_id','$nama','$nik','$hp','$email_karyawan','$alamat','$jabatan','$tim','$area','$foto_pelanggan','$nik','$nik')") or die(mysqli_error($koneksi));


          // echo "<script>alert('Berhasil Mendaftar, silahkan cek di kolom pendaftaran.');window.location='login-index.php';</script>";
        

        /*}*/

        // if (($datas2)) {
        //     $email_pengirim = 'furqanidifasi.kerja@gmail.com';
        //     $nama_pengirim = 'Indihome';
        //     $email_penerima = $_POST['email'];
        //     $subjek = 'Pengajuan';
        //     $pesan = 'Pengajuan anda atas Nama '.$nama.' dengan Nik ' .$nik. ' sedang diproses mohon bersabar, Terimakasih';

        //     $mail = new PHPMailer;
        //     $mail->isSMTP();

        //     $mail->Host = 'smtp.gmail.com';
        //     $mail->Username = $email_pengirim;
        //     $mail->Password = 'gphqyzknqlamlctt';
        //     $mail->Port = '465';
        //     $mail->SMTPAuth = true;            
        //     $mail->SMTPSecure = 'ssl';
        //     $mail->SMTPDebug = '2';


        //     $mail->setFrom($email_pengirim, $nama_pengirim);
        //     $mail->addAddress($email_penerima);
        //     $mail->isHTML(true);
        //     $mail->Subject = $subjek;
        //     $mail->Body = $pesan;

        //     $send = $mail->send();

        //     if ($send) {
        //       echo "berhasil <a href='login-index.php'> Kembali </a>";

        //     }else{
        //       echo "gagal <a href='login-index.php'> Kembali </a>";
        //     }

            echo "<script>alert('Data Tersimpan Silahkan Menuggu Email Pemberitahuan')</script>";

            echo "<script type='text/javascript'> document.location = 'login-index.php';</script>";

    // }
  }

        ?>


<?php
  include('templates2/footer.php');
?>