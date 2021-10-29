<?php

namespace App\Http\Livewire\Admin\Sections;

use App\Models\ContactUs;
use App\Models\User;
use Livewire\Component;

class Header extends Component
{
    public $fullName="";

    public function render()
    {
        $newContactUs=ContactUs::where('status','unread')->count();
        $Contacts=ContactUs::where('status','unread')->get()->take(5);
        $value=User::find(auth()->user()->id);
        $this->fullName=$value->firstName." ".$value->lastName;
        return view('livewire.admin.sections.header',['newContactUs'=>$newContactUs,'Contacts'=>$Contacts]);
    }
}
