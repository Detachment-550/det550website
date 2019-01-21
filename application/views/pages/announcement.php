<link rel="stylesheet" type="text/css" href="<?php echo base_url("css/announcement.css"); ?>">

<body>
<div class="jumbotron container-fluid">
    <div class='card'>
    <div class='card-header'><?php echo $announcement['title']; ?></div>
    <div class='card-body'><h5 class='card-title'><?php echo $announcement['subject']; ?></h5>
        <?php echo $announcement['body']; ?>
         <?php
            foreach($cadets as $cadet)
            {
                if($cadet['rin'] === $announcement['createdBy'])
                {
                    $firstName = $cadet['firstName'];
                    $lastName = $cadet['lastName'];
                }
            }
            ?>
            <p class='card-text'>Posted by: <?php echo $firstName . ' ' . $lastName; ?></p>
        </div>
    </div>
</div>

