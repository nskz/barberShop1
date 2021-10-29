<?php

namespace App\Http\Livewire\Admin\Pages;

use App\Models\BookingPrepayment;
use Livewire\Component;

class Prepaid extends Component
{
    public $isListPage=1;
    public $prepaidId,$price;

    public function returnToListPage(){
        $this->isListPage=1; //list page
        $this->cancelEditPrepaid();
        $this->resetValidation();
    }

    public function editPrepaid($id){
        $this->isListPage=3; //edit page
        $this->prepaidId=$id;
        $this->cancelEditPrepaid();
    }

    public function cancelEditPrepaid(){
        $value=BookingPrepayment::find($this->prepaidId);
        $this->price=$value->price;
        $this->resetValidation();
    }

    public function updatePrepaid(){
        $this->validate([
            'price'=>'required|regex:/^[0-9]+$/u|gt:0',
        ]);
        BookingPrepayment::where('id', $this->prepaidId)->update(
            ['price'=>$this->price]
        );
        $this->emit('showSuccessAlert','Prepaid price successfully updated!');
    }

    public function render()
    {
        $value=BookingPrepayment::first();
        return view('livewire.admin.pages.prepaid',['value'=>$value]);
    }
}
