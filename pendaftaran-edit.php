<?php
  include('templates/header.php');
  include('templates/sidebar.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once "assets/phpmailer/src/Exception.php";
require_once "assets/phpmailer/src/PHPMailer.php";
require_once "assets/phpmailer/src/SMTP.php";
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Halaman Edit Pendaftaran</h1>
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
          $data   = mysqli_query($koneksi, "select * from pendaftaran where id = '$id'");
          $row  = mysqli_fetch_assoc($data);
          $pemanggilidpelanggan = $row['pelanggan_id'];

          ?>
          <form action="" method="post" role="form" enctype="multipart/form-data">

            <input type="show" name="pem_id" required="" value="<?= $row['pelanggan_id']; ?>">

            <input type="show" name="id" required="" value="<?= $row['id']; ?>">
              
            <div class="form-group">
              <label>No Pendaftaran</label>
              <input type="text" name="no_psb" value="<?= $row['no_psb']; ?>" readonly="" class="form-control col-sm-4"></br>
              <input type="text" name="jenis_psb" value="<?= $row['jenis_psb']; ?>" readonly="" class="form-control col-sm-4">
            </div>
            <div class="form-group">
              <label>Pelanggan</label>
                </br>
                <?php
                  
                  $datas = mysqli_query($koneksi, "select * from pelanggan where id ='$pemanggilidpelanggan'") or die(mysqli_error($koneksi));
                  while($data = mysqli_fetch_assoc($datas)) {
                ?> 
              <input type="text" name="nik" value="<?= $data['nik']; ?>" readonly="" class="form-control col-sm-4">
                </br>
              <input type="text" name="nama" value="<?= $data['nama']; ?>" readonly="" class="form-control col-sm-4">
                </br>
              <input type="text" name="email" value="<?= $data['email']; ?>" readonly="" class="form-control col-sm-4">
              <?php } ?> 

            </div>
            <div class="form-group">
              <label>No. Internet</label>
              <input type="text" name="no_internet" required="" class="form-control col-sm-4" value="<?= $row['no_internet']; ?>" >
            </div>
            
            <div class="form-group">
              <label>No. Voice</label>
              <input type="text" name="no_voice" required="" class="form-control col-sm-4" value="<?= $row['no_voice']; ?>" >
            </div>
            
            <div class="form-group">
              <label>Paket</label>
              <select class="form-control  col-sm-4" name="paket_id" disabled="" >
                <option value="">Pilih Paket</option>
                <?php
                  
                  $datas = mysqli_query($koneksi, "select * from paket") or die(mysqli_error($koneksi));
                  while($data = mysqli_fetch_assoc($datas)) {
                ?> 
                <option value="<?= $data['id'] ?>" <?php echo ($row['paket_id'] == $data['id']) ? 'selected' : ''; ?>><?= $data['nama'] ?></option>
              <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label>Status Pendaftaran</label> 
              <select class="form-control  col-sm-4" name="status_pemasangan" required="">
                <option value="">Pilih</option>
                <option value="PROSES PENGECEKKAN" <?= ($row['status_pemasangan'] == 'PROSES PENGECEKKAN') ? 'selected' : ''; ?>>PROSES PENGECEKKAN</option>
                <option value="MENUGGU ANTRIAN" <?= ($row['status_pemasangan'] == 'MENUGGU ANTRIAN') ? 'selected' : ''; ?>>MENUGGU ANTRIAN</option>
                <option value="DISETUJUI" <?= ($row['status_pemasangan'] == 'DISETUJUI') ? 'selected' : ''; ?>>DISETUJUI</option>
                <option value="DIBATALKAN" <?= ($row['status_pemasangan'] == 'DIBATALKAN') ? 'selected' : ''; ?>>DIBATALKAN</option>
              </select>
            </div>
            <div class="form-group">
              <label>Keterangan</label>
              <input type="text" name="ket" required="" class="form-control" value="<?= $row['ket']; ?>" >
            </div>
            <button type="submit" class="btn btn-primary" name="submit" value="simpan" id="buttonSimpan">Ubah data</button>
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
  
        
        //melakukan pengecekan jika button submit diklik maka akan menjalankan perintah simpan dibawah ini
        if (isset($_POST['submit'])) {
          //menampung data dari inputan
          $id = $_POST['id'];
          $pem_id = $_POST['pem_id'];
          $status_pemasangan = $_POST['status_pemasangan'];
          $no_voice = $_POST['no_voice'];
          $ket = $_POST['ket'];
          $no_internet = $_POST['no_internet'];
          $nik = $_POST['nik'];
          $nama = $_POST['nama'];
          $email = $_POST['email'];

          $datas = mysqli_query($koneksi, "update pendaftaran set no_voice = '$no_voice',ket = '$ket', status_pemasangan = '$status_pemasangan',no_internet = '$no_internet' where id = '$id'") or die(mysqli_error($koneksi));

          // $datas2 = mysqli_query($koneksi, "update karywan set pem_id = '$pem_id' where id = '$id'") or die(mysqli_error($koneksi));



        if (($datas)) {
            $email_pengirim = 'furqanidifasi.kerja@gmail.com';
            $nama_pengirim = 'Indihome';
            $email_penerima = $_POST['email'];
            $subjek = 'Pengajuan';
            $pesan = 'Pengajuan Pasang Baru anda telah "' .$status_pemasangan. '", anda bisa mengklik login di web kami dengan Username "'.$nik.'" dan Password  "' .$nik. '", Terimakasih';

            $mail = new PHPMailer;
            $mail->isSMTP();

            $mail->Host = 'smtp.gmail.com';
            $mail->Username = $email_pengirim;
            $mail->Password = 'jcksixvhzaoaihrt';
            $mail->Port = '465';
            $mail->SMTPAuth = true;            
            $mail->SMTPSecure = 'ssl';
            $mail->SMTPDebug = '2';


            $mail->setFrom($email_pengirim, $nama_pengirim);
            $mail->addAddress($email_penerima);
            $mail->isHTML(true);
            $mail->Subject = $subjek;
            $mail->Body = $pesan;

            $send = $mail->send();

            if ($send) {
              echo "berhasil <a href='pendaftaran-index.php'> Kembali </a>";

            }else{
              echo "gagal <a href='pendaftaran-index.php'> Kembali </a>";
            }
            
            echo "<script>alert('data berhasil diubah.');window.location='pendaftaran-index.php';</script>";

    }

        }
        ?>

  <?php
    include('templates/footer.php');
  ?>
