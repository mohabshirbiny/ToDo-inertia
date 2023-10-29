<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\User;
use App\Models\Ticket;
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
            'boards' => Auth::user()->boards()->with(['tickets','workingTickets','doneTickets'])->get(),
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

        $board = Board::create([
            'title'=> Request::input('title'),
            'creator_id'=> Auth::user()->id,
        ]);

        $board->users()->attach(Request::input('users'));

        return Redirect::route('boards.index')->with('success', 'Board created.');

    }
    public function createTicket(Board $board)
    {
        return Inertia::render('Boards/Create-Ticket', [
            'board' => $board
        ]);

    }
    
    public function storeTicket(Board $board)
    {
        Request::validate([
            'title' => ['required', 'max:100'],
        ]);

        $board = Ticket::create([
            'title'=> Request::input('title'),
            'board_id'=> $board->id,
        ]);

        return Redirect::route('boards.index')->with('success', 'Ticket created.');

    }
    
}
