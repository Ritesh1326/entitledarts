/*
Title: Main JS File
Theme Name: Entitledarts
Author Name: Entitledarts
Author URL: 
====================*/
/*

Table of Contents:
------------------
1. Loader
2. Navbar on Scroll
3. Page scrolling
4. Scroll To Top
5. Open Sidebar Menu
6. Get Day, Time, City and Temp
7. Sliders

/* 1. Loader
====================*/
'use strict';
$(window).on('load', function() {
	$('.loader').delay(1000).fadeOut('slow');
	imgIntoBg();
});

/* 2. Navbar on Scroll
====================*/
//jQuery to collapse the navbar on scroll
var newNav = $('nav.clone');
$(window).on('scroll', function() {
	if ($(this).scrollTop() > 300) {
		newNav.removeClass('unstick').addClass('stick');
	} else {
		newNav.removeClass('stick').addClass('unstick');
	}
});
if ($('.wedding-date').length != 0){
	$('.wedding-date').arctext({radius: 360});
}

/* 3. Page scrolling
=====================*/
//jQuery for page scrolling feature - requires jQuery Easing plugin
$(function() {
	$('a.page-scroll').on('click', function(event) {
		var $anchor = $(this);
		$('html, body').stop().animate({
			scrollTop: $($anchor.attr('href')).offset().top-70
		}, 3000, 'easeInOutExpo');
		event.preventDefault();
		$('.navbar-collapse.in').collapse('hide');
	});
});


/* 4. Scroll To Top
==========================================*/

	var timeOut;
	function scrollToTop() {
	  if (document.body.scrollTop!=0 || document.documentElement.scrollTop!=0){
		window.scrollBy(0,-50);
		timeOut=setTimeout('scrollToTop()',10);
	  }
	  else clearTimeout(timeOut);
	}
	
	$(function() {
	  var slidebox = $('#slidebox');
	  if (slidebox.length>0) {
		$(window).scroll(function(){
			var distanceTop = 50;
			if  ($(window).scrollTop() > distanceTop){
				slidebox.animate({'right':'30px'},600);
			}
			else{
				slidebox.stop(true).animate({'right':'-130px'},600);
			}
		});
	  }
	});

/* 5. Open Sidebar Menu
==========================================*/
$(document).ready(function(){
    $(".hamburgur").click(function(){
        $(".sidenav").addClass("open_sidebar");
    });

    $(".closebtn").click(function(){
        $(".sidenav").removeClass("open_sidebar");
    });
});

/* 6. Get Day, Time, City and Temp
==========================================*/

$(document).ready(function() {
	var myVar=setInterval(function(){myTimer()},1000);
});

function myTimer() {
    var today = new Date();
    var Hour = today.getHours() % 12 || 12;
    var Min = today.getMinutes();
    if (Min < 10) Min = '0' + Min;

    document.getElementById("time").innerHTML = Hour+ ":" + Min;

	var d = new Date();
	var days = ["Sun","Mon","Tue","Wed","Thu","Fri","Sat"];
	document.getElementById("day").innerHTML = days[d.getDay()];
}

	var x = document.getElementById("state");
	getLocation();
	function getLocation() {
	    if (navigator.geolocation) {
	        navigator.geolocation.getCurrentPosition(showPosition);
	    } else { 
	        x.innerHTML = "Geolocation is not supported by this browser.";
	    }
	}

	function showPosition(position) {
	    // x.innerHTML = "Latitude: " + position.coords.latitude;
	    // x.innerHTML = +"<br>"
	    // x.innerHTML = +"Longitude: " + position.coords.longitude;

	    var locAPI = "http://maps.googleapis.com/maps/api/geocode/json?latlng="+position.coords.latitude+","+position.coords.longitude+"&sensor=true";

	    $.get({
	    	url : locAPI,
	    	success : function(data){
	    		console.log(data);
	    		x.innerHTML = data.results[0].address_components[4].long_name;
	    		// x.innerHTML += data.results[0].address_components[7].long_name;
	    	}
	    });
	}

/* 7. Sliders
==========================================*/	

$('.whatwedo-slider').owlCarousel({
    loop:true,
    margin:100,
    nav:true,
    dots: false,
    navText: ['', ''],
    responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },
        1000:{
            items:3
        }
    }
})

$('.portfolio-slider').owlCarousel({
    loop:true,
    margin:100,
    nav:false,
    dots: true,
    navText: ['', ''],
    responsive:{
        0:{
            items:1
        },
        1000:{
            items:1
        }
    }
})

$('.news-slider').owlCarousel({
    loop:false,
    margin:100,
    nav:false,
    dots: true,
    navText: ['', ''],
    responsive:{
        0:{
            items:1
        },
        1000:{
            items:1
        }
    }
})

// external js: isotope.pkgd.js

// init Isotope
var $grid = $('.grid').isotope({
  itemSelector: '.element-item'
});
// filter functions
var filterFns = {

};
// bind filter button click
$('.filters-button-group').on( 'click', 'button', function() {
  var filterValue = $( this ).attr('data-filter');
  // use filterFn if matches value
  filterValue = filterFns[ filterValue ] || filterValue;
  $grid.isotope({ filter: filterValue });
});

// change is-checked class on buttons
$('.filters-button-group').each( function( i, buttonGroup ) {
  var $buttonGroup = $( buttonGroup );
  $buttonGroup.on( 'click', 'button', function() {
    $buttonGroup.find('.is-checked').removeClass('is-checked');
    $( this ).addClass('is-checked');
  });
});


