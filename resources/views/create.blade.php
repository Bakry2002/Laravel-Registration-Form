@extends('layouts.master')

@section('title', 'Register Form')
@section('content')

    @if ($errors->any())
        <div class="alert alert-danger" dir="{{ App::getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <section class='form-section container-fluid' dir="{{ App::getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
        <form id="register" method="post" action="{{ route('students.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="field-wrapper row">

                <!-- Full Name -->
                <div class="field col-lg-6">
                    <label for="fullName">{{ __('create.fullName') }}</label>
                    <input type="text" id="fullName" name="fullName" placeholder="{{ __('create.plcFullName') }}">
                </div>

                <!-- Username -->
                <div class="field col-lg-6">
                    <label for="username">{{ __('create.username') }}</label>
                    <input type="text" id="username" name="username" placeholder="{{ __('create.plcUsername') }}">
                </div>

                <!-- Birthdate -->
                <div class="field col-lg-6">
                    <label for="birthDate">{{ __('create.birthdate') }}</label>
                    <input type="date" id="dateInput" name="birthDate">
                    <button type="button" id="actorsBtn" class="cta-register cta-actor" data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop">{{ __('create.actorBtn') }}</button>
                </div>

                <!-- Phone -->
                <div class="field col-lg-6">
                    <label for="phone">{{ __('create.phone') }}</label>
                    <input type="tel" id="phone" name="phone" placeholder="{{ __('create.plcPhone') }}">
                </div>

                <!-- Password -->
                <div class="field col-lg-6">
                    <label for="password">{{ __('create.password') }}</label>
                    <input type="password" id="password" name="password" placeholder="{{ __('create.plcPassword') }}">
                </div>

                <!-- Confirm Password -->
                <div class="field col-lg-6">
                    <label for="confirmPassword">{{ __('create.confirmPassword') }}</label>
                    <input type="password" id="confirmPassword" name="confirmPassword"
                        placeholder="{{ __('create.plcConfirmPassword') }}">
                </div>

                <!-- Address -->
                <div class="field col-lg-6">
                    <label for="address">{{ __('create.address') }}</label>
                    <input type="text" id="address" name="address" placeholder="{{ __('create.plcAddress') }}">
                </div>

                <!-- Email -->
                <div class="field col-lg-6">
                    <label for="email">{{ __('create.email') }}</label>
                    <input type="email" id="email" name="email" placeholder="{{ __('create.plcEmail') }}">
                </div>
            </div>

            <!-- Submit Button -->
            <div class="field">
                <input type="radio" name="" id="honeypot" style="visibility: hidden;">
                <button type="submit" id="regBtn" class="btn custom-btn reg-btn"
                    name="submit">{{ __('create.register') }}</button>
            </div>
        </form>
    </section>

    <script>
        // main form 
        const registerForm = document.forms['register'];

        // Check if all fields are filled in
        const fullName = registerForm['fullName']
        const username = registerForm['username']
        const birthdate = registerForm['birthDate']
        const phone = registerForm['phone']
        const address = registerForm['address']
        const password = registerForm['password']
        const confirmPassword = registerForm['confirmPassword']
        const email = registerForm['email']

        console.log({
            fullName,
            username,
            birthdate,
            phone,
            address,
            password,
            confirmPassword,
            email
        });
        // alert container
        const alertContainer = document.getElementById('alert-container');


        function validate() {
            alertContainer.innerHTML = ''; // Clear previous alerts

            // required fields validation
            if (!fullName.value || !username.value || !birthdate.value || !phone.value || !address.value || !password
                .value || !confirmPassword.value || !email.value) {
                showAlert('{{ __('create.allFieldsRequired') }}');
                return false;
            }

            // fullName only excepts letters, spaces in english and arabic 
            const fullNameRegex = /^[a-zA-Z\u0600-\u06FF ]+$/ // /^[a-zA-Z\u0600-\u06FF ]+$/ for arabic
            if (!fullNameRegex.test(fullName.value)) {
                showAlert('{{ __('create.fullNameError') }}');
                return false;
            }

            // Check if phone number is valid
            const phoneRegex = /^\d{11}$/;
            if (!phoneRegex.test(phone.value)) {
                showAlert('{{ __('create.phoneError') }}');
                return false;
            }

            // Check password meet validation requirements
            const passwordRegex = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,}$/;
            if (!passwordRegex.test(password.value)) {
                showAlert('{{ __('create.passwordError') }}');
                return false;
            }

            // check if confirm password is equal to password
            if (password.value !== confirmPassword.value) {
                showAlert('{{ __('create.passwordsNotMatch') }}');
                return false;
            }

            // Check if email is valid
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email.value)) {
                showAlert('{{ __('create.emailError') }}');
                return false;
            }
            return true;
        }

        function showAlert(message) {
            alertContainer.innerHTML = `<span class="alert-border"></span><div class="alert alert-danger alert-white rounded" role="alert">
    
    <div class="icon"><i class="fa fa-times-circle"></i></div>
    <strong>{{ __('create.error') }}</strong>
        ${message}
    </div>`;
            setTimeout(() => {
                alertContainer.innerHTML = '';
            }, 4000);
        }

        window.addEventListener('DOMContentLoaded', function() {
            let alerts = document.querySelectorAll('.alert'); // Get all alerts
            for (let i = 0; i < alerts.length; i++) { // Loop through all alerts
                alertContainer.appendChild(alerts[i]); //   Add alert to alert container
            }
        });


        registerForm.addEventListener('submit', function(event) {
            if (!validate()) {
                event.preventDefault(); // Prevent form from submitting
            } else {
                // Get a reference to the register button
                var registerBtn = document.getElementById('regBtn');

                // Add an event listener for form submit
                document.addEventListener('submit', function() {
                    // Change the text of the button to "Registering..."
                    registerBtn.textContent = "{{ __('create.registering') }}";
                });
            }
        });
    </script>



    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">{{ __('create.modalTitle') }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul class="actors__list" style="display: none;"></ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="cta-register cta-actor"
                        data-bs-dismiss="modal">{{ __('create.modalClose') }}</button>
                </div>
            </div>
        </div>
    </div>

@endsection('content')
