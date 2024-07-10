<h2>Product Data</h2>

<table class="table table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>Nama</th>
			<th>Harga</th>
			<th>Berat</th>
			<th>Foto</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor=1; ?>
		<?php $ambil=$koneksi->query("SELECT * FROM product"); ?>
		<?php while($pecah = $ambil->fetch_assoc()){ ?>
		<tr>
			<td><?php echo $nomor; ?></td>
			<td><?php echo $pecah['nama_product']; ?></td>
			<td><?php echo $pecah['harga_product']; ?></td>
			<td><?php echo $pecah['berat_product']; ?></td>
			<td>
				<img src="../foto_produk/<?php echo $pecah['foto_product']; ?>" width="100">
			</td>
			<td>
				<a href="index.php?halaman=hapusproduk&id=<?php echo $pecah['id_product']; ?>" class="btn-danger btn">Hapus</a>
				<a href="index.php?halaman=ubahproduk&id=<?php echo $pecah['id_product']; ?>" class="btn btn-warning">Ubah</a>
			</td>
		</tr>
	<?php $nomor++; ?>
	<?php } ?>

	</tbody>
</table>
<a href="index.php?halaman=tambahproduk" class="btn btn-primary">Tambah Data</a>