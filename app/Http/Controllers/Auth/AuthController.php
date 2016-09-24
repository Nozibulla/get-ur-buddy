<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Todo;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Use username instead of email to authenticate a user.
     */
    
    protected $username = 'username';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:20|min:4',
            'username' => 'required|max:20|min:4|alpha_dash|unique:users',
            'email' => 'required|email|max:100|unique:users',
            'password' => 'required|min:4|max:8|confirmed',
        ]);
    }

    public function todolist()
    {
        return $todos = Todo::all();
    }

    public function saveTodo(Request $request)
    {
        $todo = new Todo;
        $todo->id = $request->id;
        $todo->text = $request->text;
        $todo->completed = $request->completed;
        $todo->save();

    }

    public function edittodo(Request $request)
    {
        $todo = Todo::findorFail($request->id);
        // return $todo;
        $todo->completed = $request->completed;
        $todo->save();
    }

    public function deleteTodo(Request $request)
    {
        $todo = Todo::findorFail($request->id);
        $todo->delete();
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
