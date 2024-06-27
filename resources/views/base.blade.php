<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Management System</title>
    <!-- Include external stylesheets and scripts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <script type="importmap">
      {
        "imports": {
          "@material/web/": "https://esm.run/@material/web/"
        }
      }
    </script>
    <script type="module">
      import '@material/web/all.js';
      import {styles as typescaleStyles} from '@material/web/typography/md-typescale-styles.js';

      document.adoptedStyleSheets.push(typescaleStyles.styleSheet);
    </script>
    <!-- Link to your app.css file -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Additional inline styles -->
    <style>
      .primary-container {
        background-color: var(--md-sys-color-primary-container);
        color: black; /* Contrast text color */
        padding: 16px;
        border-radius: 8px;
      }
    </style>
</head>
<body class="main">
    @yield('content')
</body>
</html>
