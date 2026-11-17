<?php

use App\Models\Pemesanan;
use App\Models\User;
use Filament\Facades\Filament;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;

uses(RefreshDatabase::class);

beforeEach(function () {
    // Model Pemesanan memakai tabel 'pemesanan'
    if (! Schema::hasTable('pemesanan')) {
        Schema::create('pemesanan', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->date('tanggal');
            $table->time('jam');
            $table->unsignedInteger('raket')->default(0);
            $table->unsignedInteger('sepatu')->default(0);
            $table->unsignedInteger('bola')->default(0);
            $table->unsignedInteger('total_bayar')->default(0);
        });
    }

    $this->admin = User::factory()->create(['role' => User::ROLE_ADMIN]);
    $this->user = User::factory()->create(['role' => User::ROLE_USER]);

    $this->pemesanan = Pemesanan::create([
        'nama' => 'Budi',
        'tanggal' => '2026-11-01',
        'jam' => '10:00',
        'raket' => 1,
    ]);

    $this->payload = [
        'nama' => 'Siti',
        'tanggal' => '2026-11-02',
        'jam' => '11:00',
        'raket' => 1,
        'sepatu' => 0,
        'bola' => 0,
    ];
});

// ---------- Tamu ----------

it('mengarahkan tamu ke halaman login', function () {
    $this->get('/pemesanan-user')->assertRedirect('/login');
    $this->get('/pemesanan-user/data')->assertRedirect('/login');
    $this->post('/pemesanan-user', $this->payload)->assertRedirect('/login');
});

// ---------- User biasa ----------

it('mengizinkan user melihat dan menambah pemesanan', function () {
    $this->actingAs($this->user)->get('/pemesanan-user')->assertOk();
    $this->actingAs($this->user)->get('/pemesanan-user/data')->assertOk();

    $this->actingAs($this->user)
        ->post('/pemesanan-user', $this->payload)
        ->assertRedirect('/pemesanan-user/data');

    expect(Pemesanan::where('nama', 'Siti')->exists())->toBeTrue();
});

it('melarang user mengedit pemesanan', function () {
    $this->actingAs($this->user)
        ->get("/pemesanan-user/{$this->pemesanan->id}/edit")
        ->assertForbidden();

    $this->actingAs($this->user)
        ->put("/pemesanan-user/{$this->pemesanan->id}", $this->payload)
        ->assertForbidden();

    expect($this->pemesanan->fresh()->nama)->toBe('Budi');
});

it('melarang user menghapus pemesanan', function () {
    $this->actingAs($this->user)
        ->delete("/pemesanan-user/{$this->pemesanan->id}")
        ->assertForbidden();

    expect(Pemesanan::find($this->pemesanan->id))->not->toBeNull();
});

it('menyembunyikan tombol edit dan hapus dari user', function () {
    $this->actingAs($this->user)
        ->get('/pemesanan-user/data')
        ->assertDontSee('Hapus')
        ->assertDontSee('btn-edit');
});

it('melarang user masuk ke panel admin', function () {
    expect($this->user->canAccessPanel(Filament::getPanel('admin')))->toBeFalse();

    $this->actingAs($this->user)->get('/admin')->assertForbidden();
});

// ---------- Admin ----------

it('mengizinkan admin melakukan semua aksi pemesanan', function () {
    $this->actingAs($this->admin)
        ->get("/pemesanan-user/{$this->pemesanan->id}/edit")
        ->assertOk();

    $this->actingAs($this->admin)
        ->put("/pemesanan-user/{$this->pemesanan->id}", $this->payload)
        ->assertRedirect('/pemesanan-user/data');

    expect($this->pemesanan->fresh()->nama)->toBe('Siti');

    $this->actingAs($this->admin)
        ->delete("/pemesanan-user/{$this->pemesanan->id}")
        ->assertRedirect('/pemesanan-user/data');

    expect(Pemesanan::find($this->pemesanan->id))->toBeNull();
});

it('mengizinkan admin masuk ke panel admin', function () {
    expect($this->admin->canAccessPanel(Filament::getPanel('admin')))->toBeTrue();
});

// ---------- Login & register ----------

it('mengarahkan login sesuai role', function () {
    $this->post('/login', ['email' => $this->admin->email, 'password' => 'password'])
        ->assertRedirect('/admin');

    auth()->logout();

    $this->post('/login', ['email' => $this->user->email, 'password' => 'password'])
        ->assertRedirect('/pemesanan-user');
});

it('selalu membuat akun register sebagai user biasa', function () {
    $this->post('/register', [
        'name' => 'Hacker',
        'email' => 'hacker@example.com',
        'password' => 'password123',
        'password_confirmation' => 'password123',
        'role' => 'admin', // coba menyusup, harus diabaikan
    ])->assertRedirect('/pemesanan-user');

    expect(User::where('email', 'hacker@example.com')->first()->role)->toBe(User::ROLE_USER);
});
