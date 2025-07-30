// app/Http/Controllers/PelamarProfileController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PelamarProfileController extends Controller
{
    /**
     * Menampilkan form untuk mengedit profil pelamar.
     */
    public function edit()
    {
        $user = Auth::user(); // Mengambil data pengguna yang sedang login
        return view('pelamar.profile.edit', compact('user')); // Kirim data ke view
    }

    /**
     * Memperbarui data profil pelamar di database.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            // tambahkan validasi lain sesuai kebutuhan (misal: no_telp, alamat, dll)
        ]);

        // Update data pengguna
        $user->update($request->all());

        // Redirect kembali ke halaman profil dengan pesan sukses
        return redirect()->route('pelamar.profile.edit')->with('success', 'Profil berhasil diperbarui!');
    }
}