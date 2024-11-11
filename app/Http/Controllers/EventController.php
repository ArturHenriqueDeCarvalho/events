<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return inertia('Dashboard', ['events' => $events]);
    }
    public function getTodayEvents()
    {
        $todayEvents = Event::whereDate('event_date', Carbon::today())->get();
        return response()->json($todayEvents);
    }
    public function store(Request $request)
    {
        // Validação dos dados recebidos
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'event_date' => 'required|date|after:today',
            'description' => 'required|string|max:1000',
            'image' => 'nullable|image|max:2048',
        ]);

        // Armazenar a imagem se estiver presente
        if ($request->hasFile('image')) {
            $validatedData['image_path'] = $request->file('image')->store('event_images', 'public');
        }

        // Criar o evento no banco de dados
        $event = Event::create($validatedData);

        return response()->json([
            'message' => 'Evento criado com sucesso!',
            'data' => $event,
        ], 201);
    }
}
