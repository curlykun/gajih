<div class="alert alert-info {{ $class }}" id="{{ $id }}">
    <button type="button" class="close" onclick="$('#{{ $id }}').alert('close');">&times;</button>
    {{ $slot }}
</div>