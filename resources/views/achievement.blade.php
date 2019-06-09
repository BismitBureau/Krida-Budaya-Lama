@extends('layout.master')

@section('extracss')
<link rel="stylesheet" type="text/css" href="{{ asset('new/css/achievements.css') }}">
@endsection

@section('extrajs')
@endsection

@section('content')

<section>
    <h2 style="text-align: center" class="pt-4">ACHIEVEMENTS</h2>

    <div id="assetline" class="">
       <div class="mjs-object-content"></div>
   </div>
   <div class="mx-auto pt-3">
		<?php
			$count = 0;
			$now = '-1';
			$last = '-1000';
			$flag = array();
			for($i = 0; $i < count($data['achievements']); $i++) {
				//echo $last.' , '.$data['achievements'][$i]['year'].'='.strcmp($data['achievements'][$i]['year'],$last).'<br>';
				if(strcmp($data['achievements'][$i]['year'],$last) != 0 || $count == 5) {
					$now++;
					$count = 0;
				}
				$flag[$i] = $now;
				$count++;
				$last = $data['achievements'][$i]['year'];
			}
		?>
		@for($num = 0; $num <= $now; $num++)
        <div class="item">
            <div class="image">
                <div class="circular--landscape">
                    <img style="object-fit: cover" src="{{ asset('new/img/tari.jpg') }}">
                </div>
            </div>
            <div class="details">
                <div>
                    <h1><?php
                        for($j = 0; $j < count($flag); $j++) if($flag[$j] == $num) {
                            echo $data['achievements'][$j]['year'];
                            break;
                        }
                    ?></h1>
                    <p><?php
						for($j = 0; $j < count($flag); $j++) if($flag[$j] == $num) {
							if(strcmp($lang,'en') == 0)
								echo '<li>'.$data['achievements'][$j]['stringen'].'</li>';
							else
								echo '<li>'.$data['achievements'][$j]['stringid'].'</li>';
						}
					?></p>
                </div>
            </div>
        </div>
        @endfor
    </div>
</section>

@endsection
