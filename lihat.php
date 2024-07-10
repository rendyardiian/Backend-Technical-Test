<?php
session_start();
$koneksi = new mysqli("localhost","root","","tokoonline");


// jk tdk ada session pelanggan (blm login), mk dilarikan ke login.php
// if (!isset($_SESSION["customer"])) 
// {
// 	echo "<script>alert('silahkan login');</script>";
// 	echo "<script>location='login.php';</script>";	
// }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Lihat Produk</title>
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>

<!-- navbar -->
<?php include 'menu.php'; ?>
<?php 

$id_product = $_GET["id"];
$ambil = $koneksi->query("SELECT * FROM product where id_product='$id_product'");
$detail = $ambil->fetch_assoc();
?>

<section class="kontent">
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<img src="foto_produk/<?php echo $detail["foto_product"]; ?>" class="img-responsive">
			</div>
			<div class="col-md-4">
				<h2><?php echo $detail["nama_product"] ?></h2>
				<h4>Rp.<?php echo number_format($detail["harga_product"]); ?>,000</h4>
				<h4><?php echo $detail["nama_product"] ?></h4>
				<p><?php echo $detail ["deskripsi_product"]; ?></p>
			</div>
		</div>
	</div>
</section>

</body>
</html>