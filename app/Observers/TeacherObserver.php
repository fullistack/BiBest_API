<?php

namespace App\Observers;

use App\Models\teacher;

class TeacherObserver
{
    /**
     * Handle the teacher "created" event.
     *
     * @param  \App\Models\teacher  $teacher
     * @return void
     */
    public function created(teacher $teacher)
    {
        $teacher->lessonsPrice()->create();
    }

    /**
     * Handle the teacher "updated" event.
     *
     * @param  \App\Models\teacher  $teacher
     * @return void
     */
    public function updated(teacher $teacher)
    {
        //
    }

    /**
     * Handle the teacher "deleted" event.
     *
     * @param  \App\Models\teacher  $teacher
     * @return void
     */
    public function deleted(teacher $teacher)
    {
        //
    }

    /**
     * Handle the teacher "restored" event.
     *
     * @param  \App\Models\teacher  $teacher
     * @return void
     */
    public function restored(teacher $teacher)
    {
        //
    }

    /**
     * Handle the teacher "force deleted" event.
     *
     * @param  \App\Models\teacher  $teacher
     * @return void
     */
    public function forceDeleted(teacher $teacher)
    {
        //
    }
}
