<?php require 'views/layouts/main.php' ?>
<header>
    <div class="container">
        <h1 class="h1 text-center">Update Task</h1>
    </div>
</header>

<section>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                <form action="/tasks/edit?id=<?php echo $task->id ?>" method="post">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" class="form-control" placeholder="Title..." required="required" value="<?php echo $task->title; ?>">
                    </div>
                    <div class="form-group">
                        <label for="starting_date">Start date</label>
                        <input type="text" name="starting_date" id="starting_date" class="form-control" placeholder="YYYY-MM-DD" value="<?php echo date('Y-m-d H:i:s', strtotime($task->starting_date)); ?>">
                    </div>
                    <div class="form-group">
                        <label for="ending_date">End date</label>
                        <input type="text" name="ending_date" id="ending_date" class="form-control" placeholder="YYYY-MM-DD" value="<?php echo date('Y-m-d H:i:s', strtotime($task->ending_date)); ?>">
                    </div>
                    <div class="form-group">
                        <label for="ending_date">Status</label>
                        <select name="status" class="form-control">
                            <?php foreach ($status as $key => $value) : ?>
                            <?php $selected = ($task->status==$key)?'selected="selected"':''; ?>
                            <option value="<?php echo $key; ?>" <?php echo $selected; ?>>
                                <?php echo $value ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input class="btn btn-block btn-success" type="submit" value="Update">
                    </div>
                    <div class="form-group mt-4">
                        <a class="btn btn-block btn-warning" href="/tasks">Back To List</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php require 'views/layouts/footer.php' ?>