<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Halaman tambah</title>
</head>
<body>
	@if (count($errors) > 0)
		<ul>
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	@endif
	<form action="/store/tambah" method="post" enctype="multipart/form-data">
		<input type="text" name="nama" placeholder="nama motor"><br>
		<input type="text" name="brand" placeholder="nama brand"><br>
		<input type="text" name="tahun" placeholder="nama tahun"><br>
		<input type="text" name="jenis" placeholder="nama jenis"><br>
		<input type="text" name="asal" placeholder="nama asal"><br>
		<input type="file" name="gambar" id="gambar">
		<button type="submit">OK</button>
		<input type="hidden" name="_method" name="store">
	@csrf
	</form>
</body>
</html>