<?php

namespace App\Filament\Resources\AboutUs\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Fieldset;
use Filament\Forms\Components\Repeater;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;

use Filament\Schemas\Schema;

class AboutUsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('General Information & Content')
                    ->description('Manage page title and intro paragraphs in all supported languages.')
                    ->collapsible()
                    ->columnSpanFull()
                    ->schema([
                        Tabs::make('General Info Translations')
                            ->tabs([
                                Tab::make('English (en)')
                                    ->icon('heroicon-o-language')
                                    ->schema([
                                        TextInput::make('title.en')
                                            ->label('Page Header / Title (EN)')
                                            ->prefixIcon('heroicon-o-academic-cap')
                                            ->placeholder('e.g. Building the Future of Shopping')
                                            ->maxLength(255)
                                            ->columnSpanFull(),

                                        RichEditor::make('paragraph_1.en')
                                            ->label('First Paragraph (Intro & Story) (EN)')
                                            ->toolbarButtons([
                                                'attachFiles',
                                                'blockquote',
                                                'bold',
                                                'bulletList',
                                                'codeBlock',
                                                'h2',
                                                'h3',
                                                'italic',
                                                'link',
                                                'orderedList',
                                                'redo',
                                                'strike',
                                                'underline',
                                                'undo',
                                            ])
                                            ->columnSpanFull(),

                                        RichEditor::make('paragraph_2.en')
                                            ->label('Second Paragraph (Mission & Philosophy) (EN)')
                                            ->toolbarButtons([
                                                'attachFiles',
                                                'blockquote',
                                                'bold',
                                                'bulletList',
                                                'codeBlock',
                                                'h2',
                                                'h3',
                                                'italic',
                                                'link',
                                                'orderedList',
                                                'redo',
                                                'strike',
                                                'underline',
                                                'undo',
                                            ])
                                            ->columnSpanFull(),
                                    ]),

                                Tab::make('العربية (ar)')
                                    ->icon('heroicon-o-language')
                                    ->schema([
                                        TextInput::make('title.ar')
                                            ->label('عنوان الصفحة (AR)')
                                            ->prefixIcon('heroicon-o-academic-cap')
                                            ->placeholder('مثال: بناء مستقبل التسوق')
                                            ->maxLength(255)
                                            ->columnSpanFull(),

                                        RichEditor::make('paragraph_1.ar')
                                            ->label('الفقرة الأولى (القصة والبداية) (AR)')
                                            ->toolbarButtons([
                                                'attachFiles',
                                                'blockquote',
                                                'bold',
                                                'bulletList',
                                                'codeBlock',
                                                'h2',
                                                'h3',
                                                'italic',
                                                'link',
                                                'orderedList',
                                                'redo',
                                                'strike',
                                                'underline',
                                                'undo',
                                            ])
                                            ->columnSpanFull(),

                                        RichEditor::make('paragraph_2.ar')
                                            ->label('الفقرة الثانية (المهمة والفلسفة) (AR)')
                                            ->toolbarButtons([
                                                'attachFiles',
                                                'blockquote',
                                                'bold',
                                                'bulletList',
                                                'codeBlock',
                                                'h2',
                                                'h3',
                                                'italic',
                                                'link',
                                                'orderedList',
                                                'redo',
                                                'strike',
                                                'underline',
                                                'undo',
                                            ])
                                            ->columnSpanFull(),
                                    ]),

                                Tab::make('Türkçe (tr)')
                                    ->icon('heroicon-o-language')
                                    ->schema([
                                        TextInput::make('title.tr')
                                            ->label('Sayfa Başlığı (TR)')
                                            ->prefixIcon('heroicon-o-academic-cap')
                                            ->placeholder('Örn. Alışverişin Geleceğini İnşa Ediyoruz')
                                            ->maxLength(255)
                                            ->columnSpanFull(),

                                        RichEditor::make('paragraph_1.tr')
                                            ->label('Birinci Paragraf (TR)')
                                            ->toolbarButtons([
                                                'attachFiles',
                                                'blockquote',
                                                'bold',
                                                'bulletList',
                                                'codeBlock',
                                                'h2',
                                                'h3',
                                                'italic',
                                                'link',
                                                'orderedList',
                                                'redo',
                                                'strike',
                                                'underline',
                                                'undo',
                                            ])
                                            ->columnSpanFull(),

                                        RichEditor::make('paragraph_2.tr')
                                            ->label('İkinci Paragraf (TR)')
                                            ->toolbarButtons([
                                                'attachFiles',
                                                'blockquote',
                                                'bold',
                                                'bulletList',
                                                'codeBlock',
                                                'h2',
                                                'h3',
                                                'italic',
                                                'link',
                                                'orderedList',
                                                'redo',
                                                'strike',
                                                'underline',
                                                'undo',
                                            ])
                                            ->columnSpanFull(),
                                    ]),

                                Tab::make('한국어 (ko)')
                                    ->icon('heroicon-o-language')
                                    ->schema([
                                        TextInput::make('title.ko')
                                            ->label('페이지 제목 (KO)')
                                            ->prefixIcon('heroicon-o-academic-cap')
                                            ->placeholder('예: 쇼핑의 미래 구축')
                                            ->maxLength(255)
                                            ->columnSpanFull(),

                                        RichEditor::make('paragraph_1.ko')
                                            ->label('첫 번째 단락 (KO)')
                                            ->toolbarButtons([
                                                'attachFiles',
                                                'blockquote',
                                                'bold',
                                                'bulletList',
                                                'codeBlock',
                                                'h2',
                                                'h3',
                                                'italic',
                                                'link',
                                                'orderedList',
                                                'redo',
                                                'strike',
                                                'underline',
                                                'undo',
                                            ])
                                            ->columnSpanFull(),

                                        RichEditor::make('paragraph_2.ko')
                                            ->label('두 번째 단락 (KO)')
                                            ->toolbarButtons([
                                                'attachFiles',
                                                'blockquote',
                                                'bold',
                                                'bulletList',
                                                'codeBlock',
                                                'h2',
                                                'h3',
                                                'italic',
                                                'link',
                                                'orderedList',
                                                'redo',
                                                'strike',
                                                'underline',
                                                'undo',
                                            ])
                                            ->columnSpanFull(),
                                    ]),

                                Tab::make('Français (fr)')
                                    ->icon('heroicon-o-language')
                                    ->schema([
                                        TextInput::make('title.fr')
                                            ->label('Titre de la page (FR)')
                                            ->prefixIcon('heroicon-o-academic-cap')
                                            ->placeholder('Ex. Construire le futur du shopping')
                                            ->maxLength(255)
                                            ->columnSpanFull(),

                                        RichEditor::make('paragraph_1.fr')
                                            ->label('Premier paragraphe (FR)')
                                            ->toolbarButtons([
                                                'attachFiles',
                                                'blockquote',
                                                'bold',
                                                'bulletList',
                                                'codeBlock',
                                                'h2',
                                                'h3',
                                                'italic',
                                                'link',
                                                'orderedList',
                                                'redo',
                                                'strike',
                                                'underline',
                                                'undo',
                                            ])
                                            ->columnSpanFull(),

                                        RichEditor::make('paragraph_2.fr')
                                            ->label('Deuxième paragraphe (FR)')
                                            ->toolbarButtons([
                                                'attachFiles',
                                                'blockquote',
                                                'bold',
                                                'bulletList',
                                                'codeBlock',
                                                'h2',
                                                'h3',
                                                'italic',
                                                'link',
                                                'orderedList',
                                                'redo',
                                                'strike',
                                                'underline',
                                                'undo',
                                            ])
                                            ->columnSpanFull(),
                                    ]),
                            ])
                            ->columnSpanFull(),
                    ]),

                Section::make('Media & Video')
                    ->description('Manage store cover banner and promotional video URL.')
                    ->icon('heroicon-o-photo')
                    ->collapsible()
                    ->columnSpanFull()
                    ->schema([
                        FileUpload::make('image')
                            ->label('Featured Brand Image')
                            ->disk('public')
                            ->directory('about-us')
                            ->image()
                            ->openable()
                            ->downloadable()
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '16:9',
                                '21:9',
                                '4:3',
                            ])
                            ->panelLayout('integrated')
                            ->maxSize(5120)
                            ->columnSpanFull(),

                        TextInput::make('video_url')
                            ->label('Video URL (YouTube / Vimeo)')
                            ->prefixIcon('heroicon-o-video-camera')
                            ->suffixIcon('heroicon-o-link')
                            ->placeholder('https://www.youtube.com/watch?v=...')
                            ->helperText('Paste the full video URL to embed it on your frontend About Us page.')
                            ->url()
                            ->columnSpanFull(),
                    ]),

                Section::make('Team Section')
                    ->description('Manage team section headers in all languages and list team members.')
                    ->icon('heroicon-o-users')
                    ->collapsible()
                    ->columnSpanFull()
                    ->schema([
                        Tabs::make('Team Header Translations')
                            ->tabs([
                                Tab::make('English (en)')
                                    ->icon('heroicon-o-language')
                                    ->schema([
                                        TextInput::make('team_title.en')
                                            ->label('Section Main Title (EN)')
                                            ->prefixIcon('heroicon-o-chat-bubble-bottom-center-text')
                                            ->placeholder('e.g. Meet Our Creative Team')
                                            ->maxLength(255),

                                        TextInput::make('team_description.en')
                                            ->label('Section Subtitle (EN)')
                                            ->prefixIcon('heroicon-o-bars-3-bottom-left')
                                            ->placeholder('e.g. The passionate people behind our store...')
                                            ->maxLength(255),
                                    ]),

                                Tab::make('العربية (ar)')
                                    ->icon('heroicon-o-language')
                                    ->schema([
                                        TextInput::make('team_title.ar')
                                            ->label('عنوان القسم الرئيسي (AR)')
                                            ->prefixIcon('heroicon-o-chat-bubble-bottom-center-text')
                                            ->placeholder('مثال: تعرف على فريقنا المبدع')
                                            ->maxLength(255),

                                        TextInput::make('team_description.ar')
                                            ->label('وصف القسم الفرعي (AR)')
                                            ->prefixIcon('heroicon-o-bars-3-bottom-left')
                                            ->placeholder('مثال: الأشخاص الشغوفون خلف متجرنا...')
                                            ->maxLength(255),
                                    ]),

                                Tab::make('Türkçe (tr)')
                                    ->icon('heroicon-o-language')
                                    ->schema([
                                        TextInput::make('team_title.tr')
                                            ->label('Ekip Başlığı (TR)')
                                            ->prefixIcon('heroicon-o-chat-bubble-bottom-center-text')
                                            ->placeholder('Örn. Ekibimizle Tanışın')
                                            ->maxLength(255),

                                        TextInput::make('team_description.tr')
                                            ->label('Ekip Açıklaması (TR)')
                                            ->prefixIcon('heroicon-o-bars-3-bottom-left')
                                            ->placeholder('Örn. Mağazamızın arkasındaki tutkulu insanlar...')
                                            ->maxLength(255),
                                    ]),

                                Tab::make('한국어 (ko)')
                                    ->icon('heroicon-o-language')
                                    ->schema([
                                        TextInput::make('team_title.ko')
                                            ->label('팀 제목 (KO)')
                                            ->prefixIcon('heroicon-o-chat-bubble-bottom-center-text')
                                            ->placeholder('예: 크리에이티브 팀 소개')
                                            ->maxLength(255),

                                        TextInput::make('team_description.ko')
                                            ->label('팀 부제목 (KO)')
                                            ->prefixIcon('heroicon-o-bars-3-bottom-left')
                                            ->placeholder('예: 우리 매장을 만드는 열정적인 사람들...')
                                            ->maxLength(255),
                                    ]),

                                Tab::make('Français (fr)')
                                    ->icon('heroicon-o-language')
                                    ->schema([
                                        TextInput::make('team_title.fr')
                                            ->label('Titre de l\'équipe (FR)')
                                            ->prefixIcon('heroicon-o-chat-bubble-bottom-center-text')
                                            ->placeholder('Ex. Rencontrez notre équipe')
                                            ->maxLength(255),

                                        TextInput::make('team_description.fr')
                                            ->label('Sous-titre de l\'équipe (FR)')
                                            ->prefixIcon('heroicon-o-bars-3-bottom-left')
                                            ->placeholder('Ex. Les gens passionnés derrière notre boutique...')
                                            ->maxLength(255),
                                    ]),
                            ])
                            ->columnSpanFull(),

                        Repeater::make('team_members')
                            ->label('Team Members')
                            ->addActionLabel('Add New Team Member')
                            ->defaultItems(1)
                            ->collapsed(false)
                            ->itemLabel(fn(array $state): ?string => $state['name'] ?? 'New Member')
                            ->schema([
                                Grid::make(12)->schema([
                                    FileUpload::make('image')
                                        ->label('Photo')
                                        ->image()
                                        ->avatar()
                                        ->disk('public')
                                        ->directory('about-us/team')
                                        ->columnSpan(3),

                                    TextInput::make('name')
                                        ->label('Full Name')
                                        ->prefixIcon('heroicon-o-user')
                                        ->placeholder('Grace Wright')
                                        ->required()
                                        ->columnSpan(4),

                                    TextInput::make('job_title')
                                        ->label('Job Title')
                                        ->prefixIcon('heroicon-o-briefcase')
                                        ->placeholder('Founder & CEO')
                                        ->required()
                                        ->columnSpan(5),
                                ]),

                                Grid::make(3)->schema([
                                    TextInput::make('facebook_url')
                                        ->label('Facebook Profile')
                                        ->prefixIcon('heroicon-o-globe-alt')
                                        ->placeholder('https://facebook.com/...')
                                        ->url(),

                                    TextInput::make('twitter_url')
                                        ->label('Twitter / X Profile')
                                        ->prefixIcon('heroicon-o-globe-alt')
                                        ->placeholder('https://twitter.com/...')
                                        ->url(),

                                    TextInput::make('skype_url')
                                        ->label('LinkedIn Profile')
                                        ->prefixIcon('heroicon-o-globe-alt')
                                        ->placeholder('https://linkedin.com/in/...')
                                        ->url(),
                                ]),
                            ])
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
