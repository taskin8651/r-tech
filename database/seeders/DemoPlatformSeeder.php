<?php

namespace Database\Seeders;

use App\Models\Certificate;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\CourseEnrollment;
use App\Models\CourseModule;
use App\Models\Enquiry;
use App\Models\Role;
use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Database\Seeder;

class DemoPlatformSeeder extends Seeder
{
    public function run(): void
    {
        $settings = SiteSetting::current();
        $settings->update([
            'site_name'   => 'R Tech Computer',
            'phone'       => '+91 98765 43210',
            'whatsapp'    => '+91 98765 43210',
            'email'       => 'admission@rtechcomputer.in',
            'address'     => 'Main Market, Near City Center, India',
            'timing'      => 'Monday to Saturday, 9:00 AM to 6:00 PM',
        ]);

        $studentRole = Role::firstOrCreate(['id' => 2], ['title' => 'User']);

        $student = User::updateOrCreate(
            ['email' => 'student@demo.com'],
            ['name' => 'Demo Student', 'password' => bcrypt('password')]
        );
        $student->roles()->syncWithoutDetaching([$studentRole->id]);

        $categories = [
            'Basic Computer',
            'Accounting',
            'Web Designing',
            'Digital Skills',
        ];

        foreach ($categories as $category) {
            CourseCategory::firstOrCreate(
                ['slug' => str($category)->slug()],
                ['name' => $category, 'is_active' => true]
            );
        }

        $courseData = [
            [
                'category' => 'Basic Computer',
                'title'    => 'DCA Complete Computer Course',
                'slug'     => 'dca-complete-computer-course',
                'price'    => 4500,
                'duration' => '3 Months',
                'level'    => 'Beginner',
                'image'    => 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=1200&q=80',
            ],
            [
                'category' => 'Accounting',
                'title'    => 'Tally Prime with GST',
                'slug'     => 'tally-prime-with-gst',
                'price'    => 5500,
                'duration' => '2 Months',
                'level'    => 'Intermediate',
                'image'    => 'https://images.unsplash.com/photo-1554224155-6726b3ff858f?auto=format&fit=crop&w=1200&q=80',
            ],
            [
                'category' => 'Web Designing',
                'title'    => 'Frontend Web Designing',
                'slug'     => 'frontend-web-designing',
                'price'    => 6500,
                'duration' => '3 Months',
                'level'    => 'Beginner',
                'image'    => 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=1200&q=80',
            ],
            [
                'category' => 'Digital Skills',
                'title'    => 'MS Office & Internet Skills',
                'slug'     => 'ms-office-internet-skills',
                'price'    => 3500,
                'duration' => '45 Days',
                'level'    => 'Beginner',
                'image'    => 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=1200&q=80',
            ],
        ];

        $firstCourse = null;

        foreach ($courseData as $item) {
            $category = CourseCategory::where('name', $item['category'])->first();
            $course = Course::updateOrCreate(
                ['slug' => $item['slug']],
                [
                    'course_category_id' => $category?->id,
                    'title'              => $item['title'],
                    'short_description'  => 'Demo-ready course with modules, lessons, practical tasks and uploaded certificate workflow.',
                    'description'        => "This course is prepared for demo and client review.\nStudents can enroll, learn from the dashboard, track progress and receive an uploaded certificate after completion.",
                    'price'              => $item['price'],
                    'discount_price'     => null,
                    'duration'           => $item['duration'],
                    'level'              => $item['level'],
                    'image'              => $item['image'],
                    'has_certificate'    => true,
                    'is_featured'        => true,
                    'is_active'          => true,
                ]
            );

            $firstCourse ??= $course;

            $module = CourseModule::updateOrCreate(
                ['course_id' => $course->id, 'title' => 'Foundation Module'],
                ['description' => 'Orientation, tools and core concepts.', 'sort_order' => 0, 'is_active' => true]
            );

            $module->lessons()->updateOrCreate(
                ['title' => 'Course Introduction'],
                ['description' => 'Overview and outcomes.', 'video_url' => 'https://www.youtube.com/', 'is_preview' => true, 'sort_order' => 0, 'is_active' => true]
            );

            $module->lessons()->updateOrCreate(
                ['title' => 'First Practical Task'],
                ['description' => 'Hands-on student practice.', 'is_preview' => false, 'sort_order' => 1, 'is_active' => true]
            );
        }

        if ($firstCourse) {
            $enrollment = CourseEnrollment::updateOrCreate(
                ['user_id' => $student->id, 'course_id' => $firstCourse->id],
                [
                    'status'         => 'active',
                    'amount_paid'    => $firstCourse->display_price,
                    'payment_status' => 'manual',
                    'transaction_id' => 'DEMO-MANUAL-001',
                    'progress'       => 100,
                    'completed_at'   => now(),
                ]
            );

            Certificate::firstOrCreate(
                ['course_enrollment_id' => $enrollment->id],
                [
                    'user_id'        => $student->id,
                    'course_id'      => $firstCourse->id,
                    'certificate_id' => 'RTC-DEMO-2026',
                    'issued_at'      => now(),
                    'is_revoked'     => false,
                ]
            );

            Enquiry::firstOrCreate(
                ['email' => 'parent.demo@example.com', 'course_id' => $firstCourse->id],
                [
                    'name'    => 'Demo Parent',
                    'phone'   => '+91 90000 00000',
                    'message' => 'I want to know about course timing and fees.',
                    'status'  => 'new',
                ]
            );
        }
    }
}
