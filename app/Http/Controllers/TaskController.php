<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'project_id' => 'required',
        ]);

        $task = Task::create([
            'title' => $validatedData['title'],
            'project_id' => $validatedData['project_id'],
        ]);

        return back()->with('status', 'Task created!');
    }

    public function markAsCompleted(Task $task)
    {
        $task->is_completed = true;
        $task->update();

        return back()->with('status', 'Task Approved!');
    }
}
