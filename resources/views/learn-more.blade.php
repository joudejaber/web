@extends('layout.app')

@section('title', 'Learn More')

@section('content')

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

    .card-hover {
        transition: all 0.3s ease;
    }

    .card-hover:hover {
        transform: translateY(-8px);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
    }

    .btn-primary {
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        transition: all 0.3s ease;
        padding: 0.75rem 1.5rem;
        border-radius: 0.5rem;
        font-weight: 600;
        color: white;
        box-shadow: 0 4px 14px rgba(59, 130, 246, 0.3);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(59, 130, 246, 0.4);
    }
</style>

{{-- Hero Section --}}
<div class="bg-gradient-to-br from-gray-50 to-white py-20 section-fade-in">
    <div class="mx-auto max-w-7xl px-6 lg:px-8 text-center animate-fade-in-up">
        <div class="max-w-3xl mx-auto">
            <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl text-gradient">
                Learn More About RenovAid
            </h1>
            <p class="mt-6 text-lg leading-8 text-gray-700">
                RenovAid streamlines post-war reconstruction by connecting homeowners, service providers, and government agencies — all in one platform.
            </p>
        </div>
    </div>
</div>

{{-- Features Section --}}
<div class="bg-white pt-16 pb-20 section-fade-in">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="max-w-2xl mx-auto text-center animate-fade-in-up">
            <h2 class="text-base font-semibold text-blue-600 uppercase tracking-wide">Rebuild Better</h2>
            <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                Why Choose <span class="text-gradient">RenovAid</span>?
            </p>
            <p class="mt-6 text-lg text-gray-600">
                Our tools simplify every step of the reconstruction journey, from documentation to completion.
            </p>
        </div>

        <div class="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-24 lg:max-w-none">
            <dl class="grid max-w-xl grid-cols-1 gap-x-8 gap-y-16 lg:grid-cols-3 lg:max-w-none">
                <div class="flex flex-col card-hover bg-gray-50 rounded-2xl p-6 shadow-sm">
                    <dt class="text-base font-semibold text-blue-700">Document Damages</dt>
                    <dd class="mt-4 text-base text-gray-600">
                        Easily catalog damages using intuitive tools and photo uploads to ensure nothing is missed.
                    </dd>
                </div>

                <div class="flex flex-col card-hover bg-gray-50 rounded-2xl p-6 shadow-sm">
                    <dt class="text-base font-semibold text-green-700">Find Services</dt>
                    <dd class="mt-4 text-base text-gray-600">
                        Get matched with qualified, verified service providers who can help rebuild efficiently.
                    </dd>
                </div>

                <div class="flex flex-col card-hover bg-gray-50 rounded-2xl p-6 shadow-sm">
                    <dt class="text-base font-semibold text-purple-700">Track Progress</dt>
                    <dd class="mt-4 text-base text-gray-600">
                        Stay up to date with real-time updates, contract status tracking, and communication tools.
                    </dd>
                </div>
            </dl>
        </div>

        <div class="mt-16 text-center animate-fade-in-up">
            <a href="{{ route('home') }}" class="btn-primary inline-block">
                Back to Home
            </a>
        </div>
    </div>
</div>

{{-- 👇 Simple Extra Section --}}
<div class="bg-blue-50 py-16 section-fade-in">
    <div class="max-w-4xl mx-auto px-6 text-center">
        <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-4">
            Did You Know?
        </h2>
        <p class="text-lg text-gray-700">
            Over <span class="font-semibold text-blue-600">70%</span> of homeowners struggle to find reliable service providers after a disaster.
            RenovAid is here to change that — fast, transparent, and built for recovery.
        </p>
    </div>
</div>

<script>
    // Animate sections when they enter the viewport
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.section-fade-in').forEach(el => {
        observer.observe(el);
    });
</script>

@endsection
