
var clickCount = 0;

$('#voteNow').click(function(){
    $('#content').load("vote.php");
});

$(".conVotePage").click(function (e) {
    e.preventDefault();
    if (clickCount == 0) {
        $(".3").removeClass("selected 3");
        $(".2").addClass("3").removeClass("2");
        $(".1").addClass("2").removeClass("1");
        $(this).addClass("selected 1");
        clickCount++;
    } else
    if (clickCount ==1) {
        $(".3").removeClass("selected 3");
        $(".2").addClass("3").removeClass("2");
        $(".1").addClass("2").removeClass("1");
        $(this).addClass("selected 1");
        clickCount++;
    } else
    if (clickCount == 2) {
        $(".3").removeClass("selected 3");
        $(".2").addClass("3").removeClass("2");
        $(".1").addClass("2").removeClass("1");
        $(this).addClass("selected 1");
        clickCount = 0;
    }
});

$('#submit').click(function() {

    var data = {};

    data[0] = $('#ticketNumber').val();

    $('.selected').each(function(i, e) {
        data[i+1] = this.id;
    });

    console.log($('#ticketNumber').val());
    console.log(data);

    $.ajax ({
        type:'POST',
        url:'process.php',
        data: data,
        encode:true
    })
        .done(function(jqXHR) {
            var display = $.parseJSON(jqXHR);
            if (!display.success) {
                alert(display.errors.ticketNum);
            } else {
                $('#content').load('results.shtml');
            }
        })
        .fail(function() {
            console.log ("failure:  " + xhr);
        })
});

$('#liveResults').click(function() {
    window.location.href='results.php';
});

$("#voteAgain").click(function() {
    window.location.href='index.html';
});

$('#refresh').click(function() {
    location.reload();
 });

$("#reVote").click(function() {
    window.location.href='index.html';
});
