<?php
	require('../../../../includes/configuration/prepend.inc.php');

	QForm::$FormStateHandler = 'QSessionFormStateHandler';

	class SwfExample extends QForm {
		protected $swfLocalExample;
		protected $swfRemoteExample;
			
		protected function Form_Create() {
			// This will load a SWF file stored locally
            // setup our SwfObject
			$this->swfLocalExample = new QSwfObject($this);
            // set height and width
            $this->swfLocalExample->Width = 200;
            $this->swfLocalExample->Height = 200;
            // set URL of our SWF file
            $this->swfLocalExample->SwfUrl = 'test.swf';
            // Example of how to set flashvars
            $this->swfLocalExample->AddFlashvars('test', 'test');
            // Example of how to set attributes 
            // wmode sets background as transparent
            $this->swfLocalExample->AddAttributes('wmode', 'opaque');
            
            // Now let's load a SWF file from YouTube
            $this->swfRemoteExample = new QSwfObject($this);
            // set height and width
            $this->swfRemoteExample->Width = 425;
            $this->swfRemoteExample->Height = 344;
            // set URL of our SWF file
            $this->swfRemoteExample->SwfUrl = 'http://www.youtube.com/v/zTkstHr57wQ&hl=en&fs=1&';
            // Example of how to set flashvars
            $this->swfRemoteExample->AddFlashvars('test', 'test');
            // Example of how to set attributes 
            // wmode sets background as transparent
            $this->swfRemoteExample->AddAttributes('allowscriptaccess', 'always');
            $this->swfRemoteExample->AddAttributes('allowfullscreen', 'true');
									
		}

	}

	// And now run our defined form
	SwfExample::Run('SwfExample');
?>