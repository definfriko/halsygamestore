<?php
    include_once("config.php");

//Inisialisasi sesi
    session_start();
    
    //Mengecek apakah user telah login, jika tidak akan kembali ke halaman login
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: loginadmin.php");
        exit;
    }

    $wallet = mysqli_query($link, "SELECT * FROM wallet WHERE is_delete=1 ORDER BY id_wallet");
    $pembeli = mysqli_query($link, "SELECT * FROM pembeli WHERE is_delete=1 ORDER BY id_pembeli");
    $pembayaran = mysqli_query($link, "SELECT pembayaran.id_bayar, wallet.jenis_wallet, wallet.tipe_wallet, wallet.harga, pembeli.nama, pembeli.rekening, pembayaran.tanggal FROM wallet INNER JOIN pembayaran ON wallet.id_wallet=pembayaran.id_bayar INNER JOIN pembeli ON pembeli.id_pembeli=pembayaran.id_pembeli WHERE pembayaran.is_delete = 1");
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
            background-color: rgb(255,255,255);
            opacity: 0,9;
            
            }
            h1 {
                color: rgb(0,0,0);
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
            .Tabel {
                width: 60%;
                margin-left: 355px;
                background-color: rgb(255, 255, 255);
                margin-bottom: 10px;
                margin-right: 20px;
                border-style: solid;
            }
        </style>
    </head>
    <body>
        <div style="text-align: center">
            <h1>Recycle Bin</h1>
        </div>
        
        <div class='Tabel'>
        <h3>Katalog Wallet</h3>
        <table width='80%' border=1>
            <tr>
                <th>ID Wallet</th> <th>Tipe Wallet</th> <th>Jenis Wallet</th> <th>Harga</th> <th>Aksi</th>   
            </tr>

            <?php
                while($item = mysqli_fetch_array($wallet)) {
                    echo "<tr>"; 
                    echo "<td>".$item['id_wallet']."</td>"; 
                    echo "<td>".$item['tipe_wallet']."</td>"; 
                    echo "<td>".$item['jenis_wallet']."</td>"; 
                    echo "<td>".$item['harga']."</td>"; 
                    echo "<td><a href='restorewallet.php?id=$item[id_wallet]'>Restore</a></td></tr>";
                }
            ?>
        </table><br>
        </div>

        <div class='Tabel'>
        <h3>Katalog Pembeli</h3>
        <table width='80%' border=1>
            <tr>
                <th>ID Pembeli</th> <th>Nama</th> <th>Rekening</th> <th>Aksi</th> 
            </tr>
        
            <?php
                while($item = mysqli_fetch_array($pembeli)) {
                    echo "<tr>"; 
                    echo "<td>".$item['id_pembeli']."</td>"; 
                    echo "<td>".$item['nama']."</td>"; 
                    echo "<td>".$item['rekening']."</td>"; 
                    echo "<td><a href='restorepembeli.php?id=$item[id_pembeli]'>Restore</a></td></tr>"; 
                }
            ?>
        </table><br>
        </div>
        
        <div class='Tabel'>
        <h3>Katalog Handphone</h3>
        <table width='80%' border=1>
            <tr>
                <th>ID Pembayaran</th> <th>Tipe Wallet</th> <th>Jenis Wallet</th> <th>Harga</th> <th>Nama</th> <th>Rekening</th> <th>Tanggal</th> <th>Aksi</th>
            </tr>
            
            <?php
                while($item = mysqli_fetch_array($pembayaran)) {
                    echo "<tr>";
                    echo "<td>".$item['id_bayar']."</td>";
                    echo "<td>".$item['tipe_wallet']."</td>";
                    echo "<td>".$item['jenis_wallet']."</td>";
                    echo "<td>".$item['harga']."</td>";
                    echo "<td>".$item['nama']."</td>";
                    echo "<td>".$item['rekening']."</td>";
                    echo "<td>".$item['tanggal']."</td>";
                    echo "<td><a href='restorepembayaran.php?id=$item[id_bayar]'>Restore</a>";
                } 
            ?>
        </table><br>
        </div>
        
        <div style="text-align: center">
            <b><a href="homeadmin.php">Home Admin</a></b>
        </div>
    </body>
</html>