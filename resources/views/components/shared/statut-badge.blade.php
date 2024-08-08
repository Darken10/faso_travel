@props([
    'statut',
])

@php
    switch ($statut->id) {
        case 1:
            $color = "bg-lime-500";
            break;
        case 2:
            $color = "bg-red-500";
            break;
        case 3:
            $color = "bg-amber-400";
            break;
        case 1:
            $color = "bg-red-500";
            break;
        
        default:
            $color = "bg-purple-800";
            break;
    }
@endphp

<span class=" text-gray-100  {{ $color }} text-xs m-1 rounded-lg px-2 font-medium text-center capitalize">
    {{ $statut->name }}
</span>