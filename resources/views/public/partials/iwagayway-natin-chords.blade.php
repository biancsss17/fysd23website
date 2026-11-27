<div class="iwagayway-score">
@php
    $lines = [
        ['chords' => '              A                  D', 'marker' => 'I.', 'lyrics' => 'Iwagayway natin ang bandila ang Kristo'],
        ['chords' => '       G          Em          A', 'lyrics' => 'na siyang tatak nating mga kristiyano'],
        ['chords' => '       D                    A       D', 'lyrics' => 'Sundin natin ang Panginoon;'],
        ['chords' => '       G       Em     A       D', 'lyrics' => 'sundin natin ang Panginoon'],
        ['chords' => '       Bm      F#mG       D       A       D', 'lyrics' => 'Nasa gloria, nasa gloria si Hesus na Poon'],
        ['gap' => true],
        ['chords' => '                              A       D', 'marker' => 'II.', 'lyrics' => 'Iwagayway natin ng walang katapusan'],
        ['chords' => 'G          Em          A', 'lyrics' => 'ang sagisag ng kabanalan'],
        ['chords' => 'D                    A       D', 'lyrics' => 'Si Hesus siyang buhay at ilaw.'],
        ['chords' => 'G          Em     A       D', 'lyrics' => 'Siya ang ating mananakop'],
        ['chords' => 'Bm      F#mG       D       A       D', 'lyrics' => 'At sagisag ng pag-asa at buhay-kristiyano'],
        ['gap' => true],
        ['chords' => '             G       A       D', 'marker' => 'III.', 'lyrics' => 'Ang Bandila ni Hesus at Ama'],
        ['chords' => '                                      A', 'lyrics' => 'ang iwagayway natin sa tuwina'],
        ['chords' => '       G       Em     G       D', 'lyrics' => 'Pagkat siya ang ating pag-asa'],
        ['chords' => '             A                    D', 'lyrics' => 'sa ating buhay at kalul’wa'],
        ['gap' => true],
        ['chords' => '       G       A       D', 'marker' => 'IV.', 'lyrics' => 'Itong bandilang kataas-taasan'],
        ['chords' => '                                      A', 'lyrics' => 'ang nararapat nating igalang'],
        ['chords' => 'G          Em     G       D', 'lyrics' => 'Pagkat siyang sagisag ng lahat'],
        ['chords' => '             A                    D', 'lyrics' => 'ng Panginoong nasa langit'],
        ['gap' => true],
        ['chords' => '                                      G       D', 'marker' => 'V.', 'lyrics' => 'Manalangin kami sa’yo Ama.'],
        ['chords' => '                              A              D', 'lyrics' => 'Sasambahin ka namin sa tuwina'],
        ['chords' => '                                      D7   G   Em', 'lyrics' => 'Ikaw ang mapagmahal na Ama'],
        ['chords' => '                         G       D       A       D', 'lyrics' => 'nagbibigay buhay sa madla'],
        ['gap' => true],
        ['chords' => '                                      G       D', 'marker' => 'VI.', 'lyrics' => 'Kami ngayo’y bigyan ng biyaya.'],
        ['chords' => '                         A                    D', 'lyrics' => 'Ama naming mahal na patnubay'],
        ['chords' => '                              D7   G       Em', 'lyrics' => 'Ngayo’y sa amin igawad mo na..'],
        ['chords' => '       G       D       A       D   A   D', 'lyrics' => 'Bendisyonan mo kami Ama, O Ama...'],
    ];
@endphp
@include('public.partials.chord-score', ['song' => $song, 'lines' => $lines])
</div>
