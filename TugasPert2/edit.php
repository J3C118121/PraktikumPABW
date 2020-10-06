<?php include('koneksi.php'); ?>
<!DOCTYPE html>
<html>

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

	<title>Data Mahasiswa</title>
</head>

<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<div class="container">
			<a class="navbar-brand" href="index.php">Salsabila Meirizky</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item">
						<a class="nav-link" href="index.php">Beranda</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="tambah.php">Tambah Data</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<div class="container" style="margin-top:20px">
		<h2>Edit Mahasiswa</h2>

		<hr>

		<?php
		//jika sudah mendapatkan parameter GET id dari URL
		if (isset($_GET['id'])) {
			//membuat variabel $id untuk menyimpan id dari GET id di URL
			$id = $_GET['id'];

			//query ke database SELECT tabel mahasiswa berdasarkan id = $id
			$select = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE id='$id'") or die(mysqli_error($koneksi));

			//jika hasil query = 0 maka muncul pesan error
			if (mysqli_num_rows($select) == 0) {
				echo '<div class="alert alert-warning">ID tidak ada dalam database.</div>';
				exit();
				//jika hasil query > 0
			} else {
				//membuat variabel $data dan menyimpan data row dari query
				$data = mysqli_fetch_assoc($select);
			}
		}
		?>

		<?php
		//jika tombol simpan di tekan/klik
		if (isset($_POST['submit'])) {
			$nama			= $_POST['nama'];
			$jenis_kelamin	= $_POST['jenis_kelamin'];
			$agama			= $_POST['agama'];
			$hobby		= implode(",",$_POST['hobby']);

			$sql = mysqli_query($koneksi, "UPDATE mahasiswa SET nama='$nama', jenis_kelamin='$jenis_kelamin', agama='$agama', hobby='$hobby' WHERE id='$id'") or die(mysqli_error($koneksi));

			if ($sql) {
				echo '<script>alert("Berhasil Menyimpan Data."); document.location="edit.php?id=' . $id . '";</script>';
			} else {
				echo '<div class="alert alert-warning">Gagal Melakukan Proses Edit Data.</div>';
			}
		}
		?>

		<form action="edit.php?id=<?php echo $id; ?>" method="post">
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">NIM</label>
				<div class="col-sm-10">
					<input type="text" name="nim" class="form-control" size="4" value="<?php echo $data['nim']; ?>" readonly required>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Nama Mahasiswa</label>
				<div class="col-sm-10">
					<input type="text" name="nama" class="form-control" value="<?php echo $data['nama']; ?>" required>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Jenis Kelamin</label>
				<div class="col-sm-10">
					<div class="form-check">
						<input type="radio" class="form-check-input" name="jenis_kelamin" value="Laki-laki" <?php if ($data['jenis_kelamin'] == 'Laki-laki') {
																												echo 'checked';
																											} ?> required>
						<label class="form-check-label">Laki-laki</label>
					</div>
					<div class="form-check">
						<input type="radio" class="form-check-input" name="jenis_kelamin" value="Perempuan" <?php if ($data['jenis_kelamin'] == 'Perempuan') {
																												echo 'checked';
																											} ?> required>
						<label class="form-check-label">Perempuan</label>
					</div>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Agama</label>
				<div class="col-sm-10">
					<select class="form-control" name="agama" value="<?php echo $data['agama']; ?>" required>
						<option value="Islam">Islam</option>
						<option value="Katolik">Katolik</option>
                        <option value="Kristen">Kristen</option>
                        <option value="Hindu">Hindu</option>
                        <option value="Buddha">Buddha</option>
                    </select>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Hobby</label>
				<div class="col-sm-10">
					<div class="form-check">
						<input class="form-check-input" type="checkbox" name="hobby[]" value="Badminton" <?php if ($data['hobby'] == 'Badminton') {
																												echo 'checked';
																											} ?>>
						<label class="form-check-label">
							Badminton
						</label>
					</div>
					<div class="form-check">
						<input class="form-check-input" type="checkbox" name="hobby[]" value="Futsal" <?php if ($data['hobby'] == 'Futsal') {
																											echo 'checked';
																										} ?>>
						<label class="form-check-label">
							Futsal
						</label>
					</div>
					<div class="form-check">
						<input class="form-check-input" type="checkbox" name="hobby[]" value="Sepeda" <?php if ($data['hobby'] == 'Sepeda') {
																											echo 'checked';
																										} ?>>
						<label class="form-check-label">
							Sepeda
						</label>
					</div>
					<div class="form-check">
						<input class="form-check-input" type="checkbox" name="hobby[]" value="Basket" <?php if ($data['hobby'] == 'Basket') {
																											echo 'checked';
																										} ?>>
						<label class="form-check-label">
							Basket
						</label>
					</div>
					<div class="form-check">
						<input class="form-check-input" type="checkbox" name="hobby[]" value="Lari" <?php if ($data['hobby'] == 'Lari') {
																											echo 'checked';
																										} ?>>
						<label class="form-check-label">
							Lari
						</label>
					</div>
					<div class="form-check">
						<input class="form-check-input" type="checkbox" name="hobby[]" value="Berenang" <?php if ($data['hobby'] == 'Berenang') {
																											echo 'checked';
																										} ?>>
						<label class="form-check-label">
							Berenang
						</label>
					</div>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Foto</label>
				<div class="col-sm-10">
					<img src="<?php echo "file/" . $data['nama_file']; ?>" width="70px" disabled>
					<label class="form-check-label" disabled>Foto Tidak Dapat di Update</label>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">&nbsp;</label>
				<div class="col-sm-10">
					<input type="submit" name="submit" class="btn btn-primary" value="Simpan Data">
					<a href="index.php" class="btn btn-warning">Kembali</a>
				</div>
			</div>
		</form>

	</div>

	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

</body>

</html>