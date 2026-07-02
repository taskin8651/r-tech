<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseCategory;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class CoursesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('course_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courses = Course::with(['category', 'modules.lessons'])->latest()->get();

        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        abort_if(Gate::denies('course_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $course = new Course([
            'is_active'       => true,
            'is_featured'     => false,
            'has_certificate' => true,
        ]);
        $categories = CourseCategory::orderBy('name')->pluck('name', 'id');

        return view('admin.courses.create', compact('course', 'categories'));
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('course_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $data = $this->validatedData($request);
        $course = Course::create($data);
        $this->syncCourseImage($course, $request);
        $this->syncModules($course, $request->input('modules', []));

        return redirect()->route('admin.courses.index')->with('message', 'Course created successfully.');
    }

    public function edit(Course $course)
    {
        abort_if(Gate::denies('course_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $course->load('modules.lessons');
        $categories = CourseCategory::orderBy('name')->pluck('name', 'id');

        return view('admin.courses.edit', compact('course', 'categories'));
    }

    public function update(Request $request, Course $course)
    {
        abort_if(Gate::denies('course_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $course->update($this->validatedData($request, $course));
        $this->syncCourseImage($course, $request);
        $course->modules()->delete();
        $this->syncModules($course, $request->input('modules', []));

        return redirect()->route('admin.courses.index')->with('message', 'Course updated successfully.');
    }

    public function show(Course $course)
    {
        abort_if(Gate::denies('course_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $course->load(['category', 'modules.lessons', 'enrollments.user']);

        return view('admin.courses.show', compact('course'));
    }

    public function destroy(Course $course)
    {
        abort_if(Gate::denies('course_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $course->delete();

        return back()->with('message', 'Course deleted successfully.');
    }

    private function validatedData(Request $request, ?Course $course = null): array
    {
        $data = $request->validate([
            'course_category_id' => ['nullable', 'exists:course_categories,id'],
            'new_category'       => ['nullable', 'string', 'max:120'],
            'title'              => ['required', 'string', 'max:180'],
            'slug'               => ['nullable', 'string', 'max:200'],
            'short_description'  => ['nullable', 'string', 'max:255'],
            'description'        => ['nullable', 'string'],
            'image'              => ['nullable', 'string', 'max:255'],
            'meta_title'         => ['nullable', 'string', 'max:180'],
            'meta_description'   => ['nullable', 'string', 'max:255'],
            'meta_keywords'      => ['nullable', 'string', 'max:255'],
            'price'              => ['nullable', 'numeric', 'min:0'],
            'discount_price'     => ['nullable', 'numeric', 'min:0'],
            'duration'           => ['nullable', 'string', 'max:80'],
            'level'              => ['nullable', 'string', 'max:80'],
            'course_image'       => ['nullable', 'image', 'max:4096'],
        ]);

        if ($request->filled('new_category')) {
            $category = CourseCategory::firstOrCreate(
                ['slug' => Str::slug($request->new_category)],
                ['name' => $request->new_category, 'is_active' => true]
            );
            $data['course_category_id'] = $category->id;
        }

        $baseSlug = $data['slug'] ?: Str::slug($data['title']);
        $data['slug'] = $this->uniqueSlug($baseSlug, $course?->id);
        $data['price'] = $data['price'] ?? 0;
        $data['has_certificate'] = $request->boolean('has_certificate');
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_active'] = $request->boolean('is_active');

        unset($data['new_category']);
        unset($data['course_image']);

        return $data;
    }

    private function syncCourseImage(Course $course, Request $request): void
    {
        if ($request->hasFile('course_image')) {
            $course
                ->addMediaFromRequest('course_image')
                ->toMediaCollection('course_image');
        }
    }

    private function uniqueSlug(string $slug, ?int $ignoreId = null): string
    {
        $slug = $slug ?: Str::random(8);
        $original = $slug;
        $count = 2;

        while (Course::where('slug', $slug)->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))->exists()) {
            $slug = $original . '-' . $count++;
        }

        return $slug;
    }

    private function syncModules(Course $course, array $modules): void
    {
        foreach ($modules as $moduleIndex => $moduleData) {
            if (blank($moduleData['title'] ?? null)) {
                continue;
            }

            $module = $course->modules()->create([
                'title'       => $moduleData['title'],
                'description' => $moduleData['description'] ?? null,
                'sort_order'  => $moduleIndex,
                'is_active'   => true,
            ]);

            foreach (($moduleData['lessons'] ?? []) as $lessonIndex => $lessonData) {
                if (blank($lessonData['title'] ?? null)) {
                    continue;
                }

                $module->lessons()->create([
                    'title'             => $lessonData['title'],
                    'video_url'         => $lessonData['video_url'] ?? null,
                    'notes_url'         => $lessonData['notes_url'] ?? null,
                    'practice_file_url' => $lessonData['practice_file_url'] ?? null,
                    'description'       => $lessonData['description'] ?? null,
                    'is_preview'        => ! empty($lessonData['is_preview']),
                    'sort_order'        => $lessonIndex,
                    'is_active'         => true,
                ]);
            }
        }
    }
}
