<?php
/**
 * types: success, info, warning, danger
 */
namespace erdiko\core\helpers;

class FlashMessages
{
	public static function reset()
	{
		$_SESSION['erdiko_flash_message'] = array();
	}

	public static function set($message, $type = 'danger')
	{
		$_SESSION['erdiko_flash_message'][] = array(
			'text' => $message,
			'type' => $type
			);

		$_SESSION['erdiko_flash_message'];
	}

	public static function get()
	{
		$messages = array();
		if(isset($_SESSION['erdiko_flash_message']))
			$messages = $_SESSION['erdiko_flash_message'];
		self::reset();
		
		return $messages;
	}
	
}