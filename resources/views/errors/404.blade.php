@extends('layouts.index')

@section('title')
404 - {{ env('APP_NAME', 'Keybeaker') }}
@endsection

@section('content')
<div class="content">
    <div class="title m-b-md">
        404 Not Found
    </div>

    <div class="links">
        <a href="javascript:window.history.back();">Back</a>
    </div>
</div>
@endsection
