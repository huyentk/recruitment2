<div id="messages" class="row">
    @if(Session::has('message_success'))
        <div class="animated fadeOut col-md-6 col-md-offset-3 alert alert-success alert-dismissible" role="alert"
             style="text-align: center;">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            {{Session::get('message_success')}}
        </div>
    @endif
    @if(Session::has('message_info'))
        <div class="animated fadeOut col-md-6 col-md-offset-3 alert alert-info alert-dismissible" role="alert"
             style="text-align: center;">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            {{Session::get('message_info')}}
        </div>
    @endif
    @if(Session::has('message_warning'))
        <div class="animated fadeOut col-md-6 col-md-offset-3 alert alert-warning alert-dismissible" role="alert"
             style="text-align: center;">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            {{Session::get('message_warning')}}
        </div>
    @endif
    @if(Session::has('message_danger'))
        <div class="animated fadeOut col-md-6 col-md-offset-3 alert alert-danger alert-dismissible" role="alert"
             style="text-align: center;">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            {{Session::get('message_danger')}}
        </div>
    @endif
</div>

<style>
    /*#messages{*/
        /*padding-top: 25px;*/
    /*}*/
    .animated {
        -webkit-animation-duration: 15s;
        animation-duration: 15s;
        -webkit-animation-fill-mode: both;
        animation-fill-mode: both;
    }

    @-webkit-keyframes fadeOutLeft {
        0% {
            opacity: 1;
            -webkit-transform: translateX(0);
        }
        100% {
            opacity: 0;
            -webkit-transform: translateX(-10px);
        }
    }

    @keyframes fadeOutLeft {
        0% {
            opacity: 1;
            transform: translateX(0);
        }
        100% {
            opacity: 0;
            transform: translateX(-10px);
        }
    }

    @-webkit-keyframes fadeOut {
        0% {
            opacity: 1;
        }
        100% {
            opacity: 0;
        }
    }

    @keyframes fadeOut {
        0% {
            opacity: 1;
        }
        100% {
            opacity: 0;
        }
    }

    .fadeOutLeft {
        -webkit-animation-name: fadeOutLeft;
        animation-name: fadeOutLeft;
    }

    .fadeOut {
        -webkit-animation-name: fadeOut;
        animation-name: fadeOut;
    }
</style>

<script>
    setTimeout(function () {
        $('#messages').hide();
    }, 2800);
</script>