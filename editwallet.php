<?php 
    // include database connection file 
    include_once("config.php"); 
    
    // Check if form is submitted for data update, then redirect to homepage after update 
    if(isset($_POST['update'])) { 
        $id = $_POST['id'];
        $tipe_wallet = $_POST['tipe_wallet'];
        $jenis_wallet = $_POST['jenis_wallet']; 
        $harga=$_POST['harga']; 
        
        // update data 
        $result = mysqli_query($link, "UPDATE wallet SET tipe_wallet='$tipe_wallet',jenis_wallet='$jenis_wallet' ,harga='$harga' WHERE id_wallet=$id"); 
        
        // Redirect to homepage to display updated data in list 
        header("Location: homeadmin.php"); }
?>

<?php
    // Display selected minuman based on id 
    // Getting id from url 
    $id = $_GET['id']; 
    
    // Fetch data based on id 
    $result = mysqli_query($link, "SELECT * FROM wallet WHERE id_wallet=$id");

    while($wallet = mysqli_fetch_array($result)) { 
        $id = $wallet['id_wallet']; 
        $tipe_wallet = $wallet['tipe_wallet']; 
        $jenis_wallet = $wallet['jenis_wallet']; 
        $harga = $wallet['harga'];

    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Edit Wallet</title>
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
    <body><a href="homeadmin.php">Home Admin</a> 
    <br/><br/> 
    
    <div class="Tabel">
    <h2>Edit Wallet</h2> 
        <form name="update_wallet" method="post" action="editwallet.php">
            <table border="0"> 
                <tr>
                    <td>Tipe Wallet</td> 
                    <td><input type="text" name="tipe_wallet" value=<?php echo $tipe_wallet;?>></td>
                </tr> 
                <tr>
                    <td>Jenis Wallet</td> 
                    <td><input type="text" name="jenis_wallet" value=<?php echo $jenis_wallet;?>></td>
                </tr> 
                <tr>
                    <td>Harga</td> 
                    <td><input type="text" name="harga" value=<?php echo $harga;?>></td> 
                </tr> 
                <tr> 
                    <td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td> 
                    <td><input type="submit" name="update" value="Update"></td> 
                </tr> 
            </table> 
        </form>
        </div>
    </body>
</html>