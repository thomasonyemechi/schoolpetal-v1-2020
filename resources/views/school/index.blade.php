@extends('layouts.app');

@section('content')
  dyidyhduhduhdyuhdddy
  @if (session()->has('key'))
    {{session()->get('key')}}
  @endif
  {{Auth::user()->id}}


  @if (session()->has('userid'))
    {{session()->get('userid')}}
  @endif
@endsection
