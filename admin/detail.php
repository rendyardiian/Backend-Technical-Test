<h2>Detail Purchasing</h2>
<?php
$ambil = $koneksi->query("SELECT * FROM purchasing JOIN customer 
	ON purchasing.id_customer=customer.id_customer 
	WHERE purchasing.id_purchasing='$_GET[id]'");
$detail = $ambil->fetch_assoc();
?>
<pre><?php print_r($detail); ?></pre>

<strong><?php echo $detail['nama_customer']; ?></strong> <br>
<p>
	<?php echo $detail['telephone_customer']; ?> <br>
	<?php echo $detail['email_customer']; ?>
</p>

<p>
	Tanggal: <?php echo $detail['tanggal_purchasing']; ?> <br>
	Total: <?php echo $detail['total_purchasing']; ?>
</p>

<table class="table table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>Nama Produk</th>
			<th>Harga</th>
			<th>Jumlah</th>
			<th>Subtotal</th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor=1; ?>
		<?php $ambil=$koneksi->query("SELECT * FROM purchasing_product JOIN product ON purchasing_product.id_product=product.id_product WHERE purchasing_product.id_purchasing='$_GET[id]'"); ?>
		<?php while($pecah = $ambil->fetch_assoc()){ ?>
		<tr>
			<td><?php echo $nomor; ?></td>
			<td><?php echo $pecah['nama_product']; ?></td>
			<td><?php echo $pecah['harga_product']; ?></td>
			<td><?php echo $pecah['jumlah']; ?></td>
			<td>
				<?php echo $pecah['harga_product']*$pecah['jumlah']; ?>
			</td>
		</tr>
		<?php $nomor++; ?>
		<?php } ?>
	</tbody>
</table>