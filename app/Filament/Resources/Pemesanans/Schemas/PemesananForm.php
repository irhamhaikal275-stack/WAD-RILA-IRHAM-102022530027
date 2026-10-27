<?php

namespace App\Filament\Resources\Pemesanans\Schemas;

use App\Models\Pemesanan;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

class PemesananForm
{
    public static function configure(Schema $schema): Schema
    {
        $hitungTotal = function (Get $get, Set $set): void {
            $jumlah = (int) $get('raket') + (int) $get('sepatu') + (int) $get('bola');
            $set('total_bayar', $jumlah * Pemesanan::HARGA_PER_ALAT);
        };

        return $schema->components([
            Section::make('Data Pemesan')
                ->schema([
                    TextInput::make('nama')->label('Nama')->required()->maxLength(255),
                    DatePicker::make('tanggal')->required(),
                    TimePicker::make('jam')->seconds(false)->required(),
                ])
                ->columns(3),

            Section::make('Alat yang Disewa')
                ->description('Harga Rp 25.000 per alat')
                ->schema([
                    TextInput::make('raket')->label('Raket Badminton')
                        ->numeric()->minValue(0)->default(0)->required()
                        ->live(onBlur: true)->afterStateUpdated($hitungTotal),
                    TextInput::make('sepatu')->label('Sepatu Futsal')
                        ->numeric()->minValue(0)->default(0)->required()
                        ->live(onBlur: true)->afterStateUpdated($hitungTotal),
                    TextInput::make('bola')->label('Bola Futsal')
                        ->numeric()->minValue(0)->default(0)->required()
                        ->live(onBlur: true)->afterStateUpdated($hitungTotal),
                    TextInput::make('total_bayar')->label('Total Bayar')
                        ->prefix('Rp')->numeric()->default(0)
                        ->readOnly()->dehydrated(false),
                ])
                ->columns(4),
        ]);
    }
}