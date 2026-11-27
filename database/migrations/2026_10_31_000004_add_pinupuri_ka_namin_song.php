<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $lyrics = <<<'LYRICS'
PINUPURI KA NAMIN

Pinupuri ka namin O Jesus
Tinatataas sa’yo ang kamay
Umaawit sa’yo ng bagong awit
Sumasamba sa tanging ngalan Mo

CORO:
Luwalhatiin, dadakilain
Sasambahin lagi ang ngalan Mo Panginoon

Kahit kalian, di ka nagkukulang
Biyaya Mo sa amin laging laan
Pag-ibig Mo sa amin walang hanggan
Inibig Mo kami noon pa man…
LYRICS;

        DB::table('songs')->updateOrInsert(
            ['slug' => 'pinupuri-ka-namin'],
            [
                'title' => 'PINUPURI KA NAMIN',
                'category' => 'SONGS',
                'lyrics' => $lyrics,
                'video_url' => null,
                'published_at' => now(),
                'status' => 'published',
                'sort_order' => 3,
                'created_by' => null,
                'updated_at' => now(),
                'created_at' => now(),
            ],
        );
    }

    public function down(): void
    {
        DB::table('songs')->where('slug', 'pinupuri-ka-namin')->delete();
    }
};
