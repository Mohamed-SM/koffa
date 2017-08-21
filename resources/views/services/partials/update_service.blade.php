<li id="koffa{{$service->id}}">
    @if($service->status == "pas pret")
    <i class="fa fa-clock-o activity-icon"></i>
    @else
        @if($service->status == "pret")
        <i class="fa fa-star-o activity-icon"></i>
        @else
        <i class="fa fa-check-circle-o activity-icon"></i>
        @endif
    @endif
    <p>CODE {{$service->shop_id.'_'.$service->id}} : {{ $service->status }}<span class="timestamp">{{ $service->created_at->diffForHumans() }}</span>
    {{ $service->description }}<br>  
    @if(Auth::id() == $service->shop->user->id or Auth::user()->hasRole('Admin'))
        <button type="button"
        class="btn btn btn-success btn-xs"
        @if($service->status == "pret") 
        disabled="disabled"
        @endif
        onclick="pret({{$service->id}})"
        ><i class="fa fa-check-circle-o"></i> pret</button>
    @endif
    @if($service->status == "pret")
    @if(Auth::user()->hasRole('Member') or Auth::user()->hasRole('Admin'))
    <button type="button" class="btn btn-success btn-xs" onclick="delever({{$service->id}})"><i class="fa fa-hand-rock-o"></i> Delevré</button></p>
    @endif
    @endif
</li>
<hr>