<?php

namespace App\Http\Controllers;

use App\Models\Lowongan;
use Illuminate\Http\Request;

class AdminLowonganController extends Controller
{
    public function index(Request $r)
    {
        $q = Lowongan::with('perusahaan')
            ->when($r->q, fn($x)=>$x->where(fn($w)=>$w
                ->where('judul','like',"%{$r->q}%")
                ->orWhere('deskripsi','like',"%{$r->q}%")))
            ->when($r->status, fn($x)=>$x->where('status',$r->status))
            ->latest('created_at');

        $lowongans = $q->paginate(15)->withQueryString();

        return view('admin.lowongan.index', compact('lowongans'));
    }

    public function updateStatus(Request $r, Lowongan $lowongan)
    {
        $data = $r->validate([
            'status' => 'required|in:draft,pending,published,closed',
        ]);
        $lowongan->update($data);

        return back()->with('ok', "Status lowongan diubah ke {$lowongan->status}.");
    }

    public function destroy(Lowongan $lowongan)
    {
        $lowongan->delete();
        return back()->with('ok','Lowongan dihapus.');
    }
}
