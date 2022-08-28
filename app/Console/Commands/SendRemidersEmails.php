<?php

namespace App\Console\Commands;

use App\Mail\ReminderEmail;
use App\Models\Reminder;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendRemidersEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email notification to user about reminder';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Get all reminders for today
        $reminders = Task::query()
            ->whereDate('deadline', Carbon::now()->addDay())
            ->where('status', 'open')
            ->get();

        // group all reminders by user
        $data = [];
        foreach ($reminders as $reminder) {
            $data[$reminder->user_id][] = $reminder->toArray();
        }

        foreach ($data as $userId => $reminders) {
            $this->sendEmailToUser($userId, $reminders);
        }
    }

    private function sendEmailToUser($userId, $reminders)
    {
        $user = User::find($userId);

        Mail::to($user)->send(new ReminderEmail($reminders));
    }
}
