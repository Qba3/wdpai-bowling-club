<?php
$directory = $_SERVER['DOCUMENT_ROOT'] . '/public/image/gallery/';
$images = array_merge(
    glob($directory . "*.jpg"),
    glob($directory . "*.jpeg"),
    glob($directory . "*.png"),
    glob($directory . "*.gif")
);

$imagePaths = array();
foreach ($images as $image) {
    $imagePaths[] = str_replace($_SERVER['DOCUMENT_ROOT'], '', $image);
}

header('Content-Type: application/json');
echo json_encode($imagePaths);
?>