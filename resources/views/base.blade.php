<head>
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
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="container">

</body>
