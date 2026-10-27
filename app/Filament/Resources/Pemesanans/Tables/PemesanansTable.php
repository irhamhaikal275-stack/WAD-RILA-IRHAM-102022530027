<?php

namespace App\Filament\Resources\Pemesanans\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PemesanansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')->label('Nama Pemesan')->searchable(),
                TextColumn::make('tanggal')->date('d M Y')->sortable(),
                TextColumn::make('jam')->time('H:i'),
                TextColumn::make('raket')->alignCenter(),
                TextColumn::make('sepatu')->alignCenter(),
                TextColumn::make('bola')->alignCenter(),
                TextColumn::make('total_bayar')->label('Total Bayar')
                    ->formatStateUsing(fn ($state) => 'Rp ' . number_format($state, 0, ',', '.'))
                    ->sortable(),
            ])
            ->defaultSort('id', 'desc')
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}