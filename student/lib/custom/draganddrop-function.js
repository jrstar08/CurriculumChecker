$("#launchPad").height($(window).height() - 20);
var dropSpace = $(window).width() - $("#launchPad").width();
$("#dropZone").width(dropSpace - 70);
$("#dropZone").height($("#launchPad").height());

$(".card").draggable({
    appendTo: "body",
    cursor: "move",
    helper: 'clone',
    revert: "invalid"
});

$("#launchPad").droppable({
    tolerance: "intersect",
    accept: ".card",
    activeClass: "ui-state-default",
    hoverClass: "ui-state-hover",
    drop: function(event, ui) {
        $("#launchPad").append($(ui.draggable));
    }
});

$(".stackDrop1").droppable({
    tolerance: "intersect",
    accept: ".card",
    activeClass: "ui-state-default",
    hoverClass: "ui-state-hover",
    drop: function(event, ui) {        
        $(this).append($(ui.draggable));

        length1 = $(".stackDrop1 .card").length;
        subject = $(ui.draggable).attr('id');
        exist = 1;
        for(i=0; i<length1; i++)
        {
            if(subject == a[i])
                exist = 0;
        }
        if(exist == 1)
            a.push(subject);
    }
});

$(".stackDrop2").droppable({
    tolerance: "intersect",
    accept: ".card",
    activeClass: "ui-state-default",
    hoverClass: "ui-state-hover",
    drop: function(event, ui) {        
        $(this).append($(ui.draggable));

        length2 = $(".stackDrop2 .card").length;
        subject = $(ui.draggable).attr('id');
        exist = 1;
        for(i=0; i<length2; i++)
        {
            if(subject == b[i])
                exist = 0;
        }
        if(exist == 1)
            b.push(subject);
    }
});