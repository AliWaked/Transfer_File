<?php

namespace App\Jobs;

use App\Models\File;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class RemovingFiles implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // $numberOfDeletedFiles = File::where('created_at', '<', Carbon::now()->subDays(7))->delete();
        $files = File::where('created_at', '<', Carbon::now()->subDays(7))->get();
        foreach ($files as $file) {
            $file->delete();
            Storage::disk(File::DISK)->deleteDirectory($file->identifier);
        }
    }
}
