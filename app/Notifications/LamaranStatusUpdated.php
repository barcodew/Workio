<?php

namespace App\Notifications;

use App\Models\Lamaran;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class LamaranStatusUpdated extends Notification
{
    use Queueable;

    public Lamaran $lamaran;

    public function __construct(Lamaran $lamaran)
    {
        $this->lamaran = $lamaran;
    }

    public function via($notifiable): array
    {
        // kalau mau disimpan juga ke tabel notifications bawaan:
        // return ['mail', 'database'];
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        $lowongan = $this->lamaran->lowongan;
        $status   = $this->lamaran->status;

        $app_url = config('app.url');
        return (new MailMessage)
            ->subject("Status Lamaran: {$lowongan->judul}")
            ->view('emails.lamaran-status', [
                'user'     => $notifiable,
                'lamaran'  => $this->lamaran,
                'lowongan' => $lowongan,
                'status'   => $status,
                'url'      => $app_url.'/dashboard',
            ]);
    }

    // Kalau mau pakai database notifications bawaan Laravel:
    public function toArray($notifiable): array
    {
        $lowongan = $this->lamaran->lowongan;

        return [
            'type'       => 'status_lamaran',
            'message'    => "Status lamaran untuk {$lowongan->judul} menjadi {$this->lamaran->status}.",
            'lamaran_id' => $this->lamaran->id,
            'lowongan_id'=> $lowongan->id,
        ];
    }
}
