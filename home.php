<?php
    include_once("config.php");

    //Inisialisasi sesi
    session_start();
    
    //Mengecek apakah user telah login, jika tidak akan kembali ke halaman login
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: login.php");
        exit;
    }

    if(isset($_GET['search'])){
        $search = $_GET['search'];
        $listwallet = mysqli_query($link, "SELECT jenis_wallet, tipe_wallet, harga FROM wallet WHERE is_delete=0 AND jenis_wallet LIKE '%".$search."%' OR tipe_wallet LIKE '%" . $search . "%' ");
    } else {
        $listwallet = mysqli_query($link, "SELECT jenis_wallet, tipe_wallet, harga FROM wallet WHERE is_delete=0");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ 
            font: 14px sans-serif; 
            text-align: center; 
            background-image: url("https://wallpaperaccess.com/full/4892311.jpg");
        }
        h1 {
            margin-left: 10px;
            margin-right: 10px;
            color: rgb(255, 255, 255);
            font-weight: bold;
        }
        h3 {
            text-align: center;
            color: rgb(0, 0, 0);
            font-weight: bold;
            
        }
        table {
            margin-left: auto;
            margin-right: auto;
            border-color: rgb(74, 71, 53);
        }
        th {
            padding: 10px 10px 10px 10px;
            text-align: center;
            font-weight: bold;
            font-size: 17px;
            background-color: rgb(0, 0, 0);
            color: rgb(255, 255, 255);
        }
        tr  {
            text-align: center;
            color: rgb(0, 0, 0);
        }
        td {
            padding: 10px 10px 10px 10px;
            color: rgb(0, 0, 0);
        }
        p {
            text-align: center;
        }
        .Tabel {
            width: 65%;
            padding: 10px 10px 10px 10px;
            margin-top: 10px;
            margin-bottom: 10px;
            margin-left: auto;
            margin-right: auto;
            border-style: double;
            border-width: 5px;
            background-color: rgb(255, 255, 255);
            border-color: rgb(0,0,0);
        }
        .TabelSearch {
            width: 15%;
            padding: 5px 5px 5px 5px;
            margin-top: 10px;
            margin-bottom: 20px;
            margin-left: auto;
            margin-right: auto;
            border-style: double;
            border-width: 5px;
            background-color: rgb(255, 255, 255);
            border-color: rgb(0, 0, 0);
        }
        .buttonSearch {
            background-color: rgb(9, 176, 56);
            color: rgb(255, 250, 255);
            border-color: rgb(0, 0, 0);
            border-radius: 1px;
        }
        .searchLabel {
            font-weight: bold;

        }
    </style>
</head>
<body>
    <h1 class="my-5">Hello, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>! Selamat Datang di Halsy Wallet</h1>
    
    <div class="TabelSearch">
    <form action="home.php" method="GET" name="form1"> 
        <table width="25%" border="0"> 
            <tr>
                <td class="searchLabel">Cari Wallet:</td>
                <td><input type="text" name="search"></td> 
            </tr>
            <td/><td><input class="buttonSearch" type="submit" value="Search" /></td>
        </table> 
    </form>
    </div>

    <div class="Tabel">
    <h3>Katalog Wallet</h3>
    <h4>Untuk Pembelian Wallet bisa mengakses link berikut: https://bit.ly/PembelianHalsyWallet</h4>
        <table width='90%' border=2>
            <tr class="Search">
                <th>Jenis Wallet</th> <th>Tipe Wallet</th> <th>Harga</th>
            </tr>
            
            <?php
                while($item = mysqli_fetch_array($listwallet)) {
                    echo "<tr>";
                    echo "<td>".$item['jenis_wallet']."</td>";
                    echo "<td>".$item['tipe_wallet']."</td>";
                    echo "<td>".$item['harga']."</td>";
                } 
            ?>
        </table><br>
    </div>
    
    <p>
        <a href="logout.php" class="btn btn-danger ml-3">Sign Out</a>
    </p>
</body>
</html>

<?php
    
?>