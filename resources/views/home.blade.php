@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    Welcome to keybeaker!<br>
                    Select an item in the dropdown menu to proceed.
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Unread messages</div>

                <div class="panel-body">
                    You don't have any unread messages!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
