@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://laravel.com/img/notification-logo-v2.1.png" class="logo" alt="Laravel Logo">
@else
<x-application-logo class="w-16 h-16" style="width: 64px; height: 64px;" />
@endif
</a>
</td>
</tr>
