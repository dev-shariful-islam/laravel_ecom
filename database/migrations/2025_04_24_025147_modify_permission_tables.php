<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Traits\AuditColumnTrait;

return new class extends Migration
{
    use AuditColumnTrait, SoftDeletes;
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('permissions', function (Blueprint $table) {
            $table->string('prefix')->nullable();
            $table->softDeletes();
            $this->addAdminAuditColumns($table);
        });
        Schema::table('roles', function (Blueprint $table) {
            $table->softDeletes();
            $this->addAdminAuditColumns($table);
        });
        Schema::table('admins', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id')->nullable();

            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('permissions', function (Blueprint $table) {
            $table->dropColumn('prefix');
            $table->dropSoftDeletes();
            $this->dropAdminAuditColumns($table);

        });
        Schema::table('roles', function (Blueprint $table) {
            $table->dropSoftDeletes();
            $this->dropAdminAuditColumns($table);
        });
        Schema::table('admins', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropColumn('role_id');
        });
    }
};
