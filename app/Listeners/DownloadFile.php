<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DownloadFile
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $event->file->update(['total' => ($event->file->total + 1)]);
        DB::table('download_files')->insert([
            'id' => Str::uuid(),
            'file_id' => $event->file->id,
            'ip' => $event->info['ip'],
            'user_agent' => $event->info['user_agent'],
            'downloaded_at' => now(),
        ]);
    }
}
