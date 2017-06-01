@extends('layouts.app')

@section('title')
{{ $newcount>0?'('.$newcount.') ':'' }}Inbox - keybeaker
@endsection

@section('head')
<meta http-equiv="refresh" content="60">
<script>
    Notification.requestPermission(function(status) {
        if (status=='granted') {
            var count={{ $newcount }};
            if (count>0) {
                var n=new Notification('keybeaker',{'body':'You have '+count+' new message(s) in keybeaker!'});
                n.onshow=function() {
                    setTimeout(function() {
                        n.close();
                    }, 5000);
                };
                n.onclick=function() {
                    n.close();
                };
            }
        }
    });
</script>
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
                                <td style="text-align: left;">Inbox</td>
                                <td style="text-align: right;">
                                    <button class="btn btn-primary" onclick="javascript:location.href='{{ url('/sent/create') }}'">
                                        Send a new message
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @if (count($items)==0)
                    <div class="panel-body">
                        You don't have any messages in your inbox!
                    </div>
                @else
                    <div class="panel-body">
                        <div class="list-group">
                            @foreach ($items as $item)
                                <a href="{{ url('/inbox/'.$item->id) }}" class="list-group-item{{ $item->receiver_status=='received' ? ' list-group-item-warning' : '' }}">
                                    <h4 class="list-group-item-heading" style="word-break:break-all">From {{ isset($aliases[$item->sender_key])?$aliases[$item->sender_key]:$item->sender_key }}</h4>
                                    <p class="list-group-item-text">Received at {{ $item->created_at }} UTC</p>
                                    <p class="list-group-item-text">
                                        @if ($item->receiver_status=='received')
                                            New
                                        @elseif ($item->receiver_status=='read')
                                            Opened
                                        @endif
                                    </p>
                                </a>
                            @endforeach
                        </div>
                    </div>
                    @if ($items->total()>20)
                        <div class="panel-body">
                            {{ $items->links() }}
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
