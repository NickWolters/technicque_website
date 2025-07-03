<?php

namespace App\Models;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum ExperienceLevel: string implements HasLabel, HasColor
{
    case Minimal = 'minimal';
    case Basic = 'basic';
    case Ok = 'ok';
    case Good = 'good';
    case Excellent = 'excellent';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Minimal => 'Minimal',
            self::Basic => 'Basic',
            self::Ok => 'Ok',
            self::Good => 'Good',
            self::Excellent => 'Excellent',
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::Minimal => Color::Gray,
            self::Basic => Color::Amber,
            self::Ok => Color::Blue,
            self::Good => Color::Lime,
            self::Excellent => Color::Green,
        };
    }
}
