<!doctype html>
<html lang="en">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@slot(title)</title>
</head>
<body class="bg-slate-700 text-white">
    @component(header)
    <div id="app" class="max-w-7xl mx-auto py-5">
        <div>
            @slot(content)
        </div>

        <footer>
            @slot(footer)
        </footer>
    </div>
    <script src="public/js/app.js"></script>
</body>
</html>