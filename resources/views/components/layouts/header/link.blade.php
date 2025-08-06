@props(['href'])

<a href="{{ $href }}"
   {{ $attributes->merge(['class' => request()->url() === url($href) ? 'active' : 'non-active']) }}>
   {{ $slot }}
</a>