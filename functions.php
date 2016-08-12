<?php

function isGraduatedToText ($isGraduatedData) {
	if($isGraduatedData===true) return "Mezun";
	if($isGraduatedData===false) return "Mezun Değil";
	return throwWrongDataError();
}

function graduatedAtToText($graduationYear){
	if(is_null($graduationYear)) return "Çıkış Yapmamış";
	if(gettype($graduationYear)==="integer") return (string)$graduationYear;
	return throwWrongDataError();
}

function throwWrongDataError(){
	return "<em>!!! Yanlış Formatta Veri Girilmiş !!!</em>";
}