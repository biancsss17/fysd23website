@php
    $lines = [
        ['chords' => '        C       F          G    C', 'lyrics' => 'Pinupuri ka namin O Jesus'],
        ['chords' => '                F       G                 C', 'lyrics' => 'Tinataas sa’yo aming kamay'],
        ['chords' => '              F              G                 C', 'lyrics' => 'Umaawit sa’yo ng bagong awit'],
        ['chords' => '                Dm                              G', 'lyrics' => 'Sumasamba sa tanging ngalan Mo'],
        ['gap' => true],
        ['label' => 'CORO:'],
        ['chords' => '       C', 'lyrics' => 'Luwalhatiin, dadakilain'],
        ['chords' => '      F                                      G     C    C7', 'lyrics' => 'Sasambahin lagi ang ngalan Mo Panginoon'],
        ['gap' => true],
        ['chords' => '                   F      G          C', 'lyrics' => 'Kahit kalian, dika nagkulang'],
        ['chords' => '             Dm                                      C    C7', 'lyrics' => 'Biyaya Mo sa amin laging laan'],
        ['chords' => '                   F      G                         C', 'lyrics' => 'Pag-ibig Mo sa amin walang hanggan'],
        ['chords' => '                      Dm                  C', 'lyrics' => 'Iniibig Mo kami noon pa man…'],
    ];
@endphp
@include('public.partials.chord-score', ['song' => $song, 'lines' => $lines])
