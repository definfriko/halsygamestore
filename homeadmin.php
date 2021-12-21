<?php
    include_once("config.php");
    
    //Inisialisasi sesi
    session_start();
    
    //Mengecek apakah user telah login, jika tidak akan kembali ke halaman login
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: loginadmin.php");
        exit;
    }

    $listwallet = mysqli_query($link, "SELECT * FROM wallet WHERE is_delete=0 ORDER BY id_wallet");
    $listpembeli = mysqli_query($link, "SELECT * FROM pembeli WHERE is_delete=0 ORDER BY id_pembeli");
    $listpembayaran = mysqli_query($link, "SELECT pembayaran.id_bayar, wallet.jenis_wallet, wallet.tipe_wallet, wallet.harga, pembeli.nama, pembeli.rekening, pembayaran.tanggal FROM wallet INNER JOIN pembayaran ON wallet.id_wallet=pembayaran.id_bayar INNER JOIN pembeli ON pembeli.id_pembeli=pembayaran.id_pembeli WHERE pembayaran.is_delete = 0");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Homepage Admin</title>
        <style>
            body{ 
            font: 14px sans-serif; 
            background-color: rgb(0, 0, 0);
            background-image: url("https://wallpaperaccess.com/full/4892311.jpg");
            }
            h1 {
                color: rgb(255, 255, 255);
                text-align: center;
            }
            h3 {
                text-align: center;
            }
            table {
                width: 65%;
                margin-left: auto;
                margin-right: auto;
            }
            th {
                padding: 10px 10px 10px 10px;
                text-align: center;
            }
            tr  {
                text-align: center;
            }
            td {
                padding: 10px 10px 10px 10px;
            }
            p {
                text-align: center;
            }
            .Tabel {
                width: 60%;
                
                background-color: rgb(255, 255, 255);
                margin-bottom: 10px;
                margin-left: 355px;
                margin-right: 20px;
                border-style: solid;
            }
        </style>
    </head>
    <body>
        <div style="text-align: center">
            <h1>Data Wallet dan Pembeli</h1>
        </div>
        
        <div class='Tabel'>
        <h3>Katalog Wallet</h3>
        <table width='80%' border=1>
        <p>
            <a href="addwallet.php">Tambah Wallet</a>
        </p> 
            <tr>
                <th>ID Wallet</th> <th>Jenis Wallet</th> <th>Tipe Wallet</th> <th>Harga</th> <th>Aksi</th>   
            </tr>

            <?php
                while($item = mysqli_fetch_array($listwallet)) {
                    echo "<tr>"; 
                    echo "<td>".$item['id_wallet']."</td>"; 
                    echo "<td>".$item['tipe_wallet']."</td>";
                    echo "<td>".$item['jenis_wallet']."</td>";
                    echo "<td>".$item['harga']."</td>"; 
                    echo "<td><a href='editwallet.php?id=$item[id_wallet]'>Edit</a> 
                    | 
                    <a href='softdeletewallet.php?id=$item[id_wallet]'>Soft Delete</a></td></tr>";
                }
            ?>
        </table><br>
        </div>

        <div class='Tabel'>
        <h3>Data Pembeli</h3>
        <table width='80%' border=1>
        <p>
            <a href="addpembeli.php">Tambah Data Pembeli</a>
        </p> 
            <tr>
                <th>ID</th> <th>Nama</th> <th>Rekening</th> <th>Aksi</th> 
            </tr>
        
            <?php
                while($item = mysqli_fetch_array($listpembeli)) {
                    echo "<tr>"; 
                    echo "<td>".$item['id_pembeli']."</td>"; 
                    echo "<td>".$item['nama']."</td>"; 
                    echo "<td>".$item['rekening']."</td>"; 
                    echo "<td><a href='editpembeli.php?id=$item[id_pembeli]'>Edit</a> 
                    | 
                    <a href='softdeletepembeli.php?id=$item[id_pembeli]'>Soft Delete</a></td></tr>"; 
                }
            ?>
        </table><br>
        </div>
        
        <div class='Tabel'>
        <h3>Data Pembayaran</h3>
        <table width='80%' border=1>
        <p>
            <a href="addpembayaran.php">Tambah Data Pembayaran</a>
        </p>
            <tr>
            <th>ID Pembayaran</th> <th>Tipe Wallet</th> <th>Jenis Wallet</th> <th>Harga</th>  <th>Nama Pembeli</th> <th>Rekening</th> <th>Waktu Beli</th> <th>Aksi</th>
            </tr>
            
            <?php
                while($item = mysqli_fetch_array($listpembayaran)) {
                    echo "<tr>";
                    echo "<td>".$item['id_bayar']."</td>";
                    echo "<td>".$item['tipe_wallet']."</td>";
                    echo "<td>".$item['jenis_wallet']."</td>";
                    echo "<td>".$item['harga']."</td>";
                    echo "<td>".$item['nama']."</td>";
                    echo "<td>".$item['rekening']."</td>";
                    echo "<td>".$item['tanggal']."</td>";
                    echo "<td><a href='editpembayaran.php?id=$item[id_bayar]'>Edit</a> 
                    | 
                    <a href='softdeletepembayaran.php?id=$item[id_bayar]'>Soft Delete</a></td></tr>";
                } 
            ?>
        </table><br>
        </div>
        
        <div style="text-align: center">
            <b><a href="viewSoftDelete.php">Recycle Bin</a>
        </b>
        </div>

        <p>
        <a href="logout.php" class="btn btn-danger ml-3">Sign Out</a>
        </p>
    </body>
</html>