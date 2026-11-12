<?php

namespace App\Filament\Resources\Blogs\Schemas;

use Illuminate\Support\Str;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Hidden;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Components\Group;

use Filament\Schemas\Components\Split;
use Filament\Schemas\Schema;

class BlogForm
{
    public static function configure($form)
    {
        return $form
            ->schema([
                Section::make('Blog Details')
                    ->description('Specify the title, permalink slug, category, and status of the blog post.')
                    ->schema([
                        Tabs::make('Title Translations')
                            ->tabs([
                                Tab::make('English (en)')
                                    ->schema([
                                        TextInput::make('title.en')
                                            ->label('Blog Title (EN)')
                                            ->placeholder('Enter blog title in English...')
                                            ->required()
                                            ->maxLength(255)
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state))),
                                    ]),

                                Tab::make('العربية (ar)')
                                    ->schema([
                                        TextInput::make('title.ar')
                                            ->label('عنوان المقال (AR)')
                                            ->placeholder('أدخل عنوان المقال بالعربية...')
                                            ->maxLength(255),
                                    ]),

                                Tab::make('Türkçe (tr)')
                                    ->schema([
                                        TextInput::make('title.tr')
                                            ->label('Blog Başlığı (TR)')
                                            ->placeholder('Blog başlığını Türkçe girin...')
                                            ->maxLength(255),
                                    ]),

                                Tab::make('한국어 (ko)')
                                    ->schema([
                                        TextInput::make('title.ko')
                                            ->label('블로그 제목 (KO)')
                                            ->placeholder('블로그 제목을 한국어로 입력하세요...')
                                            ->maxLength(255),
                                    ]),

                                Tab::make('Français (fr)')
                                    ->schema([
                                        TextInput::make('title.fr')
                                            ->label('Titre du blog (FR)')
                                            ->placeholder('Entrez le titre en français...')
                                            ->maxLength(255),
                                    ]),
                            ])
                            ->columnSpanFull(),

                        Grid::make(2)->schema([
                            Select::make('is_published')
                                ->label('Status')
                                ->options([
                                    1 => 'Active',
                                    0 => 'Draft',
                                ])
                                // ->default(1)
                                ->required()
                                ->native(false),

                            TextInput::make('slug')
                                ->label('URL Slug')
                                ->placeholder('blog-permalink')
                                ->prefix(url('/blog') . '/')
                                ->required()
                                ->unique(ignoreRecord: true),
                        ]),

                        Grid::make(2)->schema([
                            Select::make('category_id')
                                ->label('Category')
                                ->relationship('category', 'name')
                                ->searchable()
                                ->preload()
                                ->createOptionForm([
                                    TextInput::make('name')
                                        ->label('Category Name')
                                        ->required(),
                                ]),

                            DateTimePicker::make('published_at')
                                ->label('Publish Date & Time')
                                ->default(now())
                                ->native(false),
                        ]),

                        Toggle::make('is_featured')
                            ->label('Featured Post')
                            ->helperText('Display this post in the featured section.')
                            ->default(false)
                            ->onIcon('heroicon-m-star')
                            ->offIcon('heroicon-m-x-mark')
                            ->onColor('warning'),

                        FileUpload::make('image')
                            ->label('Blog Image')
                            ->image()
                            ->disk('public')
                            ->directory('uploads/blog')
                            ->visibility('public')
                            ->imageEditor()
                            ->imageCropAspectRatio('16:9'),

                        Hidden::make('user_id')
                            ->default(fn() => auth()->id()),
                    ])
                    ->columnSpanFull(),

                Section::make('Content & Description')
                    ->description('Write the short summary excerpt and full article body content across languages.')
                    ->schema([
                        Tabs::make('Content Translations')
                            ->tabs([
                                Tab::make('English (en)')
                                    ->schema([
                                        Textarea::make('excerpt.en')
                                            ->label('Excerpt / Short Description (EN)')
                                            ->placeholder('Write a short summary in English...')
                                            ->rows(3)
                                            ->maxLength(500),

                                        RichEditor::make('content.en')
                                            ->label('Blog Content (EN)')
                                            ->placeholder('Write your full article content in English...')
                                            ->fileAttachmentsDirectory('blogs/attachments')
                                            ->extraInputAttributes(['style' => 'min-height: 250px;'])
                                            ->columnSpanFull(),
                                    ]),

                                Tab::make('العربية (ar)')
                                    ->schema([
                                        Textarea::make('excerpt.ar')
                                            ->label('الملخص / وصف قصير (AR)')
                                            ->placeholder('اكتب ملخصاً قصيراً بالعربية...')
                                            ->rows(3)
                                            ->maxLength(500),

                                        RichEditor::make('content.ar')
                                            ->label('محتوى المقال (AR)')
                                            ->placeholder('اكتب محتوى المقال كاملاً بالعربية...')
                                            ->fileAttachmentsDirectory('blogs/attachments')
                                            ->extraInputAttributes(['style' => 'min-height: 250px;'])
                                            ->columnSpanFull(),
                                    ]),

                                Tab::make('Türkçe (tr)')
                                    ->schema([
                                        Textarea::make('excerpt.tr')
                                            ->label('Özet / Kısa Açıklama (TR)')
                                            ->placeholder('Türkçe kısa bir özet yazın...')
                                            ->rows(3)
                                            ->maxLength(500),

                                        RichEditor::make('content.tr')
                                            ->label('Blog İçeriği (TR)')
                                            ->placeholder('Makale içeriğini Türkçe yazın...')
                                            ->fileAttachmentsDirectory('blogs/attachments')
                                            ->extraInputAttributes(['style' => 'min-height: 250px;'])
                                            ->columnSpanFull(),
                                    ]),

                                Tab::make('한국어 (ko)')
                                    ->schema([
                                        Textarea::make('excerpt.ko')
                                            ->label('요약 / 짧은 설명 (KO)')
                                            ->placeholder('한국어로 짧은 요약을 작성하세요...')
                                            ->rows(3)
                                            ->maxLength(500),

                                        RichEditor::make('content.ko')
                                            ->label('블로그 내용 (KO)')
                                            ->placeholder('블로그 본문 내용을 한국어로 작성하세요...')
                                            ->fileAttachmentsDirectory('blogs/attachments')
                                            ->extraInputAttributes(['style' => 'min-height: 250px;'])
                                            ->columnSpanFull(),
                                    ]),

                                Tab::make('Français (fr)')
                                    ->schema([
                                        Textarea::make('excerpt.fr')
                                            ->label('Extrait (FR)')
                                            ->placeholder('Écrivez un court résumé en français...')
                                            ->rows(3)
                                            ->maxLength(500),

                                        RichEditor::make('content.fr')
                                            ->label('Contenu du blog (FR)')
                                            ->placeholder('Écrivez le contenu complet en français...')
                                            ->fileAttachmentsDirectory('blogs/attachments')
                                            ->extraInputAttributes(['style' => 'min-height: 250px;'])
                                            ->columnSpanFull(),
                                    ]),
                            ])
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
