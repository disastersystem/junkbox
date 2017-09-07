var video, textbox, videoTracks, videoButtons;

window.onload = function(){
	video = document.querySelector("#video");
	textbox = document.querySelector("#textbox");
	videoTracks = document.querySelectorAll("track");
	videoButtons = document.querySelectorAll("button");

	//language buttons get corresponding language track
	$('#transcript-buttons').children().each(function(i) {
		var lang = this.getAttribute('id');
		document.getElementById(lang).addEventListener("click", function () {
			getTrack(videoTracks[i], readCueContent);
		}, false);
	});

	//get the active cue when the cue changes and the corresponding paragraph tag
	//we're assuming that each transcript has the same amount of cues since it's just translations of the same content
	videoTracks[0].addEventListener("cuechange", function () {
		var myTrack = this.track;
		var myCues = myTrack.activeCues; // array of current cues.
		var paragraphTags = document.getElementsByTagName("p");

		//scroll down to keep current cue in view
		function scroll() {
			var box = document.getElementById("textbox");
			box.scrollTop += 15;
		}
		scroll();

		//set background color to current cue
		if (myCues.length > 0) {
			//get all the paragraph tags
			for (var i=0; i < paragraphTags.length; i++){
				var curPar = paragraphTags[i];
				var curParTime = curPar.getAttribute("data-startTime");
				//if the start time of the paragraph matches the current cue
				if(curParTime == myCues[0].startTime){
					//add a background-color
					curPar.setAttribute("style", "background-color: rgba(0, 0, 0, 0.1);")
					//scroll down textbox
				} else {
					//remove the style tag when it is over
					curPar.removeAttribute("style")
				}
			}
		}
	}, false);

	// when a language button is clicked add a class with some
	// styling to indicate that's the current active language button
	$('.button_lang').on('click', function() {
		$('.button_lang').removeClass('selected');
		$(this).toggleClass('selected');
	});
};

//read cue content of the track
function readCueContent(track){
	textbox.innerHTML = ""; //empty textbox
	var cues = track.cues; //TextTrackCueList - find all the cues in the current track
	var currentTime = Math.floor(video.currentTime);

	//for each cue in the cue list
	for (var i=0; i < cues.length; i++){
		var cue = cues[i]; //corresponds to the current cue in a track src file
		var cueId = cue.id; //cue.id corresponds to the cue id set in the WebVTT file
		var cueStart = cue.startTime; //cue.startTime corresponds to the start time set in the WebVTT file
		var cueEnd = cue.endTime;
		var cueText = cue.text; //cue.text corresponds to the text/subtitle/caption set in the WebVTT file for the current cue

		//adding cue to textbox, display in paragraph tag with cueId, data-startTime and cueText
		textbox.innerHTML += "<p id=\"" + cueId + "\" data-startTime=\"" + cueStart + "\" data-endTime=\"" + cueEnd + "\">" + cueText + "</p>";
	}

	function setCurTime (){
	    var paragraphTags = document.getElementsByTagName("p");

	    for (var i=0; i < paragraphTags.length; i++){
	        //run changeTime function when one of the paragraph tags are clicked
	        paragraphTags[i].addEventListener('click', changeTime);
	    }

	    function changeTime(e){
	        var target = e.target.getAttribute("data-startTime"); //get the start time from the paragraph tag that was clicked
	        video.currentTime = target; //set a new current time on the video
	    }
	}
	setCurTime();
}

//show the track text if it's finished loading
function getTrack(videoTrack, callback){
	var text = videoTrack.track;

	if (videoTrack.readyState === 2){ //2 = LOADED
		text.mode = "hidden";
		callback(text);
	} else { //0 = NONE, 1 = LOADING, 3 = ERROR
		text.mode = "hidden";
		videoTrack.addEventListener('load', function(e) {
			callback(text);
		});
	}
}
