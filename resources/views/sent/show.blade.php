@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <table style="width: 100%;">
                        <tbody>
                            <tr>
                                <td style="text-align: left;">Message</td>
                                <td style="text-align: right;">
                                    <form method="POST" style="margin: 0px;">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-danger">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="panel-body">
                    Placeholder
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
