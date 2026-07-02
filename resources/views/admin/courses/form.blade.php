<style>
    .form-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:16px}.form-card{background:#fff;border:1px solid #e5e7eb;border-radius:14px;padding:20px;margin-bottom:18px}.form-field label{display:block;font-size:12px;font-weight:700;color:#475569;text-transform:uppercase;margin-bottom:7px}.form-field input,.form-field select,.form-field textarea{width:100%;border:1px solid #dbe3ef;border-radius:10px;padding:10px 12px}.form-field textarea{min-height:110px}.module-box{border:1px solid #e5e7eb;border-radius:12px;padding:16px;margin-top:14px;background:#f8fafc}.lesson-box{border:1px dashed #cbd5e1;border-radius:10px;padding:12px;margin-top:10px;background:#fff}.check-row{display:flex;gap:16px;flex-wrap:wrap}.check-row label{display:flex;align-items:center;gap:8px;font-size:14px;color:#334155}.check-row input{width:auto}.image-preview{height:210px;border-radius:14px;overflow:hidden;background:#0f172a;border:1px solid #e5e7eb}.image-preview img{width:100%;height:100%;object-fit:cover;display:block}.upload-help{font-size:12px;color:#64748b;margin-top:7px}@media(max-width:800px){.form-grid{grid-template-columns:1fr}}
</style>

<div class="form-card">
    <div class="form-grid">
        <div class="form-field"><label>Title</label><input name="title" value="{{ old('title', $course->title) }}" required></div>
        <div class="form-field"><label>Slug</label><input name="slug" value="{{ old('slug', $course->slug) }}" placeholder="Auto-generated if empty"></div>
        <div class="form-field">
            <label>Category</label>
            <select name="course_category_id">
                <option value="">Select category</option>
                @foreach($categories as $id => $name)
                    <option value="{{ $id }}" @selected((string) old('course_category_id', $course->course_category_id) === (string) $id)>{{ $name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-field"><label>New Category</label><input name="new_category" value="{{ old('new_category') }}" placeholder="Basic Computer, DCA, Tally..."></div>
        <div class="form-field"><label>Price</label><input type="number" step="0.01" name="price" value="{{ old('price', $course->price ?? 0) }}"></div>
        <div class="form-field"><label>Discount Price</label><input type="number" step="0.01" name="discount_price" value="{{ old('discount_price', $course->discount_price) }}"></div>
        <div class="form-field"><label>Duration</label><input name="duration" value="{{ old('duration', $course->duration) }}" placeholder="3 months"></div>
        <div class="form-field"><label>Level</label><input name="level" value="{{ old('level', $course->level) }}" placeholder="Beginner"></div>
        <div class="form-field">
            <label>Course Image Upload</label>
            <input type="file" name="course_image" accept="image/*">
            <p class="upload-help">Saved with Media Library. Recommended size: 1200x760.</p>
        </div>
        <div class="form-field">
            <label>Current Image</label>
            <div class="image-preview">
                <img src="{{ $course->exists ? $course->image_url : 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=1200&q=80' }}" alt="{{ $course->title ?: 'Course image' }}">
            </div>
        </div>
        <div class="form-field" style="grid-column:1/-1"><label>Image URL Fallback</label><input name="image" value="{{ old('image', $course->image) }}" placeholder="Optional external image URL if no media upload"></div>
        <div class="form-field" style="grid-column:1/-1"><label>Short Description</label><input name="short_description" value="{{ old('short_description', $course->short_description) }}"></div>
        <div class="form-field" style="grid-column:1/-1"><label>Full Description</label><textarea name="description">{{ old('description', $course->description) }}</textarea></div>
    </div>
    <div class="check-row" style="margin-top:16px">
        <label><input type="checkbox" name="is_active" value="1" @checked(old('is_active', $course->is_active))> Active</label>
        <label><input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $course->is_featured))> Featured on homepage</label>
        <label><input type="checkbox" name="has_certificate" value="1" @checked(old('has_certificate', $course->has_certificate))> Certificate available</label>
    </div>
</div>

<div class="form-card">
    <h3 class="page-card-title">Course SEO</h3>
    <div class="form-grid">
        <div class="form-field"><label>Meta Title</label><input name="meta_title" value="{{ old('meta_title', $course->meta_title) }}" placeholder="Best DCA Course in ..."></div>
        <div class="form-field"><label>Meta Keywords</label><input name="meta_keywords" value="{{ old('meta_keywords', $course->meta_keywords) }}" placeholder="dca course, computer course"></div>
        <div class="form-field" style="grid-column:1/-1"><label>Meta Description</label><input name="meta_description" value="{{ old('meta_description', $course->meta_description) }}" maxlength="255" placeholder="Short SEO description for Google."></div>
    </div>
</div>

<div class="form-card">
    <div style="display:flex;justify-content:space-between;align-items:center;gap:12px">
        <div><h3 class="page-card-title">Modules & Lessons</h3><p style="color:#64748b;margin:4px 0 0">Course > Module > Lesson structure</p></div>
        <button type="button" class="btn-primary" onclick="addModule()"><i class="fas fa-plus"></i> Module</button>
    </div>
    <div id="modules">
        @forelse($course->modules as $moduleIndex => $module)
            <div class="module-box">
                <div class="form-grid">
                    <div class="form-field"><label>Module Title</label><input name="modules[{{ $moduleIndex }}][title]" value="{{ $module->title }}"></div>
                    <div class="form-field"><label>Description</label><input name="modules[{{ $moduleIndex }}][description]" value="{{ $module->description }}"></div>
                </div>
                <div class="lessons">
                    @foreach($module->lessons as $lessonIndex => $lesson)
                        <div class="lesson-box">
                            <div class="form-grid">
                                <div class="form-field"><label>Lesson Title</label><input name="modules[{{ $moduleIndex }}][lessons][{{ $lessonIndex }}][title]" value="{{ $lesson->title }}"></div>
                                <div class="form-field"><label>Video URL</label><input name="modules[{{ $moduleIndex }}][lessons][{{ $lessonIndex }}][video_url]" value="{{ $lesson->video_url }}"></div>
                                <div class="form-field"><label>Notes URL</label><input name="modules[{{ $moduleIndex }}][lessons][{{ $lessonIndex }}][notes_url]" value="{{ $lesson->notes_url }}"></div>
                                <div class="form-field"><label>Practice File URL</label><input name="modules[{{ $moduleIndex }}][lessons][{{ $lessonIndex }}][practice_file_url]" value="{{ $lesson->practice_file_url }}"></div>
                                <div class="form-field" style="grid-column:1/-1"><label>Description</label><input name="modules[{{ $moduleIndex }}][lessons][{{ $lessonIndex }}][description]" value="{{ $lesson->description }}"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <button type="button" class="btn-outline" onclick="addLesson(this)">Add Lesson</button>
            </div>
        @empty
            <div class="module-box">
                <div class="form-grid">
                    <div class="form-field"><label>Module Title</label><input name="modules[0][title]" placeholder="Introduction"></div>
                    <div class="form-field"><label>Description</label><input name="modules[0][description]" placeholder="Module summary"></div>
                </div>
                <div class="lessons"></div>
                <button type="button" class="btn-outline" onclick="addLesson(this)">Add Lesson</button>
            </div>
        @endforelse
    </div>
</div>

<div style="display:flex;gap:10px;justify-content:flex-end">
    <a class="btn-outline" href="{{ route('admin.courses.index') }}">Cancel</a>
    <button class="btn-primary" type="submit"><i class="fas fa-save"></i> Save Course</button>
</div>

<script>
let moduleIndex = document.querySelectorAll('.module-box').length;
function addModule() {
    const index = moduleIndex++;
    document.getElementById('modules').insertAdjacentHTML('beforeend', `
        <div class="module-box">
            <div class="form-grid">
                <div class="form-field"><label>Module Title</label><input name="modules[${index}][title]" placeholder="Module title"></div>
                <div class="form-field"><label>Description</label><input name="modules[${index}][description]" placeholder="Module summary"></div>
            </div>
            <div class="lessons"></div>
            <button type="button" class="btn-outline" onclick="addLesson(this)">Add Lesson</button>
        </div>`);
}
function addLesson(button) {
    const moduleBox = button.closest('.module-box');
    const moduleNumber = [...document.querySelectorAll('.module-box')].indexOf(moduleBox);
    const lessonNumber = moduleBox.querySelectorAll('.lesson-box').length;
    moduleBox.querySelector('.lessons').insertAdjacentHTML('beforeend', `
        <div class="lesson-box">
            <div class="form-grid">
                <div class="form-field"><label>Lesson Title</label><input name="modules[${moduleNumber}][lessons][${lessonNumber}][title]" placeholder="Lesson title"></div>
                <div class="form-field"><label>Video URL</label><input name="modules[${moduleNumber}][lessons][${lessonNumber}][video_url]" placeholder="https://..."></div>
                <div class="form-field"><label>Notes URL</label><input name="modules[${moduleNumber}][lessons][${lessonNumber}][notes_url]" placeholder="https://..."></div>
                <div class="form-field"><label>Practice File URL</label><input name="modules[${moduleNumber}][lessons][${lessonNumber}][practice_file_url]" placeholder="https://..."></div>
                <div class="form-field" style="grid-column:1/-1"><label>Description</label><input name="modules[${moduleNumber}][lessons][${lessonNumber}][description]" placeholder="Lesson details"></div>
            </div>
        </div>`);
}
</script>
