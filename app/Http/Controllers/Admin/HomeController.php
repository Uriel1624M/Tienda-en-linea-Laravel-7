<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;


class HomeController extends Controller
{
    //
    public function index(){

    	$orders=Order::where('estado','recibido')->count();

    	return  view('admin.home',compact('orders'));
    }
}
