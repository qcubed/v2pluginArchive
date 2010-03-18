<?php require(__DOCROOT__ . __EXAMPLES__ . '/includes/header.inc.php'); ?>
	<?php $this->RenderBegin(); ?>

	<div class="instructions">
		<div class="instruction_title">Curling using QCurl</div>
		<b>QCurl</b> offers a way to use the Curl funcitonality within the QCubed framework. This is basically an implementation of a class I have found
		on this URL: http://php.net/manual/en/book.curl.php <br /><br />
		
		Using it is really simple: 
		
		<ul>
			<li>Create the QCurl class</li>
			<li>Set parameters like a proxy or wheterh you use POST or GET</li>
			<li>Run the curl call</li>
			<li>Fetch the response and display it</li>
		</ul>
		
		You may use 
		<div style="padding-left: 50px">
			<code>
				$this->crlControl = new QCurl("www.google.co.nz");<br /><br />
				
				// This would create a POST request<br />
				//$this->crlControl->setPost('param1=value1&param2=value2');<br />
				// OR as multipart for e.g. file uploads<br />
				//$params = array('param1'=>'value1','file1'='@file1');<br />
				//$this->crlControl->setPost($params);<br /><br />
				
				protected function btnCurl_Click($strFormId, $strControlId, $strParameter) {<br />
					if($this->txtProxy->Text){<br />
						$this->crlControl->useProxy(true);<br />
						$this->crlControl->setProxy($this->txtProxy->Text);<br />
					}<br />
					$this->crlControl->createCurl($this->txtURL->Text);<br />
					$this->lblHTTPStatus->Text = $this->crlControl->getHttpStatus();<br />
				}<br />
				
			</code>
		</div>
	</div>
	<br /><br /><br /><br /><br /><br />
	PROXY (leave blank if none is required): <br />
	<?php echo ""; $this->txtProxy->Render(); ?><br />
	URL: <br /> 
	<?php $this->txtURL->Render(); ?><br /><br />
	<?php $this->btnCurl->Render();?>
	<br /><br />
	HTTP Status: <?php $this->lblHTTPStatus->Render(); ?><br />
	Errors: <?php $this->lblError->Render(); ?>
	<?php $this->RenderEnd(); ?>
	<div id="responsepage" style="height: 200px; width: 1000px; overflow: auto; border-style: thin; border-width: 1px; border-style: solid">
	<?php
		echo $this->crlControl->__tostring();
	?>
	</div>

	
<?php require(__DOCROOT__ . __EXAMPLES__ . '/includes/footer.inc.php'); ?>