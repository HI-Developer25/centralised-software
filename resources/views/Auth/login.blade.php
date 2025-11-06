<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - Windmill Dashboard</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="{{ asset("/assets/css/tailwind.output.css") }}" />
    <script
      src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"
      defer
    ></script>
    <script src="{{ asset('/assets/js/init-alpine.js') }}"></script>
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />


    <style>

      body {
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
        .loader.normal {
            width: 20x;
            height: 20px;
        }
        .loader.purple {
          border: 5px solid #7e3af2;
          border-bottom-color: transparent;
        }
        .sticky {
          position: fixed;
        }
        .normal-state {
          background: #7C3AED;
        }
        .normal-state:hover {
          background: #6D28D9;
        }
        .passed-state {
          background: #16A34A;
        }
        .passed-state:hover {
          background: #15803D
        }
    </style>
    @routes
    <script>
        const token = localStorage.token;

        if(token && token.length > 0) {
            window.location = route("member.create");
        }
    </script>
  </head>
  <body>
    <div class="flex items-center min-h-screen p-6 bg-gray-50 dark:bg-gray-900" id="app">
      <div
        class="flex-1 h-full max-w-4xl mx-auto overflow-hidden bg-white rounded-lg shadow-xl dark:bg-gray-800 animate__animated"
        :class="{ 'animate__shakeX': failed }"
      >
        <div class="flex flex-col overflow-y-auto md:flex-row">
          
          <div class="h-32 md:h-auto md:w-1/2">
            <img
              aria-hidden="true"
              class="object-cover w-full h-full dark:hidden"
              src="https://gwadargymkhana.com.pk/members/interior.jpg"
              alt="Office"
            />
            <img
              aria-hidden="true"
              class="hidden object-cover w-full h-full dark:block"
              src="../assets/img/login-office-dark.jpeg"
              alt="Office"
            />
          </div>
          <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
            <div class="w-full">
              <h1
                class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200"
              >
                Login
              </h1>
              <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Username</span>
                <input
                    v-model="username"
                  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                  placeholder="Shahmir Ahsanullah"
                />
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Password</span>
                <input
                    v-model="password"
                  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                  placeholder="***************"
                  type="password"
                />
              </label>

              <!-- You should use a button here, as the anchor is only used for the example  -->
                <button
              class="transition-colors duration-300 ease-in-out block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 border border-transparent rounded-lg active:bg-purple-600 focus:outline-none focus:shadow-outline-purple"
              :class="{ 'normal-state': !passed, 'passed-state': passed }"
              style="height: 40px;"
              @click="generateOtp"
              :disabled="is_authenticating"
            >
              <span v-if="is_authenticating" class="loader normal"></span>
              <span v-else-if="!passed">Log in</span>
              <span v-else>Success</span>
            </button>

              <hr class="my-8" />




            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.9.0/axios.min.js" integrity="sha512-FPlUpimug7gt7Hn7swE8N2pHw/+oQMq/+R/hH/2hZ43VOQ+Kjh25rQzuLyPz7aUWKlRpI7wXbY6+U3oFPGjPOA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    const app = Vue.createApp({
        data() {
            return {
                username: "",
                password: "",
                is_authenticating: false,
                passed: false,
                failed: false
            }
        },
        methods: {
            fails() {
              this.failed = true;
              this.passed = false;
              this.is_authenticating = false;
            },
            pass() {
              this.failed = false;
              this.passed = true;
              this.is_authenticating = false;
            },
            async generateOtp() {
              this.is_authenticating = true;
              try {
                const response = await axios.get(route("api.otp", { password: this.password, user: this.username }));


                  Swal.fire({
                    title: 'Enter OTP',
                    input: 'text',
                    inputLabel: 'email',
                    inputPlaceholder: 'Enter your OTP here',
                    confirmButtonText: 'Verify',
                    showCancelButton: true,
                    inputAttributes: {
                        maxlength: 6,
                        autocapitalize: 'off',
                        autocorrect: 'off'
                    },
                    preConfirm: (otp) => {
                        if (!otp) {
                            Swal.showValidationMessage('OTP is required')
                        }
                        return otp
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        const otp = result.value;
                        this.verifyOtp(otp);
                    } else {
                      this.fails();
                    }
                });
              } catch(e) {
                this.fails();
              }

            },
            async verifyOtp(otp) {
              try {
                const response = await axios.get(route("api.otp.verify", { password: this.password, user: this.username, otp }));
                if(response.status === 200) {
                  this.login();
                }
              } catch(e) {
                this.fails();
              }
            },
            async login() {
              try {
                this.is_authenticating = true;
                const response = await axios.post(route("api.login", {
                    username: this.username,
                    password: this.password
                }));

                if(response.data.status === "200") {
                    localStorage.setItem("token", response.data.data.token);
                    window.location = route("home");
                    this.passed = true;
                    this.failed = false;
                }
              } catch(e) {
                  Toastify({
                    text: "Invalid Username or Password",
                    duration: 3000,
                    gravity: "top", // or "bottom"
                    position: "right", // or "left", "center"
                    backgroundColor: "#EF4444", // tailwind green-400
                  }).showToast();
                  this.passed = false;
                  this.failed = true;
                  setTimeout(() => {
                    this.failed = false;
                  }, 1000)
              } finally {
                this.is_authenticating = false;
              }
            }
        },
    }).mount("#app");
  </script>
</html>
