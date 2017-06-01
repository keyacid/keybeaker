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
                                <td style="text-align: left;">Sent</td>
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
                        You don't have any messages in your sent box!
                    </div>
                @else
                    <div class="panel-body">
                        <div class="list-group">
                            @foreach ($items as $item)
                                <a href="{{ url('/sent/'.$item->id) }}" class="list-group-item">
                                    <h4 class="list-group-item-heading" style="word-break:break-all">To {{ isset($aliases[$item->receiver_key])?$aliases[$item->receiver_key]:$item->receiver_key }}</h4>
                                    <p class="list-group-item-text">Sent at {{ $item->created_at }} UTC</p>
                                    <p class="list-group-item-text">
                                        @if ($item->receiver_status=='received')
                                            Unopened
                                        @elseif ($item->receiver_status=='read')
                                            Opened
                                        @elseif ($item->receiver_status=='deleted')
                                            Opened and Deleted
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
