<?php

namespace App\Observers;

use App\Models\GeneralModel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GeneralModelObserver
{
    public function creating(GeneralModel $generalModel): void
    {
        /** @var null|User $user */
        $user = Auth::user();
        $generalModel->creator_id = $user->id ?? config('masterConfig.master_user_id');
    }

    public function updating(GeneralModel $generalModel): void
    {
        /** @var null|User $user */
        $user = Auth::user();
        $generalModel->updater_id = $user->id ?? config('masterConfig.master_user_id');
    }
}
