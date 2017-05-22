<div>
    <form action="events.php" method="post" class="col-sm-3 col-xs-6">
        <text>Advertise for 10 minutes</text>
        <?php $events->adPayment($fileName, 99, 'Advertise for 10 minutes'); ?>
        <input type="hidden" name="event" value="<?php echo $_GET['advertise'];?>"/>
        <input type="hidden" name="amount" value="99"/>
    </form>
    <form action="events.php" method="post" class="col-sm-3 col-xs-6">
        <text>Advertise for one hour</text>
        <?php $events->adPayment($fileName, 500, 'Advertise for one hour'); ?>
        <input type="hidden" name="event" value="<?php echo $_GET['advertise'];?>"/>
        <input type="hidden" name="amount" value="500"/>
    </form>
    <form action="events.php" method="post" class="col-sm-3 col-xs-6">
        <text>Advertise for one day</text>
        <?php $events->adPayment($fileName, 11000, 'Advertise for one day'); ?>
        <input type="hidden" name="event" value="<?php echo $_GET['advertise'];?>"/>
        <input type="hidden" name="amount" value="11000"/>
    </form>
    <form action="events.php" method="post" class="col-sm-3 col-xs-6">
        <text>Advertise for 2 days</text>
        <?php $events->adPayment($fileName, 20000, 'Advertise for 2 days'); ?>
        <input type="hidden" name="event" value="<?php echo $_GET['advertise'];?>"/>
        <input type="hidden" name="amount" value="20000"/>
    </form>
</div>
<hr>