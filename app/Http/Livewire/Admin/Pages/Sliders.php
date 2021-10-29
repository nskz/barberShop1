<?php

namespace App\Http\Livewire\Admin\Pages;

use App\Models\Slider;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class Sliders extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme='bootstrap';
    protected $listeners = [
        'deleteSlider',
    ];

    public $isListPage=1;
    public $title,$picture,$link,$description,$sliderId;
    public $status=1;

    public function changeSliderStatus($id,$status){
        if($status==1){
            $status=0;
        }else{
            $status=1;
        }
        Slider::where('id', $id)->update(
            ['status'=>$status]
        );
    }

    public function deleteSlider($id){
        $slider= Slider::find($id);
        unlink($slider->name);
        Slider::find($id)->delete();
        $this->emit('showSuccessAlert','Slider deleted!');
    }

    public function addNewSlider(){
        $this->isListPage=2; //add page
    }

    public function returnToListPage(){
        $this->isListPage=1; //list page
        $this->cancelAddSlider();
        $this->resetValidation();
    }

    public function cancelAddSlider(){
        $this->title="";
        $this->link="";
        $this->picture="";
        $this->description="";
        $this->status=1;
        $this->resetValidation();
    }

    public function insertSlider(){
        $this->validate([
            'title'=>'required|string|regex:/^[a-zA-Z0-9@$,_#^%&*!-]+$/u',
            'picture'=>'required|image|mimes:jpg,jpeg,png,svg|max:2048'
        ]);
        $img=$this->picture->store('public/images/sliders');

        $data=new Slider();
        $data->title=$this->title;
        $data->description=$this->description;
        $data->link=$this->link;
        $data->name='storage/images/sliders/'.explode('/',$img)[3];
        $data->status=$this->status;
        $data->barberShopId=1;
        $data->save();

        $this->emit('showSuccessAlert','New Slider Added!');
        $this->cancelAddSlider();
    }

    public function editSlider($id){
        $this->isListPage=3; //edit page
        $this->sliderId=$id;
        $this->cancelEditSlider();
    }

    public function cancelEditSlider(){
        $slider=Slider::find($this->sliderId);
        $this->title=$slider->title;
        $this->link=$slider->link;
        $this->description=$slider->description;
        $this->picture="";
        $this->status=$slider->status;
        $this->resetValidation();
    }

    public function updateSlider(){
        $slider= Slider::find($this->sliderId);
        if ($this->picture != '' && $this->picture != null) {
            $this->validate([
                'title'=>'required|string|regex:/^[a-zA-Z0-9@$,_#^%&*!-]+$/u',
                'picture'=>'mimes:jpg,jpeg,png,svg|max:2048'
            ]);
            unlink($slider->name);
            $img=$this->picture->store('public/images/sliders');
            $name='storage/images/sliders/'.explode('/',$img)[3];
            Slider::where('id', $this->sliderId)->update(
                ['title'=>$this->title,'status'=>$this->status,'link'=>$this->link,'description'=>$this->description,'name'=>$name]
            );
        }else{
            $this->validate([
                'title'=>'required|string|regex:/^[a-zA-Z0-9@$,_#^%&*!-]+$/u',
            ]);
            Slider::where('id', $this->sliderId)->update(
                ['title'=>$this->title,'status'=>$this->status,'link'=>$this->link,'description'=>$this->description]
            );
        }
        $this->emit('showSuccessAlert','Slider details successfully updated!');
    }

    public function render()
    {
        $sliders=Slider::orderBy('id','desc')->paginate(10);
        return view('livewire.admin.pages.sliders',['sliders'=>$sliders]);
    }
}
