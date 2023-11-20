<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CountryResource\Pages;
use App\Filament\Resources\CountryResource\RelationManagers;
use App\Models\Country;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class CountryResource extends Resource
{
    protected static ?string $model=Country::class;

    protected static ?string $navigationIcon='heroicon-o-rectangle-stack';

    public static function getEloquentQuery():Builder
    {
        return parent::getEloquentQuery()->with('states.cities.streets.houses');
    }

    public static function form(Form $form):Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required(),
                Forms\Components\Repeater::make('states')
                    ->itemLabel(fn($state)=>$state['name'])
                    ->relationship('states')
                    ->collapsed()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required(),
                        Forms\Components\Repeater::make('cities')
                            ->itemLabel(fn($state)=>$state['name'])
                            ->relationship('cities')
                            ->collapsed()
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->required(),
                                Forms\Components\Repeater::make('streets')
                                    ->itemLabel(fn($state)=>$state['name'])
                                    ->relationship('streets')
                                    ->collapsed()
                                    ->schema([
                                        Forms\Components\TextInput::make('name')
                                            ->required(),
                                        Forms\Components\Repeater::make('houses')
                                            ->itemLabel(fn($state)=>$state['name'])
                                            ->relationship('houses')
                                            ->collapsed()
                                            ->schema([
                                                Forms\Components\TextInput::make('name')
                                                    ->required(),
                                            ]),
                                    ]),
                            ]),
                    ]),
            ])->columns(1);
    }

    public static function table(Table $table):Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations():array
    {
        return [
            //
        ];
    }

    public static function getPages():array
    {
        return [
            'index' =>Pages\ListCountries::route('/'),
            'create'=>Pages\CreateCountry::route('/create'),
            'edit'  =>Pages\EditCountry::route('/{record}/edit'),
        ];
    }
}
