<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
class BoardController extends Controller
{
    
    public function index()
    {
        return Inertia::render('Boards/Index', [
            'boards' => Auth::user()->boards
        ]);
    }

    public function create()
    {
        return Inertia::render('Boards/Create', [
            'users' => User::all()
        ]);
    }
    
    public function store()
    {
        Request::validate([
            'title' => ['required', 'max:100'],
            'users' => ['required', 'array'],
            'users.*' => ['required'],
        ]);
        // dd(request()->all());

        $board = Board::create([
            'title'=> Request::input('title'),
            'creator_id'=> Auth::user()->id,
        ]);

        $board->users()->attach(Request::input('users'));

        return Redirect::route('boards.index')->with('success', 'Board created.');

    }
    public function createTicket(Board $board)
    {
        return Inertia::render('Boards/Create');

    }
    
    public function storeTicket(Board $board)
    {
        Request::validate([
            'title' => ['required', 'max:100'],
        ]);

        dd(request()->all());

        $board = Board::create([
            'title'=> Request::input('title'),
            'creator_id'=> Auth::user()->id,
        ]);

        $board->users()->attach(Request::input('users'));

        return Redirect::route('boards.index')->with('success', 'Board created.');

    }
    
}
