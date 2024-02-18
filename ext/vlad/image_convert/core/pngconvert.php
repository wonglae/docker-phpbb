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
        if (function_exists('exif_imagetype') && ($filedata['extension'] == 'png'))
        {
		    $source = imagecreatefrompng($destination_file);
            $image = imagecreatetruecolor(imagesx($source), imagesy($source));
            $white = imagecolorallocate($image, 255, 255, 255);
            imagefill($image, 0, 0, $white);
            imagecopy($image, $source, 0, 0, 0, 0, imagesx($image), imagesy($image));
            unlink($destination_file);
            imagejpeg($image, $destination_file, 100);
            imagedestroy($image);
            imagedestroy($source);
            $namefile = substr($filedata['real_filename'], 0, -3);
            $filedata['real_filename'] = $namefile.'jpg';
            $filedata['extension'] = 'jpg';
            $filedata['mimetype'] = 'image/jpeg';
            return $filedata;
	    }
        return $filedata;
    }
}
