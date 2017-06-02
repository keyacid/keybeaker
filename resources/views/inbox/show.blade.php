@extends('layouts.app')

@section('title')
Inbox - {{ env('APP_NAME', 'Keybeaker') }}
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
                                    <button type="button" class="btn btn-default" onclick="javascript: location.href='{{ url('/inbox') }}'">
                                        &lt; Inbox
                                    </button>
                                </td>
                                <td style="text-align: right;">
                                    <form method="POST" style="margin: 0px;">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="button" class="btn btn-primary" onclick="javascript: location.href='{{ url('/sent/create?receiver='.urlencode($item->sender_key)) }}'">
                                            Reply
                                        </button>
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
                                <td style="word-break:break-all">{{ isset($aliases[$item->sender_key])?$aliases[$item->sender_key].' ('.$item->sender_key.')':$item->sender_key }}</td>
                            </tr>
                            <tr>
                                <th scope="row" style="text-align: right;">To</th>
                                <td style="word-break:break-all">{{ isset($aliases[$item->receiver_key])?$aliases[$item->receiver_key].' ('.$item->receiver_key.')':$item->receiver_key }}</td>
                            </tr>
                            <tr>
                                <th scope="row" style="text-align: right;" nowrap>Received at</th>
                                <td>{{ $item->created_at }} UTC</td>
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
