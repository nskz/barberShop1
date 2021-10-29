<?php

namespace App\Http\Livewire\Admin\Pages;

use App\Models\Barber;
use Livewire\Component;
use Livewire\WithPagination;

class Barbers extends Component
{
    use WithPagination;
    protected $paginationTheme='bootstrap';
    protected $listeners = [
        'deleteBarber',
    ];

    public $isListPage=1;
    public $status=1;
    public $firstName;
    public $lastName;
    public $email;
    public $phoneNumber;
    public $address;
    public $workDays=[];
    public $workTime="";

    public $barberId;


    public function addNewBarber(){
        $this->isListPage=2; //add page
    }

    public function returnToListPage(){
        $this->isListPage=1; //list page
        $this->cancelAddUser();
        $this->resetValidation();
    }

    public function cancelAddBarber(){
        $this->firstName="";
        $this->lastName="";
        $this->email="";
        $this->phoneNumber="";
        $this->address="";
        $this->workDays="";
        $this->workTime="";
        $this->status=1;
        $this->resetValidation();
        $this->emit('resetAddBarber');

    }

    public function render()
    {
        $barbers=Barber::orderBy('id','desc')->paginate(10);
        return view('livewire.admin.pages.barbers',['barbers'=>$barbers]);
    }
}
