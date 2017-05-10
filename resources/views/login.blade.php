@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ isset($keyerror) ? ' has-error' : '' }}">
                            <label for="key" class="col-md-4 control-label">Public Key</label>

                            <div class="col-md-6">
                                <input id="key" type="text" class="form-control" name="key" maxlength="44" value="{{ isset($oldkey) ? $oldkey : '' }}" required{{ (!isset($sigerror)) ? ' autofocus' : '' }}>

                                @if (isset($keyerror))
                                    <span class="help-block">
                                        <strong>{{ $keyerror }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Sign this message</label>

                            <div class="col-md-6">
                                <label class="control-label">{{ $nonce }}</label>
                            </div>
                        </div>

                        <div class="form-group{{ isset($sigerror) ? ' has-error' : '' }}">
                            <label for="signature" class="col-md-4 control-label">Signature</label>

                            <div class="col-md-6">
                                <input id="signature" type="text" class="form-control" name="signature" maxlength="88" required {{ (isset($sigerror)) ? ' autofocus' : '' }}>

                                @if (isset($sigerror))
                                    <span class="help-block">
                                        <strong>{{ $sigerror }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
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
