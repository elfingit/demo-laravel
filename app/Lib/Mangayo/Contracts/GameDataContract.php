<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-06-26
 * Time: 08:52
 */

namespace App\Lib\Mangayo\Contracts;

interface GameDataContract
{
	public function hasError();
	public function getErrorCode();

	public function getName();

	public function getCountry();
	public function getState();

	public function getMainMin();
	public function getMainMax();
	public function getMainDrawn();

	public function getBonusMin();
	public function getBonusMax();
	public function getBonusDrawn();

	public function getSameBalls();

	public function getDigits();
	public function getDrawn();

	public function isOption();

	public function getOptionDescription();
}