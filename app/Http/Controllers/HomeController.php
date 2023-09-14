<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;


class HomeController extends Controller
{
    public function index(){
        return redirect()->route('login');
    }
      public function __invoke()
      {
          if (Auth::user()->isAdmin())
          {
              return redirect()->route('admin-dashboard');
          }
          else if (Auth::user()->isCompany())
          {
              return redirect()->route('dashboard');
          }
          else if (Auth::user()->isIndividual())
          {
              return redirect()->route('dashboard');
          }
          else if (Auth::user()->isAgent())
          {
              return redirect()->route('agent-dashboard');
          }
      }

}