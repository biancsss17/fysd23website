<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ContentController extends Controller
{
    public function index(string $type)
    {
        $records = Content::where('type', $type)->latest()->paginate(20);

        return view('admin.contents', compact('records', 'type'));
    }

    public function create(string $type)
    {
        return view('admin.content-form', ['record' => new Content, 'type' => $type]);
    }

    public function edit(string $type, Content $record)
    {
        abort_unless($record->type === $type, 404);

        return view('admin.content-form', ['record' => $record->load('gallery'), 'type' => $type]);
    }

    public function store(Request $r, string $type)
    {
        return $this->save($r, $type, new Content);
    }

    public function update(Request $r, string $type, Content $record)
    {
        abort_unless($record->type === $type, 404);

        return $this->save($r, $type, $record);
    }

    private function save(Request $r, string $type, Content $record)
    {
        $data = $r->validate([
            'title' => 'required|string|max:180', 'slug' => ['required', 'alpha_dash', 'max:180', Rule::unique('contents')->ignore($record->id)],
            'excerpt' => 'nullable|string|max:600', 'content' => 'required|string|max:100000', 'category' => 'nullable|string|max:80',
            'cover_id' => 'nullable|exists:media,id', 'cover_upload' => 'nullable|file|mimes:jpg,jpeg,png,webp,gif,mp4,webm,ogg|max:51200', 'published_at' => 'nullable|date|required_if:status,published', 'event_date' => 'nullable|date',
            'location' => 'nullable|string|max:255', 'status' => 'required|in:draft,published', 'featured' => 'nullable|boolean', 'sort_order' => 'required|integer|min:0|max:10000',
            'gallery_uploads' => 'nullable|array|max:40', 'gallery_uploads.*' => 'required|file|mimes:jpg,jpeg,png,webp,gif,mp4,webm,ogg|max:51200',
        ]);
        $storedPaths = [];
        $gallery = [];
        unset($data['cover_upload'], $data['gallery_uploads']);
        $data['featured'] = $r->boolean('featured');
        $data['type'] = $type;
        try { DB::transaction(function () use ($record, $data, &$gallery, $r, $type, &$storedPaths) {
            if ($r->hasFile('cover_upload')) {
                $path = $r->file('cover_upload')->store('cms', 'public');
                $storedPaths[] = $path;
                $data['cover_id'] = Media::create(['path' => $path, 'name' => 'Cover image', 'alt' => $data['title']])->id;
            }
            $record->fill($data);
            if (! $record->exists) {
                $record->created_by = $r->user()->id;
            } $record->save();
            if ($r->hasFile('gallery_uploads')) {
                foreach ($r->file('gallery_uploads') as $file) {
                    $path = $file->store('cms', 'public');
                    $storedPaths[] = $path;
                    $gallery[] = Media::create(['path' => $path, 'name' => mb_substr($file->getClientOriginalName(), 0, 255), 'alt' => $record->title])->id;
                }
                $record->gallery()->sync(collect($gallery)->mapWithKeys(fn ($id, $i) => [$id => ['sort_order' => $i]])->all());
            }
        });
        } catch (\Throwable $error) { foreach ($storedPaths as $path) Storage::disk('public')->delete($path); throw $error; }

        return redirect()->route('admin.content.edit', [$type, $record])->with('success', ucfirst($type).' saved.');
    }

    public function destroy(string $type, Content $record)
    {
        abort_unless($record->type === $type, 404);
        $record->delete();

        return redirect()->route('admin.content.index', $type)->with('success', 'Content deleted.');
    }

    public function preview(string $type, Content $record)
    {
        abort_unless($record->type === $type, 404);
        $record->load('cover', 'gallery');

        return view('public.detail',['record' => $record, 'type' => $type, 'related' => collect(), 'preview' => true]);
    }
}
