<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-06-26
 * Time: 12:06
 */
namespace App\Lib;

use App\Model\Brand;

class ViewHelpers
{
	public static function brandStatusHuman($status)
	{
		$humanStatus = __('Unknown');

		switch ($status) {
			case Brand::STATUS_IN_SYNC:
				 $humanStatus = __('Synchronization in progress');
				 break;
			case Brand::STATUS_SYNCED:
				$humanStatus = __('Synchronized');
				break;

			case Brand::STATUS_ERR_SYNC:
				$humanStatus = __('Error synchronization');
				break;

			case Brand::STATUS_DISABLED:
				$humanStatus = __('Brand disabled');
				break;
		}

		return $humanStatus;

	}
}