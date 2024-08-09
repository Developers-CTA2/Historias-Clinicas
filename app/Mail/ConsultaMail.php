<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConsultaMail extends Mailable
{
    use Queueable, SerializesModels;

    public $cita;

    /**
     * Create a new message instance.
     */
    public function __construct($cita)
    {
        $this->cita = $cita;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->view('mail.Consulta')
                    ->with([
                        'nombre' => $this->cita->nombre,
                        'fecha' => $this->cita->fecha,
                        'hora' => $this->cita->hora,
                        'tipo_profesional' => $this->cita->tipo_profesional,
                        'motivo' => $this->cita->motivo,
                        'telefono' => $this->cita->telefono,
                        'email' => $this->cita->email,
                    ]);
    }
}

