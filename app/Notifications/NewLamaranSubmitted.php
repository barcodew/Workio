<?php

namespace App\Notifications;

use App\Models\Lamaran;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class NewLamaranSubmitted extends Notification
 {
    use Queueable;

    public Lamaran $lamaran;

    public function __construct( Lamaran $lamaran )
 {
        $this->lamaran = $lamaran;
    }

    public function via( $notifiable ): array
 {
        // kalau mau simpan juga di tabel notifications, tambah 'database'
        return [ 'mail' ];
    }

    public function toMail( $notifiable ): MailMessage
 {
        $lowongan = $this->lamaran->lowongan;
        $pelamar  = $this->lamaran->user;
        // user pelamar

        $url = config( 'app.url' ) . '/perusahaan/lowongan/' . $lowongan->id . '/pelamar';

        return ( new MailMessage )
        ->subject( "Lamaran Baru – {$lowongan->judul}" )
        ->view( 'emails.lamaran-baru', [
            'user'     => $notifiable,   // user perusahaan
            'lamaran'  => $this->lamaran,
            'pelamar'  => $pelamar,
            'lowongan' => $lowongan,
            'url'      => $url,
        ] );
    }

    public function toArray( $notifiable ): array
 {
        $lowongan = $this->lamaran->lowongan;

        return [
            'type'        => 'lamaran_baru',
            'message'     => "Lamaran baru untuk {$lowongan->judul} dari {$this->lamaran->user->name}.",
            'lamaran_id'  => $this->lamaran->id,
            'lowongan_id' => $lowongan->id,
        ];
    }
}
