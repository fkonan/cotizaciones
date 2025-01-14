<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MailCotizaciones extends Mailable
{
   use Queueable, SerializesModels;

   public $cotizacion;
   public $pdf;
   /**
    * Create a new message instance.
    */
   public function __construct($cotizacion, $pdf)
   {
      $this->cotizacion = $cotizacion;
      $this->pdf = $pdf;
   }
   /**
    * Get the message envelope.
    */
   public function envelope(): Envelope
   {
      return new Envelope(
         subject: 'COTIZACIÓN PROHYGIENE'
      );
   }

   /**
    * Get the message content definition.
    */
   public function content(): Content
   {
      return new Content(
         view: 'emails.cotizacion',
         with: [
            'logo' => public_path('images/empresa/logo-header-es.svg') //poner ruta completa con hosting
         ],
      );
   }


   /**
    * Get the attachments for the message.
    *
    * @return array<int, \Illuminate\Mail\Mailables\Attachment>
    */
   public function attachments(): array
   {
      return [
         Attachment::fromPath(storage_path('app/public/' . $this->pdf))
            ->as('cotizacion_' . $this->cotizacion->id . '.pdf')
            ->withMime('application/pdf'),
      ];
   }
}
