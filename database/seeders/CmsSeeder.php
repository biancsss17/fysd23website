<?php

namespace Database\Seeders;

use App\Models\Content;
use App\Models\Center;
use App\Models\HeroSlide;
use App\Models\Media;
use App\Models\Officer;
use App\Models\PageSection;
use App\Models\SiteSetting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CmsSeeder extends Seeder
{
    public function run(): void
    {
        // Keep the deployed CMS aligned with the checked-in local snapshot.
        // Unknown administrator-created settings/content are preserved.
        $localSettingOverrides = [
            'primary_color' => '#003385',
            'secondary_color' => '#e7bd57',
            'accent_color' => '#4c2aa2',
            'primary_text' => 'Explore activities',
            'primary_url' => '/activities',
            'stat_2_label' => 'Activities',
            'activities_link' => 'Explore activities',
            'nav_activities' => 'Activity',
        ];
        foreach (config('cms') as $group) {
            foreach ($group as $key => $field) {
                SiteSetting::updateOrCreate(['key' => $key], ['value' => $localSettingOverrides[$key] ?? $field[2]]);
            }
        }
        foreach ($localSettingOverrides as $key => $value) {
            SiteSetting::updateOrCreate(['key' => $key], ['value' => $value]);
        }
        foreach ([
            ['heritage', 'A legacy that continues.', 'Knowledge, love and a shared sense of purpose.'],
            ['statistics', 'Our community, in perspective.', 'A growing story of participation.'],
            ['news', 'Stories that bring us together.', 'The latest from our community.'],
            ['achievements', 'Small steps. Lasting impact.', 'Celebrating milestones that define our journey.'],
            ['activities', 'Purpose, put into practice.', 'Discover ways to learn, connect and serve.'],
            ['officers', 'People behind the purpose.', 'Meet the people helping our community move forward.'],
        ] as $i => $s) {
            PageSection::updateOrCreate(['key' => $s[0]], ['title' => $s[1], 'description' => $s[2], 'sort_order' => $i, 'visible' => true]);
        }
        $samples = [
            'news' => ['A new chapter for our community', 'Making space for meaningful conversations', 'Looking forward, together'],
            'achievements' => ['Recognizing the spirit of service', 'A milestone in shared learning', 'Celebrating community participation'],
            'activities' => ['Community learning circle', 'A day dedicated to service', 'Youth conversation and connection'],
        ];
        $sampleDates = [
            'A new chapter for our community' => '2026-10-05 18:19:28',
            'Making space for meaningful conversations' => '2026-10-04 18:19:28',
            'Looking forward, together' => '2026-10-03 18:19:28',
            'Recognizing the spirit of service' => '2026-10-05 18:19:28',
            'A milestone in shared learning' => '2026-10-04 18:19:28',
            'Celebrating community participation' => '2026-10-03 18:19:28',
            'Community learning circle' => '2026-10-05 18:19:00',
            'A day dedicated to service' => '2026-10-04 18:19:28',
            'Youth conversation and connection' => '2026-10-03 18:19:28',
        ];
        foreach ($samples as $type => $titles) {
            foreach ($titles as $i => $title) {
                Content::updateOrCreate(['slug' => Str::slug($title)], [
                    'type' => $type, 'title' => $title, 'excerpt' => 'Sample content • An invitation to connect, share ideas and build a stronger community.',
                    'content' => "This is sample content for the UECFI website. It does not describe a verified organizational event or achievement.\n\nAn administrator can replace this story, add an approved photograph and publish the details through the content manager.",
                    'category' => 'Sample content', 'status' => 'published', 'featured' => $i === 0, 'published_at' => $sampleDates[$title], 'sort_order' => $i,
                    'event_date' => $type === 'news' ? null : '2026-10-06', 'location' => $type === 'activities' ? 'To be confirmed' : null,
                ]);
            }
        }
        Center::updateOrCreate(['slug' => 'ubbog-ni-ayat'], [
            'name' => 'CENTRO UBBOG NI AYAT',
            'description' => null,
            'address' => 'GANTE III STREET, PIONEER AVENUE, MAGUGPO WEST, TAGUM CITY, DAVAO DEL NORTE',
            'latitude' => 7.4545418,
            'longitude' => 125.7998692,
            'map_url' => 'https://www.google.com/maps/place/Ubbog+Ni+Ayat/@7.4545418,125.7998692,17z/data=!3m1!4b1!4m6!3m5!1s0x32f95336dddbf151:0xc613c2ef8908ebfa!8m2!3d7.4545418!4d125.7998692!16s%2Fg%2F11t_zsvgh8?entry=ttu',
            'published_at' => now(),
            'status' => 'published',
            'sort_order' => 0,
        ]);
        Center::updateOrCreate(['slug' => 'centro-wisdom'], [
            'name' => 'CENTRO WISDOM',
            'description' => null,
            'address' => '',
            'latitude' => 7.3618161,
            'longitude' => 125.704352,
            'map_url' => 'https://www.google.com/maps/place/UECFI+-+Centro+Wisdom+(District+23)/@7.3618161,125.704352,17z/data=!3m1!4b1!4m6!3m5!1s0x32f94f222b70d6b9:0x12ea2b294ae33869!8m2!3d7.3618161!4d125.704352!16s%2Fg%2F11v0gcqr5n?entry=ttu',
            'published_at' => now(),
            'status' => 'published',
            'sort_order' => 1,
        ]);
        Center::updateOrCreate(['slug' => 'temple-of-jesus-christ-the-living-god'], [
            'name' => 'CENTRO TEMPLE OF JESUS CHRIST - THE LIVING GOD',
            'description' => null,
            'address' => '',
            'latitude' => 7.1081749,
            'longitude' => 125.6125766,
            'map_url' => 'https://www.google.com/maps/place/UECFI,+Temple+of+Jesus+Christ/@7.1081749,125.6125766,17z/data=!3m1!4b1!4m6!3m5!1s0x32f96d393b4bfac7:0x5dee1eca8a33139e!8m2!3d7.1081749!4d125.6125766!16s%2Fg%2F11r72943n2?entry=ttu',
            'published_at' => now(),
            'status' => 'published',
            'sort_order' => 2,
        ]);

        $sampleImages = [
            'sample-community-circle.png' => 'Community learning circle',
            'sample-service-recognition.png' => 'Service recognition',
            'sample-mountain-sunrise.png' => 'Mountain sunrise',
            'sample-uecfi-slideshow.webm' => 'Sample UECFI slideshow video',
            'GbvvJJdTpQgfMEWJsIQzYS9SMuGouX87otapmtP0.mp4' => 'Untitled design.mp4',
            'officers/paola-concubierta.jpg' => 'Officer portrait',
            'officers/bianca-vanessa-salada.jpg' => 'Officer portrait',
        ];
        $media = [];
        foreach ($sampleImages as $filename => $name) {
            $path = 'cms/'.$filename;
            $isVideo = in_array(pathinfo($filename, PATHINFO_EXTENSION), ['mp4', 'webm', 'ogg'], true);
            $image = Media::firstOrCreate(['path' => $path], ['name' => $name, 'alt' => $isVideo ? 'Sample UECFI slideshow video' : $name.' sample photograph']);
            if (! Storage::disk('public')->exists($path) && is_file(public_path('images/'.$filename))) {
                Storage::disk('public')->put($path, file_get_contents(public_path('images/'.$filename)));
            }
            $media[$filename] = $image;
        }
        $officerProfiles = [
            ['name' => 'HMNA. PAOLA CONCUBIERTA', 'position' => 'President', 'social_url' => 'https://www.facebook.com/paolalerts', 'term' => '2025-2026', 'hierarchy_level' => 0, 'photo' => 'officers/paola-concubierta.jpg'],
            ['name' => 'HMNA. BIANCA VANESSA F. SALADA', 'position' => 'Secretary', 'social_url' => 'https://www.facebook.com/binazki', 'term' => '2024-2026', 'hierarchy_level' => 1, 'photo' => 'officers/bianca-vanessa-salada.jpg'],
            ['name' => 'Sample officer 3', 'position' => 'Assistant Secretary', 'social_url' => null, 'term' => 'Sample term', 'hierarchy_level' => 1, 'photo' => null],
            ['name' => 'Sample officer 4', 'position' => 'Treasurer', 'social_url' => null, 'term' => 'Sample term', 'hierarchy_level' => 3, 'photo' => null],
        ];
        foreach ($officerProfiles as $i => $profile) {
            Officer::updateOrCreate(['sort_order' => $i], [
                'name' => $profile['name'],
                'position' => $profile['position'],
                'biography' => 'Sample profile. Replace with an approved officer biography and portrait.',
                'social_url' => $profile['social_url'],
                'term' => $profile['term'],
                'hierarchy_level' => $profile['hierarchy_level'],
                'photo_id' => $profile['photo'] ? $media[$profile['photo']]->id : null,
                'status' => 'published',
            ]);
        }
        $sampleStories = [
            ['news', 'A new chapter for our community', 'sample-community-circle.png', ['sample-service-recognition.png', 'sample-uecfi-slideshow.webm']],
            ['achievements', 'Recognizing the spirit of service', 'sample-service-recognition.png', ['sample-community-circle.png', 'sample-uecfi-slideshow.webm']],
        ];
        foreach ($sampleStories as [$type, $title, $cover, $galleryFiles]) {
            $story = Content::where('type', $type)->where('slug', Str::slug($title))->first();
            if ($story) {
                $story->update(['cover_id' => $media[$cover]->id]);
                $story->gallery()->sync(collect($galleryFiles)->mapWithKeys(fn ($filename, $index) => [
                    $media[$filename]->id => ['sort_order' => $index],
                ])->all());
            }
        }
        // Keep the deployed slideshow aligned with the local version: mountain, uploaded video, community.
        // Only these known seeded assets are replaced; administrator-added slides remain untouched.
        HeroSlide::whereIn('media_id', [
            $media['sample-mountain-sunrise.png']->id,
            $media['sample-community-circle.png']->id,
            $media['GbvvJJdTpQgfMEWJsIQzYS9SMuGouX87otapmtP0.mp4']->id,
        ])->delete();
        HeroSlide::create(['media_id' => $media['sample-mountain-sunrise.png']->id, 'sort_order' => 0]);
        HeroSlide::create(['media_id' => $media['GbvvJJdTpQgfMEWJsIQzYS9SMuGouX87otapmtP0.mp4']->id, 'sort_order' => 1]);
        HeroSlide::create(['media_id' => $media['sample-community-circle.png']->id, 'sort_order' => 2]);
    }
}
