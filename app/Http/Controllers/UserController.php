<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    //qekjo request jan te dhenat qe i marrim prej signup, qe i shkrun useri
    public function register(Request $request){
        $incomingFields = $request->validate([
            'name' =>  ['required','min:3','max:15', Rule::unique('users','name')],
            'email' =>  ['required','email', Rule::unique('users','email')],
            'password' => ['required','min:8','max:50']
        ]);

        //mos me rujt passwordin ne databaze, me bo hash qe mos me rujt passwordin aktual po ni vlere tjter
        $incomingFields['password']=bcrypt($incomingFields['password']);
        $user = User::create($incomingFields);
        auth()->login($user);

        return redirect('/');
    }

    //logout
    public function logout(){
        auth()->logout();
        return redirect('/');
    }

    //login
    public function login(Request $request){
        $incomingFields = $request->validate([
            'email' =>  'required',
            'password' => 'required'
        ]);

        //me kqyr nese ekziston ne databaze
        if(auth()->attempt(['email'=>$incomingFields['email'], 'password'=>$incomingFields['password']])){
            $request->session()->regenerate();
        }

        return redirect('/');
    }

    //edit profile
    public function editProfile(User $user){
        return view('profile',['user'=>$user]);
    }
    public function updateProfile(User $user,Request $request){
        $incomingFields = $request->validate([
            'name' =>  ['required','min:3','max:15', Rule::unique('users','name')->ignore($user->id)],
            'email' =>  ['required','email', Rule::unique('users','email')->ignore($user->id)],
            'password' => ['nullable','min:8','max:50']
        ]);
        
        if ($request->filled('password')) {
            $incomingFields['password'] = bcrypt($incomingFields['password']);
        } else {
            unset($incomingFields['password']);
        }

        $user->update($incomingFields);
        session()->flash('message', 'Profile updated successfully!');
        return redirect()->route('profile.edit', $user->id);
    }
}
