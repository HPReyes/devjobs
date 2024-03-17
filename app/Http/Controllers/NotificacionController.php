<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificacionController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $notificaciones = auth()->user()->unreadNotifications;

        auth()->user()->unreadNotifications->markAsRead();


        //se crea como invoke porque solo tiene un método, ya que solo queremos listar las notificaciones, no tenemos un crud ni nada por el estilo

        return view('notificaciones.index',
    [
        'notificaciones' => $notificaciones,
    ]);
    }
}
