@props(['w' => 62, 'l' => 170, 'color' => '#0E6B5B', 'pattern' => 'striate'])
@php
    $top = -50;
    $end = $top + $l;
@endphp
{{-- Drawn pointing up around 0,0 so it can be scaled and rotated from its centre. --}}
<g stroke="#2A1238" stroke-linecap="round" stroke-linejoin="round" {{ $attributes }}>
    @foreach ([1, -1] as $side)
        <g transform="scale({{ $side }} 1)" fill="none">
            <path stroke-width="3" d="M8 -128 C18 -150 30 -152 36 -172 M36 -172 l5 -6" />
            <path stroke-width="3.5" d="M{{ $w * .55 }} -66 L{{ $w + 30 }} -92 L{{ $w + 46 }} -132 l9 -8" />
            <path stroke-width="3.5" d="M{{ $w * .9 }} -10 L{{ $w + 34 }} 4 L{{ $w + 56 }} -22 l11 -5" />
            <path stroke-width="3.5" d="M{{ $w * .8 }} 50 L{{ $w + 32 }} 92 L{{ $w + 48 }} 146 l5 11" />
        </g>
        <g transform="scale({{ $side }} 1)">
            <path fill="{{ $color }}" stroke-width="2.5"
                d="M1.5 {{ $top }} C{{ $w * .7 }} {{ $top - 3 }} {{ $w }} {{ $top + 8 }} {{ $w }} {{ $top + 42 }} C{{ $w }} {{ $top + $l * .68 }} {{ $w * .55 }} {{ $end - 8 }} 1.5 {{ $end }} Z" />
            @if ($pattern === 'striate')
                @foreach ([.3, .55, .8] as $f)
                    <path fill="none" stroke-width="1.2" opacity=".7" d="M{{ $w * $f }} {{ $top + 7 }} C{{ $w * $f + 3 }} {{ $top + $l * .5 }} {{ $w * $f * .85 }} {{ $top + $l * .75 }} {{ $w * $f * .5 }} {{ $end - 16 }}" />
                @endforeach
            @elseif ($pattern === 'spots')
                <circle cx="{{ $w * .5 }}" cy="{{ $top + $l * .25 }}" r="{{ $w * .16 }}" fill="#F6F5E4" stroke-width="1.2" />
                <circle cx="{{ $w * .58 }}" cy="{{ $top + $l * .55 }}" r="{{ $w * .13 }}" fill="#F6F5E4" stroke-width="1.2" />
                <circle cx="{{ $w * .3 }}" cy="{{ $top + $l * .78 }}" r="{{ $w * .1 }}" fill="#F6F5E4" stroke-width="1.2" />
            @elseif ($pattern === 'band')
                <path fill="#F6F5E4" stroke-width="1.2" d="M1.5 {{ $top + $l * .32 }} Q{{ $w * .5 }} {{ $top + $l * .25 }} {{ $w }} {{ $top + $l * .3 }} L{{ $w * .94 }} {{ $top + $l * .5 }} Q{{ $w * .5 }} {{ $top + $l * .44 }} 1.5 {{ $top + $l * .52 }} Z" />
            @endif
            <path fill="none" stroke="#F6F5E4" stroke-width="3" opacity=".35" d="M{{ $w * .78 }} {{ $top + 16 }} C{{ $w * .86 }} {{ $top + $l * .3 }} {{ $w * .8 }} {{ $top + $l * .5 }} {{ $w * .68 }} {{ $top + $l * .66 }}" />
        </g>
    @endforeach
    <path fill="{{ $color }}" stroke-width="2.5" d="M-22 -96 C-40 -92 -{{ $w * .72 }} -78 -{{ $w * .76 }} -54 Q0 -42 {{ $w * .76 }} -54 C{{ $w * .72 }} -78 40 -92 22 -96 Q0 -103 -22 -96 Z" />
    <path fill="#2A1238" stroke-width="2" d="M-20 -97 C-24 -122 -12 -134 0 -134 C12 -134 24 -122 20 -97 Q0 -104 -20 -97 Z" />
    <circle cx="-13" cy="-120" r="3" fill="#F6F5E4" stroke="none" />
    <circle cx="13" cy="-120" r="3" fill="#F6F5E4" stroke="none" />
</g>
