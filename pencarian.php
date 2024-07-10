<?php $koneksi = new mysqli("localhost","root","","tokoonline"); ?>
<?php 
$keyword = $_GET["keyword"];

$semuadata=array();
$ambil = $koneksi->query("SELECT * FROM product WHERE nama_product LIKE '%$keyword%' 
	OR  deskripsi_product LIKE '%$keyword%'");
while($pecah = $ambil->fetch_assoc())
{
	$semuadata[]=$pecah;
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Pencarian</title>
	<link rel="stylesheet" type="text/css" href="admin/assets/css/bootstrap.css">
</head>
<body>
<?php include 'menu.php'; ?>
	<div class="container">
		<h3>Hasil Pencarian : <?php echo $keyword ?></h3>

		<?php if (empty($semuadata)): ?>
			<div class="alert alert-danger"><?php echo $keyword ?> Pencarian Tidak Ditemukan</div>
		<?php endif ?>

		<div class="row">
			
			<?php foreach ($semuadata as $key => $value): ?>

			<!-- <div class="container">
			<div class="row">
			<div class="col-md-4">
				<img src="foto_produk/<?php echo $detail["foto_product"]; ?>" class="img-responsive">
			</div>
			<div class="col-md-4">
				<h2><?php echo $detail["nama_product"] ?></h2>
				<h4>Rp.<?php echo number_format($detail["harga_product"]); ?>,000</h4>
				<h4><?php echo $detail["nama_product"] ?></h4>
				<p><?php echo $detail ["deskripsi_product"]; ?></p>
			</div> -->

			<!-- <div class="col-md-3">
				<div class="thumbnail">
					<img src="foto_produk/<?php echo $value["foto_product"] ?>" width="150" alt="" class="img-responsive">
				<div class="caption">
					<h3><?php echo $value["nama_product"] ?></h3>
					<h5>Rp. <?php echo $value['harga_product'] ?>,000</h5>
					<a href="lihat.php?id=<?php echo $value["id_product"]; ?>" class="btn btn-primary">Detail</a>
				</div>
				</div>
			</div> -->
			
			<div class="col-md-3">
				<div class="thumbnail">
					<img src="foto_produk/<?php echo $value['foto_product']; ?>" width="160" alt="">
					<div class="caption">
						<h4><?php echo $value['nama_product']; ?></h4>
						<h5><?php echo number_format($value['harga_product']); ?></h5>
						<a href="beli.php?id=<?php echo $value['id_product']; ?>" class="btn btn-primary">Beli</a>
						<a href="lihat.php?id=<?php echo $value['id_product']; ?>" class="btn btn-primary">Detail</a>
					</div>
				</div>
			</div>

		</div>
	</div>
		<?php endforeach ?>
		</div>
	</div>

</body>
</html>