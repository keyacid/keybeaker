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
                @forelse ($items as $item)
                    <div class="panel-body">
                        <a href="{{ url('/sent/'.$item->id) }}">{{ $item }}</a>
                    </div>
                @empty
                    <div class="panel-body">
                        You don't have any messages in your sent box!
                    </div>
                @endforelse
                <div class="panel-body">
                    {{ $items->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
