<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;

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


    public function updatenotification($id){
        $notifications = Notification::where('id',$id)->first();
        if($notifications->status == 0){
            $notifications->status = 1;
        } else{
            $notifications->status = 0;
        }
        $notifications->update();
        return redirect('notificaciones')->with('status', 'Notificación actualizada exitosamente.');
    }
}
