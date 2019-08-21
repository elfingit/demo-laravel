<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserParamToggleRequest;
use App\Http\Requests\UserChangeStatusRequest;
use App\Http\Requests\UserShowFieldRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserBetsCollection;
use App\Http\Resources\UserTransactionsCollection;
use App\Lib\Query\Criteria;
use App\Model\User as UserModel;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = UserModel::query();

        $criteria = new Criteria($request);
        $criteria->attachQuery($query);

        $criteria->where('id', 'id');
        $criteria->where('email', 'email');
        $criteria->relationWhere('profile', 'host', 'host');

        $users = \User::list($criteria);

    	return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(UserModel $user)
    {
        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(UserModel $user)
    {
        $roles = \UserRole::list();
    	return view('user.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, UserModel $user)
    {
		\User::update($request, $user);

	    return redirect()->route('dashboard.users.index')
	                     ->with('system_message', __('User successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function changeStatus(UserChangeStatusRequest $request, UserModel $user)
    {
        \User::changeStatus($request, $user);

        return response()->json(null, 204);
    }

    public function paramToggle(UserParamToggleRequest $request, UserModel $user)
    {
        \User::paramToggle($request, $user);

        return response()->json(null, 204);
    }

    public function showField(UserShowFieldRequest $request, UserModel $user)
    {
        $value = \User::getFieldValue($request->get('field'), $user);

        if (is_null($value)) {
            $value = 'phone not provided';
        }

        return response()->json([
            'result'    => $value
        ]);
    }

    public function bets(UserModel $user)
    {
        $bets = \Bet::getByUser($user);

        return new UserBetsCollection($bets);
    }

    public function transactions(UserModel $user)
    {
        $transactions = $user->transactions()
                            ->orderBy('user_transactions.updated_at', 'desc')
                             ->paginate(25);

        return new UserTransactionsCollection($transactions);
    }

    public function betsPending(UserModel $user)
    {
        $leads = \Lead::getListByUser($user);

    }
}
