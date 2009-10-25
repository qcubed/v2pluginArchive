/*
 * Copyright 2007-2008 Allan Jardine. All rights reserved
 * Contact: allan.jardine /AT\ sprymedia.co.uk
 * QVisualEfect Wrapper Contact: enzo at anexusit dot com
 */
var QVisualEvent = {
	Init : function() {
	if (typeof VisualEvent != "undefined") {
		if (document.getElementById("Event_display")) {
			VisualEvent.fnClose()
		} else {
			VisualEvent.fnInit()
		}
		return
	}
	var a = {
		bLoadingComplete : false,
		toInfo : false,
		fnLoadFile : function(d, e) {
			var b;
			if (e == "css") {
				b = document.createElement("link");
				b.type = "text/css";
				b.rel = "stylesheet";
				b.href = d;
				b.media = "screen";
				document.getElementsByTagName("head")[0].appendChild(b)
			} else {
				if (e == "image") {
					var c = new Image(1, 1);
					c.src = d
				} else {
					b = document.createElement("script");
					b.setAttribute("language", "JavaScript");
					b.setAttribute("src", d);
					document.body.appendChild(b)
				}
			}
		},
		fnPollReady : function(b, c) {
			if (typeof VisualEvent == "object" && typeof dp == "object") {
				VisualEvent.fnInit();
				this.fnComplete()
			} else {
				setTimeout(function() {
					a.fnPollReady()
				}, 100)
			}
		},
		fnComplete : function() {
			this.bLoadingComplete = true;
			var b = document.getElementById("EventLoading");
			b.innerHTML = '<span class="Event_header">Visual Event</span> (v.6)<br>Information about events assigned on this page.<br>Press escape to quit. Note that jQuery, YUI,<br>MooTools, Prototype and JAK are currently supported.<br><div><a href="http://www.sprymedia.co.uk/article/Visual+Event" target="_blank">Click here for further information</a></div>';
			a.toInfo = setTimeout(function() {
				document.body.removeChild(b)
			}, 3000);
			$(b).mouseover(function() {
				clearTimeout(a.toInfo)
			});
			$(b).mouseout(function() {
				a.toInfo = setTimeout(function() {
					document.body.removeChild(b)
				}, 3000)
			})
		},
		fnLoad : function() {
			if (this.bLoadingComplete == true) {
				return 0
			}
			var b = document.createElement("div");
			b.style.position = "absolute";
			b.style.top = "0";
			b.style.left = "0";
			b.style.color = "white";
			b.style.padding = "5px 10px";
			b.style.fontSize = "11px";
			b.style.fontFamily = '"Lucida Grande", Verdana, Arial, Helvetica, sans-serif';
			b.style.zIndex = "55999";
			b.style.backgroundColor = "#a2392d";
			b.setAttribute("id", "EventLoading");
			b.appendChild(document.createTextNode("Loading Visual Event..."));
			document.getElementsByTagName("body")[0].insertBefore(b,
					document.body.childNodes[0]);
			if (typeof VisualEvent == "object") {
				a.fnPollReady()
			} else {
				setTimeout(function() {
					a.fnPollReady()
				}, 1000)
			}
			
			a
					.fnLoadFile(
							"http://www.sprymedia.co.uk/design/event/media/css/event.css",
							"css");
			if (typeof jQuery == "undefined") {
				a
						.fnLoadFile(
								"http://www.sprymedia.co.uk/design/event/media/js/event-complete-jquery.js",
								"js")
			} else {
				a
						.fnLoadFile(
								"http://www.sprymedia.co.uk/design/event/media/js/event-complete.js",
								"js")
			}
		}
	};
	a.fnLoad();
   }
};