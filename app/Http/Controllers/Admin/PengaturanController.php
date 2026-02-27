<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

class PengaturanController extends Controller
{
    /**
     * Display a listing of the settings (form edit).
     */
    public function index()
    {
        $settings = Setting::all()->keyBy('key');
        return view('admin.pengaturan.index', compact('settings'));
    }

    /**
     * Update the specified settings in storage.
     */
    public function update(Request $request)
    {
        $keys = Setting::pluck('key')->toArray();

        foreach ($keys as $key) {
            if ($request->has($key)) {
                $setting = Setting::where('key', $key)->first();

                if ($setting->type == 'image' && $request->hasFile($key)) {
                    // Upload file
                    $file = $request->file($key);
                    $path = $file->store('settings', 'public');

                    // Hapus file lama jika ada
                    if ($setting->value && Storage::disk('public')->exists($setting->value)) {
                        Storage::disk('public')->delete($setting->value);
                    }

                    $setting->value = $path;
                } elseif ($setting->type == 'json') {
                    // Untuk placeholder list, mungkin tidak perlu diupdate via form biasa
                    // Bisa diabaikan atau handle khusus
                    continue;
                } else {
                    $setting->value = $request->input($key);
                }

                $setting->save();
            }
        }

        return redirect()->route('admin.pengaturan.index')->with('success', 'Pengaturan berhasil disimpan.');
    }
}