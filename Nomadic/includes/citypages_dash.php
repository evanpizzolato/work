<!--THIS CODE IS FOR THE EDIT AND DELETE BUTTONS THAT APPEAR NEXT TO A USER'S TIP ON A CITY PAGES-->
<div class='pull-right'>
<form style="display:inline;" method="get" action="citypages_edittip.php">
    <input type="hidden" name="tipId" value="<?php echo $tip['id']; ?>"/>                            
    <button type="submit" name="edit" class='adminBtn'data-toggle='tooltip' data-placement='top' title='Edit/Details'><a><span class="glyphicon glyphicon-pencil" ></span></a></button>
</form>

<form style="display:inline;" method="post">
    <input type="hidden" name="tipIdDelete" value="<?php echo $tip['id']; ?>" />
    <button type="submit" name="delete" class='adminBtn' data-toggle='tooltip' data-placement='top' title='Delete'><a><span class="glyphicon glyphicon-remove" ></span></a></button>
</form>
</div>