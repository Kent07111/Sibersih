<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Education;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EducationController extends Controller
{
    private function getContentImages($html)
    {
        preg_match_all('/<img[^>]+src="([^"]+)"/i', $html, $matches);

        return collect($matches[1] ?? [])
            ->map(function ($url) {
                $path = parse_url($url, PHP_URL_PATH);

                return ltrim($path, '/');
            })
            ->toArray();
    }

    private function deleteUnusedImages($oldHtml, $newHtml)
    {
        $oldImages = $this->getContentImages($oldHtml);
        $newImages = $this->getContentImages($newHtml);

        foreach ($oldImages as $image) {
            if (!in_array($image, $newImages)) {
                Storage::disk('public')->delete(
                    str_replace('storage/', '', $image)
                );
            }
        }
    }

    public function index(Request $request)
    {
        $query = Education::query();

        if ($request->filled('search')) {
            $query->where(
                'judul',
                'like',
                '%' . $request->search . '%'
            );
        }

        if ($request->filled('kategori')) {
            $query->where(
                'kategori',
                $request->kategori
            );
        }

        if ($request->filled('status')) {
            $query->where(
                'status',
                $request->status
            );
        }

        $educations = $query
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view(
            'admin.education.index',
            compact('educations')
        );
    }

    public function create()
    {
        return view('admin.education.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:educations,slug',
            'excerpt' => 'required|string|max:250',
            'kategori' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'isi' => 'required',
            'video_url' => 'nullable|string|max:2000',
            'pdf' => 'nullable|file|mimes:pdf|max:10240',
            // Maksimal PPT 20 MB
            // 'ppt' => 'nullable|file|mimes:ppt,pptx|max:20480',
            'ppt' => [
                'nullable',
                'file',
                'max:20480',
                function ($attribute, $value, $fail) {

                    $ext = strtolower($value->getClientOriginalExtension());

                    if (!in_array($ext, ['ppt', 'pptx'])) {
                        $fail('File harus berformat PPT atau PPTX.');
                    }

                },
            ],
            'status' => 'required',
        ]);

        $thumbnail = null;
        $pdf = null;
        $ppt = null;

        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request
                ->file('thumbnail')
                ->store('education/thumbnail', 'public');
        }

        if ($request->hasFile('pdf')) {
            $pdf = $request
                ->file('pdf')
                ->store('education/pdf', 'public');
        }

        if ($request->hasFile('ppt')) {
            $ppt = $request
                ->file('ppt')
                ->store('education/ppt', 'public');
        }

        Education::create([
            'judul' => $request->judul,
            'slug' => Str::slug($request->slug),
            'excerpt' => $request->excerpt,
            'kategori' => $request->kategori,
            'thumbnail' => $thumbnail,
            'isi' => $request->isi,
            'video_url' => $request->video_url,
            'pdf' => $pdf,
            'ppt' => $ppt,
            'status' => $request->status,
            'created_by' => auth()->id(),
        ]);

        return redirect()
            ->route('education.index')
            ->with(
                'success',
                'Artikel edukasi berhasil ditambahkan.'
            );
    }

    public function show(Education $education)
    {
        return view(
            'admin.education.show',
            compact('education')
        );
    }

    public function edit(Education $education)
    {
        return view(
            'admin.education.edit',
            compact('education')
        );
    }

    public function update(
        Request $request,
        Education $education
    ) {
        $request->validate([
            'judul' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:educations,slug,' .
                $education->id,
            'excerpt' => 'required|string|max:250',
            'kategori' => 'required|string',
            'isi' => 'required',
            'video_url' => 'nullable|string|max:2000',
            'status' => 'required',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'pdf' => 'nullable|file|mimes:pdf|max:10240',

            // Maksimal PPT 20 MB
            // 'ppt' => 'nullable|file|mimes:ppt,pptx|max:20480',
            'ppt' => [
                'nullable',
                'file',
                'max:20480',
                function ($attribute, $value, $fail) {

                    $ext = strtolower($value->getClientOriginalExtension());

                    if (!in_array($ext, ['ppt', 'pptx'])) {
                        $fail('File harus berformat PPT atau PPTX.');
                    }

                },
            ],
        ]);

        $data = [
            'judul' => $request->judul,
            'slug' => Str::slug($request->slug),
            'excerpt' => $request->excerpt,
            'kategori' => $request->kategori,
            'isi' => $request->isi,
            'video_url' => $request->video_url,
            'status' => $request->status,
        ];

        // Update thumbnail
        if ($request->hasFile('thumbnail')) {
            if (
                $education->thumbnail &&
                Storage::disk('public')->exists(
                    $education->thumbnail
                )
            ) {
                Storage::disk('public')->delete(
                    $education->thumbnail
                );
            }

            $data['thumbnail'] = $request
                ->file('thumbnail')
                ->store('education/thumbnail', 'public');
        }

        // Update PDF
        if ($request->hasFile('pdf')) {
            if (
                $education->pdf &&
                Storage::disk('public')->exists($education->pdf)
            ) {
                Storage::disk('public')->delete(
                    $education->pdf
                );
            }

            $data['pdf'] = $request
                ->file('pdf')
                ->store('education/pdf', 'public');
        }

        // Update PPT
        if ($request->hasFile('ppt')) {
            if (
                $education->ppt &&
                Storage::disk('public')->exists($education->ppt)
            ) {
                Storage::disk('public')->delete(
                    $education->ppt
                );
            }

            $data['ppt'] = $request
                ->file('ppt')
                ->store('education/ppt', 'public');
        }

        $this->deleteUnusedImages(
            $education->isi,
            $request->isi
        );

        $education->update($data);

        return redirect()
            ->route('education.index')
            ->with(
                'success',
                'Artikel berhasil diperbarui.'
            );
    }
    private function extractYoutubeEmbedUrl(?string $input): ?string
    {
        if (blank($input)) {
            return null;
        }

        $input = trim($input);

        // Jika pengguna memasukkan kode iframe
        if (str_contains($input, '<iframe')) {
            preg_match('/src=["\']([^"\']+)["\']/i', $input, $matches);

            $input = $matches[1] ?? null;
        }

        if (!$input) {
            return null;
        }

        // Format embed YouTube
        if (
            preg_match(
                '~youtube\.com/embed/([a-zA-Z0-9_-]+)~',
                $input,
                $matches
            )
        ) {
            return 'https://www.youtube.com/embed/' . $matches[1];
        }

        // Format youtube.com/watch?v=
        if (
            preg_match(
                '~youtube\.com/watch\?v=([a-zA-Z0-9_-]+)~',
                $input,
                $matches
            )
        ) {
            return 'https://www.youtube.com/embed/' . $matches[1];
        }

        // Format youtu.be/
        if (
            preg_match(
                '~youtu\.be/([a-zA-Z0-9_-]+)~',
                $input,
                $matches
            )
        ) {
            return 'https://www.youtube.com/embed/' . $matches[1];
        }

        return null;
    }
    public function uploadImage(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpg,jpeg,png,gif,webp|max:4096',
        ]);

        $path = $request
            ->file('file')
            ->store('education/content', 'public');

        return response()->json([
            'location' => Storage::url($path),
        ]);
    }
    public function deletePdf(Education $education)
    {
        if (!$education->pdf) {
            return back()->with(
                'error',
                'File PDF tidak ditemukan.'
            );
        }

        if (Storage::disk('public')->exists($education->pdf)) {
            Storage::disk('public')->delete($education->pdf);
        }

        $education->update([
            'pdf' => null,
        ]);

        return back()->with(
            'success',
            'File PDF berhasil dihapus.'
        );
    }

    public function deletePpt(Education $education)
    {
        if (!$education->ppt) {
            return back()->with(
                'error',
                'File PowerPoint tidak ditemukan.'
            );
        }

        if (Storage::disk('public')->exists($education->ppt)) {
            Storage::disk('public')->delete($education->ppt);
        }

        $education->update([
            'ppt' => null,
        ]);

        return back()->with(
            'success',
            'File PowerPoint berhasil dihapus.'
        );
    }
    public function destroy(Education $education)
    {
        foreach (
            $this->getContentImages($education->isi)
            as $image
        ) {
            Storage::disk('public')->delete(
                str_replace('storage/', '', $image)
            );
        }

        if (
            $education->thumbnail &&
            Storage::disk('public')->exists(
                $education->thumbnail
            )
        ) {
            Storage::disk('public')->delete(
                $education->thumbnail
            );
        }

        if (
            $education->pdf &&
            Storage::disk('public')->exists($education->pdf)
        ) {
            Storage::disk('public')->delete(
                $education->pdf
            );
        }

        if (
            $education->ppt &&
            Storage::disk('public')->exists($education->ppt)
        ) {
            Storage::disk('public')->delete(
                $education->ppt
            );
        }

        $education->delete();

        return back()->with(
            'success',
            'Artikel berhasil dihapus.'
        );
    }
}