<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        if (DB::table('courses')->exists()) {
            return;
        }

        $now = now();
        $categoryId = DB::table('course_categories')->insertGetId([
            'name'       => 'Computer Courses',
            'slug'       => 'computer-courses',
            'is_active'  => true,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $courses = [
            ['Diploma in Computer Applications', 'dca', 'Complete computer fundamentals, MS Office, internet and practical office work.', 4500, '3 Months', 'Beginner'],
            ['Tally & Accounting', 'tally-accounting', 'GST-ready accounting workflow with Tally, invoices, ledgers and reports.', 5500, '2 Months', 'Intermediate'],
            ['Web Designing', 'web-designing', 'HTML, CSS, responsive layouts and modern website publishing basics.', 6500, '3 Months', 'Beginner'],
        ];

        foreach ($courses as [$title, $slug, $short, $price, $duration, $level]) {
            $courseId = DB::table('courses')->insertGetId([
                'course_category_id' => $categoryId,
                'title'              => $title,
                'slug'               => $slug,
                'short_description'  => $short,
                'description'        => $short . "\n\nStudents learn through structured modules, practice work and certificate-ready completion tracking.",
                'price'              => $price,
                'discount_price'     => null,
                'duration'           => $duration,
                'level'              => $level,
                'has_certificate'    => true,
                'is_featured'        => true,
                'is_active'          => true,
                'created_at'         => $now,
                'updated_at'         => $now,
            ]);

            $moduleId = DB::table('course_modules')->insertGetId([
                'course_id'    => $courseId,
                'title'        => 'Getting Started',
                'description'  => 'Course orientation, tools and first practical workflow.',
                'sort_order'   => 0,
                'is_active'    => true,
                'created_at'   => $now,
                'updated_at'   => $now,
            ]);

            DB::table('course_lessons')->insert([
                [
                    'course_module_id'  => $moduleId,
                    'title'             => 'Introduction to ' . $title,
                    'video_url'         => 'https://www.youtube.com/',
                    'notes_url'         => null,
                    'practice_file_url' => null,
                    'description'       => 'Overview lesson and course outcomes.',
                    'is_preview'        => true,
                    'sort_order'        => 0,
                    'is_active'         => true,
                    'created_at'        => $now,
                    'updated_at'        => $now,
                ],
                [
                    'course_module_id'  => $moduleId,
                    'title'             => 'First Practice Task',
                    'video_url'         => null,
                    'notes_url'         => null,
                    'practice_file_url' => null,
                    'description'       => 'Hands-on practice for students.',
                    'is_preview'        => false,
                    'sort_order'        => 1,
                    'is_active'         => true,
                    'created_at'        => $now,
                    'updated_at'        => $now,
                ],
            ]);
        }
    }

    public function down(): void
    {
        DB::table('courses')->whereIn('slug', ['dca', 'tally-accounting', 'web-designing'])->delete();
        DB::table('course_categories')->where('slug', 'computer-courses')->delete();
    }
};
