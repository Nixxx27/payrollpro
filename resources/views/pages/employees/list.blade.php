@extends('layouts.template')

@section('css')
<style>
.clock {
  border-radius: 50%;
  background: #fff url(./public/images/clock.svg) no-repeat center;
  background-size: 90%;
  height: 17em;
  padding-bottom: 31%;
  position: relative;
  width: 17em;
}

.clock.simple:after {
  background: #000;
  border-radius: 50%;
  content: "";
  position: absolute;
  left: 50%;
  top: 50%;
  transform: translate(-50%, -50%);
  width: 5%;
  height: 5%;
  z-index: 10;
}

.minutes-container, .hours-container, .seconds-container {
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
}

.hours {
  background: #000;
  height: 20%;
  left: 48.75%;
  position: absolute;
  top: 30%;
  transform-origin: 50% 100%;
  width: 2.5%;
}

.minutes {
  background: #000;
  height: 40%;
  left: 49%;
  position: absolute;
  top: 10%;
  transform-origin: 50% 100%;
  width: 2%;
}

.seconds {
  background: red;
  height: 45%;
  left: 49.5%;
  position: absolute;
  top: 14%;
  transform-origin: 50% 80%;
  width: 1%;
  z-index: 8;
}

@keyframes rotate {
  100% {
    transform: rotateZ(360deg);
  }
}

.hours-container {
  animation: rotate 43200s infinite linear;
}
.minutes-container {
  animation: rotate 3600s infinite linear;
}
.seconds-container {
  animation: rotate 60s infinite linear;
}



.minutes-container {
  transition: transform 0.3s cubic-bezier(.4,2.08,.55,.44);
}
.seconds-container {
  transition: transform 0.2s cubic-bezier(.4,2.08,.55,.44);
}

</style>
@endsection

@section('content')
		<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="#">Home</a>
							</li>

							<li class="active">Employee</li>
						</ul><!-- /.breadcrumb -->
						<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
									<i class="ace-icon fa fa-search nav-search-icon"></i>
								</span>
							</form>
						</div><!-- /.nav-search -->
					</div>

	<div class="page-content">
	
	<div class="row">

		<div class="col-md-3 col-md-push-9">
			
			<article class="clock" style="border:4px outset #438EB9;margin-bottom:5px;">
			<div class="hours-container">
				<div class="hours"></div>
			</div>
			<div class="minutes-container">
				<div class="minutes"></div>
			</div>
			<div class="seconds-container">
				<div class="seconds"></div>
			</div>
		</article>
	
  <table class="table" align="center">
				<tr>
					<td>
						<button class="btn btn-app btn-success">
							<i class="ace-icon fa fa-pencil bigger-230"></i>In</button>
					<button class="btn btn-app btn-warning">
							<i class="ace-icon fa fa-undo bigger-230"></i>Out</button>
					</td>
				</tr>
			</table>

      <h4 class="blue bolder smaller">Recent Clock Logs</h4>
      <table class="table">
        <tr>
          <td><i class="fa fa-clock-o" aria-hidden="true">Time In : </td>
          <td>7:45 AM</td>
        </tr>

         <tr>
          <td><i class="fa fa-clock-o" aria-hidden="true">Time Out : </td>
          <td>5:01 PM</td>
        </tr>

        <tr>
          <td colspan="2" style="text-align:right"><button class="btn btn-primary btn-xs">view all <i class="fa fa-chevron-right" aria-hidden="true"></i></button></td>
        </tr>
      </table>

       
    </div><!-- /.col-sm-3 -->

		<div class="col-md-9 col-md-pull-3 ">
        @include('pages.employees.tab-content')
		</div><!-- /.col-md-9 -->



	</div><!-- /.row -->

</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->
		@include('layouts.footer')
@endsection


@section('js')
	
	<!-- inline scripts related to this page -->
	<script type="text/javascript">
		
		/*
 * Starts any clocks using the user's local time
 * From: cssanimation.rocks/clocks
 */
function initLocalClocks() {
  // Get the local time using JS
  var date = new Date;
  var seconds = date.getSeconds();
  var minutes = date.getMinutes();
  var hours = date.getHours();

  // Create an object with each hand and it's angle in degrees
  var hands = [
    {
      hand: 'hours',
      angle: (hours * 30) + (minutes / 2)
    },
    {
      hand: 'minutes',
      angle: (minutes * 6)
    },
    {
      hand: 'seconds',
      angle: (seconds * 6)
    }
  ];
  // Loop through each of these hands to set their angle
  for (var j = 0; j < hands.length; j++) {
    var elements = document.querySelectorAll('.' + hands[j].hand);
    for (var k = 0; k < elements.length; k++) {
        elements[k].style.webkitTransform = 'rotateZ('+ hands[j].angle +'deg)';
        elements[k].style.transform = 'rotateZ('+ hands[j].angle +'deg)';
        // If this is a minute hand, note the seconds position (to calculate minute position later)
        if (hands[j].hand === 'minutes') {
          elements[k].parentNode.setAttribute('data-second-angle', hands[j + 1].angle);
        }
    }
  }
}


/*
 * Set a timeout for the first minute hand movement (less than 1 minute), then rotate it every minute after that
 */
function setUpMinuteHands() {
  // Find out how far into the minute we are
  var containers = document.querySelectorAll('.minutes-container');
  var secondAngle = containers[0].getAttribute("data-second-angle");
  if (secondAngle > 0) {
    // Set a timeout until the end of the current minute, to move the hand
    var delay = (((360 - secondAngle) / 6) + 0.1) * 1000;
    setTimeout(function() {
      moveMinuteHands(containers);
    }, delay);
  }
}

/*
 * Do the first minute's rotation
 */
function moveMinuteHands(containers) {
  for (var i = 0; i < containers.length; i++) {
    containers[i].style.webkitTransform = 'rotateZ(6deg)';
    containers[i].style.transform = 'rotateZ(6deg)';
  }
  // Then continue with a 60 second interval
  setInterval(function() {
    for (var i = 0; i < containers.length; i++) {
      if (containers[i].angle === undefined) {
        containers[i].angle = 12;
      } else {
        containers[i].angle += 6;
      }
      containers[i].style.webkitTransform = 'rotateZ('+ containers[i].angle +'deg)';
      containers[i].style.transform = 'rotateZ('+ containers[i].angle +'deg)';
    }
  }, 60000);
}


/*
 * Move the second containers
 */
function moveSecondHands() {
  var containers = document.querySelectorAll('.seconds-container');
  setInterval(function() {
    for (var i = 0; i < containers.length; i++) {
      if (containers[i].angle === undefined) {
        containers[i].angle = 6;
      } else {
        containers[i].angle += 6;
      }
      containers[i].style.webkitTransform = 'rotateZ('+ containers[i].angle +'deg)';
      containers[i].style.transform = 'rotateZ('+ containers[i].angle +'deg)';
    }
  }, 1000);
}

initLocalClocks();
setUpMinuteHands();
moveMinuteHands();
moveSecondHands();


	</script>
@endsection


