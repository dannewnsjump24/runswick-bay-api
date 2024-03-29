<?php

use App\Domain\Trips\Console\DeleteExpiredTripsAndRelatedContentCommand;
use Illuminate\Support\Facades\Schedule;

Schedule::command(DeleteExpiredTripsAndRelatedContentCommand::class, [30])->dailyAt('3:00');
