<?php

namespace App\Filament\Admin\Resources\NewsletterResource\Pages;

use App\Filament\Admin\Resources\NewsletterResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateNewsletter extends CreateRecord
{
    protected static string $resource = NewsletterResource::class;
}
