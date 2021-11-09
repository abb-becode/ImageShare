<?php

    namespace App\Http\Controllers;

    use App\Models\User;
    use Illuminate\Http\Request;
    use Illuminate\Validation\Rule;

    class RegisterController extends Controller
    {
        public function create()
        {
            return view('register.create');
        }

        public function store()
        {
            //return request()->all();

            // Laravel detect automatically if validation failed,
            // he redirects you back to the previous page which is the form
            $attributes = request()->validate([
               'name' => 'required|max:255',
               /*'username' => 'required|min:3|max:255|unique:users,username',*/
               'username' => ['required', 'min:3', 'max:255', Rule::unique('users', 'username')],
               'email' => 'required|email|max:255|unique:users,email',
               'password' => 'required|min:7|max:255',
               /*'password' => ['required', 'min:7', 'max:255'],*/
            ]);

            // After validation succeed

            // Hash a password
            //$attributes['password'] = bcrypt($attributes['password']); // replaced with setPasswordAttribute in User Model

            // Create a user
            $user = User::create($attributes);

            // sign in with the user created
            auth()->login($user);

            // Flash a success message
            //session()->flash('success', 'Your account has been created successfully.');

            // Redirect to the home page with flash message
            return redirect('/')->with('success', 'Your account has been created successfully.');
        }
    }
