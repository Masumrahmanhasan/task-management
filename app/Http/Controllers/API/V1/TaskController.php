<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskStoreRequest;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $this->authorize('task-read');
        $tasks = Task::query()
            ->where('user_id', auth()->user()->id)
            ->latest()
            ->paginate(15);

        if (auth()->user()->hasRole('admin')) {
            $tasks = Task::query()->latest()->paginate(15);
        }

        return $this->success($tasks);
    }

    public function store(TaskStoreRequest $request)
    {
        $this->authorize('task-create');
        $task = Task::query()->create($request->all());
        return $this->success($task, 'Task Created Successfully');
    }

    public function show(Task $task)
    {
        $this->authorize('task-read');
        return $this->success($task);
    }

    public function update(Request $request, Task $task)
    {
        $this->authorize('task-update');
        $task->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);
        return $this->success(message: 'Task updated Successfully');
    }

    public function destroy(Task $task)
    {
        $this->authorize('task-delete');
        $task->delete();
        return $this->success($task, 'Task deleted Successfully');
    }
}
