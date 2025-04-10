@extends('admin.layouts.app')
@section('title')
Sosyal Medya
@endsection
@section('contents')
@section('topheader')
Sosyal Medya
@endsection
<div class="card radius-5">
    <div class="card-header bg-transparent">

    </div>
    <!-- Modal -->


    <div class="card-body" style="border-radius: 5px">
        <h4>{{ $sosyalmedya->gonderi_adi }} - Resimler</h4>

@php
    $resimler = json_decode($sosyalmedya->resim, true);
@endphp

@if ($resimler)
    @foreach ($resimler as $resim)
        <img src="{{ asset($resim) }}" alt="Görsel" width="200" class="m-2">
    @endforeach
@else
    <p>Resim yok.</p>
@endif
    </div>
</div>

@endsection
