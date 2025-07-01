@extends('layout.app')

@section('title', 'Home')

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

    @keyframes fadeInRight {
        from {
            opacity: 0;
            transform: translateX(30px);
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

    @keyframes pulse {
        0%, 100% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.05);
        }
    }

    .animate-fade-in-up {
        animation: fadeInUp 0.8s ease-out forwards;
    }

    .animate-fade-in-left {
        animation: fadeInLeft 0.8s ease-out forwards;
    }

    .animate-fade-in-right {
        animation: fadeInRight 0.8s ease-out forwards;
    }

    .animate-float {
        animation: float 3s ease-in-out infinite;
    }

    .animate-pulse-slow {
        animation: pulse 2s ease-in-out infinite;
    }

    .hero-gradient {
        background: linear-gradient(135deg, rgba(0, 0, 0, 0.4) 0%, rgba(0, 0, 0, 0.6) 100%);
    }

    .card-hover {
        transition: all 0.3s ease;
    }

    .card-hover:hover {
        transform: translateY(-8px);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
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

    .section-fade-in {
        opacity: 0;
        transform: translateY(50px);
        transition: all 0.8s ease-out;
    }

    .section-fade-in.visible {
        opacity: 1;
        transform: translateY(0);
    }

    .icon-bounce {
        transition: transform 0.3s ease;
    }

    .icon-bounce:hover {
        transform: scale(1.1) rotate(5deg);
    }

    .text-gradient {
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .glass-effect {
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(3px);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
</style>

<div class="relative min-h-screen">
    <!-- Hero Section -->
    <div class="relative h-screen overflow-hidden">
        <div class="absolute inset-0">
            <img src="/images/pic.jpg" alt="Construction site" class="h-full w-full object-cover transform scale-105 transition-transform duration-[10s] hover:scale-110">
            <div class="absolute inset-0 hero-gradient"></div>
            <!-- Animated overlay particles -->
            <div class="absolute inset-0 opacity-20">
                <div class="absolute top-1/4 left-1/4 w-2 h-2 bg-white rounded-full animate-float" style="animation-delay: 0s;"></div>
                <div class="absolute top-1/3 right-1/3 w-1 h-1 bg-white rounded-full animate-float" style="animation-delay: 1s;"></div>
                <div class="absolute bottom-1/4 left-1/3 w-1.5 h-1.5 bg-white rounded-full animate-float" style="animation-delay: 2s;"></div>
            </div>
        </div>
        
        <div class="relative mx-auto max-w-7xl px-6 lg:px-8">
            <div class="flex min-h-screen items-center">
                <div class="max-w-2xl">
                    <div class="glass-effect rounded-2xl p-8 animate-fade-in-up backdrop-blur-sm" style="animation-delay: 0.2s;">
                        <h1 class="mt-4 text-4xl font-bold tracking-tight text-white sm:text-6xl leading-tight animate-fade-in-left drop-shadow-lg" style="animation-delay: 0.4s;">
                            Rebuild Together with <span class="text-white">RenovAid</span>
                        </h1>
                        <p class="mt-6 text-lg leading-8 text-gray-100 animate-fade-in-left" style="animation-delay: 0.6s;">
                            Connecting homeowners with service providers for efficient post-war reconstruction. Document damages, find reliable contractors, and rebuild your community with confidence.
                        </p>
                        <div class="mt-10 flex items-center gap-x-6 animate-fade-in-up" style="animation-delay: 0.8s;">
                            <a href="{{ route('register') }}" 
                               class="btn-primary rounded-xl px-6 py-3 text-sm font-semibold text-white shadow-lg focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600 transform transition-all duration-300">
                                Get Started
                            </a>
                            <a href="{{ route('learn.more') }}" class="text-sm font-semibold leading-6 text-white hover:text-blue-200 transition-colors duration-300 group">
                                Learn more 
                                <span aria-hidden="true" class="inline-block transition-transform duration-300 group-hover:translate-x-1">→</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="bg-gradient-to-br from-gray-50 to-white py-24 sm:py-32 section-fade-in">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl lg:text-center animate-fade-in-up">
                <h2 class="text-base font-semibold leading-7 text-blue-600 uppercase tracking-wide">Rebuild Better</h2>
                <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                    Everything you need to <span class="text-gradient">restore your home</span>
                </p>
                <p class="mt-6 text-lg leading-8 text-gray-600">
                    RenovAid provides a comprehensive platform for managing your reconstruction project from start to finish with cutting-edge technology and trusted partnerships.
                </p>
            </div>
            <div class="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-24 lg:max-w-none">
                <dl class="grid max-w-xl grid-cols-1 gap-x-8 gap-y-16 lg:max-w-none lg:grid-cols-3">
                    <div class="flex flex-col card-hover bg-white rounded-2xl p-8 shadow-lg border border-gray-100 animate-fade-in-up" style="animation-delay: 0.2s;">
                        <dt class="flex items-center gap-x-3 text-base font-semibold leading-7 text-gray-900">
                            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-100 icon-bounce">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blue-600">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V19.5a2.25 2.25 0 002.25 2.25h.75"></path>
                                </svg>
                            </div>
                            Document Damages
                        </dt>
                        <dd class="mt-4 flex flex-auto flex-col text-base leading-7 text-gray-600">
                            <p class="flex-auto">Easily document and catalog damage to your property with our intuitive tools and AI-powered assessment features.</p>
                        </dd>
                    </div>
                    <div class="flex flex-col card-hover bg-white rounded-2xl p-8 shadow-lg border border-gray-100 animate-fade-in-up" style="animation-delay: 0.4s;">
                        <dt class="flex items-center gap-x-3 text-base font-semibold leading-7 text-gray-900">
                            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-green-100 icon-bounce">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-green-600">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 11-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 004.486-6.336l-3.276 3.277a3.004 3.004 0 01-2.25-2.25l3.276-3.276a4.5 4.5 0 00-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437l1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008z" />
                                </svg>
                            </div>
                            Find Services
                        </dt>
                        <dd class="mt-4 flex flex-auto flex-col text-base leading-7 text-gray-600">
                            <p class="flex-auto">Connect with qualified service providers and get the help you need from our network of verified professionals.</p>
                        </dd>
                    </div>
                    <div class="flex flex-col card-hover bg-white rounded-2xl p-8 shadow-lg border border-gray-100 animate-fade-in-up" style="animation-delay: 0.6s;">
                        <dt class="flex items-center gap-x-3 text-base font-semibold leading-7 text-gray-900">
                            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-purple-100 icon-bounce">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-purple-600">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            Track Progress
                        </dt>
                        <dd class="mt-4 flex flex-auto flex-col text-base leading-7 text-gray-600">
                            <p class="flex-auto">Monitor your reconstruction projects and stay updated on their progress with real-time notifications and updates.</p>
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</div>

<script>
    // Intersection Observer for fade-in animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, observerOptions);

    // Observe all elements with section-fade-in class
    document.querySelectorAll('.section-fade-in').forEach(el => {
        observer.observe(el);
    });

    // Add smooth parallax effect to hero image
    window.addEventListener('scroll', () => {
        const scrolled = window.pageYOffset;
        const heroImg = document.querySelector('.hero-section img');
        if (heroImg) {
            heroImg.style.transform = `translateY(${scrolled * 0.5}px) scale(1.05)`;
        }
    });
</script>

@endsection