@extends('admin.layout')

@section('title','validation du ticket')

@section('content')

    <form action="{{ route('admin.validation.valider',$ticket) }}" method="post">
        @csrf
        <button type="submit" class="btn-primary">Valider</button>
    </form>

@endsection
