<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\Support\Facades\Redirect;

class TicketController extends Controller
{

    function makeDone(Ticket $ticket)  {

        $ticket->update([
            'status' => 'done',
            'marked_done' => now()
        ]);

        return Redirect::route('boards.index')->with('success', 'Ticket updates.');

    }
}
