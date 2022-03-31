<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function countDiscount(){
        $dateNow   =   date("Y-m-d H:i");
        $discounts = DB::table('discounts')->where('date_end', '>=', $dateNow)->get();
        $count = count($discounts);
        return view('admin.partials.dashboard', compact('count'));
    }
}
