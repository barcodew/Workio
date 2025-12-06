<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminUserController extends Controller {
    public function index( Request $r ) {
        $q    = $r->input( 'q' );
        $role = $r->input( 'role' );

        $users = User::query()
        ->when( request( 'q' ), fn( $q, $v )=>$q->where( fn( $x )=>$x->where( 'name', 'like', "%$v%" )->orWhere( 'email', 'like', "%$v%" ) ) )
        ->when( request( 'role' ), fn( $q, $v )=>$q->where( 'role', $v ) )
        ->orderByDesc( 'created_at' )
        ->paginate( 10 );

        return view( 'admin.pengguna.index', compact( 'users' ) );
    }

    public function updateRole( Request $r, User $user ) {
        $data = $r->validate( [ 'role' => 'required|in:pelamar,perusahaan,admin' ] );
        $user->update( $data );

        return back()->with( 'ok', "Role {$user->name} diubah ke {$user->role}." );
    }

    public function resetPassword( User $user ) {
        $new = Str::password( 10 );
        $user->update( [ 'password' => Hash::make( $new ) ] );
        // Catatan: kamu bisa kirim ke email di sini jika Mail disetup
        // Mail::to( $user->email )->queue( new PasswordResetMail( $new ) );

        return back()->with( 'ok', "Password baru untuk {$user->email}: {$new}" );
    }

    public function destroy( User $user ) {
        // Opsional: cegah hapus diri sendiri ( admin aktif )
        if ( auth()->id() === $user->id ) {
            return back()->with( 'err', 'Tidak bisa menghapus akun sendiri.' );
        }
        $user->delete();
        return back()->with( 'ok', 'Pengguna dihapus.' );
    }
}
