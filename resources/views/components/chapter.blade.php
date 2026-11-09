@props(['place', 'when', 'where'])
<article {{ $attributes->merge(['class' => 'chapter']) }}>
    <div class="chapter-body">{{ $slot }}</div>
    <aside class="field-label">
        <span>{{ $where }}</span>
        <span>{{ $place }}</span>
        <span>{{ $when }}</span>
    </aside>
</article>
