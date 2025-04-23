<?php

namespace App\Http\Controllers;

use App\Jobs\SendTaskCreateNotification;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    //
    public function index()
    {
        // $tasks = Task::with('user')->latest()->get();
        $tasks = Auth::user()->tasks()->latest()->get();
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $user = Auth::user();

        // Create the task
        $task = $user->tasks()->create($validatedData);

        // Dispatch the notification job
        SendTaskCreateNotification::dispatch($user, $task);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully! A confirmation email will be sent shortly.');
    }

    public function destroy($id)
    {
        $user = Auth::user();

        $task = Task::findOrFail($id);

        // Authorization check (user can only delete their own tasks)
        if ($task->user_id !== $user->id) {
            abort(403, 'Unauthorized action.');
        }

        $task->delete();

        return redirect()->back()->with('success', 'Task deleted successfully!');
    }
}
