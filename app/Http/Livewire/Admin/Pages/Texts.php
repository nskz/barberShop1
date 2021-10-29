<?php

namespace App\Http\Livewire\Admin\Pages;

use App\Models\Text;
use Livewire\Component;
use Livewire\WithPagination;

class Texts extends Component
{
    use WithPagination;
    protected $paginationTheme='bootstrap';
    protected $listeners = [
        'deleteText',
    ];

    public $isListPage=1;
    public $text,$shortText,$title,$keywords,$textId;
    public $status=1;

    public function changeTextStatus($id,$status){
        if($status==1){
            $status=0;
        }else{
            $status=1;
        }
        Text::where('id', $id)->update(
            ['status'=>$status]
        );
    }

    public function deleteText($id){
        Text::find($id)->delete();
        $this->emit('showSuccessAlert','Text deleted!');
    }

    public function addNewText(){
        $this->isListPage=2; //add page
    }

    public function returnToListPage(){
        $this->isListPage=1; //list page
        $this->cancelAddText();
        $this->resetValidation();
    }

    public function cancelAddText(){
        $this->title="";
        $this->keywords="";
        $this->text="";
        $this->shortText="";
        $this->status=1;
        $this->resetValidation();
    }

    public function insertText(){
        $this->validate([
            'title'=>'required|string|regex:/^[a-zA-Z0-9@$,_#^%&*!-]+$/u',
//            'keywords'=>'required|string|regex:/^[a-zA-Z0-9@$,_#^%&*!-]+$/u',
            'text'=>'required|string',
//            'shortText'=>'required|string',
        ]);
        $data=new Text();
        $data->title=$this->title;
        $data->text=$this->text;
        $data->shortText=$this->shortText;
        $data->keywords=$this->keywords;
        $data->status=$this->status;
        $data->barberShopId=1;
        $data->save();

        $this->emit('showSuccessAlert','New Text Added!');
        $this->cancelAddText();
    }

    public function editText($id){
        $this->isListPage=3; //edit page
        $this->textId=$id;
        $this->cancelEditText();
    }

    public function cancelEditText(){
        $text=Text::find($this->textId);
        $this->title=$text->title;
        $this->keywords=$text->keywords;
        $this->text=$text->text;
        $this->shortText=$text->shortText;
        $this->status=$text->status;
        $this->resetValidation();
    }

    public function updateText(){
        $this->validate([
            'title'=>'required|string|regex:/^[a-zA-Z0-9@$,_#^%&*!-]+$/u',
//            'keywords'=>'required|string|regex:/^[a-zA-Z0-9@$,_#^%&*!-]+$/u',
            'text'=>'required|string',
//            'shortText'=>'required|string',
        ]);
        Text::where('id', $this->textId)->update(
            ['title'=>$this->title,'status'=>$this->status,'keywords'=>$this->keywords,'text'=>$this->text,'shortText'=>$this->shortText]
        );
        $this->emit('showSuccessAlert','Text details successfully updated!');
    }

    public function render()
    {
        $texts=Text::orderBy('id','desc')->paginate(10);
        return view('livewire.admin.pages.texts',['texts'=>$texts]);
    }
}
