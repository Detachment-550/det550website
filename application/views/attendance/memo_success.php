<link rel="stylesheet" type="text/css" href="/css/attend.css">

<div class="jumbotron container-fluid">
    <div class="alert alert-success" role="alert">
        Your memo was submitted!<br><br>
<!--        TODO: Make this work-->
        <p><strong>Memo Type: </strong> <?php echo $memo->attendance_memo_type->label; ?></p>
        <?php
            if($memo->event_id !== NULL)
            {
                echo "<p><strong>Event: </strong> " . $memo->event->name. "</p>";
            }
        ?>
        <p><strong>Memo Sent To: </strong> <?php echo $memo->memo_for->rank . ' ' . $memo->memo_for->last_name; ?></p>
        <p><strong>Date Submitted: </strong> <?php echo Date('Y-m-d H:i:s', strtotime($memo->created_at)); ?></p>
        <iframe src="/memo_attachments/<?php echo $memo->attachment; ?>" style="width: 100%;height:500px"></iframe>
    </div>
</div>
