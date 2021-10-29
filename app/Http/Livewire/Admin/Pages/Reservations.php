<?php

namespace App\Http\Livewire\Admin\Pages;

use App\Models\BookingStatus;
use App\Models\ReservationList;
use App\Models\User;
use App\Models\Wallet;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;


class Reservations extends Component
{
    use WithPagination;
    protected $paginationTheme='bootstrap';
    protected $listeners=[
        'returnPrepayment',
    ];

    public $isListPage=1;
    public $char="";
    public $bookingDate="";
    public $status="";
    public $bookingId;
    public $pageReserveId,$customerName,$bookingCode,$Bdate,$Btime,$phoneNumber,$barberName,$created_at,$Bstatus,$customerId;

    public function changeStatus($id,$statusId){
        ReservationList::where('id', $id)->update(
            ['status'=>$statusId]
        );
        $this->emit('showSuccessChangeStatusAlert','Status of selected row  successfully updated!');
    }

    public function details($id){
        $this->isListPage=3; //edit page
        $this->bookingId=$id;
        $data=ReservationList::leftJoin('booking_statuses as status','status.id','=','reservation_lists.status')->leftJoin('users as customer','customer.id','=','reservation_lists.userId')->leftJoin('users as barber','barber.id','=','reservation_lists.barberId')->select('reservation_lists.*','status.title as statusTitle','customer.firstName as customerName','customer.lastName as customerFamily','customer.phoneNumber as customerPhoneNumber','barber.firstName as barberName','barber.lastName as barberFamily')->where('reservation_lists.id',$id)->first();
        $this->customerId=$data->userId;
        $this->customerName=$data->customerName ." ".$data->customerFamily;
        $this->bookingCode=$data->reserveCode;
        $this->Bdate=$data->date;
        $this->Btime=$data->time;
        $this->phoneNumber=$data->customerPhoneNumber;
        $this->barberName=$data->barberName ." ".$data->barberFamily;
        $this->created_at=$data->created_at;
        $this->Bstatus=$data->status;
    }

    public function returnToListPage(){
        $this->isListPage=1; //list page
        if ($this->pageReserveId!=""){
            $this->pageReserveId="";
            return redirect()->to('admin/Reservations');
        }
    }

    public function returnPrepayment($id){
        $reserveRow=ReservationList::find($id);
        $rowCash=Wallet::where('userId',$reserveRow->userId)->get()->last();
        $newCash=$rowCash->cash + $reserveRow->prepayment;
        $data=new Wallet();
        $data->userId=$reserveRow->userId;
        $data->reservationId=$id;
        $data->price=$reserveRow->prepayment;
        $data->cash=$newCash;
        $data->typeId=1;
        $data->reasonId=2;//return prepayment
        $data->status=1;
        $data->barberShopId=1;
        $data->save();
        $this->emit('showSuccessAlert','Prepayment successfully returned!');
    }

    public function mount($id=""){
        if ($id !=""){
            $this->pageReserveId=$id;
            $this->details($id);
        }
    }

    public function render()
    {
        $statuses=BookingStatus::get();
        $char=$this->char;
        $date=$this->bookingDate;
        $status=$this->status;
        $values=ReservationList::leftJoin('booking_statuses as status','status.id','=','reservation_lists.status')->leftJoin('users as customer','customer.id','=','reservation_lists.userId')->leftJoin('users as barber','barber.id','=','reservation_lists.barberId')
            ->Where(function ($query) use ($char,$date,$status){
                $query->Where(function ($query) use ($char) {
                    $query->where(DB::raw('CONCAT_WS(" ", customer.firstName,customer.lastName)'), 'LIKE','%' .$char.'%')
                        ->orwhere(DB::raw('CONCAT_WS(" ", barber.firstName,barber.lastName)'), 'LIKE','%' .$char.'%')
                        ->orWhere('customer.phoneNumber','like','%'.$char.'%')
                        ->orWhere('reserveCode','like','%'.$char.'%');
                })->Where(function ($query) use ($date){
                    $query->orwhere('reservation_lists.date','like','%'.$date.'%');
                })->Where(function ($query) use ($status){
                    $query->orwhere('reservation_lists.status','like','%'.$status.'%');
                });
            })->select('reservation_lists.*','status.title as statusTitle','customer.firstName as customerName','customer.lastName as customerFamily','customer.phoneNumber as customerPhoneNumber','barber.firstName as barberName','barber.lastName as barberFamily')->orderBy('reservation_lists.id','desc')->paginate(10);
        return view('livewire.admin.pages.reservations',['values'=>$values,'statuses'=>$statuses]);
    }
}
