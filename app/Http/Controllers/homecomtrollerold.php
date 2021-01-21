<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Home\HomeRepositoryInterface as HomeRepo;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(HomeRepo $HomeRepo)
    {
        $this->middleware('auth');
        $this->HomeRepo = $HomeRepo;
    }

    /**
     * Show the application dashboard with polls data.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $polls = $this->HomeRepo->getPollLists();
        return view('home',compact('polls'));
    }
}
