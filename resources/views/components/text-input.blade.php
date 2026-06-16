@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => 'border-gray-300 rounded-md shadow-sm w-full',
    'style' => 'background-color: #fff0f5 !important; color: #800000;' 
]) !!}>

<style>
    input:focus {
        background-color: #fff0f5 !important;
        border-color: #800000 !important;
        outline: none !important;
        box-shadow: 0 0 0 2px rgba(128, 0, 0, 0.2) !important;
    }

    input:-webkit-autofill,
    input:-webkit-autofill:hover, 
    input:-webkit-autofill:focus {
        -webkit-text-fill-color: #800000 !important;
        -webkit-box-shadow: 0 0 0px 1000px #fff0f5 inset !important;
        transition: background-color 5000s ease-in-out 0s;
    }
</style>