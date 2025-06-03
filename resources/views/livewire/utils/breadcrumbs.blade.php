<div class="d-breadcrumbs text-sm py-0.5 text-base-content/75">
    <ul>
        @foreach($breadcrumbs as $breadcrumb)
        @if($loop->last)
        <li class="capitalize">{{Str::headline($breadcrumb)}}</li>
        @else
        <li><a href="{{url($breadcrumbs->take($loop->iteration)->join('/'))}}">{{Str::headline($breadcrumb)}}</a></li>
        @endif
        @endforeach
    </ul>
</div>