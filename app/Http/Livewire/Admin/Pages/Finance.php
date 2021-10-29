<?php

namespace App\Http\Livewire\Admin\Pages;

use App\Models\Wallet;
use App\Models\WalletReason;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Finance extends Component
{
    use WithPagination;
    protected $paginationTheme='bootstrap';

    public $isListPage=1;
    public $char="";
    public $Date="";
    public $reason="";
    public $type="";

    public function render()
    {
        $char=$this->char;
        $date=$this->Date;
        $reason=$this->reason;
        $type=$this->type;
        $reasons=WalletReason::orderBy('title')->get();
        $wallets=Wallet::leftJoin('wallet_reasons','wallet_reasons.id','=','wallets.reasonId')->leftJoin('users','users.id','=','wallets.userId')
            ->Where(function ($query) use ($char,$date,$reason,$type){
                $query->Where(function ($query) use ($char) {
                    $query->where(DB::raw('CONCAT_WS(" ", users.firstName,users.lastName)'), 'LIKE','%' .$char.'%')
                        ->orWhere('wallets.price','like','%'.$char.'%')
                        ->orWhere('wallets.trackingCode','like','%'.$char.'%');
                })->Where(function ($query) use ($date){
                    $query->orwhere('wallets.created_at','like','%'.$date.'%');
                })->Where(function ($query) use ($reason){
                    $query->orwhere('wallet_reasons.id','like','%'.$reason.'%');
                })->Where(function ($query) use ($type){
                    $query->orwhere('wallets.typeId','like','%'.$type.'%');
                });
            })->select('wallets.*','users.firstName','users.lastName','wallet_reasons.title as reason')->orderBy('wallets.id','desc')->paginate(10);

        $deposit=Wallet::where(['typeId'=>1,'status'=>1])->sum('price');
        $withdraw=Wallet::where(['typeId'=>0,'status'=>1])->sum('price');
        $total=$deposit-$withdraw;

        return view('livewire.admin.pages.finance',['wallets'=>$wallets,'reasons'=>$reasons,'total'=>$total]);
    }
}
