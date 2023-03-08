<?php

namespace App\Models;

class Task
{
    public static string $table = 'tasks';

    public static array $status = [
        0 => 'To Do',
        1 => 'In Progress',
        2 => 'Done'
    ];

}