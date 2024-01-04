// JavaScript Document
var sliders = new Array();
var currentSlide = false;

function slideFor(element,expander)
{
	
	alert(expander);
	sliders[expander].toggle();
	if(currentSlide && document.getElementById('li_'+ currentSlide).className == 'visible')
	{
		sliders[currentSlide].toggle();
	}

	currentSlide = expander;
}

function setSlider()
{
	if($('.expand')[0])
	{
		var i = 0;
		while($('.expand')[i])
		{
			var complete = function (node)
			{ 
					if($('li_'+ node.id).className == "hidden")
					{
					
						$('li_'+ node.id).className = "visible";
						window.location.hash='a_'+node.id;
					}
					else
					{
						$('li_'+ node.id).className = "hidden";
					}

			};

			sliders[$('.expand')[i].id] =  new Fx.Slide($($('.expand')[i].id),{onComplete: complete});
			sliders[$('.expand')[i].id].hide();
			$($('.expand')[i].id).style.visibility = "visible";
			i++;
		}
	}
}

jQuery(document).ready(function() {
	
});



