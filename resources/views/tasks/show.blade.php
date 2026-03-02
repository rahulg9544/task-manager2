@extends('layouts.task_layout')

@section('title', 'Task Details')

@section('content')
    <div class="max-w-5xl mx-auto space-y-10 animate-in fade-in slide-in-from-bottom-5 duration-700">
        <div class="flex items-center justify-between">
            <a href="{{ route('tasks.index') }}"
                class="p-3 bg-white/5 hover:bg-white/10 rounded-2xl transition-all text-gray-500 hover:text-white border border-white/5 group">
                <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
            </a>
            <a href="{{ route('tasks.edit', $task->id) }}"
                class="p-3 bg-blue-500/10 hover:bg-blue-500/20 rounded-2xl transition-all text-blue-400 border border-blue-500/10 text-center px-10 font-bold">
                Edit Task
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Task Info -->
            <div class="lg:col-span-2 space-y-8">
                <div class="card-bg p-10 rounded-[48px] border border-white/5 shadow-2xl">
                    <div class="flex items-center space-x-3 mb-6">
                        <span
                            class="px-3 py-1 bg-blue-500/10 text-blue-400 rounded-full text-xs font-bold uppercase tracking-widest border border-blue-500/10">
                            {{ $task->status->value }}
                        </span>
                        <span class="text-gray-500 text-sm">• {{ $task->due_date->format('M d, Y') }}</span>
                    </div>

                    <h1 class="text-4xl font-extrabold mb-6 tracking-tight">{{ $task->title }}</h1>

                    <div class="prose prose-invert max-w-none">
                        <p class="text-gray-400 text-lg leading-relaxed">
                            {{ $task->description }}
                        </p>
                    </div>

                    <div class="mt-12 flex items-center space-x-4 border-t border-white/5 pt-8">
                        <div class="w-12 h-12 rounded-full bg-blue-500 flex items-center justify-center font-bold text-xl">
                            {{ substr($task->user->name ?? 'U', 0, 1) }}
                        </div>
                        <div>
                            <p class="text-gray-500 text-xs uppercase font-bold tracking-widest">Assigned To</p>
                            <p class="text-white font-bold text-lg">{{ $task->user->name ?? 'Unassigned' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- AI Insights Sidebar -->
            <div class="space-y-8">
                <div
                    class="bg-gradient-to-br from-indigo-600/20 to-purple-600/20 p-8 rounded-[40px] border border-purple-500/20 shadow-2xl relative overflow-hidden group">
                    <!-- Decorative AI Sparkles -->
                    <div
                        class="absolute -top-10 -right-10 w-40 h-40 bg-purple-500/20 rounded-full blur-3xl opacity-50 group-hover:opacity-80 transition-opacity">
                    </div>

                    <div class="relative">
                        <div class="flex items-center space-x-3 mb-6">
                            <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                            <h3 class="text-xl font-bold text-white tracking-tight">AI Insights</h3>
                        </div>

                        <div class="space-y-6">
                            <div>
                                <p class="text-purple-300/60 text-[10px] uppercase font-bold tracking-widest mb-2">
                                    Recommended Priority</p>
                                <div class="text-2xl font-black text-purple-400 uppercase">
                                    {{ $task->ai_priority ?? 'Calculating...' }}
                                </div>
                            </div>

                            <div>
                                <p class="text-purple-300/60 text-[10px] uppercase font-bold tracking-widest mb-2">Task
                                    Summary</p>
                                <p class="text-gray-200 text-sm leading-relaxed italic">
                                    "{{ $task->ai_summary ?? 'AI is processing this task to provide a concise summary...' }}"
                                </p>
                            </div>

                            <div class="pt-4">
                                <button
                                    class="w-full py-3 bg-purple-500/20 hover:bg-purple-500/30 rounded-2xl text-purple-400 text-xs font-bold transition-all border border-purple-500/20">
                                    Refresh Analysis
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Meta Data Card -->
                <div class="card-bg p-8 rounded-[40px] border border-white/5 space-y-6">
                    <div>
                        <p class="text-gray-500 text-[10px] uppercase font-bold tracking-widest mb-1">Created At</p>
                        <p class="text-gray-300 text-sm">{{ $task->created_at->format('M d, Y H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500 text-[10px] uppercase font-bold tracking-widest mb-1">Last Updated</p>
                        <p class="text-gray-300 text-sm">{{ $task->updated_at->diffForHumans() }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection