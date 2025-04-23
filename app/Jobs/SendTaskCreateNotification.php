<?php

namespace App\Jobs;

use App\Mail\TaskCreated; // Import Mailable
use App\Models\Task;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue; // Implement ShouldQueue for background processing
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log; // Optional: for logging
use Illuminate\Support\Facades\Mail; // Import Mail facade

class SendTaskCreateNotification implements ShouldQueue // Use ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    // Public properties to hold data needed by the job
    public User $user;
    public Task $task;

    /**
     * Create a new job instance.
     */
    public function __construct(User $user, Task $task)
    {
        $this->user = $user;
        $this->task = $task;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            // Create the mailable instance
            $email = new TaskCreated($this->user, $this->task);

            // Send the email
            Mail::to($this->user->email)->send($email);

            Log::info("Task creation email sent successfully to {$this->user->email} for task ID {$this->task->id}");
        } catch (\Exception $e) {
            // Log error if sending fails
            Log::error("Failed to send task creation email to {$this->user->email} for task ID {$this->task->id}: " . $e->getMessage());

            // Fail the job explicitly
            $this->fail($e);
        }
    }
}
