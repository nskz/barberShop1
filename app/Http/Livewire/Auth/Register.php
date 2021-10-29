<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Register extends Component
{
    public $data=[
        "firstName"=>"",
        "lastName"=>"",
        "phoneNumber"=>"",
        "email"=>"",
        "password"=>"",
        "password_confirmation"=>"",
        "policy"=>""
    ];

    public function handleRegister(){
        $this->validate([
            'data.firstName'=>'required|string|regex:/^[a-zA-Z0-9@$#^%&*!]+$/u',
            'data.lastName'=>'required|string|regex:/^[a-zA-Z0-9@$#^%&*!]+$/u',
            'data.phoneNumber'=>'required|string|regex:/^[0-9]+$/u',
            'data.email'=>'required|email|unique:users,email',
            'data.password'=>'required|string|min:4|regex:/^[a-zA-Z0-9@$#^%&*!]+$/u|confirmed',
            'data.policy'=>'required'
        ]);

        $data=new User();
        $data->firstName=$this->data['firstName'];
        $data->lastName=$this->data['lastName'];
        $data->phoneNumber=$this->data['phoneNumber'];
        $data->email=$this->data['email'];
        $data->userName=$this->data['email'];
        $data->password=Hash::make($this->data['password']);
        $data->gender=0;//men
        $data->status=1;
        $data->groupId=2;//user
        $data->barberShopId=1;
        $data->save();

        $id=$data->id;
        Auth::loginUsingId($id);
        return redirect()->to('/userPanel');
    }
    public function render()
    {
        return view('livewire.auth.register');
    }
}
