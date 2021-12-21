<?php 
    // include database connection file 
    include_once("config.php"); 
    
    // Check if form is submitted for data update, then redirect to homepage after update 
    if(isset($_POST['update'])) { 
        $id = $_POST['id'];
        $id_wallet = $_POST['id_wallet']; 
        $id_pembeli =$_POST['id_pembeli']; 
        $tanggal =$_POST['tanggal']; 
        
        // update data 
        $result = mysqli_query($link, "UPDATE pembayaran SET id_wallet='$id_wallet', id_pembeli='$id_pembeli', tanggal='$tanggal' WHERE id_bayar=$id"); 
        
        // Redirect to homepage to display updated data in list 
        header("Location: homeadmin.php"); }
?>

<?php
    // Display selected minuman based on id 
    // Getting id from url 
    $id = $_GET['id']; 
    
    // Fetch data based on id 
    $result = mysqli_query($link, "SELECT * FROM pembayaran WHERE id_bayar=$id");

    while($pembayaran = mysqli_fetch_array($result)) { 
        $id = $pembayaran['id_bayar']; 
        $id_wallet = $pembayaran['id_wallet']; 
        $id_pembeli = $pembayaran['id_pembeli'];
        $tanggal = $pembayaran['tanggal'];


    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Edit Barang</title>
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
    <h2>Edit Pembeli</h2> 
        <form name="update_pembayaran" method="post" action="editpembayaran.php">
            <table border="0"> 
                <tr>
                    <td>ID Barang</td> 
                    <td><input type="text" name="id_wallet" value=<?php echo $id_wallet;?>></td>
                </tr> 
                
                <tr>
                    <td>ID Pembeli</td> 
                    <td><input type="text" name="id_pembeli" value=<?php echo $id_pembeli;?>></td> 
                </tr> 

                <tr>
                    <td>Tanggal</td> 
                    <td><input type="text" name="tanggal" value=<?php echo $tanggal;?>></td> 
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