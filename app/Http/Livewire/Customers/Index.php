<?php

namespace App\Http\Livewire\Customers;

use App\Models\ReservationList;
use App\Models\Wallet;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $deposit=Wallet::where(['userId'=>auth()->user()->id,'typeId'=>1,'status'=>1])->sum('price');
        $withdraw=Wallet::where(['userId'=>auth()->user()->id,'typeId'=>0,'status'=>1])->sum('price');
        $balance=$deposit-$withdraw;

        $reservations=ReservationList::where('userId',auth()->user()->id)->count();
        return view('livewire.customers.index',['reservations'=>$reservations,'balance'=>$balance]);
    }
}
