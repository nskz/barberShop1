<?php

namespace App\Http\Livewire\Admin;

use App\Models\Barber;
use App\Models\ContactUs;
use App\Models\ReservationList;
use App\Models\User;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $messages=ContactUs::count();
        $users=User::count();
        $barbers=Barber::count();
        $reservations=ReservationList::count();

        $ReservationList=ReservationList::leftJoin('booking_statuses as status','status.id','=','reservation_lists.status')->leftJoin('users as customer','customer.id','=','reservation_lists.userId')->leftJoin('users as barber','barber.id','=','reservation_lists.barberId')
            ->select('reservation_lists.*','status.title as statusTitle','customer.firstName as customerName','customer.lastName as customerFamily','customer.phoneNumber as customerPhoneNumber','barber.firstName as barberName','barber.lastName as barberFamily')->orderBy('reservation_lists.id','desc')->get()->take(10);

        return view('livewire.admin.index',['messages'=>$messages,'users'=>$users,'barbers'=>$barbers,'reservations'=>$reservations,'ReservationList'=>$ReservationList]);
    }
}
