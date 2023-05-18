<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function __construct(){
        $this->middleware('can:ver notificaciones')->only('index','view');
    }

    public function index(){
        logo_sitio();
        secciones();
        
        $notifications = Notification::where('status','0')->get();
        $notificationsOld = Notification::where('status','1')->get();

        return view('admin.notification.index', compact('notifications','notificationsOld'));
    }

    public function view($id){
        $notifications = Notification::where('id',$id)->first();
        logo_sitio();
        secciones();

        return view('admin.notification.view', compact('notifications'));
    }

    public function updateorder(Request $request, $id){
        $notifications = Notification::find($id);
        $notifications->status = $request->input('notification_status');
        $notifications->update();
        
        return redirect('notificaciones')->with('status', 'Orden actualizada exitosamente.');
    }
}
