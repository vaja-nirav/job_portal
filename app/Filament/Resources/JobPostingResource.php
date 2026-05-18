<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JobPostingResource\Pages;
use App\Models\JobPosting;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class JobPostingResource extends Resource
{
    protected static ?string $model = JobPosting::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-document-text';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Group::make()->schema([
                    \Filament\Schemas\Components\Section::make('Job Details')->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (string $operation, $state, $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(JobPosting::class, 'slug', ignoreRecord: true),
                        Forms\Components\RichEditor::make('description')->columnSpanFull(),
                    ])->columns(2),

                    \Filament\Schemas\Components\Section::make('Requirements & Application')->schema([
                        Forms\Components\RichEditor::make('Eligibility_Criteria')->columnSpanFull(),
                        Forms\Components\RichEditor::make('How_to_Apply')->columnSpanFull(),
                    ]),

                    \Filament\Schemas\Components\Section::make('Dynamic Data')->schema([
                        Forms\Components\Repeater::make('Important_Dates')->schema([
                            Forms\Components\TextInput::make('event')->required(),
                            Forms\Components\TextInput::make('date')->required(),
                        ])->columns(2),
                        Forms\Components\Repeater::make('Important_Link')->schema([
                            Forms\Components\TextInput::make('label')->required(),
                            Forms\Components\TextInput::make('url')->url()->required(),
                        ])->columns(2),
                        Forms\Components\Repeater::make('Vacancy_Details')->schema([
                            Forms\Components\TextInput::make('post_name')->required(),
                            Forms\Components\TextInput::make('vacancies')->numeric()->required(),
                            Forms\Components\TextInput::make('qualification')->required(),
                        ])->columns(3),
                    ]),
                ])->columnSpan(['lg' => 2]),

                \Filament\Schemas\Components\Group::make()->schema([
                    \Filament\Schemas\Components\Section::make('Status')->schema([
                        Forms\Components\Select::make('status')
                            ->options([
                                'draft' => 'Draft',
                                'published' => 'Published',
                                'expired' => 'Expired',
                            ])
                            ->required()
                            ->default('published'),
                    ]),
                    \Filament\Schemas\Components\Section::make('Relationships')->schema([
                        Forms\Components\Select::make('categories')
                            ->relationship('categories', 'name')
                            ->multiple()
                            ->preload(),
                        Forms\Components\Select::make('jobTypes')
                            ->relationship('jobTypes', 'name')
                            ->multiple()
                            ->preload(),
                        Forms\Components\Select::make('qualifications')
                            ->relationship('qualifications', 'name')
                            ->multiple()
                            ->preload(),
                    ]),
                    \Filament\Schemas\Components\Section::make('Media & SEO')->schema([
                        Forms\Components\FileUpload::make('thumbnail')->image()->directory('job-thumbnails'),
                        Forms\Components\TextInput::make('meta_title')->maxLength(255),
                        Forms\Components\Textarea::make('meta_description'),
                    ]),
                ])->columnSpan(['lg' => 1]),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('thumbnail'),
                Tables\Columns\TextColumn::make('title')->searchable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'danger' => 'expired',
                        'warning' => 'draft',
                        'success' => 'published',
                    ]),
                Tables\Columns\TextColumn::make('views_count')->sortable(),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                        'expired' => 'Expired',
                    ]),
            ])
            ->actions([
                \Filament\Actions\EditAction::make(),
            ])
            ->bulkActions([
                \Filament\Actions\BulkActionGroup::make([
                    \Filament\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJobPostings::route('/'),
            'create' => Pages\CreateJobPosting::route('/create'),
            'edit' => Pages\EditJobPosting::route('/{record}/edit'),
        ];
    }
}
