@extends('layouts.admin')
@section('content')
<div class="title-row"><div><p class="eyebrow">Leadership directory</p><h1>Officers</h1><p class="subheading">Manage officer profiles in a simple tile layout.</p></div><a class="button primary" href="/admin/officers/create">+ Add officer</a></div>
<section class="officer-admin-grid" aria-label="Officer profiles">
@forelse($officers as $officer)
<article class="officer-admin-tile">
<div class="officer-admin-photo">@if($officer->photo)<img src="{{ $officer->photo->url }}" alt="{{ $officer->photo->alt ?: $officer->name }}" loading="lazy">@else<span>{{ collect(explode(' ',$officer->name))->map(fn($name)=>mb_substr($name,0,1))->take(2)->implode('') }}</span>@endif</div>
<div class="officer-admin-info"><span class="officer-admin-position">{{ $officer->position }}</span><h2>{{ $officer->name }}</h2><p>{{ $officer->term ?: 'Term not set' }}</p><span class="officer-admin-status status-{{ $officer->status }}">{{ ucfirst($officer->status) }}</span></div>
<div class="officer-admin-actions"><a class="button primary" href="{{ route('admin.officers.edit',$officer) }}">Edit profile</a><form method="post" action="{{ route('admin.officers.destroy',$officer) }}" data-delete>@csrf @method('DELETE')<button type="submit" class="text-danger">Delete</button></form></div>
</article>
@empty
<div class="panel officer-admin-empty"><p>No officers yet.</p><a class="button primary" href="/admin/officers/create">Add the first officer</a></div>
@endforelse
</section>
@endsection
