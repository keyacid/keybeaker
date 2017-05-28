@extends('layouts.app')

@section('title')
Manage Aliases - keybeaker
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <table style="width: 100%">
                        <tbody>
                            <tr>
                                <td style="text-align: left;">Manage Aliases</td>
                                <td style="text-align: right;">
                                    <button class="btn btn-primary" onclick="javascript:location.href='{{ url('/alias/create') }}'">
                                        Create a new alias
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="panel-body">
                    {{ dump($items) }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection