<?php

/** @var $users User */

use app\core\Helper;
use app\models\User;

$images = array("user_6", "user_2", "user_3", "user_5", "user_1");

?>

<ul class="friend-list">

    <?php foreach ($users as $user) : ?>
        <?php if (Helper::auth()->id !== $user->id) : ?>
            <li>
                <a href="/message/with/<?php echo $user->id; ?>" onclick="func(0)" class="clearfix">
                    <img src="https://bootdey.com/img/Content/<?php echo $user->profile ?>.jpg" alt="" class="img-circle">
                    <div class="friend-name">
                        <strong><?php echo ucfirst($user->firstname . ' ' . $user->lastname); ?> </strong>
                    </div>
                    <div class="last-message text-muted">Lorem ipsum dolor sit amet.</div>
                    <small class="time text-muted " id="status_icon"></small>
                </a>
            </li>
        <?php endif; ?>
    <?php endforeach; ?>

</ul>