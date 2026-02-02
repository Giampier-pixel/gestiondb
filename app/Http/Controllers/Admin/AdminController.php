<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Evento;
use App\Http\Requests\Admin\AddEventoRequest;
use App\Models\User;
use App\Http\Requests\Admin\AddOrganizadorRequest;
use App\Http\Requests\Admin\AddPonenteRequest;
use App\Http\Requests\Admin\AddAsistenteRequest;
use App\Http\Requests\Admin\AddCertificadoBaseRequest;
use App\Models\Certificado;
use App\Models\Tipo;
use carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\ValidationException;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\OrganizadoresExport;
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
        $ponentes = $evento->ponentes()->withPivot('ponencia')->get();
        $asistentes = $evento->asistentes;
        $pre_registrados = $evento->pre_registrados;
        return view('admin.evento', [
            'evento' => $evento,
            'organizadores' => $organizadores,
            'ponentes' => $ponentes,
            'asistentes' => $asistentes,
            'pre_registrados' => $pre_registrados,
            'evento_id' => $evento_id   
            ]);
    }
    public function getAdd_Evento()
    {
        return view('admin.add_evento');
    }
    public function getAddCertificadoBase($evento_id)
    {
        return view('admin.add_certificado_base', ['evento_id' => $evento_id]);
    }
    public function postAddCertificadoBase(AddCertificadoBaseRequest $request, $evento_id)
    {
        $event = Evento::findOrFail($evento_id); 
        $ext = $request->base->extension();
        $name = strval($event->id) . "." . $ext;
        $request->base->storeAs('certificados', $name);
        $event->certificado_base = $name;
        $event->save();
        return redirect()->route('evento', ['evento_id' => $evento_id])->with('success', 'Certificado base subido exitosamente');
    }
    public function postAdd_Evento(AddEventoRequest $request)
    {
        $evento = Evento::create([
            'nombre' => $request->name,
            'fecha' => $request->fecha,
            'address' => $request->address ?? null,  // Operador null coalescing correcto
            'url' => $request->url,
        ]);
        
        return redirect()->route('dashboard')->with('success', 'Evento creado exitosamente');
    }
    public function getAddOrganizador($evento_id)
    {
        $users = User::select('paternal_surname', 'maternal_surname', 'name', 'id')->get();
        return view('admin.add_organizador', ['users' => $users]);
    }
    public function postAddOrganizador(AddOrganizadorRequest $request, $evento_id)
    {
        $evento = Evento::findOrFail($evento_id);
        
        // Verificar si el organizador ya existe en este evento
        $org = $evento->organizadores()->wherePivot('user_id', $request->organizador)->first();
        
        if (!$org) {  // ✅ Cambiado: Si NO existe, entonces lo agregamos
            $evento->organizadores()->attach([
                $request->organizador => ['tipo_id' => 4]  //
            ]);
        }
        
        return redirect()->route('evento', ['evento_id' => $evento_id]);
    }
    public function getAddPonente($evento_id)
    {
        $users = User::select('paternal_surname', 'maternal_surname', 'name', 'id')->get();
        return view('admin.add_ponente', ['evento_id' => $evento_id, 'users' => $users]);
    }
    public function postAddPonente(AddPonenteRequest $request, $evento_id)
    {
        $evento = Evento::findOrFail($evento_id);
        $ponente_id=(int) $request->ponente;
        $ponente = $evento->ponentes()->wherePivot('user_id', $ponente_id)->first();
        if (!$ponente) {  // Si NO existe, entonces lo agregamos
            $evento->ponentes()->attach([
                $ponente_id => ['tipo_id' => 3, 'ponencia' => $request->ponencia]
            ]);
        }
        
        return redirect()->route('evento', ['evento_id' => $evento_id]);
    }
    //Agregando asistente
    public function getAddAsistente($evento_id)
    {
        $users = User::select('paternal_surname', 'maternal_surname', 'name', 'id')->get();
        return view('admin.add_asistente', ['evento_id' => $evento_id, 'users' => $users]);
    }
    public function postAddAsistente(AddAsistenteRequest $request, $evento_id)
    {
        $evento = Evento::findOrFail($evento_id);
        $asistente_id=(int) $request->asistente;
        $asistente = $evento->asistentes()->wherePivot('user_id', $asistente_id)->first();
        if (!$asistente) {  // Si NO existe, entonces lo agregamos
            $evento->asistentes()->attach([
                $asistente_id => ['tipo_id' => 2]
            ]);
        }
        
        return redirect()->route('evento', ['evento_id' => $evento_id]);
    }
    //Terminando de agregar asistente
    public function certificados($evento_id)
    {
        $evento = Evento::findOrFail($evento_id);
        $organizadores = $evento->organizadores()->withPivot('certificado_creado')->get();
        $ponentes = $evento->ponentes()->withPivot('ponencia','certificado_creado')->get();
        $asistentes = $evento->asistentes()->withPivot('certificado_creado')->get();
        $certificados = $evento->certificados;
        return view('admin.certificados', [
            'evento' => $evento,
            'organizadores' => $organizadores,
            'ponentes' => $ponentes,
            'asistentes' => $asistentes,
            'evento_id' => $evento_id,
            'certificados' => $certificados
            ]);
    }
    public function generarCertificadoOrganizadores($evento_id)
    {
        // Lógica para generar certificados
        $evento = Evento::findOrFail($evento_id);
        $organizadores = $evento->organizadores()->wherePivot('certificado_creado', false)->get();
        foreach ($organizadores as $organizador) {
            Certificado::create([
                'tipo_id' => 4,
                'user_id' => $organizador->id,
                'evento_id' => $evento->id,
            ]);
            $evento->organizadores()->updateExistingPivot($organizador->id, ['certificado_creado' => true]);
        }
        return redirect()->route('admin-certificados', ['evento_id' => $evento_id]);
    }
    public function generarCertificadoAsistentes($evento_id)
    {
        // Lógica para generar certificados
        $evento = Evento::findOrFail($evento_id);
        $asistentes = $evento->asistentes()->wherePivot('certificado_creado', false)->get();
        foreach ($asistentes as $asistente) {
            Certificado::create([
                'tipo_id' => 2,
                'user_id' => $asistente->id,
                'evento_id' => $evento->id,
            ]);
            $evento->asistentes()->updateExistingPivot($asistente->id, ['certificado_creado' => true]);
        }
        return redirect()->route('admin-certificados', ['evento_id' => $evento_id]);
    }
    public function generarCertificadoPonentes($evento_id)
    {
        // Lógica para generar certificados
        $evento = Evento::findOrFail($evento_id);
        $ponentes = $evento->ponentes()->wherePivot('certificado_creado', false)->get();
        foreach ($ponentes as $ponente) {
            Certificado::create([
                'tipo_id' => 3,
                'user_id' => $ponente->id,
                'evento_id' => $evento->id,
            ]);
            $evento->ponentes()->updateExistingPivot($ponente->id, ['certificado_creado' => true]);
        }
        return redirect()->route('admin-certificados', ['evento_id' => $evento_id]);

    }
