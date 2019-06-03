var limit = 2;
var counter = 0;
var swapcounter = 0;
var clickedon = ["",""];
var moviearr = ["",""];
var idarr = ["",""];
var loading = 0;
var prevent = 0;



function removemovie(x){

	var element = document.getElementById('remove' + x).id;
	var list = document.getElementById('listid').value;
	var movie = document.getElementById('movie' + x).value;
	if(this === element.target) {
	 prevent = 0;
    }
	else{
		prevent = 1;
	 }
	 
	 $.ajax({
		type: 'GET',
		url: 'include/methods/remove.php?list='+list+'&movie=' + movie,
		success: function (data) {
			window.location.href = "listeditor.php?listID="+list;
		}
		});
	 
	 
}

function add(x){
	var movie = document.getElementById(x).id;
	var list = document.getElementById('listid').value;
	

		$.ajax({
		type: 'GET',
		url: 'include/methods/add.php?list='+list+'&movie=' + movie,
		success: function (data) {
			window.location.href = "listeditor.php?listID="+list;
		}
		});


}

function thumbs(x){


	var element = document.getElementById('thumbs' + x).id;
	 if(this === element.target) {
	 prevent = 0;
    }
	else{
		prevent = 1;
	 }
	
	var list = document.getElementById('listid').value;
	var movie = document.getElementById('movie' + x).value;

	
	if (document.getElementById(element).src == "assets/img/ratings/thumbs_up.png") 
    {
		$.ajax({
		type: 'GET',
		url: 'include/methods/rating.php?list='+list+'&rating=2&movie=' + movie,
	success: function (data) {
		document.getElementById(element).src = "assets/img/ratings/thumbs_down.png"; 
 
  }
});
			

	}
    else 
    {
		$.ajax({
		type: 'GET',
		url: 'include/methods/rating.php?list='+list+'&rating=1&movie=' + movie,
		success: function (data) {
		document.getElementById(element).src = "assets/img/ratings/thumbs_up.png"; 
									}
		});
     
	}

  
}
window.onerror = function(msg, url, linenumber) {
    alert('Error message: '+msg+'\nURL: '+url+'\nLine Number: '+linenumber);
    return true;
}
function swapitems(x){
	if(loading == 0 && prevent == 0)
	{
	loading = 1;
	var list = document.getElementById('listid').value;
	var movie = document.getElementById('movie' + x).value;
	swapcounter = swapcounter + 1;
	
	
	
	if(swapcounter==1)
	{
		moviearr[0] = movie;
		clickedon[0] = document.getElementById(x);
		clickedon[0].style.opacity = 0.5;
		idarr[0] = x;
	}
	else if(swapcounter == 2)
	{
		
		moviearr[1] = movie;
		clickedon[1] = document.getElementById(x);
		clickedon[1].style.opacity = 0.5;
		idarr[1] = x;

		$.ajax
		(
		{
		type: 'GET',
		url: 'include/methods/swap.php?list='+list+'&movie1='+ moviearr[0] +'&movie2=' + moviearr[1],
		success: function (data) 
		{	
			
			clickedon[0].style.opacity = 1;
			clickedon[1].style.opacity = 1;
			
			var hold = document.getElementById('order' + idarr[0]).innerHTML;
			document.getElementById('order' + idarr[0]).innerHTML = document.getElementById('order' + idarr[1]).innerHTML;
			document.getElementById('order' + idarr[1]).innerHTML = hold;
			
			var clonedElement1 = clickedon[0].cloneNode(true);
			var clonedElement2 = clickedon[1].cloneNode(true);

			clickedon[1].parentNode.replaceChild(clonedElement1, clickedon[1]);
			clickedon[0].parentNode.replaceChild(clonedElement2, clickedon[0]);

		}
		}
		);
		swapcounter = 0;
	}
	
	
	loading = 0;
	}
	prevent = 0;
}
function changetitle(){
	
	var newtitle = document.forms["titleform"]["newtitle"].value;
	
	var list = document.forms["titleform"]["listid"].value;

	$.ajax({
		type: 'GET',
		url: 'include/methods/changetitle.php?list='+list+'&name=' +newtitle,
		success: function (data) {
			document.getElementById('listtitle').innerHTML = newtitle;
		}
		});
}
