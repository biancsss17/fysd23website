<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('songs')->where('slug', 'iwagayway-natin')->update([
            'lyrics' => <<<'LYRICS'
IWAGAYWAY NATIN

A                         D
I.Iwagayway natin ang bandila ang Kristo
G          Em          A
na siyang tatak nating mga kristiyano
D                    A       D
Sundin natin ang Panginoon;
G       Em     A       D
sundin natin ang Panginoon
Bm      F#mG       D       A       D
Nasa gloria, nasa gloria si Hesus na Poon

                              A       D
II.Iwagayway natin ng walang katapusan
G          Em          A
ang sagisag ng kabanalan
D                    A       D
Si Hesus siyang buhay at ilaw.
G          Em     A       D
Siya ang ating mananakop
Bm      F#mG       D       A       D
At sagisag ng pag-asa at buhay-kristiyano

             G       A       D
III.Ang Bandila ni Hesus at Ama
                                      A
ang iwagayway natin sa tuwina
G       Em     G       D
Pagkat siya ang ating pag-asa
             A                    D
sa ating buhay at kalul’wa

       G       A       D
IV.Itong bandilang kataas-taasan
                                      A
ang nararapat nating igalang
G          Em     G       D
Pagkat siyang sagisag ng lahat
             A                    D
ng Panginoong nasa langit

                                      G       D
V.Manalangin kami sa’yo Ama.
                              A              D
Sasambahin ka namin sa tuwina
                                      D7   G   Em
Ikaw ang mapagmahal na Ama
                         G       D       A       D
nagbibigay buhay sa madla

                                      G       D
VI.Kami ngayo’y bigyan ng biyaya.
                         A                    D
Ama naming mahal na patnubay
                              D7   G       Em
Ngayo’y sa amin igawad mo na..
       G       D       A       D   A   D
Bendisyonan mo kami Ama, O Ama...
LYRICS,
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        // The previous lyrics remain available in migration 000003.
    }
};
