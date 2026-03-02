<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Task Manager') }}</title>

    <!-- Fonts - Inter / Outfit for premium feel -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }

        .glass-panel {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar {
            background-color: #1a1e2b;
        }

        .main-bg {
            background-color: #0f121a;
        }

        .card-bg {
            background-color: #1e2533;
        }

        .accent-blue {
            background-color: #3b82f6;
        }
    </style>
</head>

<body class="main-bg text-gray-200 antialiased h-screen overflow-hidden">
    <div class="flex h-full w-full">
        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col min-w-0 p-8 overflow-y-auto">
            <header class="flex justify-between items-center mb-8">
                <h1 class="text-4xl font-bold tracking-tight">@yield('title', 'Dashboard')</h1>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('tasks.create') }}"
                        class="accent-blue hover:bg-blue-600 text-white px-5 py-2.5 rounded-xl font-medium transition-all shadow-lg hover:shadow-blue-500/20">
                        + New Task
                    </a>
                </div>
            </header>

            @yield('content')
        </div>

        <!-- Right Sidebar (Stats & Navigation) -->
        <aside class="w-80 h-full sidebar border-l border-white/5 p-6 space-y-8 flex flex-col">
            <!-- User Profile -->
            <div class="flex items-center space-x-4 p-4 glass-panel rounded-2xl">
                <div
                    class="h-12 w-12 rounded-full overflow-hidden bg-blue-500 flex items-center justify-center text-xl font-bold">
                    {{ substr(auth()->user()->name, 0, 1) }}
                </div>
                <div>
                    <p class="font-bold text-lg leading-tight">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-blue-400 uppercase tracking-widest font-semibold">
                        {{ auth()->user()->role ?? 'User' }}</p>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="space-y-2">
                <p class="text-xs font-bold text-gray-500 uppercase tracking-widest px-4 mb-3">Tasks</p>
                <a href="{{ route('tasks.index') }}"
                    class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all {{ request()->routeIs('tasks.index') ? 'accent-blue text-white shadow-lg shadow-blue-500/10' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                    <span>Tasks</span>
                </a>
                @if(auth()->user()->role === 'admin')
                    <a href="#"
                        class="flex items-center space-x-3 px-4 py-3 rounded-xl text-gray-400 hover:text-white hover:bg-white/5 transition-all">
                        <span>Users <span class="text-[10px] lowercase text-gray-500 ml-1 font-normal opacity-70">(Admin
                                Only)</span></span>
                    </a>
                @endif
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full text-left flex items-center space-x-3 px-4 py-3 rounded-xl text-gray-400 hover:text-red-400 hover:bg-red-500/5 transition-all">
                        <span>Logout</span>
                    </button>
                </form>
            </nav>

            <!-- Stats Dashboard Snippet -->
            <div class="mt-auto space-y-6">
                <!-- Circular Stats -->
                <div class="grid grid-cols-3 gap-2">
                    <div class="text-center">
                        <div class="text-[10px] text-gray-500 mb-1 uppercase tracking-tighter">Total</div>
                        <div class="text-xl font-bold">{{ $stats['total'] ?? 0 }}</div>
                    </div>
                    <div class="text-center border-l border-white/5">
                        <div class="text-[10px] text-gray-500 mb-1 uppercase tracking-tighter">Done</div>
                        <div class="text-xl font-bold text-green-400">{{ $stats['completed'] ?? 0 }}</div>
                    </div>
                    <div class="text-center border-l border-white/5">
                        <div class="text-[10px] text-gray-500 mb-1 uppercase tracking-tighter">High</div>
                        <div class="text-xl font-bold text-red-500">{{ $stats['high_priority'] ?? 0 }}</div>
                    </div>
                </div>

                <!-- Small Chart Placeholder -->
                <div class="bg-white/5 p-4 rounded-2xl">
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Task Completion</p>
                    <canvas id="miniChart" height="150"></canvas>
                </div>
            </div>
        </aside>
    </div>

    @stack('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('miniChart');
            if (ctx) {
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
                        datasets: [{
                            data: [12, 19, 10, 15, 20],
                            backgroundColor: '#3b82f6',
                            borderRadius: 6,
                            barThickness: 12
                        }]
                    },
                    options: {
                        plugins: { legend: { display: false } },
                        scales: {
                            x: { grid: { display: false }, ticks: { color: '#6b7280', font: { size: 10 } } },
                            y: { display: false }
                        }
                    }
                });
            }
        });
    </script>
</body>

</html>