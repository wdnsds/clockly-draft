<?php

namespace App\Filament\Resources\TenantResource\Pages;

use App\Filament\Resources\TenantResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Stancl\Tenancy\Exceptions\TenantDatabaseAlreadyExistsException;
use Stancl\Tenancy\Jobs\CreateDatabase;
use Stancl\Tenancy\Jobs\MigrateDatabase;

class CreateTenant extends CreateRecord
{
    protected static string $resource = TenantResource::class;

    protected function afterCreate(): void
    {
        $tenant = $this->record;

        // 1) Create the tenant database
        try {
            CreateDatabase::dispatchSync($tenant);
        } catch (TenantDatabaseAlreadyExistsException $e) {
            // DB is already there—no problem, we’ll just migrate it below
            Notification::make()
                ->title("Tenant “{$tenant->id}” error : " . ($e->getMessage()))
                ->danger()
                ->sendToDatabase(auth()->user());
        }


        // 2) Run all tenant migrations
        MigrateDatabase::dispatchSync($tenant);

        // 3) (Optional) Seed default data in tenant DB
        // SeedDatabase::dispatchSync($tenant);

        // 4) Notify success
        Notification::make()
            ->title("Tenant “{$tenant->id}” created and migrated.")
            ->success()
            ->sendToDatabase(auth()->user());
    }
}
