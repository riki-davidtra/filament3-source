<?php

namespace App\Filament\Pages;

use Filament\Forms;
use Filament\Pages\Page;
use Livewire\WithFileUploads;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class Settings extends Page implements Forms\Contracts\HasForms
{
    use WithFileUploads, Forms\Concerns\InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-cog';
    protected static string $view            = 'filament.pages.settings';
    protected static ?int $navigationSort     = 101;

    public $settings;
    public $items = [];

    public static function canAccess(): bool
    {
        return Auth::user()?->can('viewAny', \App\Models\Setting::class) ?? false;
    }

    public function mount(): void
    {
        $this->settings = Setting::with('settingItems')->orderBy('order')->get();

        foreach ($this->settings as $setting) {
            foreach ($setting->settingItems as $item) {
                $this->items[$item->id] = $item->value;
            }
        }

        $this->form->fill([
            'items' => $this->items,
        ]);
    }

    protected function getFormSchema(): array
    {
        $schema = [];

        foreach ($this->settings as $setting) {
            $settingFields = [];

            foreach ($setting->settingItems as $item) {
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
                        $field = Forms\Components\FileUpload::make("items.$id")
                            ->label($label)
                            ->disk('public')
                            ->directory('settings')
                            ->openable()
                            ->maxSize(2048)
                            ->deleteUploadedFileUsing(function ($file) use ($id) {
                                Storage::disk('public')->delete($file);
                                $item = \App\Models\SettingItem::find($id);
                                if ($item) {
                                    $item->value = null;
                                    $item->save();
                                }
                            });
                        break;
                    default:
                        continue 2;
                }

                $settingFields[] = $field;
            }

            if (!empty($settingFields)) {
                $schema[] = Forms\Components\Section::make($setting->name)
                    ->schema($settingFields);
            }
        }

        return $schema;
    }

    public function save(): void
    {
        $data = $this->form->getState();

        foreach ($this->settings as $setting) {
            foreach ($setting->settingItems as $item) {
                $itemId = $item->id;

                if (in_array($item->type, ['text', 'textarea', 'textarea_editor', 'url', 'number', 'email', 'color', 'file'])) {
                    $item->value = $data['items'][$itemId] ?? null;
                }

                $item->save();
            }
        }

        Notification::make()
            ->title('Succeed')
            ->body('Settings updated successfully.')
            ->success()
            ->send();
    }
}
