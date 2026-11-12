<?php

namespace App\Filament\Pages;

use App\Enums\NavigationGroup;
use App\Models\CompanySetting;
use Filament\Actions\Action;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Pages\Page;
use BackedEnum;
use UnitEnum;
use Illuminate\Contracts\Support\Htmlable;

class ManageCompanySettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-building-office-2';
    protected static UnitEnum|string|null $navigationGroup = NavigationGroup::ContentManagement;
    protected static ?int $navigationSort = 3;

    public function getView(): string
    {
        return 'filament.pages.manage-company-settings';
    }

    public ?array $data = [];

    public function getTitle(): string|Htmlable
    {
        return 'Company Settings';
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('saveHeader')
                ->label('Save Changes')
                ->icon('heroicon-m-check-circle')
                ->color('primary')
                ->action('save'),
        ];
    }

    public function mount(): void
    {
        $settings = CompanySetting::first();
        $this->form->fill($settings ? $settings->toArray() : []);
    }

    public function form($form)
    {
        return $form
            ->schema([
                Grid::make(['default' => 1, 'lg' => 3])
                    ->schema([
                        Grid::make(1)
                            ->columnSpan(['default' => 1, 'lg' => 2])
                            ->schema([
                                Section::make('Company Details')
                                    ->description('Primary address and description across different languages')
                                    ->icon('heroicon-o-building-office')
                                    ->schema([
                                        Tabs::make('Company Details Languages')
                                            ->tabs([
                                                Tab::make('English (en)')
                                                    ->schema([
                                                        Textarea::make('contact_section_desc.en')
                                                            ->label('Contact Section Description (EN)')
                                                            ->rows(3),
                                                        Textarea::make('address.en')
                                                            ->label('Store Address (EN)')
                                                            ->rows(3),
                                                    ]),

                                                Tab::make('العربية (ar)')
                                                    ->schema([
                                                        Textarea::make('contact_section_desc.ar')
                                                            ->label('وصف قسم الاتصال (AR)')
                                                            ->rows(3),
                                                        Textarea::make('address.ar')
                                                            ->label('عنوان المتجر (AR)')
                                                            ->rows(3),
                                                    ]),

                                                Tab::make('Français (fr)')
                                                    ->schema([
                                                        Textarea::make('contact_section_desc.fr')
                                                            ->label('Contact Section Description (FR)')
                                                            ->rows(3),
                                                        Textarea::make('address.fr')
                                                            ->label('Store Address (FR)')
                                                            ->rows(3),
                                                    ]),

                                                Tab::make('Türkçe (tr)')
                                                    ->schema([
                                                        Textarea::make('contact_section_desc.tr')
                                                            ->label('Contact Section Description (TR)')
                                                            ->rows(3),
                                                        Textarea::make('address.tr')
                                                            ->label('Store Address (TR)')
                                                            ->rows(3),
                                                    ]),

                                                Tab::make('한국어 (ko)')
                                                    ->schema([
                                                        Textarea::make('contact_section_desc.ko')
                                                            ->label('Contact Section Description (KO)')
                                                            ->rows(3),
                                                        Textarea::make('address.ko')
                                                            ->label('Store Address (KO)')
                                                            ->rows(3),
                                                    ]),
                                            ])
                                            ->columnSpanFull(),
                                    ]),

                                Section::make('Social Channels')
                                    ->description('Public social media profiles and channels')
                                    ->icon('heroicon-o-share')
                                    ->columns(2)
                                    ->schema([
                                        TextInput::make('facebook_url')
                                            ->label('Facebook URL')
                                            ->placeholder('https://facebook.com/your-page')
                                            ->prefixIcon('fab-facebook')
                                            ->url(),
                                        TextInput::make('linkedin_url')
                                            ->label('LinkedIn URL')
                                            ->placeholder('https://linkedin.com/company/your-company')
                                            ->prefixIcon('fab-linkedin')
                                            ->url(),
                                        TextInput::make('instagram_url')
                                            ->label('Instagram URL')
                                            ->prefixIcon('fab-instagram')
                                            ->url(),
                                        TextInput::make('whatsapp_number')
                                            ->label('WhatsApp Number')
                                            ->prefixIcon('si-whatsapp')
                                            ->tel(),
                                    ]),
                            ]),

                        Grid::make(1)
                            ->columnSpan(['default' => 1, 'lg' => 1])
                            ->schema([
                                Section::make('Contact Info')
                                    ->description('Phones and email addresses')
                                    ->icon('heroicon-o-phone')
                                    ->schema([
                                        TextInput::make('primary_phone')
                                            ->label('Primary Phone')
                                            ->prefixIcon('heroicon-m-phone'),
                                        TextInput::make('secondary_phone')
                                            ->label('Secondary Phone')
                                            ->prefixIcon('heroicon-m-phone'),
                                        TextInput::make('support_model')
                                            ->label('Support Email')
                                            ->prefixIcon('heroicon-m-envelope'),
                                        TextInput::make('career_email')
                                            ->label('Career Email')
                                            ->prefixIcon('heroicon-m-envelope'),
                                    ]),
                            ]),
                    ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();
        CompanySetting::updateOrCreate(['id' => 1], $data);

        Notification::make()
            ->title('Settings saved successfully')
            ->success()
            ->send();
    }
}
