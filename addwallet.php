<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Add Wallet</title>
        <style>
            table {
            margin-left: auto;
            margin-right: auto;
            }
            h2 {
                text-align: center;
            }
            table {
                margin-left: auto;
                margin-right: auto;
            }
            th {
                padding: 10px 10px 10px 10px;
                text-align: center;
            }
            tr  {
                text-align: center;
                padding: 10px 10px 10px 10px;
            }
            td  {
                text-align: center;
                padding: 7px 10px 7px 10px;
            }
            .Tabel {
                margin-bottom: 10px;
                margin-left: 20px;
                margin-right: 20px;
                border-style: solid;
            }
        </style>
    </head>
    <body>
        <a href="homeadmin.php">Home Admin</a> 
        <br/><br/>

        <div class="Tabel">
        <h2>Tambah Wallet</h2>
        <form action="addwallet.php" method="post" name="form1"> 
            <table width="25%" border="0"> 
                <tr>
                    <td>Jenis Wallet</td>
                    <td><input type="text" name="tipe_wallet"></td> 
                </tr> 

                <tr>
                    <td>Tipe Wallet</td> 
                    <td><input type="text" name="jenis_wallet"></td> 
                </tr>

                <tr>
                    <td>Harga</td> 
                    <td><input type="text" name="harga"></td> 
                </tr>
                <tr>
                    <td></td> 
                    <td><input type="submit" name="Submit" value="Add"></td> 
                </tr> 
            </table> 
        </form>
        </div>

        <?php
            // Check If form submitted, insert form data into users table.
            if(isset($_POST['Submit'])) { 
                $tipe_wallet = $_POST['tipe_wallet']; 
                $jenis_wallet = $_POST['jenis_wallet']; 
                $harga = $_POST['harga'];


                // include database connection file 
                include_once("config.php");

                // Insert user data into table 
                $result = mysqli_query($link, "INSERT INTO wallet(tipe_wallet, jenis_wallet , harga) VALUES ('$tipe_wallet', '$jenis_wallet', '$harga')");
                // Show message when user added 
                echo "Berhasil menambahkan $jenis_wallet ke Katalog Barang! <br><a href='homeadmin.php'>Kembali ke Home Admin</a>"; 
            }
        ?>
    </body>
</html>