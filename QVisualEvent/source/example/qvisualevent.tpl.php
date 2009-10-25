<?php require(__DOCROOT__ . __EXAMPLES__ . '/includes/header.inc.php'); ?>
	<?php $this->RenderBegin(); ?>
 
	<div class="instructions">
		<h1 class="instruction_title">Debugging Your Ajax Application identifying JS events</h1>
		
		<p>Even although Javascript (in the browser at least) is an event driven programming paradigm, 
		  it can often be really quite difficult to identify which elements will trigger an action. 
		  QVisuaEvent is a wrapper of <a href="http://www.sprymedia.co.uk/article/Visual+Event"></>Visual Event</a> tool designed to address exactly this problem.</p>
        
         <p><b>Introduction</b>:</p> 
         <p>When working with events in Javascript, it is often easy to loose track of what events are subscribed where. 
               This is particularly true if you are using a large number of events, which is typical in a modern interface employing progressive enhancement. 
               Javascript libraries also add another degree of complexity to listeners from a technical point of view, while from a developers point of view they of course can make life much easier! 
               But when things go wrong it can be difficult to trace down why this might be.
			   It is QVisualEvent which visually shows the elements on a page that have events subscribed to them, what those events are and the function that the event would run when triggered. This is primarily intended to assist debugging, 
			   but it can also be very interesting and informative to see the subscribed events on other pages 
         </p>
         
         <p><b>Usage:</b></p>
         <p>Load</p>
         <code>
         	$objQVE = new QVisualEvent($this); // To load Visual Event tool and Initialize the events parsing 
         	$objQVE->Init(); ////Call to render Visual Events
         </code>
         
         <p>Remove: If you are seeing the events parser and you need to return again to normal page; you just need to press <b>ESC key</b> or call by code.</p>
         
         <code>
         	$objQVE->Close();
         </code>	
         
         <p> More information at <a href="http://www.sprymedia.co.uk/article/Visual+Event">Official Page</a></p>
	</div>
	<code>
	<p><?php $this->txtInputA->RenderWithName(); ?></p>
	<p><?php $this->txtInputB->RenderWithName(); ?></p>
	<p><?php $this->btnButtonA->Render(); ?>&nbsp;&nbsp;&nbsp;<?php $this->btnButtonB->Render(); ?></p>
	<p><?php $this->btnButtonC->Render(); ?></p>

	<?php $this->RenderEnd(); ?>
<?php require(__DOCROOT__ . __EXAMPLES__ . '/includes/footer.inc.php'); ?>