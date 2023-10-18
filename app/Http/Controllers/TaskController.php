<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskStoreRequest;
use App\Jobs\SendTaskCompletedNotification;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::query()
            ->where('user_id', auth()->user()->id)
            ->latest()
            ->paginate(15);

        if (auth()->user()->hasRole('admin')) {
            $tasks = Task::query()->latest()->paginate(15);
        }
        return view('task.index', ['tasks' => $tasks]);
    }

    public function create()
    {
        return view('task.create');
    }

    public function edit(Task $task)
    {
        return view('task.edit', ['task' => $task]);
    }

    public function store(TaskStoreRequest $request)
    {
        $task = Task::query()->create($request->all());
        return redirect()->route('tasks.index');
    }

    public function update(Request $request, Task $task)
    {
        $task->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);
        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->back();
    }

    public function changeStatus(Task $task)
    {
        $task->update([
            'status' => 'completed'
        ]);

        dispatch(new SendTaskCompletedNotification($task->user));
        return redirect()->back();
    }

}
