<?php

namespace App\Http\Livewire\Admin\Pages;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Livewire\Component;

class EditProfile extends Component
{
    public $data=[
        'firstName'=>'',
        'lastName'=>'',
        'phoneNumber'=>'',
        'email'=>'',
        'password'=>'',
        'password_confirmation'=>''
    ];

    public function mount(){
        $this->data['firstName']=auth()->user()->firstName;
        $this->data['lastName']=auth()->user()->lastName;
        $this->data['phoneNumber']=auth()->user()->phoneNumber;
        $this->data['email']=auth()->user()->email;
    }
    public function cancelEditInfo(){
        $this->data['firstName']=auth()->user()->firstName;
        $this->data['lastName']=auth()->user()->lastName;
        $this->data['phoneNumber']=auth()->user()->phoneNumber;
        $this->data['email']=auth()->user()->email;
    }
    public function cancelEditPass(){
        $this->data['password']="";
        $this->data['password_confirmation']="";
    }
    public function editPass(){
        $this->validate([
            'data.password'=>'required|string|min:4|regex:/^[a-zA-Z0-9@$#^%&*!]+$/u|confirmed',
        ]);
        $password = Hash::make($this->data['password']);
            User::where('id', auth()->user()->id)->update(['password'=>$password]);

            $this->cancelEditPass();
            //add sweet alert
            $this->emit('showSuccessAlert','Password successfully changed!');
    }
    public function editInfo(){
        $this->validate([
            'data.firstName'=>'required|string|regex:/^[a-zA-Z0-9@$#^%&*!]+$/u',
            'data.lastName'=>'required|string|regex:/^[a-zA-Z0-9@$#^%&*!]+$/u',
            'data.phoneNumber'=>'required|string|regex:/^[0-9]+$/u',
            'data.email'=>'required|email|unique:users,email,' . auth()->user()->id,
        ]);
        User::where('id', auth()->user()->id)->update(
            ['firstName'=>$this->data['firstName'],'lastName'=>$this->data['lastName'],'phoneNumber'=>$this->data['phoneNumber'],'email'=>$this->data['email'],'userName'=>$this->data['email']]
        );
        //add sweet alert
        $this->emit('showSuccessAlert','Your information successfully changed!');
    }
    public function render()
    {
        return view('livewire.admin.pages.edit-profile');
    }
}
