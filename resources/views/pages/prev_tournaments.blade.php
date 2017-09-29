@extends('layouts.default')
@section('content')
    <?php session()->put('url.intended', URL::previous()); ?>
    <div class="container">
        <div class="row" style="margin-top: 10px">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading"><h4>Previous Tournaments</h4></div>

                </div>
                @foreach ($tournaments as $tournament)
                    @if($tournament->completed)
                        <div class="panel panel-default">
                            <div class="panel-heading tournament-title" data-target="<?= $tournament->id?>">
                                {{ $tournament->name }}
                            </div>
                            <div class="panel-body tournament-details" id="details-<?=$tournament->id?>" style="display:none">
                                <div><?=$tournament->report?></div>
                                <div><?=$tournament->crosstable?></div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
<script>
    // Toggle display of Previous Tournaments.
    $(".tournament-title").click(function(){
        $("#details-" + this.getAttribute("data-target")).slideToggle();
    });
</script>
@stop