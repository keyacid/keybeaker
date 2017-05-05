@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <table style="width:100%;">
                        <tbody>
                            <tr>
                                <td>Manage public keys</td>
                                <td style="text-align: right;">
                                    <button class="btn btn-primary" onclick="javascript:location.href='{{ url('/publickey/create') }}';">
                                        Add a public key
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="panel-body">
                    You don't have any public keys!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
