<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\Contracts\TaskRepositoryInterface;
use App\Services\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct(
        protected TaskService $service,
        protected TaskRepositoryInterface $repo,
        protected \App\Repositories\Contracts\UserRepositoryInterface $userRepo
    ) {
    }

    public function index(Request $request)
    {
        $tasks = $this->service->all($request->all());
        $stats = $this->repo->getDashboardStats();
        return view('tasks.index', compact('tasks', 'stats'));
    }

    public function create()
    {
        $users = $this->userRepo->all();
        return view('tasks.create', compact('users'));
    }

    public function edit(int $id)
    {
        $task = $this->service->find($id);
        $users = $this->userRepo->all();
        return view('tasks.edit', compact('task', 'users'));
    }

    public function show(int $id)
    {
        $task = $this->service->find($id);
        return view('tasks.show', compact('task'));
    }

    public function store(Request $request)
    {
        $this->service->store($request->all());
        return redirect()->route('tasks.index')->with('success', 'Task created successfully');
    }

    public function update(Request $request, int $id)
    {
        $this->service->update($id, $request->all());
        return redirect()->route('tasks.index')->with('success', 'Task updated successfully');
    }
}
