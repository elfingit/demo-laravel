<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-07-15
 * Time: 09:59
 */

namespace App\Lib\Query;

use Illuminate\Http\Request;
use \Illuminate\Database\Eloquent\Builder;

class Criteria
{
	/** @var Request */
	protected $request;
	/**
	 * @var Builder
	 */
	protected $builder;

	/**
	 * Criteria constructor.
	 *
	 * @param Request $request
	 */
	public function __construct(Request $request)
	{
		$this->request = $request;
	}

	public function attachQuery(Builder $builder)
	{
		$this->builder = $builder;
	}

	public function where($filter, $field)
	{
		if (!is_null($this->request->get($filter))) {
			$this->builder->where($field, $this->request->get($filter));
		}

	}

	public function relationWhere($relation, $filter, $field)
	{
		if (!is_null($this->request->get($filter))) {

			$this->builder = $this->builder->whereHas($relation, function (Builder $query) use ($field, $filter) {
				$query->where($field, $this->request->get($filter));
			});
		}
	}

	public function orderBy($field, $order)
    {
        $this->builder->orderBy($field, $order);

        return $this;
    }

	public function paginate($perPage = 25)
	{
		return $this->builder->paginate($perPage);
	}
}
