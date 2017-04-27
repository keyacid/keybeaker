@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add public key</div>

                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/publickey') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="publickey" class="col-md-4 control-label">Public Key</label>
                            <div class="col-md-6">
                                <input id="publickey" type="text" class="form-control" name="publickey" required autofocus>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Sign this message: </label>
                            <div class="col-md-6">
                                <label class="control-label">{{ $nonce }}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="signature" class="col-md-4 control-label">Signature</label>
                            <div class="col-md-6">
                                <input id="signature" type="text" class="form-control" name="signature" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Add
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
