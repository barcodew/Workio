<?php

namespace App\Http\Controllers;

use App\Models\Perusahaan;
use Illuminate\Http\Request;

class PelamarPerusahaanController extends Controller {
    public function show( Perusahaan $perusahaan ) {
        // lowongan aktif perusahaan ini
        $lowongans = $perusahaan->lowongans()
        ->where( 'status', 'published' )
        ->latest()
        ->paginate( 6 );

        return view( 'guest.perusahaan.show', [
            'perusahaan' => $perusahaan,
            'lowongans'  => $lowongans,
        ] );
    }
}
