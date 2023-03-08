<?php use App\App\App;

require 'views/layouts/main.php' ?>
<?php
    $events = [];
    if (!empty($tasks)) {
        foreach ($tasks as $key => $task) {
            $tmp = [
                'id' => $task->id,
                'title' => $task->title,
                'start' => $task->starting_date,
                'end' => $task->ending_date
            ];
            array_push($events, $tmp);
        }
    }
?>
    <script type="text/javascript" src="<?= asset('/js/jquery.min.js'); ?>"></script>
    <script type="text/javascript" src="<?= asset('/js/moment.min.js'); ?>"></script>
    <script type="text/javascript" src="<?= asset('/js/fullcalendar.min.js'); ?>"></script>
<script>
  $(document).ready(function() {

    var events = <?= json_encode($events); ?>;

    $('#calendar').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay,listWeek'
      },
      defaultDate: "<?=date('Y-m-d') ?>",
      navLinks: true, // can click day/week names to navigate views
      editable: true,
      eventLimit: true, // allow "more" link when too many events
      events: events
    });

  });

</script>

<header class="mt-4 mb-4">
    <div class="container">
        <h1 class="h1 text-center">To Do List</h1>
        <div class="row mt-4">
            <div class="col-6">
                <a href="/tasks" class="btn btn-block btn-warning">List Viewer</a>
            </div>
            <div class="col-6">
                <a class="btn btn-block btn-info" href="/tasks/create">Create new Task</a>
            </div>
        </div>
    </div>
</header>

<section>
    <div class="container">
        <div id='calendar'></div>
    </div>
</section>

<?php require 'views/layouts/footer.php' ?>