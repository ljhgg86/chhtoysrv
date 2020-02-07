<div class="list-group">
    @foreach($types as $type)
    <a href="{{ url('/admin/yellowpages/'.$type->id.'/infomationsList') }}" class="list-group-item">{{ $type->name }}</a>
    @endforeach
</div>
