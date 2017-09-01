
/**
*主题：velonic管理模板
*作者：coderthemes
*全日历页
*/

!function($) {
    "use strict";

    var CalendarPage = function() {};

    CalendarPage.prototype.init = function() {

        //检查如果插件是可用的
        if ($.isFunction($.fn.fullCalendar)) {
            /* 初始化外部事件 */
            $('#external-events .fc-event').each(function() {
                // 创建一个事件对象 (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                // 它不需要有一个开始或结束
                var eventObject = {
                    title: $.trim($(this).text()) // 使用元素的文本作为事件标题
                };

                // 商店在DOM元素的事件对象之后可以得到它
                $(this).data('eventObject', eventObject);

                // 使事件可拖动使用jQuery UI
                $(this).draggable({
                    zIndex: 999,
                    revert: true, // 会导致事件回到它的
                    revertDuration: 0 // 拖后初始位置
                });

            });
            
            /* 初始化日历*/

            var date = new Date();
            var d = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();

            $('#calendar').fullCalendar({
                 dayClick: function() {
                    var str = $(this).val();
                    console.log(str);
                     //  console.log(  $('#calendar').fullCalendar( 'removeEvents','11'));
                     //   console.log($('#calendar').fullCalendar( 'refetchEvents' ));
                       // console.log($('#calendar').fullCalendar.events);
             alert('a day has been clicked!');
             },
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,basicWeek,basicDay'
                },
                editable: true,
                eventLimit: true, //允许“更多”链接时，太多的事件
                droppable: true, // 这让事情被落在日历上 !!!
                drop: function(date, allDay) { // 这个函数被调用时被删除

                    // 检索被丢弃的元素的存储事件对象
                    var originalEventObject = $(this).data('eventObject');
                    console.log(originalEventObject);
                    //我们需要复制它，以便多个事件没有对同一对象的引用
                    var copiedEventObject = $.extend({}, originalEventObject);

                    // 分配它的日期，据报道
                    copiedEventObject.start = date;
                    copiedEventObject.allDay = allDay;
                    console.log(copiedEventObject);
                    // 使事件在日历上呈现
                    // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                    $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

                    //是“删除掉”的复选框选中后？
                    if ($('#drop-remove').is(':checked')) {
                        // 如果是这样的话，删除元素从“拖动事件”名单
                        $(this).remove();
                    }


                },

                events: [{
                    id:'11',
                    title: 'All Day Event',
                    start: new Date(y, m, 1),
                    color:'#ff0000'
                    },  
                    {
                    id:'11',
                    title: 'All Day Event',
                    start: new Date(y, m, 2),
                    color:'#0000ff'
                    },                  
                  ],

            });
             /*添加新的事件*/
            // 添加新事件的窗体

            $("#add_event_form").on('submit', function(ev) {
                ev.preventDefault();

                var $event = $(this).find('.new-event-form'),
                    event_name = $event.val();

                if (event_name.length >= 3) {

                    var newid = "new" + "" + Math.random().toString(36).substring(7);
                    // 创建事件条目
                    $("#external-events").append(
                        '<div id="' + newid + '" class="fc-event">' + event_name + '</div>'
                    );


                    var eventObject = {
                        title: $.trim($("#" + newid).text()) // 使用元素的文本作为事件标题
                    };

                    // 商店在DOM元素的事件对象之后可以得到它
                    $("#" + newid).data('eventObject', eventObject);

                    //复位可拖动
                    $("#" + newid).draggable({
                        revert: true,
                        revertDuration: 0,
                        zIndex: 999
                    });

                    // 复位输入
                    $event.val('').focus();
                } else {
                    $event.focus();
                }
            });

        }
        else {
            alert("未安装日历插件");
        }
    },
    //init
    $.CalendarPage = new CalendarPage, $.CalendarPage.Constructor = CalendarPage
}(window.jQuery),

//初始化
function($) {
    "use strict";
    $.CalendarPage.init()
    console.log( $.CalendarPage);
}(window.jQuery);

$('#calendar').fullCalendar({
    events: [
        // events here
    ],
    editable: true,
    eventResize: function(event, delta, revertFunc) {

        alert(event.title + " end is now " + event.end.format());

        if (!confirm("is this okay?")) {
            revertFunc();
        }

    }
});