<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Status;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $statuses = [
            ['status' => 'Como nuevo'],
            ['status' => 'Nuevo'],
            ['status' => 'Usado'],
            ['status' => 'Muy usado'],
            ['status' => 'Hecho polvoo'],
        ];

        foreach ($statuses as $statusdata) {
            $status = Status::create([
                'status' => $statusdata['status'],
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Status::truncate();
    }
};
