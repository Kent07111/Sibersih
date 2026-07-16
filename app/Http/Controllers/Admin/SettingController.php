<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;
use Illuminate\Support\Str;
use App\Models\Education;
use App\Models\Activity;
use App\Models\Setting;
use App\Models\WastePoint;
use App\Services\ImageService;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function qrCenter()
    {
        return view('admin.settings.qr-center', [

            'educations' => Education::orderBy('judul')->get(),

            'activities' => Activity::orderBy('judul')->get(),

            'wastePoints' => WastePoint::orderBy('nama')->get(),

            'url' => null,

            'type' => null,

            'selected' => null

        ]);
    }
    public function generateQr(Request $request)
    {
        $request->validate([

            'type' => 'required'

        ]);

        $url = '';

        switch ($request->type) {

            case 'landing':

                $url = url('/');

                break;

            case 'education':

                $education = Education::findOrFail($request->education);

                $url = url('/edukasi/'.$education->slug);

                break;

            case 'activity':

                $activity = Activity::findOrFail($request->activity);

                $url = url('/kegiatan/'.$activity->slug);

                break;

            case 'waste-point':

                $point = WastePoint::findOrFail($request->waste_point);

                $url = "https://www.google.com/maps?q={$point->latitude},{$point->longitude}";

                break;

            case 'custom':

                $url = $request->custom_url;

                break;

        }

        return view('admin.settings.qr-center',[

            'educations'=>Education::orderBy('judul')->get(),

            'activities'=>Activity::orderBy('judul')->get(),

            'wastePoints'=>WastePoint::orderBy('nama')->get(),

            'url'=>$url,

            'type'=>$request->type,

            'selected'=>$request->all()

        ]);

    }


    /**
     * Show the form for creating a new resource.
     */
    public function index()
    {
        $setting = Setting::first();

        return view(
            'admin.settings.index',
            compact('setting')
        );
    }

    public function store(Request $request)
    {
        return $this->saveSetting($request);
    }

    public function update(Request $request, Setting $setting)
    {
        return $this->saveSetting($request, $setting);
    }

    private function saveSetting(Request $request, Setting $setting = null)
    {
        try {

            $data = $request->validate([
                'nama_desa'   => 'required|max:255',
                'name'        => 'required|max:255',
                'alamat'      => 'required',
                'telepon'     => 'required|max:20',
                'email'       => 'required|email',

                'tentang'     => 'nullable',

                'facebook'    => 'nullable|string|max:255',
                'instagram'   => 'nullable|string|max:255',
                'youtube'     => 'nullable|string|max:255',

                'maps_embed'  => 'nullable',


                'logo'        => 'nullable|image|max:2048',
                'favicon'     => 'nullable|image|max:1024',
                'banner'      => 'nullable|image|max:4096',
                'hero_image'  => 'nullable|image|max:4096',
            ]);

            if (!$setting) {
                $setting = new Setting();
            }

            if ($request->hasFile('logo')) {

                $data['logo'] = ImageService::replace(

                    $request->file('logo'),

                    $setting->logo,

                    'settings'

                );

            }

if ($request->hasFile('favicon')) {

    $data['favicon'] = ImageService::replace(

        $request->file('favicon'),

        $setting->favicon,

        'settings'

    );

}
if ($request->hasFile('banner')) {

    $data['banner'] = ImageService::replace(

        $request->file('banner'),

        $setting->banner,

        'settings'

    );

}

if ($request->hasFile('hero_image')) {

    $data['hero_image'] = ImageService::replace(

        $request->file('hero_image'),

        $setting->hero_image,

        'settings'

    );

}

            $setting->fill($data);
            $setting->save();

            return back()->with('success', 'Setting berhasil disimpan.');

        } catch (\Illuminate\Validation\ValidationException $e) {

            return back()
                ->withErrors($e->validator)
                ->withInput();

        } catch (\Exception $e) {

            return back()->with(
                'error',
                'Terjadi kesalahan : '.$e->getMessage()
            );

        }
    }

    private function uploadWebp($file, $folder)
    {
        $manager = new ImageManager(new Driver());

        $image = $manager->read($file)
            ->scaleDown(width: 1600)
            ->toWebp(80);

        $filename = Str::uuid().'.webp';

        Storage::disk('public')->put(
            $folder.'/'.$filename,
            (string) $image
        );

        return $folder.'/'.$filename;
    }
}
