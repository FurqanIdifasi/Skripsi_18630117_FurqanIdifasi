 <?php
 include('koneksi.php');
 $id = $_GET['id'];
          $status_config = 'HD OGP';

          $datas = mysqli_query($koneksi, "update pemasangan set status_config = '$status_config' where id = '$id'") or die(mysqli_error($koneksi));
            echo "<script>alert('Berhasil Req Config.');window.location='pemasangan-index.php';</script>";

  ?>