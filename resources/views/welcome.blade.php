@extends('layouts.index')

@section('title')
{{ env('APP_NAME', 'Keybeaker') }}
@endsection

@section('content')
<div class="top-right links">
    <a href="{{ url('/inbox') }}">Inbox</a>
</div>

<div class="content">
    <div class="title m-b-md">
        {{ env('APP_NAME', 'Keybeaker') }}
    </div>

    <div class="links">
        <a href="https://github.com/keyacid/">GitHub</a>
        <a href="https://github.com/keyacid/keybeaker/blob/master/LICENSE">License</a>
    </div>
</div>
@endsection
