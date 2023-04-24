<?php

namespace App\Http\Controllers\Admin;

Use App\Http\Controllers\Controller;
Use App\Models\Caretaker;
Use App\Models\Cat;
Use App\Models\Vet;
use Illuminate\Http\Request;
use Spatie\Searchable\Search;

class DashboardController extends Controller
{
    public function index()
    {
      //  $countCats = Cat::count();
      //  $countCaretaker = Caretaker::count();
      //  $countVet = Vet::count();
       // return view('admin.dashboard')->with([
       //     'countCats' => $countCats,
          //  'countCaretaker' => $countCaretaker,
          //  'countVet' => $countVet,
      //  ]);
      return view('admin.dashboard');
    }
}

