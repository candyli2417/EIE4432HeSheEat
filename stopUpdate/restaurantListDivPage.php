<!DOCTYPE html>
<html lang="en">
<head>
<title>Restaurant List - HeSheEat</title>
<link rel="icon" href="https://i.imgur.com/nLtvyR5.png">
<!-- Main CSS -->
<link rel="stylesheet" href="main.css"/>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
<!-- Boostrap -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
            integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
            crossorigin="anonymous">
</script>
<!-- W3School Font -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
</style>
<script type = "text/javascript">
<!-- Make the navigation bar responsive -->
function verticalNav() 
{
    var x = document.getElementById("header");
    if (x.className === "header navbar navbar-expand-lg bg-info") {
        x.className += " responsive";
    } else {
        x.className = "header navbar navbar-expand-lg bg-info";
    }
}
<!-- Make the top bar responsive -->
function horizontalBar()
{
	var x = document.getElementById("categoryBar");
	if (x.className === "card Rtopbar transparentBg border-danger responsive") {
        x.className = "card Rtopbar transparentBg border-danger";
    } else {
        x.className = "card Rtopbar transparentBg border-danger responsive";
    }
}
function page()
{
	var y = "<?php echo $_GET["choice"] ?>";
	var p = "<?php echo $_GET["page"] ?>";
	$.post("getRestaurant.php",
		{eatwhat:y/* , page: p */},
		function(data)
		{
			var i = -12+12*p;
			var x = 1;
			data = JSON.parse(data);
			console.log(data[0]);
			var word="";
			for(var k = 0;k<12;k++)
			{
				if(!data[k+i])break;
				word+='<div class="card Rcard border-danger transparentBg">';
				word+='<img src="https://i.imgur.com/'+data[k+i].I+'.png" alt="Image">';
				word+='<div id="CH'+x+'" class="card-header text-danger"></div>';
				word+='<div class="card-body text-danger">';
				word+='<div id="CC'+x+'" class="card-title"></div><p>';
				word+='<span id="CD'+x+'"></span><br/>';
				word+='<span id="CP'+x+'"></span></p>';
				word+='</div></div>';
				x++;
			}
			$("#content").html(word);
			i = -12+12*p;
			x = 1;
			for(var k = 0;k<12;k++)
			{
				if(!data[k+i])break;
				$("#CH"+x).html(data[k+i].N);
				$("#CC"+x).html(data[k+i].C);
				$("#CD"+x).html(data[k+i].D);
				$("#CP"+x).html(data[k+i].P);
				x++;
			}
			
			// Generate pagination
			var pageWord="";
			var maxPage = Math.ceil(data.length/12);
			console.log(maxPage);
			pageWord+='<div class="Rpagination transparentBg">'
			if(p!=1) {p--; pageWord+='<a href="restaurantListDivPage.php?choice='+y+'&page='+p+'">&laquo;</a>'; p++;}
			i=1;
			for(i;i<=maxPage;i++)
			{
				pageWord+="<a href='restaurantListDivPage.php?choice="+y+"&page="+i+"'>"+i+"</a>";
			}
			i=p;i++;
			if(p<maxPage) {pageWord+="<a href='restaurantListDivPage.php?choice="+y+"&page="+i+"'>&raquo;</a>";}
			pageWord+="</div>";
			// console.log(pageWord);
			$("#pagination").html(pageWord);
		}
	);	
}
function category(y,p)
{
	console.log(y+"eee"+p);
	if(typeof y ==="undefined"){y = "all";}
	if(typeof p ==="undefined"){p = "1";}
	console.log(y+"eee"+p);
	$.post("getRestaurant.php",
		{eatwhat:y},
		function(data)
		{
			var i = 0;
			var x = 1;
			data = JSON.parse(data);
			console.log(data[0]);
			var word="";
			for(i;i<12;i++)
			{
				if(!data[i])break;
				word+='<div class="card Rcard border-danger transparentBg">';
				word+='<img src="https://i.imgur.com/'+data[i].I+'.png" alt="Image">';
				word+='<div id="CH'+x+'" class="card-header text-danger"></div>';
				word+='<div class="card-body text-danger">';
				word+='<div id="CC'+x+'" class="card-title"></div><p>';
				word+='<span id="CD'+x+'"></span><br/>';
				word+='<span id="CP'+x+'"></span></p>';
				word+='</div></div>';
				x++;
			}
			$("#content").html(word);
			i=0;
			x=1;
			for(i;i<12;i++)
			{
				if(!data[i])break;
				$("#CH"+x).html(data[i].N);
				$("#CC"+x).html(data[i].C);
				$("#CD"+x).html(data[i].D);
				$("#CP"+x).html(data[i].P);
				x++;
			}
			
			// Generate pagination
			var pageWord="";
			var maxPage = Math.ceil(data.length/12);
			console.log(maxPage);
			pageWord+='<div class="Rpagination transparentBg">';
			if(p!=1) 
			{
				i = p--;
				pageWord+='<a href="restaurantListDivPage.php?choice='+y+'&page='+i+'">&laquo;</a>';
			}
			i=1;
			for(i;i<=maxPage;i++)
			{
				pageWord+="<a href='restaurantListDivPage.php?choice="+y+"&page="+i+"'>"+i+"</a>";
			}
			i=1;
			if(i<maxPage) {pageWord+="<a href='restaurantListDivPage.php?choice="+y+"&page=2'>&raquo;</a>";}
			pageWord+="</div>";
			// console.log(pageWord);
			$("#pagination").html(pageWord);
		}
	);
}
$(function spanClick()
	{
		$('span.choice').click(function()
			{
				var c = $(this).data('choice');
				category(c,1);
			}
		);
	}
);
</script>
</head>

