<?php

namespace App\Jawaban;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Event;

class NomorTiga {

    public function getData() {
        $data = Event::where('user_id', Auth::id())->get();
        return $data;
    }

    public function getSelectedData(Request $request) {
        $event = Event::where('id', $request->id)
                      ->where('user_id', Auth::id())
                      ->first();

        if ($event) {
            return response()->json($event);
        }

        return response()->json(['error' => 'Data tidak ditemukan'], 404);
    }

    public function update(Request $request) {
        $validated = $request->validate([
            'id' => 'required|exists:events,id',
            'name' => 'required|string|max:255',
            'start' => 'required|date',
            'end' => 'required|date|after:start_time',
        ]);
    
        $event = Event::where('id', $validated['id'])
                      ->where('user_id', Auth::id())
                      ->first();
    
        if (!$event) {
            return back()->withErrors(['error' => 'Event tidak ditemukan atau tidak diizinkan']);
        }
    
        $event->update([
            'name' => $validated['name'],
            'start' => $validated['end'],
            'end' => $validated['end_time'],
        ]);
    
        return redirect()->route('event.home')->with('success', 'Event berhasil diperbarui!');
    }    

    public function delete(Request $request) {
        $event = Event::where('id', $request->id)
                      ->where('user_id', Auth::id())
                      ->first();

        if (!$event) {
            return redirect()->route('event.home')->with('error', 'Event tidak ditemukan atau tidak diizinkan');
        }

        $event->delete();

        return redirect()->route('event.home')->with('success', 'Event berhasil dihapus');
    }
}
