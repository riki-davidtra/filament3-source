<?php

namespace App\Filament\Pages;

use Filament\Forms;
use Filament\Pages\Page;
use Livewire\WithFileUploads;
use App\Models\ConfigGroup;
use App\Models\ConfigItem;
use Illuminate\Support\Facades\Storage;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class Settings extends Page implements Forms\Contracts\HasForms
{
    use WithFileUploads, Forms\Concerns\InteractsWithForms;

    protected static ?string $navigationIcon  = 'heroicon-o-cog';
    protected static string $view             = 'filament.pages.settings';
    // protected static ?string $navigationGroup = 'Manajemen Pengaturan';
    protected static ?string $title           = 'Pengaturan';
    protected static ?string $navigationLabel = 'Pengaturan';
    protected static ?int $navigationSort     = 101;

    public $configGroups;
    public $items = [];
    public $files = [];

    public static function canAccess(): bool
    {
        return Auth::user()?->can('viewAny', \App\Models\ConfigGroup::class) ?? false;
    }

    public function mount(): void
    {
        $this->configGroups = ConfigGroup::with('configItems')->orderBy('order')->get();

        foreach ($this->configGroups as $group) {
            foreach ($group->configItems as $item) {
                $this->items[$item->id] = $item->value;

                if ($item->type === 'file' && $item->value_file) {
                    $this->files[$item->id] = $item->value_file;
                }
            }
        }

        $this->form->fill([
            'items' => $this->items,
        ]);
    }

    protected function getFormSchema(): array
    {
        $schema = [];

        foreach ($this->configGroups as $group) {
            $groupFields = [];

            foreach ($group->configItems as $item) {
                $id    = $item->id;
                $label = $item->name;

                switch ($item->type) {
                    case 'text':
                        $field = Forms\Components\TextInput::make("items.$id")
                            ->label($label);
                        break;
                    case 'textarea':
                        $field = Forms\Components\Textarea::make("items.$id")
                            ->label($label)
                            ->rows(5);
                        break;
                    case 'textarea_editor':
                        $field = Forms\Components\RichEditor::make("items.$id")
                            ->label($label)
                            ->toolbarButtons([]);
                        break;
                    case 'url':
                        $field = Forms\Components\TextInput::make("items.$id")
                            ->label($label)
                            ->url();
                        break;
                    case 'number':
                        $field = Forms\Components\TextInput::make("items.$id")
                            ->label($label)
                            ->numeric();
                        break;
                    case 'email':
                        $field = Forms\Components\TextInput::make("items.$id")
                            ->label($label)->email();
                        break;
                    case 'color':
                        $field = Forms\Components\ColorPicker::make("items.$id")
                            ->label($label);
                        break;
                    case 'file':
                        $field = Forms\Components\FileUpload::make("files.$id")
                            ->label($label)
                            ->disk('public')
                            ->directory('configs')
                            ->preserveFilenames()
                            ->openable()
                            ->maxSize(2048)
                            ->deleteUploadedFileUsing(function ($file) use ($id) {
                                Storage::disk('public')->delete($file);
                                $item = \App\Models\ConfigItem::find($id);
                                if ($item) {
                                    $item->value_file = null;
                                    $item->save();
                                }
                            });
                        break;
                    default:
                        continue 2;
                }

                $groupFields[] = $field;
            }

            if (!empty($groupFields)) {
                $schema[] = Forms\Components\Section::make($group->name)
                    ->schema($groupFields);
            }
        }

        return $schema;
    }

    public function save(): void
    {
        $data = $this->form->getState();

        foreach ($this->configGroups as $group) {
            foreach ($group->configItems as $item) {
                $itemId = $item->id;

                if (in_array($item->type, ['text', 'textarea', 'textarea_editor', 'url', 'number', 'email', 'color'])) {
                    $item->value = $data['items'][$itemId] ?? null;
                }

                if ($item->type === 'file' && isset($data['files'][$itemId])) {
                    $item->value_file = $data['files'][$itemId];
                }

                $item->save();
            }
        }

        Notification::make()
            ->title('Succeed')
            ->body('Pengaturan berhasil diperbarui.')
            ->success()
            ->send();
    }
}
