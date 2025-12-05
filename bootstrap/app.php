<?php

use App\Http\Middleware\AdminMiddleware;
use App\Jobs\SendCustomEmailJob;
use App\Models\Message;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'admin' => AdminMiddleware::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })
    ->withSchedule(function (Schedule $schedule) {
        $schedule->call(function () {

            $messages = Message::whereNotNull('recurrence')
                ->where('next_run_at', '<=', now())
                ->get();

            foreach ($messages as $msg) {

                SendCustomEmailJob::dispatch(
                    $msg->receiver->email,
                    $msg->subject,
                    $msg->body
                );

                $msg->next_run_at = match ($msg->recurrence) {
                    'hourly' => Carbon::now()->addHour(),
                    'daily' => Carbon::now()->addDay(),
                    'weekly' => Carbon::now()->addWeek(),
                    'monthly' => Carbon::now()->addMonth(),
                };

                $msg->save();
            }
        })->everyMinute();
    })->create();
