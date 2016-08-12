<?php
/*

Öğrencilerin bilgilerinin toplu halde bulunduğu, öğrenci numarası ile talepte bulunulduğu zaman öğrencinin detayının görüntülendiği bir mini sistem

*/

// öncelikle öğrenci bilgilerinin bulunduğu ve PHP tarafından okunabilecek bir kaynağa ihtiyacımız var
// bu kaynağı students.php içinde bir dizi olarak oluşturduk, işlem yapacağımız sayfaya çekiyoruz

require_once "students.php"; 

// öğrenci numarasının girilebileceği formu göster
// eğer sayfaya bir öğrenci numarası ile talep geldiyse, bu numarayı formun içinde göster

// öğrenciler dizisini döngüye sokarak öğrencileri listele
// öğrenci listesindeki elemanlara tıklayarak sayfaya bunun detayını istediğine dair talep gönder
// listeye basılan öğrencinin numarası ile sayfaya talep olarak gelen öğrenci numarası birbirine eşitse, listenin bu elemanını "aktif" olarak seç, rengi kendini belli etsin

// Formumuz GET ile çalıştığından, talepler adres çubuğunun sonuna ?student_id={TALEP_EDILEN_OGRENCININ_NUMARASI} şeklinde iletildiğinden, linkleri de böyle verebiliyoruz
// Listedeki her öğrencinin numarası, yine liste içinde bulunuyor

// sayfaya gelirken öğrenci numarası girilmiş mi diye bak
// girildiyse, girilen bu numara öğrenci listesinde var mı diye bak
// bu numara öğrenci listesinde yoksa, böyle bir öğrenci yok diyerek çalışmayı durdur
// detayı bulunan öğrencinin bilgilerini ekrana bas

// kimi işlemler için yardımcı fonksiyonlar kullanabiliriz, bunları "functions.php" isimli başka bir dosyada tanımlıyoruz, bu dosyada da kullanmak için içeri çağırıyoruz
require_once "functions.php";
?>
<!DOCTYPE html>
<html lang="tr">
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
				<input type="text" class="form-control" name="student_id" id="inpStudentId" value="<? if(isset($_GET['student_id'])) echo $_GET["student_id"] ?>">
			</div>
			<button type="submit" class="btn btn-primary">Öğrenci Bilgilerini Getir</button>
		</form>
		<div class="col-md-6">
			<h1>Öğrenci Listesi</h1>
			<div class="list-group">
				<?php foreach($students as $student): 
					if( in_array($student['student_id'], $bannedStudentIds) ) continue;
				?>
					<a href="?student_id=<?=$student["student_id"]?>" class="list-group-item <? if($student["student_id"]==$_GET["student_id"]) echo "active" ?>">
						<?=$student["name"]["first_name"]?> <?=$student["name"]["last_name"]?>
					</a>
				<?php endforeach; ?>
			</div>
		</div>
		<div class="col-md-6">
			<?php
			if(isset($_GET['student_id'])):

				// eğer bu numara tanımlandıysa, ama bu numaraya sahip bir öğrenci, yani bu numarayı index olarak kullanan bir dizi elemanı yoksa hata ver
				if( ! isset( $students[ $_GET['student_id'] ] ) ): ?>
			<div class="alert alert-danger" role="alert"><strong><?=$_GET['student_id']?></strong> numarasına sahip bir öğrenci yok.</div>
		<?php else:
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
				<td><?=isGraduatedToText($ogrenci['is_graduated'])?></td>
			</tr>
			<tr>
				<th>Çıkış Yılı</th>
				<td><?=graduatedAtToText($ogrenci["graduated_at"])?></td>
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
	<?php endif; endif; ?>
</div>
</div>
</body>
</html>