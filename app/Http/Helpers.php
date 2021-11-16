<?php 
namespace App\Http;
use App\Models\Store;
use App\Models\UserAssignedStore;
use Illuminate\Support\Facades\Auth;

class Helpers 
{
    public static function selected_store()
    {
        if (Auth::user()->id == 1) {
            $store = Store::where('selected', 1)->get();
            return $store[0];
        } else {
            $store = UserAssignedStore::where('userid', Auth::user()->id)
            ->join('stores', 'stores.id', '=', 'user_assigned_stores.storeid')
            ->select('storeid as id', 'stores.name as name')->get();
            return $store[0];
        }
    }

    public static function development()
    {
        return 'do';
    }

    public static function stores()
    {
        $store = Store::all();
        return $store;
    }
}

?>