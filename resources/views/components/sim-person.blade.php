@props(['image', 'initial', 'name', 'role'])
<div class="person">
    @if (file_exists(public_path($image)))
        <img src="{{ asset($image) }}" alt="{{ $name }}">
    @else
        <span class="person-initial" aria-hidden="true">{{ $initial }}</span>
    @endif
    <p><strong>{{ $name }}</strong> {{ $role }}</p>
</div>
