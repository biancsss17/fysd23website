<div class="chord-score" aria-label="Lyrics and chords for {{ $song->title }}">
    @foreach ($lines as $line)
        @if (($line['label'] ?? false) !== false)
            <p class="chord-score-label">{{ $line['label'] }}</p>
        @elseif (($line['gap'] ?? false) === true)
            <div class="chord-score-gap" aria-hidden="true"></div>
        @else
            <div class="chord-score-line">
                <span class="chord-score-chords">{{ $line['chords'] }}</span>
                <span class="chord-score-lyrics">@if (($line['marker'] ?? false) !== false)<mark>{{ $line['marker'] }}</mark>@endif{{ $line['lyrics'] }}</span>
            </div>
        @endif
    @endforeach
</div>
