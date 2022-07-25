<div id="location-info" class="basic-container multi-part-container">
    <div id="location-info-page">
{{--            <p><a>home</a></p>&nbsp&nbsp>&nbsp;&nbsp;<p><a>forum index</a></p>--}}
            @for($i = 0; $i < count($page); $i++)
                @if($i == count($page)-1)
                <p><a href="{{$page[$i][1]}}">{{$page[$i][0]}}</a></p>
                @else
                <p><a href="{{$page[$i][1]}}">{{$page[$i][0]}}</a></p>&nbsp;&nbsp;>&nbsp;&nbsp;
                @endif
            @endfor
    </div>
    <div id="location-info-date">
        {{date('D M d, Y')}}
    </div>
</div>
