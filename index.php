<?php require_once "students.php"; ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Öğrenci Bilgi Sistemi</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body style="margin-top:20px;">
	<div class="container">
		<form class="form-inline">
			<div class="form-group">
				<label for="inpStudentId">Öğrenci Numarası</label>
				<input type="text" class="form-control" name="student_id" id="inpStudentId" <? if(isset($_GET['student_id'])) echo 'value="'.$_GET['student_id'].'"';?>>
			</div>
			<button type="submit" class="btn btn-primary">Öğrenci Bilgilerini Getir</button>
		</form>
		<div class="col-md-6">
			<h1>Öğrenci Listesi</h1>
			<div class="list-group">
				<?php
				foreach($students as $student_id => $student):
					?>
				<a href="?student_id=<?=$student_id?>" class="list-group-item <?php if($student_id==$_GET['student_id']) echo "active"?>"><?=$student["name"]["first_name"]?> <?=$student["name"]["last_name"]?></a>
				<?php
				endforeach;
				?>
			</div>
		</div>
		<div class="col-md-6">
			<?php

/*

	Öğrencileri nbilgilerinin toplu halde bulunduğu, öğrenci numarası ile talepte bulunulduğu zaman öğrencinin detayının görüntülendiği bir mini sistem

*/

// öncelikle öğrenci bilgilerinin bulunduğu ve PHP tarafından okunabilecek bir kaynağa ihtiyacımız var

	

// sayfaya gelirken öğrenci numarası girilmiş mi diye bak


// numaranın girilebileceği formu göster

	if(isset($_GET['student_id'])):
	// girildiyse bu numaraya ait öğrenci kaydını göster
		// öğrenci detayının sunumuna ihtiyacımız var (ismi, bilgileri, notları vs...)
		if( ! isset($students[$_GET['student_id']])) die("Bu numaraya sahip bir öğrenci kaydı yok.");
	$ogrenci = $students[$_GET['student_id']];
	?>
	<h1>Öğrenci Bilgileri</h1>
	<h2><?=$ogrenci["name"]["first_name"]?> <?=$ogrenci["name"]["last_name"]?></h2>
	<table class="table table-striped">
		<tr>
			<th>Öğrenci No</th>
			<td><?=$ogrenci["student_id"]?></td>
		</tr>
		<tr>
			<th>Öğrenci Adı</th>
			<td><?=$ogrenci["name"]["first_name"]?> <?=$ogrenci["name"]["last_name"]?></td>
		</tr>
		<tr>
			<th>Doğum Yılı</th>
			<td><?=$ogrenci["birth_year"]?></td>
		</tr>
		<tr>
			<th>Giriş Yılı</th>
			<td><?=$ogrenci["registered_at"]?></td>
		</tr>
		<tr>
			<th>Mezun mu?</th>
			<td><?=$ogrenci["is_graduated"]?></td>
		</tr>
		<tr>
			<th>Çıkış Yılı</th>
			<td><?=$ogrenci["graduated_at"]?></td>
		</tr>
		<tr>
			<th>Dönem</th>
			<td><?=$ogrenci["term"]?></td>
		</tr>
		<tr>
			<th>Bölüm</th>
			<td><?=$ogrenci["department"]?></td>
		</tr>
		<tr>
			<th>Dersler</th>
			<td>
				<ul>
					<?php foreach ($ogrenci['lectures'] as $lecture): ?>
						<li><?=$lecture['name']?> - <?=$lecture['grade']?></li>
					<? endforeach; ?>
				</ul>
			</td>
		</tr>
	</table>
	<?php
	endif;
	?>
</div>
</div>
</body>
</html>