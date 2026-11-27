<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('songs')->updateOrInsert(
            ['slug' => 'narito-ako'],
            [
                'title' => 'NARITO AKO',
                'category' => 'SONGS',
                'lyrics' => <<<'LYRICS'
NARITO AKO

Intro: E – A – C#m – F#m – B

E                 A    C#m
I. Narito ako Panginoon
    F#m
Sasambahin ang ‘yong ngalan
  E                 A  C#m
O Diyos sa kaitaasan
      F#m             B             E   E7
Pag-ibig mo’y walang hanggan

Coro:  A          B          C#m
Damhin mo ang tibok ng puso
       F#m  B                         E E7
Harinawa’y ayon sa ‘yong gusto
   A          B          C#m
O Diyos linisin mo ako
                F#m       B              E
Nang matupad ang kalooban mo
                      A     C#m
II. Narito ako Panginoon
   F#m             B
Dalangin ko nawa’y dinggin
   E              A     C#m
Kasalana’y patawarin
   F#m             B   E   E7
Biyaya mo’y paratingin
                      A     C#m
III. Narito ako Panginoon
    F#m              B
Suguin mo kung naisin
E                         A        C#m
Gabay mo’y siyang aking hiling
    F#m                    B    E   E7
Igawad mo kung marapatin…
LYRICS,
                'video_url' => null,
                'published_at' => now(),
                'status' => 'published',
                'sort_order' => 1,
                'created_by' => null,
                'updated_at' => now(),
                'created_at' => now(),
            ],
        );
    }

    public function down(): void
    {
        DB::table('songs')->where('slug', 'narito-ako')->delete();
    }
};
