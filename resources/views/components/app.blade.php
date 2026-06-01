
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>@yield('title', 'SanBong.vn')</title>
  <script src="//unpkg.com/alpinejs" defer></script>

  <!-- Tailwind & Fonts -->
  <script src="https://cdn.tailwindcss.com/3.4.16"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: '#10b981',
            secondary: '#0ea5e9',
          },
          borderRadius: {
            button: '8px',
          },
        },
      },
    };
  </script>

  <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('style.css') }}">
  @include('components.partials.modals')
  <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body class="bg-white font-['Roboto']">

  @include('components.partials.header')
  <main>
    {{ $slot}}
  </main>
  @include('components.partials.footer') 
  @include('components.partials.modals') 
  </body>
</html>