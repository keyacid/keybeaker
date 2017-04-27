@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Manage public keys
                    <button class="btn btn-primary" onclick="javascript:location.href='{{ url('/publickey/create') }}';"\>
                        Add a public key
                    </button>
                </div>

                <div class="panel-body">
                    You don't have any public keys!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
