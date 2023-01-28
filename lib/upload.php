<?php

function resize_image($image_path, $max_width, $max_height, $new_image_path) {
    $image = imagecreatefromjpeg($image_path);
    $width = imagesx($image);
    $height = imagesy($image);

    if ($width > $max_width || $height > $max_height) {
        // calculate new dimensions
        $new_width = ($width > $max_width) ? $max_width : $width;
        $new_height = ($height > $max_height) ? $max_height : $height;

        // create new image
        $new_image = imagecreatetruecolor($new_width, $new_height);

        // copy and resize old image into new image
        imagecopyresampled($new_image, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

        // save new image
        imagepng($new_image, $new_image_path, 90);
    }
}