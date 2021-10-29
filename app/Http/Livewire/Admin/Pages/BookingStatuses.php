<?php

namespace App\Http\Livewire\Admin\Pages;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\BookingStatus;

class BookingStatuses extends Component
{
    use WithPagination;
    protected $paginationTheme='bootstrap';

    protected $listeners = [
        'deleteStatus',
    ];

    public $isListPage=1;
    public $title;
    public $statusId;

    public function deleteStatus($id){
        BookingStatus::find($id)->delete();
        $this->emit('showSuccessAlert','Status deleted!');
    }

    public function addNewStatus(){
        $this->isListPage=2; //add page
    }

    public function returnToListPage(){
        $this->isListPage=1; //list page
        $this->cancelAddStatus();
        $this->resetValidation();
    }

    public function editStatus($id){
        $this->isListPage=3; //edit page
        $this->statusId=$id;
        $this->cancelEditStatus();
    }

    public function cancelAddStatus(){
        $this->title="";
        $this->resetValidation();
    }

    public function insertStatus(){
        $this->validate([
            'title'=>'required|string',
        ]);
        $data=new BookingStatus();
        $data->title=$this->title;
        $data->barberShopId=1;
        $data->save();

        $this->emit('showSuccessAlert','New Status Added!');
        $this->cancelAddStatus();
    }

    public function cancelEditStatus(){
        $data=BookingStatus::find($this->statusId);
        $this->title=$data->title;
        $this->resetValidation();
    }

    public function updateStatus(){
        $this->validate([
            'title'=>'required|string',
        ]);
        BookingStatus::where('id', $this->statusId)->update(
            ['title'=>$this->title]
        );
        $this->emit('showSuccessAlert','Status successfully updated!');
    }

    public function render()
    {
        $statues=BookingStatus::paginate(10);
        return view('livewire.admin.pages.booking-statuses',['statuses'=>$statues]);
    }
}
