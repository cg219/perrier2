(function(){
	// $(".slider").fadeOut(5000);
	var processing = false;
	var holder = $(".slider");
	var slides = $(".slider_images");
	var images = $(".slide_image_holder");

	if( holder ){
		slides.width(images.width() * holder.attr("data-amount"));
		images.each(function(index){
			var img = $(this).find("img");
			img.css({
				marginLeft: img.width() * .5 * -1,
				marginTop: img.height() * .5 * -1
			})
		})
	}

	if( $(".single").length ){

		var timer =  setInterval(function(){
			if( $(".addthis_button_expanded").length ){
				$(".addthis_button_expanded").attr("id", "addThisImportant" );
				console.log("Timer");

				clearInterval(timer);
			}
		}, 500);

	}

	$("li.dropdown.hover").hover(function(){
		$(this).find(".dropdown-toggle").click();
	}, function(){
		$(this).removeClass("open");
		// $(this).find(".dropdown-toggle").click();
	})

	$("li.dropdown.hover").click(function(event){
		// console.log($(this).find(".dropdown-toggle"));
		$(this).removeClass("open");
		window.location = $(this).attr("href");
	})

	$(".addthis_button_expanded").css({
		width: "40px"
	})

	$("#hotspot-navbar .dropdown-menu li").on("click", function(event){
		event.preventDefault();
		event.stopPropagation();

		var $this = $(this);
		$this.toggleClass("selected");
		var newTitle = updateHotspotTitle($this.parent());
		$("#hotspot-toggle").text(newTitle);

		if(newTitle == "ALL"){
			deselectChoices($this.parent());
		}
	})

	$(".goButton").on("click", function(event){
		event.preventDefault();

		var arg = getSelectedCities();
		var form = $(this).parent().find("form");
		form.find("input").val(arg);
		form.submit();
	})

	$(".disabled").on("click", function(event){
		event.preventDefault();
	})

	$(".backToTop").on("click", function(){
		$("html, body").animate({
			scrollTop: "0px"
		}, 1000,
		"swing",
		function(){
			$(".backToTop").fadeOut(function(){
				$(document).on("scroll.back", function(event){
					scrollBack();
				})
			});
		})
	})

	var defaultURL = $(".nextPostLink a").last().attr("href");
	var originalH = $(document).height();
	var showing = false;

	$(document).on("scroll.back", function(event){
		scrollBack();
	})

	$(document).on("scroll.main", function(event){
		if(processing) return false;

		if( $(window).scrollTop() + $(window).height() == $(document).height() ){
			processing = true;

			var container = $("#singlemain, #main").last();

			console.log(container.data("next-page"));
			console.log(defaultURL);
			if(container.data("next-page") == defaultURL){
				$(document).off(".main");
				processing = false;
				return false;
			}

			$(".loader").fadeIn();

			loadNextPage(container.data("next-page") || defaultURL, "main", function(data, newURL){
				processing = false;
				$(".loader").fadeOut();
				container.append(data);
				if( newURL ){
					container.data("next-page", newURL);
				}
				else{
					$(document).off(".main");
				}
			});
		}
	});

	$("button.next").on("click", function(){
		changeSlide("up");
	})

	$("button.prev").on("click", function(){
		changeSlide("back");
	})

	$("#newsletterForm").submit(function(){
		console.log("Form Submitting");
		var form = $(this);
		
		$.ajax({
			url: form.attr("action"),
			type: "POST",
			data: form.serialize(),
			success: function(response){
				console.log(response);
			}
		})
		return false;
	})

	function scrollBack(){
		$(".backToTop").fadeIn();
		$(document).off(".back");
	}

	function changeSlide(direction){
			
		slides.fadeOut(function(){
			direction = direction == "up" ? 1 : 0;

			var newIndex;
			var index = parseInt(holder.attr("data-index"));
			var amount = parseInt(holder.attr("data-amount"));
			var width = slides.width();

			switch(direction){
				case 1:
					newIndex = ( index == amount - 1 ) ? 0 : ++index;
					break;

				case 0:
					newIndex = ( index == 0) ? amount - 1  : --index;
					break;
			}


			holder.attr("data-index", newIndex);
			slides.css({
				marginLeft : newIndex == 0 ? 0 : ( width - ( width * (newIndex / amount) ) ) * -1
			});

			slides.fadeIn();
		});
	}

	function loadNextPage( url, id, callback ){
		id = "#" + id;

		$.ajax({
			url: url,
			type: "POST",
			data: {
				skipFirstFeatured: true
			},
			success: function(response){
				var articles = $( id + " .article", response);
				var nextURL = $(".nextPostLink a", response).last().attr("href") || false;
				callback(articles, nextURL);
			},
			error: function(response){
				console.log("error")
			}
		});
	}

	function getSelectedCities(){
		var hotspots = "";

		$("#hotspot-navbar .dropdown-menu li").each(function(index){
			var li = $(this);
			if(li.hasClass("selected")){
				hotspots += (li.text() + ",");
			}
		})

		return hotspots.substr(0,hotspots.length - 1);
	}

	function updateHotspotTitle(target){
		var title = "";

		target.find("li").each(function(index){
			var li = $(this);
			if(li.hasClass("selected")){
				title = (title == "") ? li.text() : "MULTIPLE";
			}
		});

		return title == "" ? "ALL" : title;
	}

	function deselectChoices(target){
		target.find("li").each(function(index){
			var li = $(this);
			if(li.hasClass("selected") && li.text() != "ALL"){
				li.toggleClass("selected");
			}
		});
	}
})();