<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::connection(config('activitylog.database_connection'))->create(config('activitylog.table_name'),
            function(Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('tenant_id')
                    ->nullable();
                $table->string('log_name')
                    ->nullable();
                $table->text('description');
                $table->nullableMorphs('subject', 'subject');
                $table->string('event')
                    ->nullable();
                $table->nullableMorphs('causer', 'causer');
                $table->json('properties')
                    ->nullable();
                $table->uuid('batch_uuid')
                    ->nullable();
                $table->timestamps();
                $table->index('log_name');
            });
    }

    public function down(): void
    {
        Schema::connection(config('activitylog.database_connection'))->dropIfExists(config('activitylog.table_name'));
    }
};
