<?php

namespace App\Controllers;

use App\App\App;
use App\Models\Task;
use App\App\Request;
use App\Models\Users;

class TaskController
{
    public function index()
    {
        $tasks = App::get('DB')->selectAll(
            table: Task::$table,
            order: 'order by tasks.id desc',
            join: [
                'table' => Users::$table,
                'refKey' => 'user_id',
                'foreignKey' => 'users.id'
            ],
            select: 'tasks.*, users.name'
        );
        $title = 'tasks lists';
        $status = Task::$status;

        return view('tasks.index', compact('tasks', 'title', 'status'));
    }

    public function create()
    {
        $title = 'Create new Task';
        $status = Task::$status;
        $users = App::get('DB')->selectAll(Users::$table);
        return view('tasks.create', compact('title', 'status', 'users'));
    }

    public function store()
    {
        $params = [
            'title' => (empty($_POST['title'])) ? '' : trim(strip_tags($_POST['title'])),
            'starting_date' => (empty($_POST['starting_date'])) ? '' : trim(strip_tags($_POST['starting_date'])),
            'ending_date' => (empty($_POST['ending_date'])) ? '' : trim(strip_tags($_POST['ending_date'])),
            'status' => (empty($_POST['status'])) ? 0 : trim(strip_tags($_POST['status'])),
            'user_id' => (empty($_POST['user'])) ? 0 : trim(strip_tags($_POST['user'])),
        ];

        if (empty($params['title'])) {
            return redirect('tasks/create');
        }

        try {
            App::get('DB')->insert(Task::$table, $params);
        } catch (Exception $e) {
            require "views/500.php";
        }

        return redirect('tasks');
    }

    public function edit()
    {
        if (Request::get('id') == null) {
            require "views/404.php";
            exit(0);
        }

        $id = trim(strip_tags(Request::get('id')));

        $task = App::get('DB')->first(Task::$table, id: $id);
        if (empty($task)) {
            require "views/404.php";
            exit(0);
        }

        $task = $task[0];
        $title = $task->title . ' | tasks edit';
        $status = Task::$status;

        return view('tasks.update', compact('task', 'title', 'status'));
    }

    public function update()
    {
        if (Request::get('id') == null) {
            require "views/404.php";
            exit(0);
        }

        $id = trim(strip_tags(Request::get('id')));

        $task = App::get('DB')->first(Task::$table, id: $id);
        if (empty($task)) {
            require "views/404.php";
            exit(0);
        }

        $params = [
            'title' => (empty($_POST['title'])) ? '' : trim(strip_tags($_POST['title'])),
            'starting_date' => (empty($_POST['starting_date'])) ? '' : trim(strip_tags($_POST['starting_date'])),
            'ending_date' => (empty($_POST['ending_date'])) ? '' : trim(strip_tags($_POST['ending_date'])),
            'status' => (empty($_POST['status'])) ? 0 : trim(strip_tags($_POST['status']))
        ];

        if (empty($params['title'])) {
            require "views/500.php";
            exit(0);
        }

        try {
            App::get('DB')->update(Task::$table, $params, $id);
        } catch (Exception $e) {
            require "views/500.php";
        }

        return redirect('tasks');
    }

    public function delete()
    {
        if (Request::get('id') == null) {
            require "views/404.php";
        }

        $id = trim(strip_tags(Request::get('id')));

        $task = App::get('DB')->first(Task::$table, id: $id);
        if (!empty($task)) {
            App::get('DB')->delete(Task::$table, $id);
        }

        return redirect('tasks');
    }

    public function calendar()
    {
        $tasks = App::get('DB')->selectAll(Task::$table);
        $title = 'Calendar';
        return view('tasks.calendar', compact('title', 'tasks'));
    }
}