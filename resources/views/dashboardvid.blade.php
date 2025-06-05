<html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css"
        integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/video.js/8.22.0/video-js.min.css"
        integrity="sha512-7wMpNCbZmQmUPa3OOvqZo2TbK4n4xy4hdSWvxXKaJH8tR/9+7YFS0qyiKK3FV3tE6ANeSAdd3xfFQbf71P5Dfw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .video-js {
            width: 90%;
            height: 500px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="mt-5">
            <div class="row">
                <div class="col-md-8">
                    <div class="text-center">
                        <video id="my-video" class="video-js rounded" controls preload="auto" width="100%"
                            height="100%">
                            <source src="{{ asset($dt_video[0]->path) }}" type="video/mp4" />
                            Your browser does not support the video tag.
                        </video>
                    </div>
                    <h3 id="playtitle" style="margin-left: 45px;"></h3>
                </div>
                <div class="col-md-4">
                    <div class="list-group">
                        @foreach ($dt_video as $video)
                            <a href="javascript:void(0);" class="playlist-item list-group-item list-group-item-action"
                                data-video="{{ asset($video->path) }}"
                                data-title="{{ $video->title }}">{{ $video->title }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js"
        integrity="sha512-ykZ1QQr0Jy/4ZkvKuqWn4iF3lqPZyij9iRv6sGqLRdTPkY69YX6+7wvVGmsdBbiIfN/8OdsI7HABjvEok6ZopQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/video.js/8.22.0/video.min.js"
        integrity="sha512-0ywUhsu4ODVwVU1HQMDcn8CrHXxOiWgEj0uPabkuRQFUQpgtdguHnOZ4Uihz9Y9WUSJQphS2dp3jOlB0QwD0iA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        var player = videojs("my-video");
        var playTitle = document.getElementById("playtitle");
        player.on("play", function () {
            var currentSrc = player.currentSrc();
            var currentItem = document.querySelector(`.playlist-item[data-video="${currentSrc}"]`);
            if (currentItem) {
                playTitle.textContent = currentItem.getAttribute("data-title");
            }
        });
        document.querySelectorAll(".playlist-item").forEach((item) => {
            item.addEventListener("click", function () {
                var videoSrc = this.getAttribute("data-video");
                player.src({ type: "video/mp4", src: videoSrc });
                player.play();
            });
        });
    </script>
</body>

</html>