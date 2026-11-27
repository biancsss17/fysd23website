<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('songs')->where('slug', 'pinupuri-ka-namin')->update([
            'lyrics' => <<<'LYRICS'
PINUPURI KA NAMIN

C       F          G    C
Pinupuri ka namin O Jesus
        F       G                 C
Tinataas sa’yo aming kamay
      F              G                 C
Umaawit sa’yo ng bagong awit
        Dm                              G
Sumasamba sa tanging ngalan Mo

CORO:       C
Luwalhatiin, dadakilain
      F                                      G     C    C7
Sasambahin lagi ang ngalan Mo Panginoon
           F      G          C
Kahit kalian, dika nagkulang
     Dm                                      C    C7
Biyaya Mo sa amin laging laan
           F      G                         C
Pag-ibig Mo sa amin walang hanggan
              Dm                  C
Iniibig Mo kami noon pa man…
LYRICS,
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        // The previous lyrics remain available in migration 000004.
    }
};
