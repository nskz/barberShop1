<?php

namespace App\Http\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $data=[
        "email"=>"",
        "password"=>"",
        "remember"=>false
    ];

    public function login(){
        $this->validate([
            'data.email'=>'required|email',
            'data.password'=>'required|string|regex:/^[a-zA-Z0-9@$#^%&*!]+$/u',
        ]);

        if (Auth::attempt([
            'email'=>$this->data['email'],
            'password'=>$this->data['password'],
        ],$this->data['remember'])){
            if (auth()->user()->groupId==1){
                return redirect()->to('/admin');
            }
            else{
                return redirect()->to('/UserPanel');
            }
        }
        else{
//            $this->data['email']="";
//            $this->data['password']="";
            return back()->with('message','Email and Password are incorrect');
        }
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
