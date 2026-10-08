<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\Content;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function show(Media $media)
    {
        abort_unless(Storage::disk('public')->exists($media->path), 404);

        return response()->file(Storage::disk('public')->path($media->path), ['X-Content-Type-Options' => 'nosniff', 'Cache-Control' => 'public, max-age=86400']);
    }

    public function destroy(Media $media)
    {
        $path = $media->path;
        $isVideo = $media->is_video;

        DB::transaction(function () use ($media) {
            DB::table('site_settings')
                ->whereIn('key', ['logo_id', 'favicon_id', 'hero_image_id'])
                ->where('value', (string) $media->id)
                ->update(['value' => null]);

            // Foreign keys clear or detach this media from content, officers, and slides.
            $media->delete();
        });

        Storage::disk('public')->delete($path);

        return back()->with('success', $isVideo ? 'Video deleted.' : 'Photo deleted.');
    }

    public function destroyFromContent(string $type, Content $record, Media $media)
    {
        abort_unless($record->type === $type, 404);

        return $this->destroy($media);
    }

}
