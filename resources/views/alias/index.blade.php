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
                @if (count($items)==0)
                    <div class="panel-body">
                        You don't have any aliases!
                    </div>
                @else
                    <div class="panel-body">
                        <ul class="list-group">
                            @foreach ($items as $item)
                                <li class="list-group-item">
                                    <table width="100%">
                                        <tbody>
                                            <tr>
                                                <td style="text-align: left;word-break:break-all">{{ $item->alias }} -> {{ $item->object_key }}</td>
                                                <td style="text-align: right;">
                                                    <form method="POST" style="margin: 0px;" action="{{ url('/alias/'.$item->id) }}">
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
                                </li>
                            @endforeach
                        </ul>
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