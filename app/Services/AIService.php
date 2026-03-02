<?php

namespace App\Services;

use App\Models\Task;

class AIService
{
    /**
     * Generate AI summary and priority based on task details.
     * 
     
     */
    public function generateSummary(Task $task): array
    {
        // Mock fallback as requested - simulate some logic
        $priority = strlen($task->description) > 50 ? 'high' : 'medium';
        return [
            'ai_summary' => "AI-generated summary for: " . $task->title . ". Description length: " . strlen($task->description) . " chars.",
            'ai_priority' => $priority,
        ];
    }
}
