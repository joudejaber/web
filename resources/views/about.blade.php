@extends('layout.app')

@section('title', 'About')

@section('content')

{{-- Styles (same as Home for consistency) --}}
<style>
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .animate-fade-in-up {
        animation: fadeInUp 0.8s ease-out forwards;
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

    .btn-primary {
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        position: relative;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(59, 130, 246, 0.4);
    }

    .card-hover {
        transition: all 0.3s ease;
    }

    .card-hover:hover {
        transform: translateY(-8px);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
    }
</style>

{{-- Hero --}}
<div class="bg-gradient-to-br from-gray-50 to-white py-24 section-fade-in">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="max-w-3xl mx-auto text-center animate-fade-in-up">
            <div class="glass-effect rounded-2xl p-10 shadow-lg">
                <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl text-gradient">About RenovAid</h1>
                <p class="mt-6 text-lg leading-8 text-gray-700">
                    RenovAid is a platform dedicated to simplifying and accelerating post-war reconstruction efforts by connecting homeowners, service providers, and government agencies.
                </p>
            </div>
        </div>
    </div>
</div>

{{-- Mission --}}
<div class="bg-white pt-12 pb-20 section-fade-in">
    <div class="mx-auto max-w-7xl px-6 lg:px-8 text-center animate-fade-in-up">
        <h2 class="text-base font-semibold text-blue-600 uppercase">Our Mission</h2>
        <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
            Building a <span class="text-gradient">Better Future</span>
        </p>
        <p class="mt-6 text-lg text-gray-600">
            We aim to make reconstruction more transparent, efficient, and accessible for everyone.
        </p>
    </div>
</div>

{{-- 🧭 Our Values --}}
<div class="bg-gray-50 py-24 section-fade-in">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl mb-12 text-gradient">Our Core Values</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="p-8 bg-white rounded-2xl shadow-md card-hover">
                <h3 class="text-xl font-semibold text-blue-700">Trust</h3>
                <p class="mt-4 text-gray-600">We ensure transparency, reliability, and integrity in all collaborations.</p>
            </div>
            <div class="p-8 bg-white rounded-2xl shadow-md card-hover">
                <h3 class="text-xl font-semibold text-green-700">Efficiency</h3>
                <p class="mt-4 text-gray-600">Smart tools to speed up reconstruction and reduce delays.</p>
            </div>
            <div class="p-8 bg-white rounded-2xl shadow-md card-hover">
                <h3 class="text-xl font-semibold text-purple-700">Community</h3>
                <p class="mt-4 text-gray-600">We connect people to rebuild neighborhoods together.</p>
            </div>
        </div>
    </div>
</div>

{{-- 🔧 How It Works --}}
<div class="bg-gray-50 py-24 section-fade-in">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl text-gradient mb-12">How RenovAid Works</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10 text-left">
            <div class="p-6 bg-white rounded-2xl shadow-md card-hover">
                <h3 class="text-lg font-semibold text-blue-700">1. Sign Up</h3>
                <p class="mt-2 text-gray-600">Create your account and provide basic info about your home or services.</p>
            </div>
            <div class="p-6 bg-white rounded-2xl shadow-md card-hover">
                <h3 class="text-lg font-semibold text-green-700">2. Submit & Connect</h3>
                <p class="mt-2 text-gray-600">Document damages or browse jobs and connect with verified users.</p>
            </div>
            <div class="p-6 bg-white rounded-2xl shadow-md card-hover">
                <h3 class="text-lg font-semibold text-purple-700">3. Rebuild Together</h3>
                <p class="mt-2 text-gray-600">Track progress, complete contracts, and restore homes with ease.</p>
            </div>
        </div>
    </div>
</div>

{{-- Back to Home --}}
<div class="py-16 text-center section-fade-in">
    <a href="/" class="btn-primary inline-block rounded-md px-6 py-3 text-sm font-semibold text-white shadow-lg">
        Back to Home
    </a>
</div>

{{-- JS to animate fade-ins --}}
<script>
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

    document.querySelectorAll('.section-fade-in').forEach(el => {
        observer.observe(el);
    });
</script>

@endsection
