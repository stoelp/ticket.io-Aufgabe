<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventRequest;
use App\Models\Event;
use App\Models\Ticket;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::with('tickets')->get();
        return response()->json([
            'status' => true,
            'message' => 'Events loaded successfully!',
            'events' => $events
        ], 200);
    }

    public function store(EventRequest $request)
    {
        $event = Event::create($request->except('tickets'));
        $this->saveTickets($request, $event);
        return response()->json([
            'status' => true,
            'message' => 'Event saved successfully!',
            'event' => $event
        ], 200);
    }

    public function update(EventRequest $request, Event $event)
    {
        $event->update($request->except('tickets'));
        $this->saveTickets($request, $event);
        return response()->json([
            'status' => true,
            'message' => 'Event updated successfully!',
            'event' => $event
        ], 200);
    }

    public function destroy(Event $event)
    {
        foreach ($event->tickets as $ticket) {
            $ticket->delete();
        }
        $event->delete();
        return response()->json([
            'status' => true,
            'message' => 'Event deleted successfully!'
        ], 200);
    }

    public function show(Event $event)
    {
        $event->load('tickets');
        return response()->json([
            'status' => true,
            'message' => 'Event loaded successfully!',
            'event' => $event
        ], 200);
    }

    private function saveTickets(EventRequest $request, Event $event)
    {
        if ($request->get('tickets')) {
            $tickets = [];
            foreach ($request->get('tickets') as $ticket) {
                $tickets[] = new Ticket($ticket);
            }
            $event->tickets()->saveMany($tickets);
            $event->load('tickets');
        }
    }
}
