<!DOCTYPE html>
<html>
<head>
    <title>Kanban Board</title>
</head>
<script src="{{ asset('js/app.js') }}" defer></script>
<link href="{{ asset('css/app.css') }}" rel="stylesheet">

<style>
.column {
    border: 1px solid red;
    min height: 200px;
}
.card {
    border: 1px solid black;
    height: 50px;
}
</style>
<body>

<div class="container">

    @yield('content')

</div>

</body>
</html>