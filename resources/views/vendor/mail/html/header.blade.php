@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Blink-Safety')
<img src="https://blink-safety.com/build/assets/blink-safety-logo-312d4928.svg" class="logo" alt="Blink-Safety">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
