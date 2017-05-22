

/**
 * Created by evan on 2017-04-04.
 */
function vote(id, value) { // function vote with 2 arguments: topics id and value (+1 or -1) depending if you clicked on the arrow up or down
    var dataFields = {'id': id, 'value': value}; // We pass the 2 arguments
    $.ajax({ // Ajax
        type: "POST",
        url: "ajax/topics-voting-system.php",
        data: dataFields,
        timeout: 3000,
        success: function(dataBack){
            $('#number' + id).html(dataBack); // div "number" with the new number
            $('#arrow_up' + id).html('<div class="arrow_up_voted"></div>'); //replace the clickable "arrow up" by the not clickable one
            $('#arrow_down' + id).html('<div class="arrow_down_voted"></div>'); //replace the clickable "arrow down" by the not clickable one
            $('#message' + id).html('<div id="alertFadeOut' + id + '" style="color: green">Thank you for voting</div>'); // Diplay message with a fadeout
            $('#alertFadeOut' + id).fadeOut(2000, function () {
                $('#alertFadeOut' + id).text('');
            });
        },
        error: function() {
            $('#number' + id).text('Problem!');
        }
    });
}