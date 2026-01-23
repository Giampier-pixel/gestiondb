<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Evento;

class AdminController extends Controller
{
    public function getdashboard()
    {
        $eventos = Evento::orderBy('fecha', 'desc')->get();
        
        return view('admin.dashboard', ['eventos' => $eventos]);
    }
    public function evento ($evento_id)
    {
        $evento = Evento::findOrFail($evento_id);
        $organizadores = $evento->organizadores;
        $ponentes = $evento->ponentes;
        $asistentes = $evento->asistentes;
        $pre_registrados = $evento->pre_registrados;
        return view('admin.evento', [
            'evento' => $evento,
            'organizadores' => $organizadores,
            'ponentes' => $ponentes,
            'asistentes' => $asistentes,
            'pre_registrados' => $pre_registrados
            ]);
    }
}