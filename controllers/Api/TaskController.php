<?php

namespace App\Controllers\Api;

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

        return jsonResponse($tasks);
    }

    public function store()
    {
        $params = [
            'title' => (empty(Request::post('title'))) ? '' : trim(strip_tags(Request::post('title'))),
            'starting_date' => (empty(Request::post('starting_date'))) ? '' : trim(strip_tags(Request::post('starting_date'))),
            'ending_date' => (empty(Request::post('ending_date'))) ? '' : trim(strip_tags(Request::post('ending_date'))),
            'status' => (empty(Request::post('status')) ? 0 : trim(strip_tags(Request::post('status')))),
            'user_id' => (empty(Request::post('user')) ? 0 : trim(strip_tags(Request::post('user')))),
        ];

        if (empty($params['title'])) {
            return errorResponse('validation', 'please send inputs');
        }

        try {
            App::get('DB')->insert(Task::$table, $params);
        } catch (Exception $e) {
            return errorResponse('validation', 'Error');
        }

        return noContentResponse();
    }


    public function update()
    {
        if (Request::get('id') !== null) {
            return errorResponse('validation', 'id not sent');
        }

        $id = trim(strip_tags(Request::get('id')));

        $task = App::get('DB')->first(Task::$table, Task::class, $id);
        if (empty($task)) {
            return errorResponse('not_found', 'not found');
            exit(0);
        }

        $params = [
            'title' => (empty($_POST['title'])) ? '' : trim(strip_tags($_POST['title'])),
            'starting_date' => (empty($_POST['starting_date'])) ? '' : trim(strip_tags($_POST['starting_date'])),
            'ending_date' => (empty($_POST['ending_date'])) ? '' : trim(strip_tags($_POST['ending_date'])),
            'status' => (empty($_POST['status'])) ? 0 : trim(strip_tags($_POST['status'])),
            'user_id' => (empty($_POST['user'])) ? 0 : trim(strip_tags($_POST['user'])),
        ];

        if (empty($params['title'])) {
            return errorResponse('validation', 'please ssend inputs');
            exit(0);
        }

        try {
            App::get('DB')->update(Task::$table, $params, $id);
        } catch (Exception $e) {
            return errorResponse('error', 'error');
        }

        return noContentResponse();
    }

    public function delete()
    {
        if (Request::get('id') !== null) {
            return errorResponse('validation', 'id not sent');
        }

        $id = trim(strip_tags(Request::get('id')));

        $task = App::get('DB')->first(Task::$table, Task::class, $id);
        if (!empty($task)) {
            App::get('DB')->delete(Task::$table, $id);
        }

        return noContentResponse();
    }
}