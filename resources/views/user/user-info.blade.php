@extends("public.layouts")

@section("content")
<div style="width: 400px;background-color: #9b8a30;">
    {{--{{$name}}--}}
    {{--<p>{{ time() }}</p>--}}
    {{--<p>{{ date('Y-m-d H:i:s') }}</p>--}}
    {{--<p>--}}
        {{--{{--}}
            {{--$name1 or 'default'--}}
        {{--}}--}}
    {{--</p>--}}
    {{--<p>@{{ $name }}</p>--}}
    {{-- hahah--}}
    {{--@if ( $name == "liuxiaoshuai" )--}}
        {{--I'm liuxiaoshuai--}}
    {{--@elseif( $name == "lxs" )--}}
        {{--I'm lxs--}}
    {{--@else--}}
        {{--I'm default--}}
    {{--@endif--}}

    {{--<br/>--}}
    {{--@unless ( $name != "liuxiaoshuai" )--}}
        {{--I'm liuxiaoshuai--}}
    {{--@endunless--}}

    {{--<br/>--}}

    {{--@for($i = 0;$i < 10;$i++)--}}
        {{--{{$i}}--}}
    {{--@endfor--}}

    {{--<br/>--}}

    {{--@foreach ($userInfo as $key => $val)--}}
    {{--{{$val['name']}}--}}
    {{--@endforeach--}}

    {{--@forelse($userInfo as $key => $val)--}}
        {{--<p>{{$val->name}}</p>--}}
    {{--@empty--}}
        {{--<p>null</p>--}}
    {{--@endforelse--}}
    <a href="{{url('url1Test')}}">url()</a>
    <br/>
    <a href="{{action('userController@urlTest')}}">action()</a>
    <br/>
    <a href="{{route('url')}}">route()</a>
</div>
@stop