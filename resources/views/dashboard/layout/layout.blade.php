<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Safari Boulevard - Data Management System</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body>

    @include("dashboard.layout.header")

    @include("dashboard.layout.sidebar")

    @yield("dashboard/dashboard")

</body>

</html>
