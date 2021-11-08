@extends('layouts.main')

@section('container')

@livewire('edit-note', ['note' => $note])


@endsection