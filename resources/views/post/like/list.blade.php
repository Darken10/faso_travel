@extends('layout')
   
@section('title','Liste des J\'aime')
    

@section('content')

    <x-post.like.list :$likes />

@endsection
