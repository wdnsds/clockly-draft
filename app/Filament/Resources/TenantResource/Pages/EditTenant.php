<?php

namespace App\Filament\Resources\TenantResource\Pages;

use App\Filament\Resources\TenantResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Stancl\Tenancy\Jobs\MigrateDatabase;

class EditTenant extends EditRecord
{
    protected static string $resource = TenantResource::class;

    protected function afterSave(): void
    {
        $tenant = $this->record;

        // Re-run migrations to pick up any new files
        MigrateDatabase::dispatchSync($tenant);

        Notification::make()
            ->title("Tenant “{$tenant->id}” edited and migrated.")
            ->success()
            ->sendToDatabase(auth()->user());
    }
    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
