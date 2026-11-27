@extends('layouts.public')
@section('title', 'Songs · UECFI')
@section('content')
    <section class="page-heading wrap">
        <p class="eyebrow">UECFI / SONGS</p>
        <h1>Song library</h1>
        <p>Lyrics and chords for worship and service preparation.</p>
    </section>
    <section class="wrap section songs-directory">
        @if ($songs->isNotEmpty())
            <aside class="song-directory-list" aria-label="Song list">
                <div class="song-list-intro">
                    <p class="song-list-kicker">WORSHIP LIBRARY</p>
                    <h2>Choose a song.</h2>
                    <p>Open a song to view its lyrics and chords.</p>
                    <span class="song-count">{{ $songs->count() }} {{ $songs->count() === 1 ? 'song' : 'songs' }}</span>
                </div>
                <nav class="song-list-links">
                    <p class="song-list-group-label">SERVICE FLOW</p>
                    @foreach ($songs as $song)
                        <button class="song-list-link" type="button" data-song-target="{{ $song->slug }}" aria-expanded="false">
                            <span class="song-list-number">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                            <span class="song-list-copy">
                                <strong>{{ $song->title }}</strong>
                                @if ($song->category)<small>{{ $song->category }}</small>@endif
                            </span>
                            <span class="song-list-arrow" aria-hidden="true">↗</span>
                        </button>
                    @endforeach
                </nav>
            </aside>
            <div class="song-results">
                <p class="song-detail-prompt" data-song-prompt>Choose a song above to view its chords and lyrics.</p>
                @foreach ($songs as $song)
                    <article class="song-card song-detail" id="song-panel-{{ $song->slug }}" data-song-panel="{{ $song->slug }}" tabindex="-1" hidden>
                <div class="song-card-heading">
                    <div>
                        @if ($song->category)<p class="eyebrow">{{ $song->category }}</p>@endif
                        <h2>{{ $song->title }}</h2>
                    </div>
                    <span class="song-number">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                </div>
                <div class="song-card-body">
                    @if ($song->slug === 'narito-ako')
                        @include('public.partials.narito-ako-chords', ['song' => $song])
                    @elseif ($song->slug === 'iwagayway-natin')
                        @include('public.partials.iwagayway-natin-chords', ['song' => $song])
                    @elseif ($song->slug === 'pinupuri-ka-namin')
                        @include('public.partials.pinupuri-ka-namin-chords', ['song' => $song])
                    @else
                        <div class="lyrics" aria-label="Lyrics for {{ $song->title }}">{!! nl2br(e($song->lyrics)) !!}</div>
                    @endif
                </div>
                    </article>
                @endforeach
            </div>
        @else
            <div class="empty-state"><h2>Songs are being prepared.</h2><p>Published lyrics will appear here.</p></div>
        @endif
    </section>
    @if ($songs->isNotEmpty())
        <script>
            (() => {
                const buttons = [...document.querySelectorAll('[data-song-target]')];
                const panels = [...document.querySelectorAll('[data-song-panel]')];
                const prompt = document.querySelector('[data-song-prompt]');
                const openSong = (slug, updateHash = true) => {
                    const button = buttons.find((item) => item.dataset.songTarget === slug);
                    const panel = panels.find((item) => item.dataset.songPanel === slug);
                    if (!button || !panel) return;
                    buttons.forEach((item) => {
                        const active = item === button;
                        item.classList.toggle('is-selected', active);
                        item.setAttribute('aria-expanded', active ? 'true' : 'false');
                    });
                    panels.forEach((item) => { item.hidden = item !== panel; });
                    if (prompt) prompt.hidden = true;
                    if (updateHash) history.replaceState(null, '', `#${slug}`);
                    panel.focus({ preventScroll: true });
                };
                buttons.forEach((button) => button.addEventListener('click', () => openSong(button.dataset.songTarget)));
                const initial = window.location.hash.slice(1);
                if (initial) openSong(initial, false);
            })();
        </script>
    @endif
@endsection
