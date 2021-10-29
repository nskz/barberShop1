<?php

namespace App\Http\Livewire\Admin\Pages;

use App\Models\ContactUs;
use Livewire\Component;
use Livewire\WithPagination;

class Contact extends Component
{
    use WithPagination;
    protected $paginationTheme='bootstrap';

    protected $listeners = [
        'deleteContact',
    ];

    public $isListPage=1;
    public $pageContactId,$contactId,$status,$nickname,$subject,$message,$phoneNumber,$email,$created_at;

    public function details($id){
        $this->isListPage=3; //edit page
        $this->contactId=$id;
        $data=ContactUs::find($this->contactId);
        $this->nickname=$data->nickname;
        $this->email=$data->email;
        $this->phoneNumber=$data->phoneNumber;
        $this->message=$data->message;
        $this->subject=$data->subject;
        $this->created_at=$data->created_at;
        $this->status=1;

        ContactUs::where('id', $this->contactId)->update(
            ['status'=>'read']
        );
    }

    public function deleteContact($id){
        ContactUs::find($id)->delete();
        $this->emit('showSuccessAlert','Message deleted!');
    }

    public function returnToListPage(){
        $this->isListPage=1; //list page
        if ($this->pageContactId!=""){
            $this->pageContactId="";
            return redirect()->to('admin/ContactUs');
        }
    }

    public $char="";

    public function mount($id=""){
        if ($id !=""){
            $this->pageContactId=$id;
            $this->details($id);
        }
    }

    public function render()
    {
        $values=ContactUs::Where('nickname','like','%'.$this->char.'%')->orWhere('phoneNumber','like','%'.$this->char.'%')->orWhere('subject','like','%'.$this->char.'%')->orWhere('message','like','%'.$this->char.'%')->orWhere('email','like','%'.$this->char.'%')->orWhere('status','like', $this->char.'%')->orderBy('id','desc')->paginate(10);
        return view('livewire.admin.pages.contact',['values'=>$values]);
    }
}
