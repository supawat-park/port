@extends('layouts.sidemenu')

@section('content')
    <h1 class="mt-4">Simple Regex [Regular Expression]</h1>
    <h3 class="mt-4">Input string with following condition</h3>
    <h5 class="mt-4"> - Not null</h5>
    <h5 class="mt-4"> - First character must be number (0-9)</h5>
    <h5 class="mt-4"> - String can contain only alphabet, number and underscore '_'</h5>
    <br>
            <regex-component></regex-component>
@endsection
