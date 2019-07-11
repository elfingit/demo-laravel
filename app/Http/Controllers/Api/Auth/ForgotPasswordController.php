<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;

class ForgotPasswordController extends \App\Http\Controllers\Auth\ForgotPasswordController
{
	/**
	 * Get the response for a successful password reset link.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  string  $response
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
	 */
	protected function sendResetLinkResponse(Request $request, $response)
	{
		return response()->json(['status' => $response]);
	}

	/**
	 * Get the response for a failed password reset link.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  string  $response
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
	 */
	protected function sendResetLinkFailedResponse(Request $request, $response)
	{
		return response()->json([
			'message'   => trans($response),
			'errors' => [
				'email' => [trans($response)]
			]
		], 422);
	}

	/**
	 * Reset the given user's password.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
	 */
	public function reset(Request $request)
	{
		$request->validate($this->rules(), $this->validationErrorMessages());

		// Here we will attempt to reset the user's password. If it is successful we
		// will update the password on an actual user model and persist it to the
		// database. Otherwise we will parse the error and return the response.
		$response = $this->broker()->reset(
			$this->passwordCredentials($request), function ($user, $password) {
			$this->resetPassword($user, $password);
		}
		);

		// If the password was successfully reset, we will redirect the user back to
		// the application's home authenticated view. If there is an error we can
		// redirect them back to where they came from with their error message.
		return $response == Password::PASSWORD_RESET
			? $this->sendResetResponse($request, $response)
			: $this->sendResetFailedResponse($request, $response);
	}

	/**
	 * Get the password reset validation rules.
	 *
	 * @return array
	 */
	protected function rules()
	{
		return [
			'token' => 'required',
			'email' => 'required|email',
			'password' => 'required|confirmed|min:8',
		];
	}

	/**
	 * Get the password reset validation error messages.
	 *
	 * @return array
	 */
	protected function validationErrorMessages()
	{
		return [];
	}


	/**
	 * Get the broker to be used during password reset.
	 *
	 * @return \Illuminate\Contracts\Auth\PasswordBroker
	 */
	public function broker()
	{
		return \Password::broker();
	}

	protected function resetPassword($user, $password)
	{
		$user->password = Hash::make($password);

		$user->setRememberToken(Str::random(60));

		$user->save();

		event(new PasswordReset($user));

	}

	protected function passwordCredentials(Request $request)
	{
		return $request->only(
			'email', 'password', 'password_confirmation', 'token'
		);
	}

	/**
	 * Get the response for a successful password reset.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  string  $response
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
	 */
	protected function sendResetResponse(Request $request, $response)
	{
		return response()->json(['status' => 'ok']);
	}

	/**
	 * Get the response for a failed password reset.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  string  $response
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
	 */
	protected function sendResetFailedResponse(Request $request, $response)
	{
		return response()->json(['email' => trans($response)], 422);
	}
}
