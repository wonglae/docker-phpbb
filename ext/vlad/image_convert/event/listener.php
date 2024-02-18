<?php
/**
*
* @package phpBB Extension - Image convert
* @copyright (c) 2017 Vlad
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/
namespace vlad\image_convert\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
* Event listener
*/
class listener implements EventSubscriberInterface
{
/**
* Assign functions defined in this class to event listeners in the core
*
* @return array
* @static
* @access public
*/
	static public function getSubscribedEvents()
	{
		return array(
			'core.modify_uploaded_file'			=> array ('upload_image_convert', 1),
		);
	}

	/** @var \phpbb\config\config */
	protected $config;

	//** @var string phpbb_root_path */
	protected $phpbb_root_path;

	/**
	* Constructor
	*/
	public function __construct(
		$phpbb_root_path,
		\phpbb\config\config $config
                )
	{
		$this->phpbb_root_path = $phpbb_root_path;
		$this->config = $config;
	}

	public function upload_image_convert($event)
	{
		$is_image = $event['is_image'];
		$filedata = $event['filedata'];
		$destination_file = $this->phpbb_root_path . $this->config['upload_path'] . '/' . $filedata['physical_filename'];
		if ($is_image)
		{
			// Modify to webp by Siava (begin)
			if (function_exists('exif_imagetype') && ($filedata['extension'] == 'jpg'))
			{
				$image = imagecreatefromjpeg($destination_file);
				unlink($destination_file);
				imagewebp($image, $destination_file, 100);
				imagedestroy($image);
				$namefile = substr($filedata['real_filename'], 0, -3);
				$filedata['real_filename'] = $namefile.'webp';
				$filedata['extension'] = 'webp';
				$filedata['mimetype'] = 'image/webp';
				$event['filedata'] = $filedata;
			}
			if (function_exists('exif_imagetype') && ($filedata['extension'] == 'png'))
			{
				$image = imagecreatefrompng($destination_file);
				@imagepalettetotruecolor($image);
				@imagealphablending($image, true);
				@imagesavealpha($image, true);
				unlink($destination_file);
				imagewebp($image, $destination_file, 100);
				imagedestroy($image);
				$namefile = substr($filedata['real_filename'], 0, -3);
				$filedata['real_filename'] = $namefile.'webp';
				$filedata['extension'] = 'webp';
				$filedata['mimetype'] = 'image/webp';
				$event['filedata'] = $filedata;
			}
/*			
			if (function_exists('exif_imagetype') && ($filedata['extension'] == 'gif'))
			{
				$image = imagecreatefromgif($destination_file);
				@imagepalettetotruecolor($image);
				@imagealphablending($image, true);
				@imagesavealpha($image, true);
				unlink($destination_file);
				imagewebp($image, $destination_file, 100);
				imagedestroy($image);
				$namefile = substr($filedata['real_filename'], 0, -3);
				$filedata['real_filename'] = $namefile.'webp';
				$filedata['extension'] = 'webp';
				$filedata['mimetype'] = 'image/webp';
				$event['filedata'] = $filedata;
			}
			// Modify to webp by Siava (end)
*/
		}
	}
}
