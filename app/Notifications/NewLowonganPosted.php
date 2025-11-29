<?php

namespace App\Notifications;

use App\Models\Lowongan;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class NewLowonganPosted extends Notification
{
    use Queueable;

    public Lowongan $lowongan;

    public function __construct(Lowongan $lowongan)
    {
        $this->lowongan = $lowongan;
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        $lowongan = $this->lowongan;
        $url      = route('jobs.show', $lowongan->id); // rute detail lowongan

        return (new MailMessage)
            ->subject("Lowongan Baru: {$lowongan->judul}")
            ->view('emails.new-lowongan', [
                'user'     => $notifiable,
                'lowongan' => $lowongan,
                'url'      => $url,
            ]);
    }
}
