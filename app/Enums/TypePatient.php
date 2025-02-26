<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum TypePatient: string implements HasLabel
{
    case Cat = 'Cat';
    case Dog = 'Dog';
    case Rabbit = 'Rabbit';


    public function getLabel(): ?string
    {
        return match ($this) {
            self::Cat => 'Cat',
            self::Dog => 'Dog',
            self::Rabbit => 'Rabbit'
        };
    }
}
