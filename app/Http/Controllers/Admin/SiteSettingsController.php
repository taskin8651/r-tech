<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SiteSettingsController extends Controller
{
    public function edit()
    {
        abort_if(Gate::denies('course_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $settings = SiteSetting::current();

        return view('admin.settings.edit', compact('settings'));
    }

    public function update(Request $request)
    {
        abort_if(Gate::denies('course_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $data = $request->validate([
            'site_name'        => ['required', 'string', 'max:160'],
            'logo'             => ['nullable', 'string', 'max:255'],
            'site_logo'        => ['nullable', 'image', 'max:4096'],
            'favicon'          => ['nullable', 'image', 'max:1024'],
            'phone'            => ['nullable', 'string', 'max:60'],
            'whatsapp'         => ['nullable', 'string', 'max:60'],
            'email'            => ['nullable', 'email', 'max:160'],
            'address'          => ['nullable', 'string'],
            'timing'           => ['nullable', 'string', 'max:160'],
            'facebook_url'     => ['nullable', 'url', 'max:255'],
            'instagram_url'    => ['nullable', 'url', 'max:255'],
            'youtube_url'      => ['nullable', 'url', 'max:255'],
            'linkedin_url'     => ['nullable', 'url', 'max:255'],
            'meta_title'       => ['nullable', 'string', 'max:180'],
            'meta_description' => ['nullable', 'string', 'max:255'],
            'meta_keywords'    => ['nullable', 'string', 'max:255'],
            'about_intro'      => ['nullable', 'string'],
            'mission'          => ['nullable', 'string'],
            'vision'           => ['nullable', 'string'],
            'privacy_policy'   => ['nullable', 'string'],
            'terms_conditions' => ['nullable', 'string'],
            'refund_policy'    => ['nullable', 'string'],
        ]);

        unset($data['site_logo'], $data['favicon']);

        $settings = SiteSetting::current();
        $settings->update($data);

        if ($request->hasFile('site_logo')) {
            $settings->addMediaFromRequest('site_logo')->toMediaCollection('site_logo');
        }

        if ($request->hasFile('favicon')) {
            $settings->addMediaFromRequest('favicon')->toMediaCollection('favicon');
        }

        return back()->with('message', 'Site settings updated successfully.');
    }
}
