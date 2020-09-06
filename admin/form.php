<?php
require_once('connect.php');
require_once('functions.php');

if ((($_POST['sex']) == "") || (($_POST['lastName']) == "") || (($_POST['birthDate']) == "")) {
    die (require 'error.php');
}
if (($_FILES['avatar']['size']) > 100000) {
    die(require 'error.php');
}
//строки
$sexFilter = htmlspecialchars($_POST['sex'], ENT_QUOTES, 'UTF-8');
$lastNameFilter = htmlspecialchars($_POST['lastName'], ENT_QUOTES, 'UTF-8');
$nameFilter = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
$thirdNameFilter = htmlspecialchars($_POST['thirdName'], ENT_QUOTES, 'UTF-8');
$birthDateFilter = htmlspecialchars($_POST['birthDate'], ENT_QUOTES, 'UTF-8');
$colorFilter = htmlspecialchars($_POST ['color'], ENT_QUOTES, 'UTF-8');
$charactersFilter = htmlspecialchars($_POST ['characters'], ENT_QUOTES, 'UTF-8');
//аватар
$avatarUploadFolder = 'uploads\users\avatar';
$pathAvatar = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . $avatarUploadFolder . DIRECTORY_SEPARATOR;
$inputAvatarName = 'avatar';
//фильтры
$perseverance = (isset($_POST['perseverance'])) ? 1 : 0;
$neatness = (isset($_POST['neatness'])) ? 1 : 0;
$selfLearning = (isset($_POST['self-learning'])) ? 1 : 0;
$hardWork = (isset($_POST['hard-work'])) ? 1 : 0;
$photosFilter = $_FILES['photos'];
//фотки
$photosUploadFolder = 'uploads\users\photos';
$pathPhotos = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . $photosUploadFolder . DIRECTORY_SEPARATOR;
$inputPhotoName = 'photos';
//итог
$sex = $sexFilter;
$lastName = $lastNameFilter;
$name = $nameFilter;
$thirdName = $thirdNameFilter;
$birthDate = $birthDateFilter;
$color = $colorFilter;
$characters = $charactersFilter;
$avatar = implode(massPhotoLoader($inputAvatarName, $pathAvatar, $avatarUploadFolder));
$photos = massPhotoLoader($inputPhotoName, $pathPhotos, $photosUploadFolder);
//уеба блок проверяющий массив фото и собирающий его в бд
$onePhoto = $photos['0'];
$one = (!empty($photos['0'])) ? $onePhoto : "";
$twoPhoto = $photos['1'];
$two = (!empty($photos['1'])) ? $twoPhoto : "";
$threePhoto = $photos['2'];
$three = (!empty($photos['2'])) ? $threePhoto : "";
$fourPhoto = $photos['3'];
$four = (!empty($photos['3'])) ? $fourPhoto : "";
$fivePhoto = $photos['4'];
$five = (!empty($photos['4'])) ? $fivePhoto : "";

$query .= "INSERT INTO allresult (sex, lastName, username, thirdName, birthDate, avatar, color, perseverance,
 neatness, selflearning, hardworking, characters, photos1, photos2, photos3, photos4, photos5) VALUES ('$sex', '$lastName', '$name', '$thirdName', '$birthDate',
 '$avatar', '$color', '$perseverance', '$neatness', '$selfLearning', '$hardWork', '$characters', '$one', '$two', '$three', '$four', '$five');";
$conn->query($query);
if ($conn) require('done.html');