<?php require 'views/layouts/main.php' ?>
<header class="mt-4 mb-4">
    <div class="container">
        <h1 class="h1 text-center">To Do List</h1>
        <div class="row mt-4">
            <div class="col-4">
                <a href="/tasks/calendar" class="btn btn-block btn-outline-success">Calendar Viewer</a>
            </div>
            <div class="col-4">
                <a class="btn btn-block btn-outline-info" href="/tasks/create">Create new Task</a>
            </div>
            <div class="col-4">
                <a class="btn btn-block btn-outline-warning" href="wiki/SabaIdea.postman_collection.json">Postman Collection</a>
            </div>
        </div>
    </div>
</header>

<section>
    <div class="container">
        <div class="row">
            <div class="col-12">
                    <table datatable class="table table-bordered mt-4 py-2">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Starting Date</th>
                                <th>Ending Date</th>
                                <th>Status</th>
                                <th>User</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tasks as $index => $task) : ?>
                            <tr>
                                <td><?= $index+1; ?></td>
                                <td><?= $task->title; ?></td>
                                <td><?= date('Y-m-d H:i:s', strtotime($task->starting_date)); ?></td>
                                <td><?= date('Y-m-d H:i:s', strtotime($task->ending_date)); ?></td>
                                <td><?= $status[$task->status]; ?></td>
                                <td><?= $task->name; ?></td>
                                <td>
                                    <a href="/tasks/edit?id=<?= $task->id; ?>" class="btn btn-success">Edit</a>
                                    <a href="/tasks/delete?id=<?= $task->id; ?>" class="btn btn-danger delete-work">Delete</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require 'views/layouts/footer.php' ?>