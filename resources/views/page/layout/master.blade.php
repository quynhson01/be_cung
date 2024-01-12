<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <base href="{{asset('frontend')}}\">
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>BE CUNG</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets\img\wm.png">

    <!-- all css here -->
    <link rel="stylesheet" href="assets\css\bootstrap.min.css">
    <link rel="stylesheet" href="assets\css\plugin.css">
    <link rel="stylesheet" href="assets\css\bundle.css">
    <link rel="stylesheet" href="assets\css\style.css">
    <link rel="stylesheet" href="assets\css\responsive.css">
    <script src="assets\js\vendor\modernizr-2.8.3.min.js"></script>
</head>

<body style="font-family: Arial, Helvetica, sans-serif;">
    <!-- Add your site or application content here -->

    <!--pos page start-->
    <div class="pos_page">
        <div class="container">
            <!--pos page inner-->
            <div class="pos_page_inner">
                <!--header area -->
                @include('page.layout.header')
                <!--header end -->

                <!--pos home section-->
                @yield('content')
                <!--pos home section end-->

                <!--footer area start-->
                @include('page.layout.footer')
                <!--footer area end-->
            </div>
            <!--pos page inner end-->
        </div>
    </div>
    <!--pos page end-->

    <!-- all js here -->
    <script src="assets\js\vendor\jquery-1.12.0.min.js"></script>
    <script src="assets\js\popper.js"></script>
    <script src="assets\js\bootstrap.min.js"></script>
    <script src="assets\js\ajax-mail.js"></script>
    <script src="assets\js\plugins.js"></script>
    <script src="assets\js\main.js"></script>
    @yield('script')
    <style>
        .fb-livechat,
        .fb-widget {
            display: none
        }

        .ctrlq.fb-button,
        .ctrlq.fb-close {
            position: fixed;
            right: 10px;
            cursor: pointer;
            padding: 0 8px;
            background: #ff3200;
        }

        .ctrlq.fb-button {
            z-index: 999;
            background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/PjwhRE9DVFlQRSBzdmcgIFBVQkxJQyAnLS8vVzNDLy9EVEQgU1ZHIDEuMS8vRU4nICAnaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkJz48c3ZnIGVuYWJsZS1iYWNrZ3JvdW5kPSJuZXcgMCAwIDEyOCAxMjgiIGhlaWdodD0iMTI4cHgiIGlkPSJMYXllcl8xIiB2ZXJzaW9uPSIxLjEiIHZpZXdCb3g9IjAgMCAxMjggMTI4IiB3aWR0aD0iMTI4cHgiIHhtbDpzcGFjZT0icHJlc2VydmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiPjxnPjxyZWN0IGZpbGw9IiMwMDg0RkYiIGhlaWdodD0iMTI4IiB3aWR0aD0iMTI4Ii8+PC9nPjxwYXRoIGQ9Ik02NCwxNy41MzFjLTI1LjQwNSwwLTQ2LDE5LjI1OS00Niw0My4wMTVjMCwxMy41MTUsNi42NjUsMjUuNTc0LDE3LjA4OSwzMy40NnYxNi40NjIgIGwxNS42OTgtOC43MDdjNC4xODYsMS4xNzEsOC42MjEsMS44LDEzLjIxMywxLjhjMjUuNDA1LDAsNDYtMTkuMjU4LDQ2LTQzLjAxNUMxMTAsMzYuNzksODkuNDA1LDE3LjUzMSw2NCwxNy41MzF6IE02OC44NDUsNzUuMjE0ICBMNTYuOTQ3LDYyLjg1NUwzNC4wMzUsNzUuNTI0bDI1LjEyLTI2LjY1N2wxMS44OTgsMTIuMzU5bDIyLjkxLTEyLjY3TDY4Ljg0NSw3NS4yMTR6IiBmaWxsPSIjRkZGRkZGIiBpZD0iQnViYmxlX1NoYXBlIi8+PC9zdmc+) center no-repeat #0084ff;
            width: 50px;
            height: 50px;
            text-align: center;
            bottom: 30px;
            border: 0;
            outline: 0;
            border-radius: 60px;
            -webkit-border-radius: 60px;
            -moz-border-radius: 60px;
            -ms-border-radius: 60px;
            -o-border-radius: 60px;
            box-shadow: 0 1px 6px rgba(0, 0, 0, .06), 0 2px 32px rgba(0, 0, 0, .16);
            -webkit-transition: box-shadow .2s ease;
            background-size: 80%;
            transition: all .2s ease-in-out
        }

        .ctrlq.fb-button:focus,
        .ctrlq.fb-button:hover {
            transform: scale(1.1);
            box-shadow: 0 2px 8px rgba(0, 0, 0, .09), 0 4px 40px rgba(0, 0, 0, .24)
        }

        .fb-widget {
            background: #fff;
            z-index: 1000;
            position: fixed;
            width: 360px;
            height: 435px;
            overflow: hidden;
            opacity: 0;
            bottom: 0;
            right: 24px;
            border-radius: 6px;
            -o-border-radius: 6px;
            -webkit-border-radius: 6px;
            box-shadow: 0 5px 40px rgba(0, 0, 0, .16);
            -webkit-box-shadow: 0 5px 40px rgba(0, 0, 0, .16);
            -moz-box-shadow: 0 5px 40px rgba(0, 0, 0, .16);
            -o-box-shadow: 0 5px 40px rgba(0, 0, 0, .16)
        }

        .fb-credit {
            text-align: center;
            margin-top: 8px
        }

        .fb-credit a {
            transition: none;
            color: #eee;
            font-family: Helvetica, Arial, sans-serif;
            font-size: 12px;
            text-decoration: none;
            border: 0;
            font-weight: 400
        }

        .ctrlq.fb-overlay {
            z-index: 0;
            position: fixed;
            height: 100vh;
            width: 100vw;
            -webkit-transition: opacity .4s, visibility .4s;
            transition: opacity .4s, visibility .4s;
            top: 0;
            left: 0;
            background: rgba(0, 0, 0, .05);
            display: none
        }

        .ctrlq.fb-close {
            z-index: 4;
            padding: 0 8px;
            background: #4267b2;
            font-weight: 700;
            font-size: 11px;
            color: #fff;
            margin: 5px 20px 0px 0;
            border-radius: 3px
        }

        .ctrlq.fb-close::after {
            content: "X";
            font-family: sans-serif
        }

        .bubble {
            width: 20px;
            height: 20px;
            background: #c00;
            color: #fff;
            position: absolute;
            z-index: 999999999;
            text-align: center;
            vertical-align: middle;
            top: -2px;
            left: -5px;
            border-radius: 50%;
        }

        .bubble-msg {
            width: 120px;
            left: -140px;
            top: 5px;
            position: relative;
            background: rgba(59, 89, 152, .8);
            color: #fff;
            padding: 5px 8px;
            border-radius: 5px;
            text-align: center;
            font-size: 13px;
        }
    </style>
    <div class="fb-livechat">
        <div class="ctrlq fb-overlay"></div>
        <div class="fb-widget">
            <div class="ctrlq fb-close"></div>
            <div class="fb-page" data-href="https://www.facebook.com/profile.php?id=100092979841876" data-tabs="messages" data-width="360" data-height="400" data-small-header="true" data-hide-cover="true" data-show-facepile="false"> </div>
            <div class="fb-credit"> <a href="https://hoaky68.com" target="_blank" rel="noopener noreferrer"></a> </div>
            <div id="fb-root"></div>
        </div><a href="https://m.me/&#039; + link_mobile + &#039;" title="Gửi tin nhắn cho chúng tôi qua Facebook" class="ctrlq fb-button" rel="nofollow" target="_blank">
            <!-- <div class="bubble">1</div> -->
            <div class="bubble-msg">Bạn cần hỗ trợ?</div>
        </a>
    </div>
    <script src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&#038;version=v2.9"></script>
    <script>
        jQuery(document).ready(function($) {
            function detectmob() {
                if (navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPod/i) || navigator.userAgent.match(/BlackBerry/i) || navigator.userAgent.match(/Windows Phone/i)) {
                    return true;
                } else {
                    return false;
                }
            }
            var t = {
                delay: 125,
                overlay: $(".fb-overlay"),
                widget: $(".fb-widget"),
                button: $(".fb-button")
            };
            setTimeout(function() {
                $("div.fb-livechat").fadeIn()
            }, 8 * t.delay);
            if (!detectmob()) {
                $(".ctrlq").on("click", function(e) {
                    e.preventDefault(), t.overlay.is(":visible") ? (t.overlay.fadeOut(t.delay), t.widget.stop().animate({
                        bottom: 0,
                        opacity: 0
                    }, 2 * t.delay, function() {
                        $(this).hide("slow"), t.button.show()
                    })) : t.button.fadeOut("medium", function() {
                        t.widget.stop().show().animate({
                            bottom: "30px",
                            opacity: 1
                        }, 2 * t.delay), t.overlay.fadeIn(t.delay)
                    })
                })
            }
        });
    </script>
</body>

</html>
