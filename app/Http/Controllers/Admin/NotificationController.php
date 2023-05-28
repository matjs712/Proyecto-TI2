<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\Ingrediente;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:ver notificaciones')->only('index', 'view');
    }

    public function index()
    {
        logo_sitio();
        secciones();

        $notifications = Notification::where('status', '0')->get();
        $notificationsOld = Notification::where('status', '1')->get();

        return view('admin.notification.index', compact('notifications', 'notificationsOld'));
    }

    public function view($id)
    {
        $notifications = Notification::where('id', $id)->first();
        logo_sitio();
        secciones();

        return view('admin.notification.view', compact('notifications'));
    }

    public function notificacionajax()
    {
        $notifications = Notification::where('status', 0)->latest()->pluck('tipo', 'detalle')->take(5);
        $count = Notification::where('status', 0)->count();

        if ($count > 5) {
            $remainingCount = $count - 5;
            $notifications['+'] = $remainingCount;
        }

        return response()->json($notifications);
    }

    public function notificacioningredientes()
    {
        $ingredientes = Ingrediente::where('cantidad', '<=', 500)->pluck('name', 'cantidad');
        return response()->json($ingredientes);
    }

    public function updatenotification($id)
    {
        $notifications = Notification::where('id', $id)->first();
        if ($notifications->status == 0) {
            $notifications->status = 1;
        } else {
            $notifications->status = 0;
        }
        $notifications->update();
        return redirect('notificaciones')->with('status', 'Notificación actualizada exitosamente.');
    }
    public function actualizarNotificaciones(Request $request)
    {
        $ids = $request->input('ids');

        // Actualizar el estado de las notificaciones seleccionadas
        Notification::whereIn('id', $ids)->update(['status' => 1]);

        // Realizar cualquier otra acción o devolver una respuesta

        return response()->json(['message' => 'Notificaciones actualizadas correctamente.']);
    }
}