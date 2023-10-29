<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\User;
use App\Models\Ticket;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    
    public function index()
    {

        $mostIncludedUser = User::select('name')->withCount('boards')->orderBy('boards_count','desc')->first();

        $topDoneBoards = DB::table('boards')
                            ->join('tickets','boards.id','tickets.board_id')
                            ->select('boards.id','boards.title'  )
                            ->selectRaw('count(tickets.id) as done_tickets')
                            ->selectRaw('0 as all_tickets')
                            ->groupBy('boards.id')
                            ->selectSub(function ($query) {
                                $query->from('tickets')
                                    ->whereColumn('tickets.board_id', 'boards.id')
                                    ->selectRaw('count(tickets.id)')
                                    ->latest()
                                    ->take(1);
                            }, 'all_tickets')
                            ->where('tickets.status','done')
                            ->orderBy('done_tickets','desc')
                            ->limit(3)->get();
                            
        $mostActivityBoard = DB::table('boards')
                            ->join('tickets','boards.id','tickets.board_id')
                            ->select('boards.title'  )
                            ->selectRaw('count(tickets.id) as marked_done_tickets')
                            ->whereBetween('marked_done', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                            ->groupBy('boards.id')
                            ->first();

        return Inertia::render('Dashboard',[
            'mostIncludedUser'  => $mostIncludedUser,
            'topDoneBoards'     => $topDoneBoards,
            'mostActivityBoard' => $mostActivityBoard
        ]);
    }

    
    
}