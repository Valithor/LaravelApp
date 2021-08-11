@extends('layout')
@section('content')

    @php
        $id = $tournament->id;
        $type = $tournament->type;
        $players = $tournament->players;
        $tournament = json_decode($tournament->data);
        function getButtonClass($tournament, $x, $y, $reverse=0)
        {
            $thisbtn = $tournament[$x][$y];
            $class = "tournament-field btn ";
            if($thisbtn!=''){
                if($reverse) {
                    $nextbtn = $tournament[$x-1][floor($y/2)];
                } else {
                    if(count($tournament[$x])==1 && $x == count($tournament)-1) {
                        $class = $class . "btn-success winner";
                        return $class;
                    }
                    $nextbtn = $tournament[$x+1][floor($y/2)];
                }
                if($nextbtn==='') {
                    $class = $class . "btn-outline-success";
                } else {
                    if($nextbtn === $thisbtn) {
                        $class = $class . "btn-outline-success";
                    } else {
                        $class = $class . "btn-outline-danger";
                    }
                }
            } else {
                $class = $class . "btn-outline-info";
            }
            return $class;
        }
        function getButtonDisabled($tournament, $x, $y, $reverse=0)
        {
            $thisbtn = $tournament[$x][$y];
            if($thisbtn!=''){
                if($reverse) {
                    if($x == floor(count($tournament)/2)){
                        return("disabled");
                    }
                    $nextbtn = $tournament[$x-1][floor($y/2)];
                } else {
                    if(count($tournament[$x])==1) {
                        return "disabled";
                    }
                    $nextbtn = $tournament[$x+1][floor($y/2)];
                }
                if($nextbtn==='') {
                    $flag = 0;
                    for($i=0;$i<count($tournament[$x]);$i++) {
                        if($tournament[$x][$i] === '') {
                            return "disabled";
                        }
                    }
                    return "";
                }
            }
            return "disabled";
        }

    @endphp

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

                $count=$players;
                $firstlayer = count($tournament[0]);

                if($type == 1){
                    if($firstlayer>$count/2) {
                        $flag = 1;
                    }
                    else {
                        $flag = 0;
                    }
                    $colcount = count($tournament);
                } else {
                    if($firstlayer>ceil($count/2)/2) {
                        $flag = 1;
                    }
                    else {
                        $flag = 0;
                    }
                    $colcount = floor(count($tournament)/2);
                }
                $lastlayer = 0;
                $rowwidth=(count($tournament))*150;
            @endphp
            <div class="row" id="tournament" style="width: {{$rowwidth}}; margin: 0 auto;">
                @for($x=0; $x<$colcount; $x++)
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
                        @for($y=0; $y<count($tournament[$x]); $y++)
                            @if($y===0)
                                <div style="height: {{$startheight}}"></div>
                            @else
                                <div style="height: {{$height}}"></div>
                            @endif
                            <button class="
                            {{getButtonClass($tournament,$x,$y)}}" id="{{$x}}by{{$y}}"
                                    onclick="tournamentClick(this.id)" {{getButtonDisabled($tournament,$x,$y)}}>
                                {{$tournament[$x][$y]}}
                            </button>
                        @endfor

                        @php
                            $lastlayer = $y;
                        @endphp
                        <div style="height: {{$startheight}}"></div>
                    </div>
                    @if($x<$colcount-1)
                        <svg height="{{$startheight*2+($height+$buttonheighthalf*2)*($lastlayer-1)+$buttonheighthalf*2}}"
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


                @if($type==2)
                        <svg height="{{$startheight*2+($height+$buttonheighthalf*2)*($lastlayer-1)+$buttonheighthalf*2}}"
                            width="10">
                            <line x1="0" y1="{{$startheight+$buttonheighthalf}}"
                                  x2="10" y2="{{$startheight+$buttonheighthalf}}"
                                  style="stroke:black;stroke-width:1"/>
                        </svg>
                        <div class="col" id="col{{$colcount}}" style="padding: 0px">
                        <div style="height: {{$startheight}}"></div>
                        <button class="
                            @if($tournament[$colcount][0])
                                tournament-field btn btn-success winner
                            @else
                                tournament-field btn btn-outline-info
                            @endif
                        " id="{{$x}}by0"
                                onclick="tournamentClick(this.id)" disabled>
                            {{$tournament[$colcount][0]}}
                        </button>
                        <div style="height: {{$startheight}}"></div>
                        </div>
                            <svg height="{{$startheight*2+($height+$buttonheighthalf*2)*($lastlayer-1)+$buttonheighthalf*2}}"
                                width="10">
                                <line x1="0" y1="{{$startheight+$buttonheighthalf}}"
                                      x2="10" y2="{{$startheight+$buttonheighthalf}}"
                                      style="stroke:black;stroke-width:1"/>
                            </svg>

                        @for($x=$colcount+1; $x<count($tournament); $x++)
                            @php
                                $startheight = (($buttonheighthalf)*(pow(2,2*$colcount-$x+$flag)-2))/2+$buttonheighthalf-($flag*$buttonheighthalf);
                                $height = ($buttonheighthalf)*(pow(2,2*$colcount-$x+$flag)-2);
                            @endphp
                            @if($x>$colcount+1)
                                <svg
                                    height="{{$startheight*2+($height+$buttonheighthalf*2)*(count($tournament[$x])-1)+$buttonheighthalf*2}}"
                                    width="10">
                                    @for($y=0; $y<count($tournament[$x]);$y++)
                                        <line x1="5" y1="{{$startheight+$buttonheighthalf+(($height+$buttonheighthalf*2)*$y)}}"
                                              x2="10" y2="{{$startheight+$buttonheighthalf+(($height+$buttonheighthalf*2)*$y)}}"
                                              style="stroke:black;stroke-width:1"/>
                                    @endfor
                                    @for($y=0; $y<(count($tournament[$x])/2);$y++)
                                        <line x1="5"
                                              y1="{{$startheight+$buttonheighthalf+(($height+$buttonheighthalf*2)*$y*2)}}"
                                              x2="5"
                                              y2="{{$startheight+$buttonheighthalf+(($height+$buttonheighthalf*2)*($y*2+1))}}"
                                              style="stroke:black;stroke-width:1"/>
                                    @endfor
                                </svg>
                            @endif
                            <div class="col" id="col{{$x}}" style="padding: 0px">
                                @for($y=0; $y<count($tournament[$x]); $y++)
                                    @if($y===0)
                                        <div style="height: {{$startheight}}"></div>
                                    @else
                                        <div style="height: {{$height}}"></div>
                                    @endif
                                        <button class="
                            {{getButtonClass($tournament,$x,$y,1)}}" id="{{$x}}by{{$y}}"
                                                onclick="tournamentClick(this.id)" {{getButtonDisabled($tournament,$x,$y,1)}}>
                                            {{$tournament[$x][$y]}}
                                        </button>
                                @endfor

                                @php
                                    $lastlayer = $y;
                                @endphp
                                <div style="height: {{$startheight}}"></div>

                            </div>
                        @endfor
                @endif
            </div>
                    <button class="btn btn-success" onclick="store()">Zapisz</button>
                    <button class="btn btn-success" onclick="copyLink()">Kopiuj link</button>
        </div>
    </div>

    <script type="text/javascript">
        function tournamentClick(clicked_id) {
            const words = clicked_id.split('by');
            const clicked_x = parseInt(words[0]);
            const clicked_y = parseInt(words[1]);
            const type = {{$type}};
            let flag = 1;

            let next_x = clicked_x+1;

            if (type==2){
                if(clicked_x > {{$colcount}}){
                    next_x = clicked_x-1;
                }
                if(next_x == {{$colcount}}){
                    let winner_id = (next_x).toString().concat('by0');
                    document.getElementById(winner_id).classList.add('btn-success');
                    document.getElementById(winner_id).classList.add('winner');
                    document.getElementById(winner_id).innerHTML = document.getElementById(clicked_id).innerHTML;
                    let opposite_x = 2*{{$colcount}} - clicked_x;
                    let opposite_id = (opposite_x).toString().concat('by0');
                    console.log(opposite_id);
                    document.getElementById(clicked_id).disabled = true;
                    document.getElementById(opposite_id).disabled = true;
                    document.getElementById(opposite_id).classList.remove('btn-outline-success');
                    document.getElementById(opposite_id).classList.add('btn-outline-danger');
                    return
                }
                let nextcoltest = document.getElementById('col'.concat((next_x).toString()));
                let nextlayertest = nextcoltest.getElementsByTagName('button');
                if(nextlayertest.length == 1){
                    let opposite_x = 2*{{$colcount}} - next_x;
                    let opposite_id = (opposite_x).toString().concat('by0');
                    if(document.getElementById(opposite_id).classList.contains('btn-outline-success')){
                        flag = 1;
                        document.getElementById(opposite_id).disabled = false;
                    } else {
                        flag = 0;
                    }
                }
            }

            let parallel_id = clicked_x.toString().concat('by', (clicked_y - 1).toString());
            if (clicked_y % 2 < 1) {
                parallel_id = clicked_x.toString().concat('by', (clicked_y + 1).toString());
            }

            document.getElementById(clicked_id).disabled = true;
            document.getElementById(parallel_id).disabled = true;
            document.getElementById(parallel_id).classList.remove('btn-outline-success');
            document.getElementById(parallel_id).classList.add('btn-outline-danger');

            let next_id = (next_x).toString().concat('by', (Math.floor(clicked_y / 2).toString()));
            document.getElementById(next_id).classList.remove('btn-outline-info');
            document.getElementById(next_id).innerHTML = document.getElementById(clicked_id).innerHTML;

            if (clicked_x =={{$colcount-3+$type}} || clicked_x =={{$colcount+1}}) {
                document.getElementById(next_id).classList.add('btn-success');
                document.getElementById(next_id).classList.add('winner');
                return
            } else {
                document.getElementById(next_id).classList.add('btn-outline-success');
            }

            const thiscol = document.getElementById('col'.concat(clicked_x.toString()));
            var thislayer = thiscol.getElementsByTagName('button');
            for (let i = 0; i < thislayer.length; i++) {
                if (document.getElementById(thislayer[i].id).disabled === false) {
                    flag = 0;
                }
            }

            if (flag === 1) {
                let nextcol = document.getElementById('col'.concat((next_x).toString()));
                var nextlayer = nextcol.getElementsByTagName('button');
                for (let i = 0; i < nextlayer.length; i++) {
                    document.getElementById(nextlayer[i].id).disabled = false;
                }
            }
        }

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
                url: '{{route('tournament.edit',$id)}}',
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

        function copyLink() {
            var dummy = document.createElement('input'),
                text = window.location.href;
            document.body.appendChild(dummy);
            dummy.value = text;
            dummy.select();
            document.execCommand('copy');
            document.body.removeChild(dummy);
        }
    </script>

@endsection

