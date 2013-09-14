(function(){
	// $(".slider").fadeOut(5000);
	var processing = false;

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

	var defaultURL = $(".nextPostLink a").last().attr("href");

	$(document).on("scroll.main", function(event){
		if(processing) return false;

		if( $(window).scrollTop() + $(window).height() == $(document).height() ){
			processing = true;

			var container = $("#main");

			if(container.data("next-page") == defaultURL){
				$(document).off(".main");
				processing = false;
				return false;
			}

			loadNextPage(container.data("next-page") || defaultURL, function(data, newURL){
				processing = false;
				$("#main").append(data);
				if( newURL ){
					$("#main").data("next-page", newURL);
				}
				else{
					$(document).off(".main");
				}
			});
		}
	});

	function loadNextPage( url, callback ){
		$.ajax({
			url: url,
			type: "POST",
			data: {
				skipFirstFeatured: true
			},
			success: function(response){
				var articles = $("#main .article", response);
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