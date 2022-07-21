<?php
$host        = "localhost";
$user        = "root";
$pass        = "";
$db          = "akademik";

$koneksi    = mysqli_connect($host,$user,$pass,$db);
if(!$koneksi){ //cek koneksi
    die("Tidak bisa terkoneksi ke database");
}
$nim      = "";
$nama     = "";
$alamat   = "";
$fakultas = "";
$sukses   = "";
$error    = "";

if(isset($_POST['simpan'])){
    $nim       = $_POST['nim'];
    $nama      = $_POST['nama'];
    $alamat    = $_POST['alamat'];
    $fakultas  = $_POST['fakultas'];

    if($nim && $nama && $alamat && $fakultas){
        $sql1 = "insert into mahasiswa (nim,nama,alamat,fakultas) values ('$nim','$nama','$alamat','$fakultas')";
        $q1   = mysqli_query($koneksi, $sql1);
        if ($q1) {
             $sukses     = "Berhasil memasukkan data baru";
        }else{
            $error       = "Gagal memasukkan data";
        }
     }else{
        $error = "Silahkan masukkan data";
     }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">



    <style>
    .mx-auto {
        width: 800px;
    }

    .card {
        margin-top: 10px;
    }
    </style>
</head>

<body>
    <div class="mx-auto">
        <!-- untuk memasukkan data -->
        <div class="card">
            <div class="card-header">
                Create / Edit Data
            </div>
            <div class="card-body">
                <?php
                 if($error){
                    ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error ?>
                </div>
                <?php
                }
                ?>
                <?php
                 if($sukses) {
                 ?>
                <div class="alert alert-sukses" role="alert">
                    <?php echo $sukses ?>
                </div>
                <?php
                }
                ?>



                <form action="" method="POST">
                    <div class="mb-3 row">
                        <label for="nim" class="col-sm-2 col-form-label">nim</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nim" name="nim" value="<?php echo $nim ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nama" class="col-sm-2 col-form-label">nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="alamat" class="col-sm-2 col-form-label">alamat</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="alamat" name="alamat"
                                value="<?php echo $alamat ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="fakultas" class="col-sm-2 col-form-label">fakultas</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="fakultas" id="fakultas">
                                <option value="">- Pilih fakultas -</opotion>
                                <option value="Ekonomi" <?php if($fakultas == "ekonomi") echo "selected"?>>ekonomi
                                </option>
                                <option value="IT" <?php if($fakultas == "IT") echo "selected"?>>IT</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <input type="submit" name="simpan" value="simpan data" class="btn btn-primary" />
                    </div>
                </form>
            </div>
        </div>

        <!-- untuk mengeluarkan data -->
        <div class="card">
            <div class="card-header text-white bg-secondary">
                Data Mahasiswa
            </div>
            <div class="card-body">
                 <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">nim</th>
                            <th scope="col">nama</th>
                            <th scope="col">alamat</th>
                            <th scope="col">fakultas</th>
                            <th scope="col">aksi</th>

                        </tr>
                        <tbody>
                            <?php
                            $sql2  = "select * from mahasiswa order by id desc";
                            $q2    = mysqli_query($koneksi,$sql2); 
                            $urut  = 1;
                            while($r2 = mysqli_fetch_array($q2)){
                                $id      = $r2['id'];
                                $nim     = $r2['nim'];
                                $nama    = $r2['nama'];
                                $alamat  = $r2['alamat'];
                                $fakultas= $r2['fakultas'];

                                ?>
                                <tr>
                                    <th scope="row"><?php echo $urut++ ?></th>
                                    <td scope ="row"><?php echo $nim?></td>
                                    <td scope ="row"><?php echo $nama?></td>
                                    <td scope ="row"><?php echo $alamat?></td>
                                    <td scope ="row"><?php echo $fakultas?></td>
                                    

                                    </td>


                                </tr>
                                <?php

                            }
                            ?>
                    </thead>
                 </table>
            </div>
        </div>
</body>

</html>