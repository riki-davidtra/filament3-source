<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FornasRegistrationResource\Pages;
use App\Filament\Resources\FornasRegistrationResource\RelationManagers;
use App\Models\FornasRegistration;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Schemas\FornasParticipantSchema;
use Illuminate\Support\Facades\Auth;

class FornasRegistrationResource extends Resource
{
    protected static ?string $model = FornasRegistration::class;

    protected static ?string $navigationIcon   = 'heroicon-o-document-text';
    protected static ?string $navigationGroup  = 'Manajemen FORNAS';
    protected static ?string $navigationLabel  = 'Pendaftaran';
    protected static ?string $pluralModelLabel = 'Daftar Pendaftaran';
    protected static ?string $modelLabel       = 'Pendaftaran';
    protected static ?int $navigationSort      = 32;

    public static function getNavigationBadge(): ?string
    {
        $query = static::getModel()::whereIn('status', ['Menunggu', 'Diproses']);

        if (!Auth::user()->hasAnyRole(['Super Admin', 'Admin'])) {
            $query->where('user_id', Auth::id());
        }

        return (string) $query->count();
    }
    protected static ?string $navigationBadgeTooltip = 'Jumlah pendaftar yang menunggu verifikasi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('fornas_event_id')
                    ->label('FORNAS')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->relationship('fornasEvent', 'title', function ($query) {
                        $query->orderBy('title', 'asc');
                    }),
                Forms\Components\Select::make('kormi_id')
                    ->label('KORMI')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->relationship('kormi', 'name', function ($query) {
                        $query->orderBy('name', 'asc');
                    }),
                Forms\Components\TextInput::make('penanggung_jawab')
                    ->label('Penanggung Jawab')
                    ->required()
                    ->string()
                    ->maxLength(255),
                Forms\Components\TextInput::make('no_hp')
                    ->label('No HP')
                    ->required()
                    ->tel()
                    ->maxLength(20),

                Forms\Components\Fieldset::make('Status Pendaftaran')
                    ->schema([
                        Forms\Components\Radio::make('status')
                            ->label('Status')
                            ->required()
                            ->options([
                                'Menunggu'      => 'Menunggu',
                                'Diproses'      => 'Diproses',
                                'Terverifikasi' => 'Terverifikasi',
                                'Tidak Lengkap' => 'Tidak Lengkap',
                                'Ditolak'       => 'Ditolak',
                            ])
                            ->reactive()
                            ->afterStateUpdated(function (callable $set) {
                                $set('catatan', null);
                            })
                            ->disabled(fn() => !Auth::user()->hasAnyRole(['Super Admin', 'admin'])),
                        Forms\Components\Textarea::make('catatan')
                            ->label('Catatan')
                            ->nullable()
                            ->string()
                            ->maxLength(3000)
                            ->columnSpanFull()
                            ->reactive()
                            ->disabled(fn() => !Auth::user()->hasAnyRole(['Super Admin', 'admin'])),
                    ])
                    ->visible(function (string $context): bool {
                        return $context === 'edit';
                    }),

                \Filament\Forms\Components\Repeater::make('fornasParticipants')
                    ->label('Peserta')
                    ->relationship('fornasParticipants')
                    ->schema(FornasParticipantSchema::form())
                    ->columns(2)
                    ->columnSpanFull()
                    ->createItemButtonLabel('Tambah Peserta')
                    ->visible(fn(string $context): bool => $context === 'create'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                if (!Auth::user()->hasAnyRole(['Super Admin', 'Admin'])) {
                    $query->where('user_id', Auth::id());
                }
            })
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('fornasEvent.title')
                    ->label('FORNAS')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('kormi.name')
                    ->label('KORMI')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('penanggung_jawab')
                    ->label('Penanggung Jawab')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('no_hp')
                    ->label('No HP')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status Pendaftaran')
                    ->sortable()
                    ->searchable()
                    ->badge()
                    ->color(function ($state) {
                        return match ($state) {
                            'Menunggu'      => 'warning',
                            'Diproses'      => 'primary',
                            'Terverifikasi' => 'success',
                            'Tidak Lengkap' => 'warning',
                            'Ditolak'       => 'danger',
                            default         => 'gray',
                        };
                    })
                    ->tooltip('Lihat Detail')
                    ->action(
                        \Filament\Tables\Actions\Action::make('detail_status_registrasi')
                            ->label('Detail Status Pendaftaran')
                            ->modalWidth('md')
                            ->modalSubmitAction(false)
                            ->modalCancelAction(false)
                            ->modalCloseButton()
                            ->button()
                            ->modalContent(function ($record) {
                                $catatan = $record->catatan;
                                return new \Illuminate\Support\HtmlString("
                                    <div>
                                        <h3>Status: {$record->status}</h3>" .
                                    (!empty($catatan) ? "<p>Catatan: {$catatan}</p>" : "") . "
                                    </div>
                                ");
                            })
                    ),
                \Filament\Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->sortable()
                    ->searchable()
                    ->dateTime()
                    ->since()
                    ->dateTimeTooltip()
                    ->toggleable(isToggledHiddenByDefault: true),
                \Filament\Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->sortable()
                    ->searchable()
                    ->dateTime()
                    ->since()
                    ->dateTimeTooltip()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->visible(function ($record): bool {
                        if (Auth::user()->hasAnyRole(['Super Admin', 'admin'])) {
                            return true;
                        }
                        return $record->status === 'Tidak Lengkap';
                    })
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\FornasParticipantsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListFornasRegistrations::route('/'),
            'create' => Pages\CreateFornasRegistration::route('/create'),
            'edit'   => Pages\EditFornasRegistration::route('/{record}/edit'),
        ];
    }
}
