@extends('layouts.task_layout')

@section('title', 'New Task')

@section('content')
    <div class="max-w-4xl mx-auto space-y-8 animate-in fade-in slide-in-from-bottom-5 duration-700">
        <div class="flex items-center space-x-3 mb-4">
            <a href="{{ route('tasks.index') }}"
                class="p-3 bg-white/5 hover:bg-white/10 rounded-2xl transition-all text-gray-500 hover:text-white border border-white/5 group">
                <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
            </a>
        </div>

        <div class="bg-white p-12 rounded-[48px] shadow-2xl shadow-black ring-1 ring-white/5">
            <h2 id="taskTitleDisplay" class="text-4xl font-extrabold text-[#1a1e2b] mb-10 tracking-tight leading-tight">
                New Campaign Objective
            </h2>

            <form method="POST" action="{{ route('tasks.store_web') }}" class="space-y-10">
                @csrf

                <div class="space-y-4">
                    <div class="relative group">
                        <input type="text" name="title" id="titleInput" placeholder="e.g. Launch New Campaign" required
                            class="w-full bg-[#f4f7fe] border-transparent rounded-[24px] px-8 py-5 text-lg text-[#1a1e2b] font-medium focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500/20 transition-all placeholder:text-gray-400 shadow-inner">
                    </div>

                    <div class="relative">
                        <textarea name="description" rows="4" placeholder="The details of your marketing campaign..."
                            class="w-full bg-[#f4f7fe] border-transparent rounded-[24px] px-8 py-6 text-base text-gray-600 leading-relaxed font-medium focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500/20 transition-all placeholder:text-gray-400 shadow-inner resize-none"></textarea>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    <div class="space-y-4">
                        <label class="text-sm font-bold text-gray-400 uppercase tracking-widest pl-2">Priority</label>
                        <div class="flex items-center gap-3 bg-[#f4f7fe] p-3 rounded-[28px] shadow-inner">
                            @foreach(['low', 'medium', 'high'] as $p)
                                <label class="flex-1 text-center cursor-pointer group">
                                    <input type="radio" name="priority" value="{{ $p }}" {{ $loop->first ? 'checked' : '' }}
                                        class="hidden peer">
                                    <div
                                        class="py-3 px-4 rounded-[20px] font-bold text-sm transition-all text-gray-400 peer-checked:bg-white peer-checked:text-[#1a1e2b] peer-checked:shadow-lg peer-checked:shadow-black/5 hover:text-gray-600">
                                        {{ ucfirst($p) }}
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="space-y-4">
                        <label class="text-sm font-bold text-gray-400 uppercase tracking-widest pl-2">Status</label>
                        <div class="flex items-center gap-3 bg-[#f4f7fe] p-3 rounded-[28px] shadow-inner">
                            @foreach(['pending', 'in_progress', 'completed'] as $s)
                                <label class="flex-1 text-center cursor-pointer group">
                                    <input type="radio" name="status" value="{{ $s }}" {{ $loop->first ? 'checked' : '' }}
                                        class="hidden peer">
                                    <div
                                        class="py-3 px-4 rounded-[20px] font-bold text-xs transition-all text-gray-400 peer-checked:bg-white peer-checked:text-[#1a1e2b] peer-checked:shadow-lg peer-checked:shadow-black/5 hover:text-gray-600">
                                        {{ ucfirst(str_replace('_', ' ', $s)) }}
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    <div class="space-y-4">
                        <label class="text-sm font-bold text-gray-400 uppercase tracking-widest pl-2">Due Date</label>
                        <div class="relative group">
                            <input type="date" name="due_date" value="{{ date('Y-m-d') }}"
                                class="w-full bg-[#f4f7fe] border-transparent rounded-[24px] px-8 py-5 text-gray-600 font-medium focus:ring-4 focus:ring-blue-500/10 transition-all shadow-inner">
                        </div>
                    </div>

                    <div class="space-y-4">
                        <label class="text-sm font-bold text-gray-400 uppercase tracking-widest pl-2">Assign To</label>
                        <select name="assigned_to"
                            class="w-full bg-[#f4f7fe] border-transparent rounded-[24px] px-8 py-5 text-gray-600 font-medium focus:ring-4 focus:ring-blue-500/10 transition-all shadow-inner ring-0 focus:outline-none">
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="pt-8 text-center">
                    <button type="submit"
                        class="accent-blue hover:bg-blue-600 text-white px-16 py-6 rounded-[32px] text-xl font-bold transition-all shadow-2xl shadow-blue-500/20 hover:-translate-y-1 transform active:scale-95 group">
                        Create Task
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const titleInput = document.getElementById('titleInput');
        const display = document.getElementById('taskTitleDisplay');
        titleInput.addEventListener('input', (e) => {
            display.textContent = e.target.value || 'New Campaign Objective';
        });
    </script>
@endpush