<?php

namespace App\Policies;

use App\Models\Pemesanan;
use App\Models\User;

/**
 * Hak akses modul Pemesanan.
 *
 * | Fitur  | Admin | User  |
 * |--------|-------|-------|
 * | Lihat  |  ya   |  ya   |
 * | Tambah |  ya   |  ya   |
 * | Edit   |  ya   | tidak |
 * | Hapus  |  ya   | tidak |
 *
 * Policy ini otomatis dipakai oleh Filament (panel admin)
 * dan oleh Gate::authorize() di PemesananUserController.
 */
class PemesananPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Pemesanan $pemesanan): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Pemesanan $pemesanan): bool
    {
        return true;
    }

    public function delete(User $user, Pemesanan $pemesanan): bool
    {
        return true;
    }

    public function deleteAny(User $user): bool
    {
        return true;
    }
}
