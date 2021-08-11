@extends('layout')
@section('content')

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <h2 style="margin: 0 auto">Turniej</h2>
            </div>
        </div>
        <div class="card-body">
            @php
                $buttonheighthalf=30;

                $count=count($players);
                $P = pow(2,floor(log($count,2))+1);
                $firstlayer = (2*$count)-$P;
                if($firstlayer>$count/2) {
                    $flag = 1;
                }
                else {
                    $flag = 0;
                }
                $colcount = ceil(log($count,2))+($firstlayer<1);
                $lastlayer = 0;
                $thisLayer = 0;
                $done = 0;
                $rowwidth=($colcount+($firstlayer>0))*150;
            @endphp
            <div class="row" id="tournament" style="width: {{$rowwidth}}; margin: 0 auto;">
                @for($x=0+($firstlayer<1); $x<=$colcount; $x++)
                    <div class="col" id="col{{$x}}" style="padding: 0px">
                        @php
                            if($x<1) {
                                $startheight = 0;
                                $height = 0;
                            } else {
                                $startheight = (($buttonheighthalf)*(pow(2,$x+$flag)-2))/2+$buttonheighthalf-($flag*$buttonheighthalf);
                                $height = ($buttonheighthalf)*(pow(2,$x+$flag)-2);
                            }
                        @endphp
                        @for($y=0; $y<floor($lastlayer/2); $y++)
                            @if($y===0)
                                <div style="height: {{$startheight}}"></div>
                            @else
                                <div style="height: {{$height}}"></div>
                            @endif
                            <button class="tournament-field btn btn-outline-info" id="{{$x}}by{{$y}}"
                                    onclick="tournamentClick(this.id)" disabled></button>
                        @endfor

                        @php
                            $lastlayer = $y;
                            $y=0;
                        @endphp

                        @if($x===0)
                            @for($y=0; $y<$firstlayer;$y++)
                                <button class="tournament-field btn btn-outline-success" id="{{$x}}by{{$y}}"
                                        onclick="tournamentClick(this.id)">{{$players[$y]}}</button>
                            @endfor
                            @php
                                $lastlayer=$lastlayer+$y;
                                $done=$y;
                            @endphp
                        @else
                            @if($count-$done>0)
                                @if($firstlayer<1)
                                    <div style="height: {{$startheight}}"></div>
                                @endif
                                @for($y=0; $y<$count-$done;$y++)
                                    <div style="height: {{$height}}"></div>
                                    <button class="tournament-field btn btn-outline-success"
                                            id="{{$x}}by{{$y+$lastlayer}}" onclick="tournamentClick(this.id)"
                                            @if($firstlayer>0)
                                            disabled
                                        @endif
                                    >
                                        {{$players[$y+$done]}}
                                    </button>
                                @endfor
                                @php
                                    $lastlayer=$lastlayer+$y;
                                    $done=$done+$y;
                                @endphp
                            @endif
                        @endif
                        <div style="height: {{$startheight}}"></div>
                        {{--                        <p>{{$startheight}} {{$height}} {{$lastlayer}}</p>--}}
                    </div>
                    @if($x<$colcount)
                        <svg
                            height="{{$startheight*2+($height+$buttonheighthalf*2)*($lastlayer-1)+$buttonheighthalf*2}}"
                            width="10">
                            @for($y=0; $y<$lastlayer;$y++)
                                <line x1="0" y1="{{$startheight+$buttonheighthalf+(($height+$buttonheighthalf*2)*$y)}}"
                                      x2="5" y2="{{$startheight+$buttonheighthalf+(($height+$buttonheighthalf*2)*$y)}}"
                                      style="stroke:black;stroke-width:1"/>
                            @endfor
                            @for($y=0; $y<($lastlayer/2);$y++)
                                <line x1="5"
                                      y1="{{$startheight+$buttonheighthalf+(($height+$buttonheighthalf*2)*$y*2)}}"
                                      x2="5"
                                      y2="{{$startheight+$buttonheighthalf+(($height+$buttonheighthalf*2)*($y*2+1))}}"
                                      style="stroke:black;stroke-width:1"/>
                            @endfor
                        </svg>
                    @endif
                @endfor
            </div>
            <button class="btn btn-success" onclick="store()">zapisz</button>
        </div>
    </div>

    <script type="text/javascript">
        function tournamentClick(clicked_id) {
            const words = clicked_id.split('by');
            const clicked_x = parseInt(words[0]);
            const clicked_y = parseInt(words[1]);

            let parallel_id = clicked_x.toString().concat('by', (clicked_y - 1).toString());
            if (clicked_y % 2 < 1) {
                parallel_id = clicked_x.toString().concat('by', (clicked_y + 1).toString());
            }

            document.getElementById(clicked_id).disabled = true;
            document.getElementById(parallel_id).disabled = true;
            document.getElementById(parallel_id).classList.remove('btn-outline-success');
            document.getElementById(parallel_id).classList.add('btn-outline-danger');

            const next_id = (clicked_x + 1).toString().concat('by', (Math.floor(clicked_y / 2).toString()));
            document.getElementById(next_id).classList.remove('btn-outline-info');
            document.getElementById(next_id).innerHTML = document.getElementById(clicked_id).innerHTML;

            if (clicked_x >{{$colcount-2}}) {
                document.getElementById(next_id).classList.add('btn-success');
                document.getElementById(next_id).classList.add('winner');
                return
            } else {
                document.getElementById(next_id).classList.add('btn-outline-success');
            }

            const thiscol = document.getElementById('col'.concat(clicked_x.toString()));
            var thislayer = thiscol.getElementsByTagName('button');
            let flag = 1;
            for (let i = 0; i < thislayer.length; i++) {
                if (document.getElementById(thislayer[i].id).disabled === false) {
                    flag = 0;
                }
            }

            if (flag === 1) {
                const nextcol = document.getElementById('col'.concat((clicked_x + 1).toString()));
                var nextlayer = nextcol.getElementsByTagName('button');
                for (let i = 0; i < nextlayer.length; i++) {
                    document.getElementById(nextlayer[i].id).disabled = false;
                }
            }
        }

    </script>
    <script type="text/javascript">
        function store() {
            const row = document.getElementById('tournament');
            let columns = row.getElementsByClassName('col');
            let tournament = [];
            for (let i = 0; i < columns.length; i++) {
                let fields = [];
                let buttons = columns[i].getElementsByTagName('button');
                for (let j = 0; j < buttons.length; j++) {
                    fields.push(buttons[j].innerText);
                }
                tournament.push(fields);
            }
            console.log(tournament);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('value')
                }
            });

            $.ajax({
                url: '{{route('tournament.store')}}',
                type: "POST",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {
                    tournament: JSON.stringify(tournament),
                    players: {{$count}}
                },
                success: function (data) {
                    console.log(data);
                },
                error: function (data, textStatus, errorThrown) {
                    console.log(data);

                },
            })
        }
    </script>
@endsection
