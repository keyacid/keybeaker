@extends('layouts.app')

@section('title')
Send a new message - {{ env('APP_NAME', 'Keybeaker') }}
@endsection

@section('head')
<script>
    function aliasChange() {
        document.getElementById("key").value=document.getElementById("receiver").value;
    }

    window.onload=function() {
        document.getElementById("key").addEventListener("keydown",function(event) {
            document.getElementById("receiver").options[0].selected=true;
        });
    }
</script>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Send a new message</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/sent/create') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label class="col-md-4 control-label">Sender Public Key</label>

                            <div class="col-md-7">
                                <label class="control-label" style="word-break:break-all">{{ $key }}</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="receiver" class="col-md-4 control-label">Receiver</label>

                            <div class="col-md-7">
                                <select id="receiver" name="receiver" class="form-control" onchange="aliasChange()">
                                    <option value="">ENTER PUBLIC KEY</option>
                                    @foreach ($aliases as $key=>$alias)
                                        <option value="{{ $key }}">{{ $alias }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group{{ isset($keyerror) ? ' has-error' : '' }}">
                            <label for="key" class="col-md-4 control-label">Receiver Public Key</label>

                            <div class="col-md-7">
                                <input id="key" type="text" class="form-control" name="key" maxlength="44" value="{{ isset($oldkey) ? $oldkey : '' }}" required{{ (!isset($sigerror)) ? ' autofocus' : '' }}>

                                @if (isset($keyerror))
                                    <span class="help-block">
                                        <strong>{{ $keyerror }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="content" class="col-md-4 control-label">Content</label>

                            <div class="col-md-7">
                                <textarea id="content" class="form-control" name="content" rows="5" style="resize: vertical;" required>{{ isset($oldcontent) ? $oldcontent : '' }}</textarea>
                            </div>
                        </div>

                        <div class="form-group{{ isset($sigerror) ? ' has-error' : '' }}">
                            <label for="signature" class="col-md-4 control-label">Signature</label>

                            <div class="col-md-7">
                                <input id="signature" type="text" class="form-control" name="signature" maxlength="88" value="{{ isset($oldsig) ? $oldsig : '' }}" autocomplete="off" required {{ (isset($sigerror)) ? ' autofocus' : '' }}>

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
                                    Send
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
