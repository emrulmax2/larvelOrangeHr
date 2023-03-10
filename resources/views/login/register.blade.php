@extends('../layout/' . $layout)

@section('head')
    <title>Register - Tailwind HTML Admin Template</title>
@endsection

@section('content')
    <div class="container sm:px-10">
        <div class="block xl:grid grid-cols-2 gap-4">
            <!-- BEGIN: Register Info -->
            <div class="hidden xl:flex flex-col min-h-screen">
                <a href="" class="-intro-x flex items-center pt-5">
                    <img alt="Midone - HTML Admin Template" class="w-6" src="{{ asset('build/assets/images/logo.svg') }}">
                    <span class="text-white text-lg ml-3">
                        Demo
                    </span>
                </a>
                <div class="my-auto">
                    <img alt="Midone - HTML Admin Template" class="-intro-x w-1/2 -mt-16" src="{{ asset('build/assets/images/illustration.svg') }}">
                    <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">A few more clicks to <br> sign up to your account.</div>
                    <div class="-intro-x mt-5 text-lg text-white text-opacity-70 dark:text-slate-400">Manage all your e-commerce accounts in one place</div>
                </div>
            </div>
            <!-- END: Register Info -->
            <!-- BEGIN: Register Form -->
            <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                <div class="my-auto mx-auto xl:ml-20 bg-white dark:bg-darkmode-600 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                    <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">Sign Up</h2>
                    <div class="intro-x mt-2 text-slate-400 dark:text-slate-400 xl:hidden text-center">A few more clicks to sign in to your account. Manage all your e-commerce accounts in one place</div>
                    <div class="intro-x mt-8">
                    <form id="register-form">
                        <input type="text" id="name" name="name" class="intro-x login__input form-control py-3 px-4 block" placeholder="Name">
                        <div id="error-name" class="login__input-error text-danger mt-2"></div>
                        <input type="email" id="email" name="email" class="intro-x login__input form-control py-3 px-4 block mt-4" placeholder="Email">
                        <div id="error-email" class="login__input-error text-danger mt-2"></div>
                        <select id="gender" name="gender" class="form-select login__input mt-2 sm:mr-2" aria-label="Default select example">
                            <option value="">Please Select</option>
                            <option value="male">Male</option>
                            <option  value="female">Female</option>
                        </select>
                        <div id="error-gender" class="login__input-error text-danger mt-2"></div>
                        <input type="password" id="password" name="password" class="intro-x login__input form-control py-3 px-4 block mt-4" placeholder="Password">
                        <div id="error-password" class="login__input-error text-danger mt-2"></div>
                        
                        <input type="password" id="password_confirmation" name="password_confirmation" class="intro-x login__input form-control py-3 px-4 block mt-4" placeholder="Password Confirmation">
                        <div id="error-confirmation" class="login__input-error text-danger mt-2"></div>
                    </form>
                    </div>
                    <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                        <button id="btn-login" class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top">Register</button>
                        <a href="{{ route('login.index') }}" class="btn btn-outline-secondary py-3 px-4 w-full xl:w-32 mt-3 xl:mt-0 align-top">Sign in</a>
                    </div>
                </div>
            </div>
            <!-- END: Register Form -->
        </div>
    </div>
@endsection
@section('script')
    <script type="module">
        (function () {
            async function register() {
                // Reset state
                $('#register-form').find('.login__input').removeClass('border-danger')
                $('#register-form').find('.login__input-error').html('')

                // Post form
                let myform = document.getElementById("register-form");
                let formData = new FormData(myform);
                // Loading state
                $('#btn-login').html('<i data-loading-icon="oval" data-color="white" class="w-5 h-5 mx-auto"></i>')
                tailwind.svgLoader()
                await helper.delay(1500)

                axios.post(`register`,formData).then(res => {
                    location.href = '/'
                }).catch(err => {
                    $('#register-form').find('.login__input').removeClass('border-danger')
                    $('#register-form').find('.login__input-error').html('')
                    $('#btn-login').html('Register')
                    if (err.response.data.message != 'Wrong email or password.') {
                        for (const [key, val] of Object.entries(err.response.data.errors)) {
                            $(`#${key}`).addClass('border-danger')
                            $(`#error-${key}`).html(val)
                        }
                    } else {
                        $(`#password`).addClass('border-danger')
                        $(`#error-password`).html(err.response.data.message)
                    }
                })
            }

            $('#register-form').on('keyup', function(e) {
                if (e.keyCode === 13) {
                    register()
                }
            })

            $('#btn-login').on('click', function() {
                register()
            })
        })()
    </script>
@endsection
