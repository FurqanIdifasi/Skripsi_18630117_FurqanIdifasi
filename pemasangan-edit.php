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
            <h1>Halaman Edit Pemasangan</h1>
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
          $data   = mysqli_query($koneksi, "select pemasangan.*, pendaftaran.no_psb, pendaftaran.tgl_psb, pelanggan.nama, pelanggan.email,pelanggan.alamat, karyawan.nama as nama_teknisi from pemasangan JOIN pendaftaran ON pendaftaran.id = pemasangan.pendaftaran_id JOIN pelanggan ON pelanggan.id = pendaftaran.pelanggan_id LEFT JOIN karyawan ON karyawan.id = pemasangan.teknisi_id where pemasangan.id = '$id'");
          $row  = mysqli_fetch_assoc($data);
          ?>
          <form action="" method="post" role="form" enctype="multipart/form-data">
            <input type="hidden" name="id" required="" value="<?= $row['id']; ?>">
            <input type="hidden" name="pendaftaran_id" required="" value="<?= $row['pendaftaran_id']; ?>">

              
            <div class="form-group">
              <label>Nama Pelanggan</label>
              <input type="text" name="tgl_rencana_pasang" required="" class="form-control col-sm-4" value="<?= $row['nama']; ?>" >
            </div>
            <div class="form-group">
              <input type="hidden" name="email" required="" class="form-control col-sm-4" value="<?= $row['email']; ?>" >
            </div>
            
            <div class="form-group">
              <label>Tgl Rencana Pasang</label>
              <input type="date" name="tgl_rencana_pasang" required="" class="form-control col-sm-4" value="<?= $row['tgl_rencana_pasang']; ?>" >
            </div>
            <div class="form-group">
              <label>No. PSB</label>
              <select class="form-control  col-sm-4" name="pendaftaran_id" disabled="" >
                <?php
                  
                  $datas = mysqli_query($koneksi, "select * from pendaftaran") or die(mysqli_error($koneksi));
                  while($data = mysqli_fetch_assoc($datas)) {
                ?> 
                <option value="<?= $data['id'] ?>" <?php echo ($row['pendaftaran_id'] == $data['id']) ? 'selected' : ''; ?>><?= $data['no_psb'] ?></option>
              <?php } ?>
              </select>
            </div>
                <?php if($_SESSION['hak_akses'] == 'admin') { ?>
            <div class="form-group">
              <label>Teknisi</label>
              <select class="form-control  col-sm-4" name="teknisi_id" required="">
                <option value="">Pilih Teknisi</option>
                <?php
                  $datas = mysqli_query($koneksi, "select * from karyawan where jabatan ='teknisi'") or die(mysqli_error($koneksi));
                  while($data = mysqli_fetch_assoc($datas)) {
                ?> 
                <option value="<?= $data['id'] ?>" <?php echo ($row['teknisi_id'] == $data['id']) ? 'selected' : ''; ?>><?= $data['nama'] ?></option>
              <?php } ?>
              </select>
            </div>

             <?php } else { ?>
               <input type="hidden" name="teknisi_id" required="" class="form-control" value="<?= $row['teknisi_id']; ?>" >
              <?php } ?>



            <div class="form-group">
              <label>Status</label>
              <select class="form-control  col-sm-4" name="status_pasang" required="">
                <option value="">Pilih</option>
                <option value="SEDANG ANTRIAN" <?= ($row['status_pasang'] == 'SEDANG ANTRIAN') ? 'selected' : ''; ?>>SEDANG ANTRIAN</option>
                <option value="MENUJU RUMAH PELANGGAN" <?= ($row['status_pasang'] == 'MENUJU RUMAH PELANGGAN') ? 'selected' : ''; ?>>MENUJU RUMAH PELANGGAN</option>
                <option value="PROSES PEMASANGAN" <?= ($row['status_pasang'] == 'PROSES PEMASANGAN') ? 'selected' : ''; ?>>PROSES PEMASANGAN</option>
                <option value="SELESAI" <?= ($row['status_pasang'] == 'SELESAI') ? 'selected' : ''; ?>>SELESAI</option>
                <option value="ADA KENDALA" <?= ($row['status_pasang'] == 'ADA KENDALA') ? 'selected' : ''; ?>>ADA KENDALA</option>
              </select>
            </div>

            <div class="form-group">
              <label>Keterangan</label>
              <input type="text" name="keterangan" class="form-control" value="<?= $row['keterangan']; ?>" >
            </div>
            <div class="form-group">
              <label>Tanggal Selesai</label>
              <input type="date" name="tgl_selesai"  class="form-control col-sm-2" value="<?= $row['tgl_selesai']; ?>">
            </div>

            <div class="form-group">
              <label>Foto</label><br>
              <img src="assets/gambar/<?= $row['foto'];?>" width="100" class="mb-3">
              <input type="file" name="foto" class="form-control col-sm-4" >
              <i>(Abaikan jika tidak ingin ganti foto)</i>
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
       
        
        //melakukan pengecekan jika button submit diklik maka akan menjalankan perintah simpan dibawah ini
        if (isset($_POST['submit'])) {
          //menampung data dari inputan
          $id = $_POST['id'];
          $tgl_rencana_pasang = $_POST['tgl_rencana_pasang'];
          $keterangan = $_POST['keterangan'];
          $status_pasang = $_POST['status_pasang'];
          $teknisi_id = $_POST['teknisi_id'];
          $email = $_POST['email'];
          $tgl_selesai = $_POST['tgl_selesai'];
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

          $datas = mysqli_query($koneksi, "update pemasangan set keterangan = '$keterangan',status_pasang = '$status_pasang',foto = '$foto',teknisi_id = '$teknisi_id',tgl_selesai = '$tgl_selesai',tgl_rencana_pasang = '$tgl_rencana_pasang' where id = '$id'") or die(mysqli_error($koneksi));



        if (($datas)) {
            $email_pengirim = 'furqanidifasi.kerja@gmail.com';
            $nama_pengirim = 'Indihome';
            $email_penerima = $_POST['email'];
            $subjek = 'Pengajuan';

            if ($status_pasang == 'SELESAI') {
              
            $pesan = 'Selamat Pengajuan Pasang Baru anda telah "' .$status_pasang. '", Terimakasih';
            } else {

            $pesan = 'balum tuntung';
            }

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
            
            echo "<script>alert('data berhasil diubah.');window.location='pemasangan-index-teknisi.php';</script>";

    }

        }
        ?>

  <?php
    include('templates/footer.php');
  ?>
