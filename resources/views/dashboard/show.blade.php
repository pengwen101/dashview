<html lang="en" class="h-screen">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$dashboard->name}}</title>
    <script src="https://cdn.tailwindcss.com/3.3.0"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="m-0 p-0 h-screen w-screen overflow-hidden">
    <iframe 
        src="{{ $dashboard->link }}" 
        class="fixed top-0 left-0 w-screen h-screen border-0" 
        frameborder="0" 
        allowfullscreen 
        title="{{ $dashboard->name }} {{ $dashboard->description }}">
    </iframe>
</body>
</html>

