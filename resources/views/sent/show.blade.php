@extends('layouts.app')

@section('title')
Sent - keybeaker
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <table style="width: 100%;">
                        <tbody>
                            <tr>
                                <td style="text-align: left;">
                                    <button type="button" class="btn btn-default" onclick="javascript: location.href='{{ url('/sent') }}'">
                                        &lt; Sent
                                    </button>
                                </td>
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
                    <table class="table">
                        <tbody>
                            <tr>
                                <th scope="row" style="text-align: right;">From</th>
                                <td style="word-break:break-all">{{ $item->sender_key }}</td>
                            </tr>
                            <tr>
                                <th scope="row" style="text-align: right;">To</th>
                                <td style="word-break:break-all">{{ $item->receiver_key }}</td>
                            </tr>
                            <tr>
                                <th scope="row" style="text-align: right;">Sent at</th>
                                <td>{{ $item->created_at }} UTC</td>
                            </tr>
                            <tr>
                                <th scope="row" style="text-align: right;">Status</th>
                                <td>
                                    @if ($item->receiver_status=='received')
                                        Unopened
                                    @elseif ($item->receiver_status=='read')
                                        Opened
                                    @elseif ($item->receiver_status=='deleted')
                                        Opened and Deleted
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" style="text-align: right;">Content</th>
                                <td style="word-break:break-all">{!! nl2br(e($item->content)) !!}</td>
                            </tr>
                            <tr>
                                <th scope="row" style="text-align: right;">Signature</th>
                                <td style="word-break:break-all">{{ $item->signature }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
