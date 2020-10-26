<?php

/** @var $model Message */
/** @var $users User */
/** @var $with User */


use app\Helper;
use app\models\Message;
use app\models\User;


?>
<div class="row">
    <div class="col-md-4 bg-white ">
        <div class=" row border-bottom padding-sm" style="height: 40px; padding: 10px">
            <?php echo count($users) - 1; ?> Member(s) online
        </div>

        <!-- member list -->
        <?php include __DIR__ . '/inc/list-users-online.html.php' ?>
    </div>

    <!--=========================================================-->
    <!-- selected chat -->
    <div class="col-md-8 bg-white ">
        <div class="chat-message">
            <ul class="chat">

                <?php if ((isset($conversations)) && count($conversations) > 0) : ?>

                    //1- Determiner la position de l'user connecté.<br>
                    //2- Afficher le message correspondant<br>
                    //3- Afficher son nom et sa photo<br>

                    <?php  //Helper::dump($with) ?>
                    <?php foreach ($conversations as $msg) : ?>

                        <?php if ($msg->user_to === Helper::auth()->id) : ?>
                            <li class="right clearfix">
                                <span class="chat-img pull-right">
                                    <img src="https://bootdey.com/img/Content/<?php echo Helper::auth()->profile ?>.jpg" alt="<?php echo Helper::auth()->displayName() ?>" style="cursor: pointer;">
                                </span>
                                <div class="chat-body clearfix">
                                    <div class="header">
                                        <strong class="primary-font"><?php echo Helper::auth()->displayName() ?></strong>
                                        <small class="pull-right text-muted"><i class="fa fa-clock-o"></i> 13 mins ago</small>
                                    </div>
                                    <p>
                                        <?php echo $msg->content; ?>
                                    </p>
                                </div>
                            </li>
                        <?php elseif ($msg->user_from === Helper::auth()->id) : ?>

                            <li class="left clearfix">
                                <span class="chat-img pull-left">
                                    <img src="https://bootdey.com/img/Content/<?php echo $with->profile ?>.jpg" alt="User Avatar">
                                </span>
                                <div class="chat-body clearfix">
                                    <div class="header">
                                        <strong class="primary-font"><?php echo $with->displayName() ?></strong>
                                        <small class="pull-right text-muted"><i class="fa fa-clock-o"></i> 12 mins ago</small>
                                    </div>
                                    <p>
                                        <?php echo $msg->content; ?>
                                    </p>
                                </div>
                            </li>
                        <?php endif; ?>


                    <?php endforeach; ?>
                <!--  <li class="right clearfix">
                    <span class="chat-img pull-right">
                        <img src="https://bootdey.com/img/Content/user_1.jpg" alt="User Avatar">
                    </span>
                    <div class="chat-body clearfix">
                        <div class="header">
                            <strong class="primary-font">Sarah</strong>
                            <small class="pull-right text-muted"><i class="fa fa-clock-o"></i> 13 mins ago</small>
                        </div>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales at.
                        </p>
                    </div>
                </li> -->
                <?php else: ?>
                    <div class="">

                    </div>
                <?php endif ?>




            </ul>
        </div>


        <?php if (isset($model)) : ?>
            <?php include __DIR__ . '/inc/form.html.php';  ?>
        <?php endif; ?>


        <!--<div class="chat-box bg-white">
            <div class="input-group">
                <input class="form-control border no-shadow no-rounded" placeholder="Type your message here">
                <span class="input-group-btn">
            			<button class="btn btn-success no-rounded" type="button">Send</button>
            		</span>
            </div> /input-group -->
    </div>
</div>
</div>