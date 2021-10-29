<?php

namespace App\Http\Livewire\Admin\Pages;

use App\Models\Barber;
use App\Models\WeekDay;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

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
    public $startWorkTime="";
    public $endWorkTime="";
    public $workTimes=[];
    public $currentDay="";
    public $barberId;

    public function addNewBarber(){
        $this->isListPage=2; //add page
    }

    public function returnToListPage(){
        $this->isListPage=1; //list page
        $this->cancelAddBarber();
        $this->resetValidation();
        //for working timepicker i forced to add this to refresh page
        return redirect()->to('admin/Settings/BarbersList');

    }

    public function cancelAddBarber(){
        $this->firstName="";
        $this->lastName="";
        $this->email="";
        $this->phoneNumber="";
        $this->address="";
        $this->workDays=[];
        $this->startWorkTime="";
        $this->endWorkTime="";
        $this->workTimes=[];
        $this->status=1;
        $this->resetValidation();
        $this->emit('resetAddBarber');
    }

    public function insertBarber(){
        $this->validate([
            'firstName'=>'required|string|regex:/^[a-zA-Z0-9@$#^%&*!]+$/u',
            'lastName'=>'required|string|regex:/^[a-zA-Z0-9@$#^%&*!]+$/u',
            'phoneNumber'=>'required|string|regex:/^[0-9]+$/u',
            'email'=>'required|email|unique:barbers,email',
            'startWorkTime'=>'required',
            'endWorkTime'=>'required',
        ]);
        if ($this->workDays==null){
            $this->emit('message','The Days of work field is required.');
        }
        else{
            $FromTime= date('H:i',strtotime($this->startWorkTime));
            $t=strtotime($this->startWorkTime);
            while ($t < strtotime($this->endWorkTime)){
                $ToTime = strtotime('+ 30 minute', strtotime($FromTime));
                array_push($this->workTimes,[$FromTime, date('H:i',$ToTime)]);
                $FromTime=date('H:i',$ToTime);
                $t=$ToTime;
            }

            $data=new Barber();
            $data->firstName=$this->firstName;
            $data->lastName=$this->lastName;
            $data->phoneNumber=$this->phoneNumber;
            $data->email=$this->email;
            $data->address=$this->address;
            $data->workDays=json_encode($this->workDays);
            $data->startWorkTime=$this->startWorkTime;
            $data->endWorkTime=$this->endWorkTime;
            $data->workTimes=json_encode($this->workTimes);
            $data->status=$this->status;
            $data->barberShopId=1;
            $data->save();

            $this->emit('message','');
            $this->emit('showSuccessAlert','New Barber Added!');
            $this->cancelAddBarber();
        }
    }

    public function changeBarberStatus($id,$status){
        if($status==1){
            $status=0;
        }else{
            $status=1;
        }
        Barber::where('id', $id)->update(
            ['status'=>$status]
        );
    }

    public function deleteBarber($id){
        Barber::find($id)->delete();
        $this->emit('showSuccessAlert','Barber deleted!');
    }

    public function editBarber($id){
        $this->isListPage=3; //edit page
        $this->barberId=$id;
        $this->cancelEditBarber();
    }

    public function cancelEditBarber(){
        $data=Barber::find($this->barberId);
        $this->firstName=$data->firstName;
        $this->lastName=$data->lastName;
        $this->email=$data->email;
        $this->phoneNumber=$data->phoneNumber;
        $this->address=$data->address;
        $this->workDays=[];
        $this->startWorkTime=$data->startWorkTime;
        $this->endWorkTime=$data->endWorkTime;
        $this->status=$data->status;
        $this->resetValidation();

        $weekDays=WeekDay::get();
        $va=explode("," ,$data->workDays);
        $va = str_replace('[', '', $va);
        $va = str_replace(']', '', $va);
        $va = str_replace('"', '', $va);
        foreach($weekDays as $weekDay){
            foreach ($va as $v){
                if($v==$weekDay->id) {
                    $this->currentDay .=$weekDay->title ." , ";
                }
            }
        }
        $this->emit('resetAddBarber');
    }

    public function updateBarber(){
        $this->validate([
            'firstName'=>'required|string|regex:/^[a-zA-Z0-9@$#^%&*!]+$/u',
            'lastName'=>'required|string|regex:/^[a-zA-Z0-9@$#^%&*!]+$/u',
            'phoneNumber'=>'required|string|regex:/^[0-9]+$/u',
            'email'=>'required|email|unique:barbers,email,'. $this->barberId,
            'startWorkTime'=>'required',
            'endWorkTime'=>'required',
        ]);
        $FromTime= date('H:i',strtotime($this->startWorkTime));
        $t=strtotime($this->startWorkTime);
        while ($t < strtotime($this->endWorkTime)){
            $ToTime = strtotime('+ 30 minute', strtotime($FromTime));
            array_push($this->workTimes,[$FromTime, date('H:i',$ToTime)]);
            $FromTime=date('H:i',$ToTime);
            $t=$ToTime;
        }

        if ($this->workDays==null){
            Barber::where('id', $this->barberId)->update(
                ['status'=>$this->status,'firstName'=>$this->firstName,'lastName'=>$this->lastName,'email'=>$this->email,'address'=>$this->address,'phoneNumber'=>$this->phoneNumber,'startWorkTime'=>$this->startWorkTime,'endWorkTime'=>$this->endWorkTime,'workTimes'=>json_encode($this->workTimes)]
            );
        }
        else{
            Barber::where('id', $this->barberId)->update(
                ['status'=>$this->status,'firstName'=>$this->firstName,'lastName'=>$this->lastName,'email'=>$this->email,'address'=>$this->address,'phoneNumber'=>$this->phoneNumber,'startWorkTime'=>$this->startWorkTime,'endWorkTime'=>$this->endWorkTime,'workTimes'=>json_encode($this->workTimes),'workDays'=>json_encode($this->workDays)]
            );
        }
        $this->currentDay="";
        $this->emit('showSuccessAlert','Barber details successfully updated!');
    }

    public $char="";
    public $weekDays;

    public function mount(){
        $this->weekDays=WeekDay::get();
    }

    public function render()
    {
        $barbers=Barber::where(DB::raw('CONCAT_WS(" ", firstName,lastName)'), 'LIKE','%' .$this->char.'%')->orWhere('email','like','%'.$this->char.'%')->orWhere('address','like','%'.$this->char.'%')->orWhere('phoneNumber','like','%'.$this->char.'%')->orderBy('id','desc')->paginate(10);
        return view('livewire.admin.pages.barbers',['barbers'=>$barbers]);
    }
}
