<?php
/**
*
* @package phpBB Extension - Image convert
* @copyright (c) 2019 Vlad
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/
namespace vlad\image_convert\core;

class pngconvert
{
	public function pngconvert($destination_file, $filedata)
    {
        if (function_exists('exif_imagetype') && ($filedata['extension'] == 'jpg')) {
            $image = imagecreatefromjpeg($destination_file);
            unlink($destination_file);
            imagewebp($image, $destination_file, 100);
            imagedestroy($image);
            $namefile = substr($filedata['real_filename'], 0, -3);
            $filedata['real_filename'] = $namefile . 'webp';
            $filedata['extension'] = 'webp';
            $filedata['mimetype'] = 'image/webp';
            return $filedata;
        }
        if (function_exists('exif_imagetype') && ($filedata['extension'] == 'png')) {
            $image = imagecreatefrompng($destination_file);
            @imagepalettetotruecolor($image);
            @imagealphablending($image, true);
            @imagesavealpha($image, true);
            unlink($destination_file);
            imagewebp($image, $destination_file, 100);
            imagedestroy($image);
            $namefile = substr($filedata['real_filename'], 0, -3);
            $filedata['real_filename'] = $namefile . 'webp';
            $filedata['extension'] = 'webp';
            $filedata['mimetype'] = 'image/webp';
            return $filedata;
        }
        return $filedata;
    }
}
