<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Lang;
use Illuminate\Http\Response;

class LoginController extends Controller
{
    use  ThrottlesLogins;

    protected $maxAttempts = 8;

    public function authenticate(Request $request)
    {
        if ($this->hasTooManyLoginAttempts($request))
        {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);

        }

        // grab credentials from the request
        $credentials = $request->only('email', 'password');

        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = app('tymon.jwt.auth')->attempt($credentials)) {
                $this->incrementLoginAttempts($request);

                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTExceptionception $e) {
            $this->incrementLoginAttempts($request);
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // all good so return the token
        return response()->json(compact('token'));
    }

    /**
     * Set the key to login
     * @return string
     */
    public function username()
    {
        return 'email';
    }

    /**
     * Redirect the user after determining they are locked out.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendLockoutResponse(Request $request)
    {
        $seconds = $this->limiter()->availableIn(
            $this->throttleKey($request)
        );

        $message = Lang::get('auth.throttle', ['seconds' => $seconds]);

        $errors = [$this->username() => $message];

        return response()->json($errors, Response::HTTP_TOO_MANY_REQUESTS);
    }
}
