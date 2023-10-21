import './bootstrap';
const Pusher = require('pusher-js');

// const Pusher = require('')
const pusher = new Pusher('4433479d7d357012871e', {
    cluster: 'ap1'
});
const channel = pusher.subscribe('public');

//Receive messages
channel.bind('chat', function (data) {

    $.post("/receive", {
        _token: '{{csrf_token()}}',
        message: data.message,
    })
        .done(function (res) {
            $(".messages > .message").last().after(res);
            $(document).scrollTop($(document).height());
        });
});

$("form").submit(function (event) {
    event.preventDefault();
    console.log($("form #message").val())

    $.ajax({
        url: "/broadcast",
        method: 'POST',
        headers: {
            'X-Socket-Id': pusher.connection.socket_id
        },
        data: {
            _token: '{{csrf_token()}}',
            message: $("form #message").val(),
        }
    }).done(function (res) {
        $(".messages > .message").last().after(res);
        $("form #message").val('');
        $(document).scrollTop($(document).height());
    });
});
