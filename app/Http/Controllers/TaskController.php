<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
{
    return view('tasks.index'); // we will create this view next
}

}
