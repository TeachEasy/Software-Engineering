<?php include 'includes/header.php';?>
<html>
	<head>
		<link rel="stylesheet" href="components/bootstrap2/css/bootstrap.css">
		<link rel="stylesheet" href="components/bootstrap2/css/bootstrap-responsive.css">
		<link rel="stylesheet" href="css/calendar.css">
	</head>
	<body>
		<div class="container">
		<div class="page-header">
			<div class="pull-right form-inline">
				<div class="btn-group">
					// prev button in calendar nav bar
					<button class="btn btn-primary" data-calendar-nav="prev"><< Prev</button>
					// today button in calendar nav bar
					<button class="btn" data-calendar-nav="today">Today</button>
					// next button in calendar nav bar
					<button class="btn btn-primary" data-calendar-nav="next">Next >></button>
				</div>
				<div class="btn-group">
					// year button in calendar nav bar
					<button class="btn btn-warning" data-calendar-view="year">Year</button>
					// month button in calendar nav bar
					<button class="btn btn-warning active" data-calendar-view="month">Month</button>
					// week button in calendar nav bar
					<button class="btn btn-warning" data-calendar-view="week">Week</button>
					// day button in calendar nav bar
					<button class="btn btn-warning" data-calendar-view="day">Day</button>
				</div>
			</div>

			<h3></h3>
		</div>

		<div class="row">
			<div class="span9">
				<div id="calendar"></div>
			</div>
			<div class="span3">
				

				
			</div>
		</div>

		<div class="clearfix"></div>
		

		<script type="text/javascript" src="components/jquery/jquery.min.js"></script>
		<script type="text/javascript" src="components/underscore/underscore-min.js"></script>
		<script type="text/javascript" src="components/bootstrap2/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="components/jstimezonedetect/jstz.min.js"></script>
		<script type="text/javascript" src="js/calendar.js"></script>
		<script type="text/javascript" src="js/app.js"></script>

		<script type="text/javascript">
			var disqus_shortname = 'bootstrapcalendar'; // required: replace example with your forum shortname
			(function() {
				var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
				dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
				(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
			})();
		</script>
	</div>

	</body>
</html>