public function documento($certificado_id)
{
    $certificado = Certificado::findorFail($certificado_id);
    $evento = $certificado->evento;
    $fecha = Carbon::parse($evento->fecha);
    $tipo = $certificado->tipo;
    $user = $certificado->usuario;
    $meses= [
        "",
        'Enero',
        'Febrero',
        'Marzo',
        'Abril',
        'Mayo',
        'Junio',
        'Julio',
        'Agosto',
        'Septiembre',
        'Octubre',
        'Noviembre',
        'Diciembre'
    ];
    $dia = $fecha->day<10 ? '0'.$fecha->day : $fecha->day;
    $ruta = storage_path('app/private/certificados/' . $evento->certificado_base);
    $base64 = "data:image/png;base64," . base64_encode(file_get_contents($ruta));
    $url_certificado = route('documento', ['certificado_id' => $certificado->id]);
    
    // Generar código QR
    $qr_code = new QrCode(
        data: $url_certificado,
        encoding: new Encoding('UTF-8'),
        errorCorrectionLevel: ErrorCorrectionLevel::Low,
        size: 300,
        margin: 10,
        foregroundColor: new Color(0, 0, 0),
        backgroundColor: new Color(255, 255, 255)
    );
    
    $writer = new PngWriter();
    $result = $writer->write($qr_code);
    $qr_data = $result->getDataUri();
    
    $pdf = Pdf::loadView('admin.plantillas.certificado_academico', [
        'evento' => $evento,
        'base64' => $base64,
        'dia' => $dia,
        'mes' => $meses,
        'fecha' => $fecha,
        'user' => $user,
        'tipo' => $tipo,
        'qr_code' => $qr_data,          
        'url_certificado' => $url_certificado  
    ])->setPaper('a4', 'landscape')
      ->setOption('dpi', 150)
      ->setOption('image_dpi', 300);
      
    return $pdf->stream('certificado_'.$user->name.'_'.$evento->nombre.'.pdf');
}
    public function exportarOrganizadores($evento_id)
    {
        $evento = Evento::findOrFail($evento_id);
        $organizadores = $evento->organizadores()->select('paternal_surname', 'maternal_surname', 'name', 'email')->get();
        
        return Excel::download(new OrganizadoresExport($organizadores), 'organizadores.xlsx');
    }


}