<?php require(__DOCROOT__ . __EXAMPLES__ . '/includes/header.inc.php'); ?>
   <?php $this->RenderBegin(); ?>

   <div class="instructions">
   <h1 class="instruction_title">QSlider: jQuery-based Slider Control</h1>	   

    The Slider is a graphical UI component frequently seen in rich client
    (Windows) applications. It lets the user easily pick a value from a range.
    You can see the control in action below. Note that the QSlider would not be
    possible without the tight integration between QCubed and jQuery.<br/><br/>
          
    Instantiate a <b>QSlider</b> control just like you would any other QControl.    
    Then, set some its properties:

    <ul>
        <li><b>MinValue</b> and <b>MaxValue</b> to define the range from which the user can pick a value.</li>
        <li><b>Steps</b> to determine how many steps (discrete points) are there on the continuum between
        the minimum and maximum values.</li>
        <li><b>InitialValue</b> to set the initial value of the slider.</li>
        <li><b>CssClass</b> determines the styling on the overall control.
           Note how the CssClass on the container is set to "ui-slider-1" -
           there's another sample styles called "ui-slider-2" (look at
           slider.css for its definition). Feel free to provide your own slider
           styles!</li>
       <li><b>CssClassHandle</b> sets the CSS style for the "grabby thing" (the handle) - the
           bar that the user drags around to set the value of the control.</li>
       <li><b>ShowValueTextBox</b>: a boolean that determines whether the text box showing
           the currently chosen value is shown. That QTextBox is built into the QSlider.</li>
    </ul>      

   </div>
   
   <?php $this->objSlider->Render(); ?>
   <br /><br />   
   <?php $this->btnSubmit->Render(); ?>

   <?php $this->RenderEnd(); ?>

<?php require(__DOCROOT__ . __EXAMPLES__ . '/includes/footer.inc.php'); ?>
