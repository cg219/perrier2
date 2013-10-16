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
				// console.log("Set Time");

		var timer =  setInterval(function(){
			if( $(".addthis_button_expanded").length ){
				$(".addthis_button_expanded").attr("id", "addThisImportant" );
				// console.log("Timer");
				// console.log("Timer");

				clearInterval(timer);
			}
		}, 500);

	}

	$("li.dropdown.hover").hover(function(event){
		$(this).addClass("open");
	}, function(){
		$(this).removeClass("open");
	})

	$("li.dropdown.hover").click(function(event){
		event.preventDefault();
		// console.log($(this).find("a").attr("href"));
		// console.log($(this));
		window.location = $(this).find("a").attr("href");
		$(this).removeClass("open");
	})

	$(".widget li.dropdown.hover .dropdown-menu li").click(function(event){
		event.preventDefault();
		event.stopPropagation();
		// console.log($(this).find("a").attr("href"));
		// console.log($(this));
		window.location = $(this).find("a").attr("href");
		$(this).removeClass("open");
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

	$(".slide_image_holder").on("mouseenter", function(){
		$(this).find(".caption").fadeIn();
	})

	$(".slide_image_holder").on("mouseleave", function(){
		$(this).find(".caption").fadeOut();
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

		if( $(window).scrollTop() + $(window).height() + 30 >= $(document).height() ){
			processing = true;

			var container = $("#singlemain, #main").last();

			// console.log(container.data("next-page"));
			// console.log(defaultURL);
			if(container.data("next-page") == defaultURL){
				$(document).off(".main");
				processing = false;
				return false;
			}

			$(".loader").fadeIn();

			loadNextPage(container.data("next-page") || defaultURL, "main", function(data, newURL){
				processing = false;
				$(".loader").fadeOut();
				// console.log(data);
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
		// console.log("Form Submitting");
		var form = $(this);
		
		$.ajax({
			url: form.attr("action"),
			type: "POST",
			data: form.serialize(),
			success: function(response){
				// console.log(response);
				form.each(function(){
					this.reset();
				})
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
				var articles = $( id + " > .article", response);
				var nextURL = $(".nextPostLink a", response).last().attr("href") || false;
				callback(articles, nextURL);
			},
			error: function(response){
				// console.log("error")
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