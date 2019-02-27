<?php

namespace App\Http\Controllers\admin\index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    //首页展示
    public function index()
    {
    	return view('admin.index.index');
    }
}
