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
    over: function( event, ui ) {
        subject = $(ui.draggable).attr('id');
        if(subject == 'subject_1526')
            alert('hehe');
        else
        {
            
            
        }
    },
    drop: function(event, ui) { 
        if(subject != 'subject_1526')       
        $(this).append($(ui.draggable));

        var m_id = [];
        var abc = '';
        $.each($(ui.draggable), function(i,e) {
           m_id.push(e.id);
           abc += m_id + ' ';
        });

        alert(abc);
        

        length1 = $(".stackDrop1 .card").length;
        subject =  $(ui.draggable).attr('id');
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

// $( ".stackDrop1" ).droppable({
//     over: function( event, ui ) {
//         subject = $(ui.draggable).attr('id');
//         if(subject == 'subject_1526')
//             alert('hehe');
//     }
//   });
  

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

$(".stackDrop3").droppable({
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

$(".stackDrop4").droppable({
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

$(".stackDrop5").droppable({
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

$(".stackDrop6").droppable({
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

$(".stackDrop7").droppable({
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

$(".stackDrop8").droppable({
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

$(".stackDrop9").droppable({
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

$(".stackDrop10").droppable({
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

$(".stackDrop11").droppable({
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