<body onload="page()">
	<nav id="header" class="header navbar navbar-expand-lg bg-info">
		<a href="index.html"><img src="asset/logo_small.png" alt="logo" style="height:100px"></a>
		<ul class="navbar-nav mr-auto">
		<a href="index.html"><button class="btn btn-outline-light">Home</button></a> 
		<a href="restaurantListJS.html"><button class="btn btn-outline-light active">Restaurant</button></a>
		<a href="random.html"><button class="btn btn-outline-light">Random</button></a>
		<a href="aboutUs.html"><button class="btn btn-outline-light">About Us</button></a>
		</ul>
		<form name="UForm" action="search.php" method="post" class="form-inline">
			<input class="form-control mr-sm-2" type="search" name="eatwhat" placeholder="Type here" aria-label="Search">
			<input class="btn btn-dark my-2 my-sm-0" type="submit" value="Search">
		</form>
		<a href="javascript:void(0);" class="icon mx-2" onclick="verticalNav()">
			<i class="fa fa-bars" style="font-size: 30px; color: #343a40;"></i>
		</a>
	</nav>
	
	<div id="categoryBar" class = "card Rtopbar transparentBg border-danger responsive">
		<form name="RestForm" onsubmit="return false">
			<a href="javascript:void(0);" class="icon mx-2" onclick="horizontalBar()">
				<i class="fa fa-filter" style="font-size: 30px; color: #343a40;"></i>
			</a>
			<div class="row">
				<div class="col-sm-3">
					<span class="choice" data-choice="all"><title1>All</title1></span>
				</div>
				<div class="col-sm-3">
					<title1>Cuisine</title1></br>
					<span class="choice" data-choice="Chinese">Chinese</span><br>
					<span class="choice" data-choice="Dessert">Dessert</span><br>
					<span class="choice" data-choice="France">France</span><br>
					<span class="choice" data-choice="Italian">Italian</span><br>
					<span class="choice" data-choice="Japanese">Japanese</span><br>
					<span class="choice" data-choice="Taiwan">Taiwan</span>
				</div>
				<div class="col-sm-3">
					<title1>District</title1></br>
					<span class="choice" data-choice="Hung Hom">Hung Hom</span></br>
					<span class="choice" data-choice="Whampoa">Whampoa</span></br>
					<span class="choice" data-choice="Tsim Sha Tsui">Tsim Sha Tsui</span>
				</div>
				<div class="col-sm-2">
					<title1>Price</title1></br>
					<span class="choice" data-choice="<$50"><$50</span></br>
					<span class="choice" data-choice="$51-100">$51-100</span></br>
					<span class="choice" data-choice="$101-200">$101-200</span></br>
					<span class="choice" data-choice="$201-400">$201-400</span>
				</div>
			</div>
		</form>
	</div>
	
	<div id="content" class="Rcontent">
	<!-- <span id="on9WKC">123</span> -->	
	</div>
	
	<div id="pagination" class="text-center">
		
	</div>
	
	<div id="footer" class="footer">
		<div class="FCreator">
		<i>Designed by:</i><br/>
			Hui Ka Hung,&nbsp
			Kwan Wai Kin,&nbsp
			Li King Wai,<br/>
			Ng Chi Chun,&nbsp
			Tsang Chi Kin.
		</div>
	</div>
</body>
</html>