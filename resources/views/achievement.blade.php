@extends('layout.master')

@section('styling')
  <script src="{{ url('javascript/achievement.js') }}"></script>
  <link rel="stylesheet" href="{{ url('style/achievement.css') }}">
  <link rel="stylesheet" href="{{ url('style/index.css') }}">
@endsection

@section('content')

<div class="topBorder"></div>

<div id="achievementWrapper">
	<div id="content">
	 <div class="achievementHeader">
	  <!--
	  <table>
		<tr>
		  <td style="width : 10%;">

		  </td>
		  <td style="width : 20%;">
			<hr>
		  </td>
		  <td style="width : 5%;">

		  </td>
		  <td style="width : 30%;">
		-->	
			<div id="tulisan">
				OUR ACHIEVEMENTS
			</div>
		<!--  
		  </td>
		  <td style="width : 5%;">

		  </td>
		  <td style="width : 20%;">
			<hr>
		  </td>
		  <td style="width : 10%;">

		  </td>
		</tr>	
	  </table>
	  -->
	 </div>

	  <div class="achievementBox">
		<div class="vr">
		</div>
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
		<div class="achievementContent" @if($num == $now) id='lastContent' @endif>
			<table class="wrapper" style="width:100%">
				<tr>
					<td class="achievementInfo1">	
						@if($num%2==0)
							<ul>
								<?php
									for($j = 0; $j < count($flag); $j++) if($flag[$j] == $num) {
										if(strcmp($lang,'en') == 0)
											echo '<li>'.$data['achievements'][$j]['stringen'].'</li>';
										else
											echo '<li>'.$data['achievements'][$j]['stringid'].'</li>';
									}
								?>
							</ul>
						@endif
					</td>
					<td class="circlebox">
						<button class="yearCircle">
							<?php
								for($j = 0; $j < count($flag); $j++) if($flag[$j] == $num) {
									echo $data['achievements'][$j]['year'];
									break;
								}
							?>
						</button>
					</td>
					<td class="achievementInfo2">
						@if($num%2==1)
							<ul>
								<?php
									for($j = 0; $j < count($flag); $j++) if($flag[$j] == $num) {
										if(strcmp($lang,'en') == 0)
											echo '<li>'.$data['achievements'][$j]['stringen'].'</li>';
										else
											echo '<li>'.$data['achievements'][$j]['stringid'].'</li>';
									}
								?>
							</ul>
						@endif				
					</td>
				</tr>
			</table>
		</div>
		@endfor
	  </div>
	 </div>
</div>
@endsection
