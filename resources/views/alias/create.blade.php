@extends('layouts.app')

@section('title')
Create a new alias - keybeaker
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <button type="button" class="btn btn-default" onclick="javascript: location.href='{{ url('/alias') }}'">
                        < Alias
                    </button>
                    Create a new alias
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/alias/create') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ isset($keyerror) ? ' has-error' : '' }}">
                            <label for="key" class="col-md-4 control-label">Public Key</label>

                            <div class="col-md-7">
                                <input id="key" type="text" class="form-control" name="key" maxlength="44" required autofocus>

                                @if (isset($keyerror))
                                    <span class="help-block">
                                        <strong>{{ $keyerror }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="alias" class="col-md-4 control-label">Alias</label>

                            <div class="col-md-7">
                                <input id="alias" type="text" class="form-control" name="alias" value="{{ isset($oldalias) ? $oldalias : '' }}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Create
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection