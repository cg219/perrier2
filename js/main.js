(function(){
	// $(".slider").fadeOut(5000);

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