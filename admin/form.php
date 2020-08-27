<?php
require_once('connect.php');
include('functions.php');

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
//изображение
$avatarUploadFolder = 'uploads\users\avatar';
$avatarName = $_FILES['avatar']['name'];
$avatarTmp = $_FILES['avatar']['tmp_name'];
$avatarFolder = get_folder_path($avatarName, $avatarUploadFolder);
move_uploaded_file($avatarTmp, $avatarFolder);
//фильтры
$colorFilter = htmlspecialchars($_POST ['color'], ENT_QUOTES, 'UTF-8');
$charactersFilter = htmlspecialchars($_POST ['characters'], ENT_QUOTES, 'UTF-8');
$perseverance = (isset($_POST['perseverance'])) ? 1 : 0;
$neatness = (isset($_POST['neatness'])) ? 1 : 0;
$selfLearning = (isset($_POST['self-learning'])) ? 1 : 0;
$hardWork = (isset($_POST['hard-work'])) ? 1 : 0;
$photosFilter = $_FILES['photos'];
photos_check($photosFilter);

//итог
$sex = $sexFilter;
$lastName = $lastNameFilter;
$name = $nameFilter;
$thirdName = $thirdNameFilter;
$birthDate = $birthDateFilter;
$avatar = get_image_path ($avatarName, $avatarUploadFolder);;
$color = $colorFilter;
$characters = $charactersFilter;
$photos = $photosFilter;

$query = "INSERT INTO allresult (sex, lastName, username, thirdName, birthDate, avatar, color, perseverance,
 neatness, selflearning, hardworking, photos, characters) VALUES ('$sex', '$lastName', '$name', '$thirdName', '$birthDate',
 '$avatar', '$color', '$perseverance', '$neatness', '$selfLearning', '$hardWork', '$photos', '$characters');";
$conn->query($query);
if ($conn) require('done.html');