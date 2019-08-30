<link rel="stylesheet" type="text/css" href="/css/profile.css">

<body>
<div class="jumbotron container-fluid">
    <h1 class="display-4"><?php echo $heading; ?></h1>
    <div class="container">
        <div class="row">
            <div class="col-4">
                <div class="card">
                    <img class="card-img-top" alt="Profile picture" src='<?php echo $picture; ?>'>
                    <div class="card-body">
                        <p class="card-text">
                            <strong>Contact Information: </strong><br>
                            <strong>Email: </strong> <?php echo $user->email; ?><br>
                            <strong>Phone Number: </strong> <?php echo "(" . $user->phone[0] . $user->phone[1] .
                                $user->phone[2] . ") " . $user->phone[3] . $user->phone[4] .
                                $user->phone[5] . "-" . $user->phone[6] . $user->phone[7] .
                                $user->phone[8] . $user->phone[9]; ?><br>
                            <strong>Flight: </strong> <?php echo $user->flight; ?><br>
                            <strong>Position: </strong> <?php echo $user->position; ?><br>
                            <strong>Major: </strong> <?php echo $user->major; ?><br>
                        </p>
                        <?php
                            if( $myprofile === true)
                            {
                                echo '<a class="btn btn-primary" href="/index.php/cadet/edit">Edit Profile</a>';
                            }
                        ?>

                    </div>
                </div>
            </div>

            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Class:</h5>
                        <p class="card-text"><?php echo $user->class; ?></p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Bio:</h5>
                        <p class="card-text"><?php echo $user->bio; ?></p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Awards and Achievements:</h5>
                        <p class="card-text"><?php echo $user->awards; ?></p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Air Force Goals:</h5>
                        <p class="card-text"><?php echo $user->afgoals; ?></p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Personal Goals:</h5>
                        <p class="card-text"><?php echo $user->goals; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
