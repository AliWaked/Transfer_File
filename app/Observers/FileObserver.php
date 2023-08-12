<?php

namespace App\Observers;

use App\Models\File;
use Illuminate\Support\Facades\Auth;

class FileObserver
{
    /**
     * Handle the File "created" event.
     */
    public function creating(File $file): void
    {
        if($user_id = Auth::id()) {
            
        }
    }

    /**
     * Handle the File "updated" event.
     */
    public function updated(File $file): void
    {
        //
    }

    /**
     * Handle the File "deleted" event.
     */
    public function deleted(File $file): void
    {
        //
    }

    /**
     * Handle the File "restored" event.
     */
    public function restored(File $file): void
    {
        //
    }

    /**
     * Handle the File "force deleted" event.
     */
    public function forceDeleted(File $file): void
    {
        //
    }
}
