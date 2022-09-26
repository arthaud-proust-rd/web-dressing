@props(['type'=>'success', 'during'=>2])
<div
    class="{{ $type==='success' ? 'text-green-700 bg-green-50' : 'text-red-700 bg-red-50' }} px-3 py-2 rounded-md"
    x-data="{ show: true }"
    x-transition
    x-init="setTimeout(()=>show=false, {{ $during * 1000 }})"
    x-show="show"
>
    {{ $slot }}
</div>
