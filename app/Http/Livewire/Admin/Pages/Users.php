<?php

namespace App\Http\Livewire\Admin\Pages;

use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class Users extends Component
{
    use WithPagination;
    protected $paginationTheme='bootstrap';
    protected $listeners = [
        'deleteUser',
    ];

    public $isListPage=1;
    public $status=1;
    public $firstName;
    public $lastName;
    public $email;
    public $phoneNumber;
    public $password;
    public $password_confirmation="";
    public $newPassword="";
    public $new_password_confirmation="";
    public $groupId;
    public $groups;

    public $userId;

    public function changeUserStatus($id,$status){
        if($status==1){
            $status=0;
        }else{
            $status=1;
        }
        User::where('id', $id)->update(
            ['status'=>$status]
        );
    }

    public function deleteUser($id){
        User::find($id)->delete();
        $this->emit('showSuccessAlert','User deleted!');
    }

    public function addNewUser(){
        $this->isListPage=2; //add page
    }

    public function returnToListPage(){
        $this->isListPage=1; //list page
        $this->cancelAddUser();
        $this->resetValidation();
    }

    public function cancelAddUser(){
        $this->firstName="";
        $this->lastName="";
        $this->email="";
        $this->phoneNumber="";
        $this->groupId="";
        $this->password="";
        $this->password_confirmation="";
        $this->status=1;
        $this->resetValidation();
    }

    public function insertUser(){
        $this->validate([
            'firstName'=>'required|string|regex:/^[a-zA-Z0-9@$#^%&*!]+$/u',
            'lastName'=>'required|string|regex:/^[a-zA-Z0-9@$#^%&*!]+$/u',
            'phoneNumber'=>'required|string|regex:/^[0-9]+$/u',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|string|min:4|regex:/^[a-zA-Z0-9@$#^%&*!]+$/u|confirmed',
        ]);
        $data=new User();
        $data->firstName=$this->firstName;
        $data->lastName=$this->lastName;
        $data->phoneNumber=$this->phoneNumber;
        $data->email=$this->email;
        $data->userName=$this->email;
        $data->password=Hash::make($this->password);
        $data->gender=0;//men
        $data->status=$this->status;
        $data->groupId=$this->groupId;
        $data->barberShopId=1;
        $data->save();

        $this->emit('showSuccessAlert','New User Added!');
        $this->cancelAddUser();
    }

    public function editUser($id){
        $this->isListPage=3; //edit page
        $this->userId=$id;
        $this->cancelEditUser();
    }

    public function cancelEditUser(){
        $user=User::find($this->userId);
        $this->firstName=$user->firstName;
        $this->lastName=$user->lastName;
        $this->email=$user->email;
        $this->phoneNumber=$user->phoneNumber;
        $this->groupId=$user->groupId;
        $this->status=$user->status;
        $this->newPassword="";
        $this->password_confirmation="";
        $this->resetValidation();
    }

    public function updateUser(){
        $this->validate([
            'firstName'=>'required|string|regex:/^[a-zA-Z0-9@$#^%&*!]+$/u',
            'lastName'=>'required|string|regex:/^[a-zA-Z0-9@$#^%&*!]+$/u',
            'phoneNumber'=>'required|string|regex:/^[0-9]+$/u',
            'email'=>'required|email|unique:users,email,'. $this->userId,
        ]);
        User::where('id', $this->userId)->update(
            ['groupId'=>$this->groupId,'status'=>$this->status,'firstName'=>$this->firstName,'lastName'=>$this->lastName,'email'=>$this->email,'userName'=>$this->email,'phoneNumber'=>$this->phoneNumber]
        );
        $this->emit('showSuccessAlert','User details successfully updated!');
    }

    public function cancelEditPass(){
        $this->newPassword="";
        $this->new_password_confirmation="";
        $this->resetValidation();
    }

    public function editPass(){
        $this->validate([
            'newPassword' => 'min:4|regex:/^[a-zA-Z0-9@$#^%&*!]+$/u|required|same:new_password_confirmation',
        ]);
        $password = Hash::make($this->newPassword);
        User::where('id', $this->userId)->update(['password'=>$password]);

        $this->cancelEditPass();
        //add sweet alert
        $this->emit('showSuccessAlert','Password successfully changed!');
    }

    public $char="";
    public function mount($char=""){
        $this->groups=UserGroup::where('status',1)->orderBy('title')->get();
        $this->char=$char;
    }

    public function render()
    {
        $users=User::leftJoin('user_groups','user_groups.id','=','users.groupId')->where(DB::raw('CONCAT_WS(" ", firstName,lastName)'), 'LIKE','%' .$this->char.'%')->orWhere('email','like','%'.$this->char.'%')->orWhere('user_groups.title','like','%'.$this->char.'%')->orWhere('phoneNumber','like','%'.$this->char.'%')->select('users.*','user_groups.title as groupTitle')->orderBy('users.id','desc')->paginate(10);
        return view('livewire.admin.pages.users',['users'=>$users]);
    }
}
