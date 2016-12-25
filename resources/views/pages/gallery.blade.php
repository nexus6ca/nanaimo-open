@extends('layouts.default')
@section('content')
    <link rel="stylesheet" href="css/blueimp-gallery.min.css">
    <!-- The Gallery as lightbox dialog, should be a child element of the document body -->
    <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
        <div class="slides"></div>
        <h3 class="title"></h3>
        <a class="prev">‹</a>
        <a class="next">›</a>
        <a class="close">×</a>
        <a class="play-pause"></a>
        <ol class="indicator"></ol>
    </div>
    <div id="links">
        <?php $count = 1; ?>
        @foreach ($files as $file)
            @if ($file !== '.' || $file !== '..')
                <a href="images/gallery/{{$file}}" title="Picture-{{$count}}">
                    <img class="img-thumbnail" style="height:20%; width:20%;" src="images/gallery/{{$file}}" alt="Thumbnail Image Picture-{{$count}}">
                </a>
                <?php $count++ ?>
            @endif
        @endforeach
    </div>

    <script src="js/blueimp-gallery.min.js"></script>

    <script>
        document.getElementById('links').onclick = function (event) {
            event = event || window.event;
            var target = event.target || event.srcElement,
                    link = target.src ? target.parentNode : target,
                    options = {index: link, event: event},
                    links = this.getElementsByTagName('a');
            blueimp.Gallery(links, options);
        };
    </script>

{{--    <script>
        blueimp.Gallery(
                document.getElementById('links').getElementsByTagName('a'),
                {
                    container: '#blueimp-gallery-carousel',
                    carousel: true
                }
        );
    </script>--}}
@stop

