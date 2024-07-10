<?php

$ambil = $koneksi->query("SELECT * FROM product WHERE id_product = '$_GET[id]'");
$pecah = $ambil->fetch_assoc();
$fotoproduk = $pecah['foto_product'];
if (file_exists('../foto_produk/$foto_product')) 
{
	unlink("../foto_produk/$fotoproduk");
}


$koneksi->query("DELETE FROM product WHERE id_product='$_GET[id]'");

echo "<script>alert('produk terhapus');</script>";
echo "<script>location='index.php?halaman=product';</script>";

?>