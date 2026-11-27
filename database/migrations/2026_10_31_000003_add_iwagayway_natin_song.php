<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $lyrics = <<<'LYRICS'
IWAGAYWAY NATIN

I. Iwagayway natin ang bandila ni Kristo
   na siyang tatak nating kristiyano
Sundin natin ang Panginoon;
sundin natin ang Panginoon
Nasa gloria, nasa gloria si Hesus na Poon

II. Iwagayway natin ng walang katapusan
    ang sagisag ng kabanalan
Si Hesus siyang buhay at ilaw.
Siya ang ating mananakop
At sagisag ng pag-asa at buhay-kristiyano

III. Ang Bandila ni Hesus at Ama
     ang iwagayway natin sa tuwina
Pagkat siya ang ating pag-asa
sa ating buhay at kalul’wa

Itong bandilang kataas-taasan
ang nararapat nating igalang
Pagkat siyang sagisag ng lahat
ng Panginoon nasa langit

IV. Manalangin kami sa’yo Ama.
    Sasambahin ka namin sa tuwina
Ikaw ang mapagmahal na Ama
nagbibigay buhay sa madla

Kami ngayo’y bigyan ng biyaya.
Ama naming mahal na patnubay
Ngayo’y sa amin igawad mo na..
Bendisyonan mo kami Ama, O Ama...
LYRICS;

        DB::table('songs')->updateOrInsert(
            ['slug' => 'iwagayway-natin'],
            [
                'title' => 'IWAGAYWAY',
                'category' => 'SONGS',
                'lyrics' => $lyrics,
                'video_url' => null,
                'published_at' => now(),
                'status' => 'published',
                'sort_order' => 2,
                'created_by' => null,
                'updated_at' => now(),
                'created_at' => now(),
            ],
        );
    }

    public function down(): void
    {
        DB::table('songs')->where('slug', 'iwagayway-natin')->delete();
    }
};
