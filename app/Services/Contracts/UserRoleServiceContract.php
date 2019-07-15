<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-07-15
 * Time: 13:02
 */
namespace App\Services\Contracts;

interface UserRoleServiceContract
{
	public function list();
	public function getRolesIds();
}