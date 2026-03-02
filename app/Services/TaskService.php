<?php

namespace App\Services;

use App\Repositories\Contracts\TaskRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TaskService
{
    public function __construct(
        protected TaskRepositoryInterface $repo,
        protected AIService $aiService
    ) {
    }

    public function all(array $filters = [])
    {
        return $this->repo->all($filters);
    }

    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {
            $task = $this->repo->create($data);

            try {
                $aiData = $this->aiService->generateSummary($task);
                $this->repo->update($task->id, $aiData);
            } catch (\Exception $exception) {
                // Log AI failure but keep task created
                Log::error('AI Integration Failed: ' . $exception->getMessage());
            }

            return $task->fresh('user');
        });
    }

    public function update(int $id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            $task = $this->repo->update($id, $data);

            // Re-trigger AI summary if description changed significant
            if (isset($data['description'])) {
                try {
                    $aiData = $this->aiService->generateSummary($task);
                    $this->repo->update($id, $aiData);
                } catch (\Exception $exception) {
                    Log::error('AI Integration Failed during update: ' . $exception->getMessage());
                }
            }

            return $task->fresh('user');
        });
    }

    public function destroy(int $id)
    {
        return $this->repo->delete($id);
    }

    public function find(int $id)
    {
        return $this->repo->find($id);
    }
}
