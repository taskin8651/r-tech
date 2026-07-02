<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $permissions = [
            'course_create',
            'course_edit',
            'course_show',
            'course_delete',
            'course_access',
        ];

        foreach ($permissions as $permission) {
            $permissionId = DB::table('permissions')->where('title', $permission)->value('id');

            if (! $permissionId) {
                $permissionId = DB::table('permissions')->insertGetId([
                    'title'      => $permission,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            if (DB::table('roles')->where('id', 1)->exists()) {
                DB::table('permission_role')->updateOrInsert([
                    'permission_id' => $permissionId,
                    'role_id'       => 1,
                ]);
            }
        }
    }

    public function down(): void
    {
        $ids = DB::table('permissions')
            ->whereIn('title', ['course_create', 'course_edit', 'course_show', 'course_delete', 'course_access'])
            ->pluck('id');

        DB::table('permission_role')->whereIn('permission_id', $ids)->delete();
        DB::table('permissions')->whereIn('id', $ids)->delete();
    }
};
