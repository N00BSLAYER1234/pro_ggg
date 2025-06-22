
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Countries Quiz')</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            min-height: 100vh;
            line-height: 1.6;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(10px);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.3);
            border: 1px solid rgba(255,255,255,0.1);
        }

        .btn {
            background: #4CAF50;
            color: white;
            border: none;
            padding: 12px 24px;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin: 5px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .btn:hover {
            background: #45a049;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }

        .btn-secondary {
            background: #2196F3;
        }

        .btn-secondary:hover {
            background: #1976D2;
        }

        .btn-warning {
            background: #FF9800;
        }

        .btn-warning:hover {
            background: #F57C00;
        }

        .form-group {
            margin: 20px 0;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }

        select, input {
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            width: 100%;
            background: rgba(255,255,255,0.9);
            color: #333;
        }

        .text-center {
            text-align: center;
        }

        h1 {
            font-size: 2.5em;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        h2 {
            font-size: 2em;
            margin-bottom: 15px;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
        }

        h3 {
            font-size: 1.5em;
            margin-bottom: 15px;
        }

        .subtitle {
            font-size: 1.2em;
            opacity: 0.9;
            margin-bottom: 30px;
        }

        .progress-bar {
            width: 100%;
            height: 8px;
            background: rgba(255,255,255,0.2);
            border-radius: 4px;
            overflow: hidden;
            margin: 15px 0;
        }

        .progress-fill {
            height: 100%;
            background: #4CAF50;
            transition: width 0.3s ease;
        }

        .stats {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 15px 0;
            font-size: 1.1em;
        }

        .flag-img {
            max-width: 100px;
            max-height: 70px;
            border-radius: 5px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.3);
            border: 2px solid rgba(255,255,255,0.2);
            object-fit: cover;
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px;
                margin: 10px;
            }

            h1 {
                font-size: 2em;
            }

            .btn {
                width: 100%;
                margin: 5px 0;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="container">
        @yield('content')
    </div>
    @stack('scripts')
</body>
</html>
