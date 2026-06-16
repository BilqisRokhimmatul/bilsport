<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Bilsport Jember</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <script>
        function setCookie(name, value, days) {
            let expires = "";
            if (days) {
                let date = new Date();
                date.setTime(date.getTime() + (days*24*60*60*1000));
                expires = "; expires=" + date.toUTCString();
            }
            document.cookie = name + "=" + (value || "")  + expires + "; path=/";
        }

        function getCookie(name) {
            let nameEQ = name + "=";
            let ca = document.cookie.split(';');
            for(let i=0; i < ca.length; i++) {
                let c = ca[i].trim();
                if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
            }
            return null;
        }

        function deleteCookie(name) {   
            document.cookie = name +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
        }

        const currentTheme = getCookie('theme') || 'light';
        const currentFont = getCookie('font_size') || 'text-base';

        if (currentTheme === 'dark') {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }

        document.addEventListener("DOMContentLoaded", function() {
            document.body.classList.add(currentFont);
            if (currentTheme === 'dark') {
                document.body.style.setProperty('background-color', '#121212', 'important');
                document.body.style.setProperty('color', '#ffffff', 'important');
            } else {
                document.body.style.setProperty('background-color', '#FDF5E6', 'important');
                document.body.style.setProperty('color', '#000000', 'important');
            }
        });
    </script>
    </head>
<body style="background-color: #FDF5E6; font-family: 'Poppins', sans-serif;">
    @include('partials.navbar')
    <div style="height: 100px;"></div> 
    <main>{{ $slot }}</main>
    @include('partials.footer')
    <a href="https://wa.me/6285785617164" style="position: fixed; bottom: 20px; right: 20px; z-index: 1000;">
        <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="WA" width="60">
    </a>
</body>
</html>