<?php

namespace MK;

/**
 * Description of Validator
 *
 * @author Mariusz Kowalczyk
 */
class Image {
    
    public static function resize($file, $ext, $max_width, $max_height) {
        $size = getimagesize($file);
        $width = $size['0'];
        $height = $size['1'];
        
        if($width / $max_width < $height / $max_height) {
            $scale = $width / $max_width;
        }else {
            $scale = $height / $max_height;
        }
        $new_width = $width / $scale;
        $new_height = $height / $scale;

        switch ($ext) {
            case "gif":
                $img = imagecreatefromgif($file);
                break;
            case "jpeg":
            case "jpg":
                $img = imagecreatefromjpeg($file);
                break;
            case "png":
                $img = imagecreatefrompng($file);
                break;
        }
        imagesavealpha($img, true); //saving transparency
        $img_base = imagecreatetruecolor($new_width, $new_height);
        imagealphablending($img_base, false);
        imagesavealpha($img_base,true);
        $transparent = imagecolorallocatealpha($img_base, 255, 255, 255, 127);
        imagefilledrectangle($img_base, 0, 0, $new_width, $new_height, $transparent);
        imagecopyresized($img_base, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

        switch ($ext) {
            case "gif":
                imagegif($img_base, $file);
                break;
            case "jpeg":
            case "jpg":
                imagejpeg($img_base, $file);
                break;
            case "png":
                imagepng($img_base, $file);
                break;
        }
    }

}