<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" x-init="initialize()" lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Centralised Software</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="{{ asset('/assets/css/tailwind.output.css') }}" />
    <script
      src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"
      defer
    ></script>
    <script src="{{ asset('/assets/js/init-alpine.js') }}?v=2"></script>
    <script src="https://kit.fontawesome.com/231b67747d.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@25.3.1/build/js/intlTelInput.min.js"></script>
    <link href="https://cdn.jsdelivr.net/gh/priyashpatil/phone-input-by-country@0.0.1/cpi.css" rel="stylesheet" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@25.3.1/build/css/intlTelInput.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script src="https://unpkg.com/vue-select@latest"></script>
    <link rel="stylesheet" href="https://unpkg.com/vue-select@3.0.0/dist/vue-select.css">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/choices.js/1.1.6/styles/css/choices.min.css" integrity="sha512-/PTsSsk4pRsdHtqWjRuAL/TkYUFfOpdB5QDb6OltImgFcmd/2ZkEhW/PTQSayBKQtzjQODP9+IAeKd7S2yTXtA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css"
    />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
   
    <style>
      body {
        overflow-y: scroll;
        height: 100%;
      }
      .loader {
        width: 20px;
        height: 20px;
        border: 5px solid #FFF;
        border-bottom-color: transparent;
        border-radius: 50%;
        display: inline-block;
        box-sizing: border-box;
        animation: rotation 1s linear infinite;
      }

        @keyframes rotation {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
        }
        .loader.big {
          width: 40px;
          height: 40px;
        }
        .loader.small {
          width: 10px;
          height: 10px;
        }
        .loader.purple {
          border: 5px solid #7e3af2;
          border-bottom-color: transparent;
        }
        .sticky {
          position: fixed;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    @routes
    <script>
      // Example: After login, you get token from response
      const token = localStorage.token; // Replace this dynamically


      if(!localStorage.getItem("token")) {
        window.location = route("login");
      } else {

      // Save token somewhere persistent (localStorage recommended)
      localStorage.setItem('token', token);

      // Set default Authorization header for all axios requests
      axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;
      // Now all axios calls will include the token automatically
      }

      localStorage.setItem("dark", false);
    </script>
    <style>
            
      .hide {
        animation: hide 0.3s forwards;
      }
      .hideNavbar {
        animation: hideNavbar 0.3s forwards;
      }
      @keyframes hide {
        0% {
          width: 230px;
        }
        100% {
          width: 60px;
        }
      }
      @keyframes hideNavbar {
        100% {
          display: none;
        }
      }
    </style>
  </head>
  <body>
    <div
      class="flex h-screen bg-gray-50 dark:bg-gray-900"
      :class="{ 'overflow-hidden': isSideMenuOpen}"
    >

      
      <!-- Desktop sidebar -->
      <x-navbar 
            x-show="isSideMenuOpen"
            style="width: 20%; width: 230px;"  
            visible
            x-transition:enter="transition ease-in-out duration-150"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in-out duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
      />
      <x-navbar 
            x-show="isSideMenuOpen" 
            style="position: fixed; height: 100%; width: 230px;"
            x-transition:enter="transition ease-in-out duration-150"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in-out duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
        />
      <!-- Mobile sidebar -->
      <!-- Backdrop -->
      <div class="flex flex-col flex-1">
        <header class="z-10 py-4 bg-white shadow-md dark:bg-gray-800">
          <div
            class="container flex items-center justify-between h-full px-6 mx-auto text-purple-600 dark:text-purple-300"
          >
            <!-- Mobile hamburger -->
            <button
              class="p-1 -ml-1 mr-5 rounded-md focus:outline-none focus:shadow-outline-purple"
              @click="toggleSideMenu"
              aria-label="Menu"
            >
              <svg
                class="w-6 h-6"
                aria-hidden="true"
                fill="currentColor"
                viewBox="0 0 20 20"
              >
                <path
                  fill-rule="evenodd"
                  d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                  clip-rule="evenodd"
                ></path>
              </svg>
            </button>
          </div>
        </header>


        {{ $slot }}
    </div>
</div>
</body>
</html>

