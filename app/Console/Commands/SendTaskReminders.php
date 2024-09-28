<?php

namespace App\Console\Commands;

use App\Mail\TaskReminderMail;
use App\Models\Task;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendTaskReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tasks:send-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send task reminder emails to users for upcoming tasks';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Fetch tasks with reminder time approaching in the next 5 minutes
        $tasks = Task::where('reminder_time', '<=', now()->addMinutes(5))
                      ->where('reminder_time', '>=', now())
                      ->whereNull('reminder_sent_at') // Ensure reminders are not sent multiple times
                      ->get();

        foreach ($tasks as $task) {
            Mail::to($task->user->email)->send(new TaskReminderMail($task));

            // Mark reminder as sent
            $task->reminder_sent_at = now();
            $task->save();
        }

        $this->info('Task reminder emails sent successfully.');
    }
}
