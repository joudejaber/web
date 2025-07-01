@extends('layout.app')

@section('title', 'Register')

@section('content')
<style>
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeInLeft {
        from {
            opacity: 0;
            transform: translateX(-30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes float {
        0%, 100% {
            transform: translateY(0px);
        }
        50% {
            transform: translateY(-10px);
        }
    }

    .animate-fade-in-up {
        animation: fadeInUp 0.8s ease-out forwards;
    }

    .animate-fade-in-left {
        animation: fadeInLeft 0.8s ease-out forwards;
    }

    .animate-float {
        animation: float 3s ease-in-out infinite;
    }

    .hero-gradient {
        background: linear-gradient(135deg, rgba(0, 0, 0, 0.4) 0%, rgba(0, 0, 0, 0.6) 100%);
    }

    .btn-primary {
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .btn-primary::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }

    .btn-primary:hover::before {
        left: 100%;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(59, 130, 246, 0.4);
    }

    .glass-effect {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }

    .input-field {
        transition: all 0.3s ease;
        border: 1px solid rgba(209, 213, 219, 0.3);
    }

    .input-field:focus {
        transform: translateY(-1px);
        box-shadow: 0 10px 25px rgba(59, 130, 246, 0.15);
    }

    .text-gradient {
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .role-option {
        transition: all 0.3s ease;
        cursor: pointer;
        border: 2px solid rgba(209, 213, 219, 0.3);
    }

    .role-option:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(59, 130, 246, 0.15);
        border-color: #3b82f6;
    }

    .role-option.selected {
        border-color: #3b82f6;
        background: rgba(59, 130, 246, 0.05);
    }
</style>

<div class="relative min-h-screen">
    <!-- Background with overlay -->
    <div class="absolute inset-0">
        <img src="/images/pic.jpg" alt="Construction site" class="h-full w-full object-cover">
        <div class="absolute inset-0 hero-gradient"></div>
        <!-- Animated overlay particles -->
        <div class="absolute inset-0 opacity-20">
            <div class="absolute top-1/4 left-1/4 w-2 h-2 bg-white rounded-full animate-float" style="animation-delay: 0s;"></div>
            <div class="absolute top-1/3 right-1/3 w-1 h-1 bg-white rounded-full animate-float" style="animation-delay: 1s;"></div>
            <div class="absolute bottom-1/4 left-1/3 w-1.5 h-1.5 bg-white rounded-full animate-float" style="animation-delay: 2s;"></div>
        </div>
    </div>

    <div class="relative flex min-h-screen flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md animate-fade-in-up" style="animation-delay: 0.2s;">
            <div class="glass-effect rounded-2xl p-8 shadow-2xl">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold tracking-tight text-gray-900 animate-fade-in-left" style="animation-delay: 0.4s;">
                        Join <span class="text-gradient">RenovAid</span>
                    </h2>
                    <p class="mt-2 text-sm text-gray-600 animate-fade-in-left" style="animation-delay: 0.5s;">
                        Start your reconstruction journey today
                    </p>
                </div>

                <form class="space-y-6 animate-fade-in-up" style="animation-delay: 0.6s;" action="{{ route('register.form') }}" method="POST">
                    @csrf
                    <div>
                        <label for="name" class="block text-sm font-medium leading-6 text-gray-900 mb-2">Full name</label>
                        <input id="name" name="name" type="text" required 
                               class="input-field block w-full rounded-xl border-0 py-3 px-4 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                        @error('name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium leading-6 text-gray-900 mb-2">Email address</label>
                        <input id="email" name="email" type="email" autocomplete="email" required 
                               class="input-field block w-full rounded-xl border-0 py-3 px-4 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                        @error('email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="role_id" class="block text-sm font-medium leading-6 text-gray-900 mb-3">I am a...</label>
                        <select id="role_id" name="role_id" required 
                                class="input-field block w-full rounded-xl border-0 py-3 px-4 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                            <option value="">Select your role</option>
                            <option value="1">Homeowner</option>
                            <option value="2">Service Provider</option>
                        </select>
                        @error('role_id')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium leading-6 text-gray-900 mb-2">Password</label>
                        <input id="password" name="password" type="password" required 
                               class="input-field block w-full rounded-xl border-0 py-3 px-4 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                        @error('password')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium leading-6 text-gray-900 mb-2">Confirm password</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" required 
                               class="input-field block w-full rounded-xl border-0 py-3 px-4 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                    </div>

                    <div class="mt-8">
                        <button type="submit" 
                                class="btn-primary flex w-full justify-center rounded-xl px-4 py-3 text-sm font-semibold leading-6 text-white shadow-lg focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                            Create Account
                        </button>
                    </div>
                </form>

                <div class="mt-8 text-center animate-fade-in-up" style="animation-delay: 0.8s;">
                    <p class="text-sm text-gray-600">
                        Already have an account?
                        <a href="{{ route('login') }}" class="font-semibold text-blue-600 hover:text-blue-500 transition-colors duration-300 group">
                            Sign in
                            <span aria-hidden="true" class="inline-block transition-transform duration-300 group-hover:translate-x-1">→</span>
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection