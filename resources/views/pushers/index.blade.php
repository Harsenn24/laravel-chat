<!DOCTYPE html>
<html lang="en">

<head>
    <title>Chat Laravel Pusher | Edlin App</title>
    @vite('resources/css/app.css')
    <link rel="icon" href="https://assets.edlin.app/favicon/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>

<body>
    <?php
    $dataNavbar = [
        'attribute1' => $sender,
        'iduse' => $idUser,
    ];
    ?>

    <x-navbar-comp :data="$dataNavbar" />

    <div class="container mx-auto shadow-lg rounded-lg mt-20 w-1/2 bg-yellow-200">
        <div class="w-full px-5 flex flex-col justify-between">
            <div class="flex flex-col mt-5">

                <div class="messages">
                    @include('pushers.broadcast', ['message' => "Hey! What's up!  👋"])
                    @include('pushers.receive', ['message' => "Ask a friend to open this link and you can chat with them!"])
                </div>

                <form id="sendchat">
                    <input class="w-full bg-gray-300 mt-5 py-5 px-3 rounded-xl" type="text" type="text" id="message" name="message" placeholder="Enter message..." autocomplete="off">
                    <button type="submit"></button>
                </form>
            </div>
        </div>
    </div>
</body>

<script>
    const pusher = new Pusher('4433479d7d357012871e', {
        cluster: 'ap1'
    });

    const uidchat = `{{$uidchat}}`

    const channel = pusher.subscribe(uidchat);

    const idReceiver = '{{$idReceiver}}'

    //Receive messages
    channel.bind('chat', function(data) {
        $.post(`/receive/${idReceiver}`, {
                _token: '{{csrf_token()}}',
                message: data.message,
            })
            .done(function(res) {
                $(".messages > .message").last().after(res);
                $(document).scrollTop($(document).height());
            });
    });


    //Broadcast messages
    $("#sendchat").submit(function(event) {
        event.preventDefault();

        $.ajax({
            url: `/broadcast/${idReceiver}`,
            method: 'post',
            headers: {
                'X-Socket-Id': pusher.connection.socket_id
            },
            data: {
                _token: '{{csrf_token()}}',
                message: $("form #message").val(),
                user_chat: uidchat
            }
        }).done(function(res) {
            $(".messages > .message").last().after(res);
            $("form #message").val('');
            $(document).scrollTop($(document).height());
        });
    });
</script>

</html>