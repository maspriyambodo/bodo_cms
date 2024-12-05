@extends('layouts.admin_template')
@push('stylesheet')
<style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 50px;
        }
        #progress {
            width: 100%;
            background-color: #f3f3f3;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin: 20px 0;
            display: none;
        }
        #progress-bar {
            width: 0;
            height: 30px;
            background-color: #4caf50;
            border-radius: 5px;
        }
    </style>
@endpush
@section('content')
<div class="card">
    <div class="card-body">
        <h1>Internet Speed Test</h1>
    <button id="start-test">Start Speed Test</button>
    <div id="progress">
        <div id="progress-bar"></div>
    </div>
    <div id="result"></div>
    </div>
</div>
@endsection
@push('scripts')
<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
<script>
        $(document).ready(function() {
            $('#start-test').click(function() {
                $('#progress').show();
                $('#progress-bar').css('width', '0%');
                $('#result').text('');
                let progressInterval = setInterval(function() {
                    let currentWidth = parseInt($('#progress-bar').css('width')) / $('#progress').width() * 100;
                    if (currentWidth < 100) {
                        $('#progress-bar').css('width', (currentWidth + 10) + '%');
                    }
                }, 100);
                $.get('speed-test-json', function(data) {
                    clearInterval(progressInterval);
                    $('#progress-bar').css('width', '100%');
                    $('#result').html('Download Speed: ' + data.download_speed_mbps + ' Mbps<br>Time Taken: ' + data.time_taken_seconds + ' seconds<br>Data Size: ' + data.data_size_bytes + ' bytes');
                }).fail(function() {
                    clearInterval(progressInterval);
                    $('#result').text('Error occurred while testing speed.');
                });
            });
        });
    </script>
@endpush