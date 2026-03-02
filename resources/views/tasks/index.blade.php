@extends('layouts.task_layout')

@section('title', 'Tasks')

@section('content')
    <div class="mb-8 space-y-4">
        <!-- Filters -->
        <div class="flex flex-wrap items-center gap-4 bg-white/5 p-5 rounded-2xl">
            <div class="relative flex-1 min-w-[200px]">
                <input type="text" placeholder="Search Filter Task"
                    class="w-full bg-white/5 border-white/10 rounded-xl px-4 py-2.5 text-sm focus:ring-blue-500 focus:border-blue-500 transition-all placeholder:text-gray-500">
            </div>
            <select class="bg-white/5 border-white/10 rounded-xl px-4 py-2.5 text-sm text-gray-400 focus:ring-blue-500">
                <option>Status</option>
                <option value="pending">Pending</option>
                <option value="in_progress">In Progress</option>
                <option value="completed">Completed</option>
            </select>
            <select class="bg-white/5 border-white/10 rounded-xl px-4 py-2.5 text-sm text-gray-400 focus:ring-blue-500">
                <option>Priority</option>
                <option value="low">Low</option>
                <option value="medium">Medium</option>
                <option value="high">High</option>
            </select>
        </div>

        <!-- Task List -->
        <div class="space-y-4">
            @forelse($tasks as $task)
                <div
                    class="card-bg p-6 rounded-[32px] border border-white/5 hover:border-white/10 transition-all group shadow-2xl relative overflow-hidden">
                    <!-- AI Badge if exists -->
                    @if($task->ai_priority)
                        <div
                            class="absolute top-0 right-0 mt-4 mr-4 px-3 py-1 bg-gradient-to-r from-purple-500/20 to-blue-500/20 text-purple-400 text-[10px] font-bold uppercase tracking-widest rounded-full border border-purple-500/20 shadow-inner">
                            AI Recommended: {{ $task->ai_priority }}
                        </div>
                    @endif

                    <div class="flex items-start justify-between gap-6">
                        <div class="flex-1">
                            <div class="flex items-center space-x-3 mb-2">
                                <span
                                    class="px-2.5 py-1 rounded-lg text-[10px] uppercase font-bold tracking-wider 
                                        {{ $task->priority->value === 'high' ? 'bg-red-500/10 text-red-400 border border-red-500/10' : ($task->priority->value === 'medium' ? 'bg-yellow-500/10 text-yellow-500 border border-yellow-500/10' : 'bg-blue-500/10 text-blue-400 border border-blue-500/10') }}">
                                    {{ strtoupper($task->priority->value) }}
                                </span>
                                <span class="text-xs text-gray-500 font-medium">Due
                                    {{ $task->due_date->format('M d, Y') }}</span>
                            </div>
                            <h3 class="text-2xl font-bold mb-2 group-hover:text-blue-400 transition-colors">{{ $task->title }}
                            </h3>
                            <p class="text-gray-400 text-sm leading-relaxed mb-4 line-clamp-2 max-w-2xl">
                                {{ $task->description }}
                            </p>

                            <div class="flex items-center space-x-6 text-xs text-gray-500">
                                <div class="flex items-center space-x-2">
                                    <div
                                        class="w-1.5 h-1.5 rounded-full {{ $task->status->value === 'completed' ? 'bg-green-500' : ($task->status->value === 'in_progress' ? 'bg-yellow-500' : 'bg-gray-500') }}">
                                    </div>
                                    <span
                                        class="uppercase tracking-widest font-bold">{{ str_replace('_', ' ', $task->status->value) }}</span>
                                </div>
                                <span class="flex items-center bg-white/5 px-2 py-1 rounded-md border border-white/5">
                                    Assigned to: <strong
                                        class="ml-1 text-gray-300">{{ $task->user->name ?? 'Unassigned' }}</strong>
                                </span>
                            </div>
                        </div>

                        <div class="flex flex-col space-y-2">
                            <a href="{{ route('tasks.show', $id ?? $task->id) }}"
                                class="p-3 bg-white/5 hover:bg-white/10 rounded-2xl transition-all text-gray-400 hover:text-white border border-white/5 text-center px-6">
                                Detail + AI
                            </a>
                            <a href="{{ route('tasks.edit', $id ?? $task->id) }}"
                                class="p-3 bg-blue-500/10 hover:bg-blue-500/20 rounded-2xl transition-all text-blue-400 border border-blue-500/10 text-center px-6">
                                Edit
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-20 bg-white/5 rounded-[40px] border border-dashed border-white/10 shadow-2xl">
                    <p class="text-gray-500 text-lg">No tasks found. Time to launch a new campaign!</p>
                </div>
            @endforelse

            <div class="mt-8">
                {{ $tasks->links() }}
            </div>
        </div>
    </div>
@endsection