<?php

namespace App\Http\Livewire\Admin\Pages;

use App\Models\UserGroup;
use Livewire\Component;
use Livewire\WithPagination;

class UserGroupsList extends Component
{
    use WithPagination;
    protected $paginationTheme='bootstrap';

    protected $listeners = [
        'deleteGroup',
    ];

    public $isListPage=1;
    public $status=1;
    public $title;
    public $level;
    public $groupId;

    public function deleteGroup($id){
        UserGroup::find($id)->delete();
        $this->emit('showSuccessAlert','UserGroup deleted!');
    }

    public function changeGroupStatus($id,$status){
        if($status==1){
            $status=0;
        }else{
            $status=1;
        }
        UserGroup::where('id', $id)->update(
            ['status'=>$status]
        );
    }

    public function addNewGroup(){
        $this->isListPage=2; //add page
    }

    public function returnToListPage(){
        $this->isListPage=1; //list page
        $this->cancelAddGroup();
        $this->resetValidation();
    }

    public function editGroup($id){
        $this->isListPage=3; //edit page
        $this->groupId=$id;
        $this->cancelEditGroup();
    }

    public function cancelAddGroup(){
        $this->title="";
        $this->level="";
        $this->status=1;
        $this->resetValidation();
    }

    public function insertGroup (){
        $this->validate([
            'title'=>'required|string',
            'level'=>'required|string',
        ]);
        $data=new UserGroup();
        $data->title=$this->title;
        $data->level=$this->level;
        $data->status=$this->status;
        $data->barberShopId=1;
        $data->save();

        $this->emit('showSuccessAlert','New UserGroup Added!');
        $this->cancelAddGroup();
    }

    public function cancelEditGroup(){
        $userGroups=UserGroup::find($this->groupId);
        $this->title=$userGroups->title;
        $this->level=$userGroups->level;
        $this->status=$userGroups->status;
        $this->resetValidation();
    }

    public function updateGroup(){
        $this->validate([
            'title'=>'required|string',
            'level'=>'required|string',
        ]);
        UserGroup::where('id', $this->groupId)->update(
            ['status'=>$this->status,'title'=>$this->title,'level'=>$this->level]
        );
        $this->emit('showSuccessAlert','Group details successfully updated!');
    }

    public function render()
    {
        $userGroups=UserGroup::paginate(10);
        return view('livewire.admin.pages.user-groups-list',['userGroups'=>$userGroups]);
    }
}
