@extends('layouts.admin')

@section('page-title', 'Site Settings')

@section('content')
<style>
    .settings-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:16px}.settings-card{background:#fff;border:1px solid #e5e7eb;border-radius:14px;padding:20px;margin-bottom:18px}.settings-field label{display:block;font-size:12px;font-weight:800;color:#475569;text-transform:uppercase;margin-bottom:7px}.settings-field input,.settings-field textarea{width:100%;border:1px solid #dbe3ef;border-radius:10px;padding:10px 12px}.settings-field textarea{min-height:120px}.settings-field .ck-editor__editable{min-height:260px}.settings-field .ck.ck-editor{color:#111827}.settings-field .ck-content ul{list-style:disc;padding-left:22px}.settings-field .ck-content ol{list-style:decimal;padding-left:22px}@media(max-width:800px){.settings-grid{grid-template-columns:1fr}}
</style>

<div class="admin-page-head">
    <div>
        <h2 class="admin-page-title">Site Settings</h2>
        <p class="admin-page-subtitle">Update frontend brand, contact, about and policy content.</p>
    </div>
</div>

<form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="settings-card">
        <h3 class="page-card-title">Brand & Contact</h3>
        <div class="settings-grid">
            <div class="settings-field"><label>Site Name</label><input name="site_name" value="{{ old('site_name', $settings->site_name) }}" required></div>
            <div class="settings-field"><label>Logo Upload</label><input type="file" name="site_logo" accept="image/*"></div>
            <div class="settings-field"><label>Favicon Upload</label><input type="file" name="favicon" accept="image/*"></div>
            <div class="settings-field" style="grid-column:1/-1"><label>Logo URL Fallback</label><input name="logo" value="{{ old('logo', $settings->logo) }}" placeholder="Optional logo image URL"></div>
            <div class="settings-field"><label>Phone</label><input name="phone" value="{{ old('phone', $settings->phone) }}"></div>
            <div class="settings-field"><label>WhatsApp</label><input name="whatsapp" value="{{ old('whatsapp', $settings->whatsapp) }}"></div>
            <div class="settings-field"><label>Email</label><input name="email" value="{{ old('email', $settings->email) }}"></div>
            <div class="settings-field"><label>Timing</label><input name="timing" value="{{ old('timing', $settings->timing) }}"></div>
            <div class="settings-field" style="grid-column:1/-1"><label>Address</label><textarea name="address">{{ old('address', $settings->address) }}</textarea></div>
        </div>
    </div>

    <div class="settings-card">
        <h3 class="page-card-title">SEO & Social Links</h3>
        <div class="settings-grid">
            <div class="settings-field"><label>Meta Title</label><input name="meta_title" value="{{ old('meta_title', $settings->meta_title) }}" placeholder="R Tech Computer - Online Courses"></div>
            <div class="settings-field"><label>Meta Keywords</label><input name="meta_keywords" value="{{ old('meta_keywords', $settings->meta_keywords) }}" placeholder="computer course, dca, tally"></div>
            <div class="settings-field" style="grid-column:1/-1"><label>Meta Description</label><textarea name="meta_description">{{ old('meta_description', $settings->meta_description) }}</textarea></div>
            <div class="settings-field"><label>Facebook URL</label><input name="facebook_url" value="{{ old('facebook_url', $settings->facebook_url) }}"></div>
            <div class="settings-field"><label>Instagram URL</label><input name="instagram_url" value="{{ old('instagram_url', $settings->instagram_url) }}"></div>
            <div class="settings-field"><label>YouTube URL</label><input name="youtube_url" value="{{ old('youtube_url', $settings->youtube_url) }}"></div>
            <div class="settings-field"><label>LinkedIn URL</label><input name="linkedin_url" value="{{ old('linkedin_url', $settings->linkedin_url) }}"></div>
        </div>
    </div>

    <div class="settings-card">
        <h3 class="page-card-title">About Content</h3>
        <div class="settings-field"><label>About Intro</label><textarea name="about_intro">{{ old('about_intro', $settings->about_intro) }}</textarea></div>
        <div class="settings-grid" style="margin-top:16px">
            <div class="settings-field"><label>Mission</label><textarea name="mission">{{ old('mission', $settings->mission) }}</textarea></div>
            <div class="settings-field"><label>Vision</label><textarea name="vision">{{ old('vision', $settings->vision) }}</textarea></div>
        </div>
    </div>

    <div class="settings-card">
        <h3 class="page-card-title">Policies</h3>
        <div class="settings-field"><label>Privacy Policy</label><textarea class="policy-editor" name="privacy_policy">{{ old('privacy_policy', $settings->privacy_policy) }}</textarea></div>
        <div class="settings-field" style="margin-top:16px"><label>Terms & Conditions</label><textarea class="policy-editor" name="terms_conditions">{{ old('terms_conditions', $settings->terms_conditions) }}</textarea></div>
        <div class="settings-field" style="margin-top:16px"><label>Refund Policy</label><textarea class="policy-editor" name="refund_policy">{{ old('refund_policy', $settings->refund_policy) }}</textarea></div>
    </div>

    <div style="display:flex;justify-content:flex-end">
        <button class="btn-primary" type="submit"><i class="fas fa-save"></i> Save Settings</button>
    </div>
</form>
@endsection

@section('scripts')
<script>
    document.querySelectorAll('.policy-editor').forEach(function (editor) {
        ClassicEditor
            .create(editor, {
                toolbar: [
                    'heading', '|',
                    'bold', 'italic', 'link',
                    'bulletedList', 'numberedList',
                    'blockQuote', '|',
                    'undo', 'redo'
                ]
            })
            .catch(function (error) {
                console.error(error);
            });
    });
</script>
@endsection
