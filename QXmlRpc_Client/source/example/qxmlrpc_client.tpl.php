<?php require(__DOCROOT__ . __EXAMPLES__ . '/includes/header.inc.php'); ?>
	<?php $this->RenderBegin(); ?>

	<div class="instructions">
		<h1 class="instruction_title">Getting information accross XML-RPC</h1>
		
		<p><b>QXmlRpc_Client</b> provides a client for XML-RPC based web services, as defined
		in <a target='_blank' href="http://phpxmlrpc.sourceforge.net/">this specification</a>. If
		the server you need to talk to responds to XML-RPC, you'll save yourself
		a bunch of time if you use this plugin.</p>
		
		<p>To look into how the plugin works in detail, let's consider a sample web service
		defined at <a href="http://phpxmlrpc.sourceforge.net/server.php?methodName=examples.getStateName" target="_blank">http://phpxmlrpc.sourceforge.net/server.php?methodName=examples.getStateName</a>.
		This example is really simple: given a number from 1 to 51, the service returns the name
		of the USA state that has that "id". If you enter a number outside of that range, the
		service returns an error. Go ahead and experiment with it in the text box below.</p>
		
		<p>Let's now look at how to use the client. It's really straightforward - first,
		initialize a <b>QXmlRpc_Client</b> object. Then, create an array of parameters
		that you want to pass to the web service. Each parameter has to be wrapped with a
		QXmlRpc_Client::prepare() call to format the parameters appropriately. 
		
        <div style="padding-left: 50px">
            <code>
				$aParams = array( QXmlRpc_Client::prepare((int) $this->txtState->Text) );
			</code>
		</div>
			
		<p>Then, make the actual request - note that requests are synchronous (i.e. execution
		will go to the next line of code after you get the actual response). That said, if
		you are making the call in a <b>QAjaxAction</b>, the QForm will still be responsive
		to the user.</p>

        <div style="padding-left: 50px">
            <code>
				list($success, $response) = $client->request(<br>
			</code>
			<div style="padding-left: 20px">
				<code>
				'phpxmlrpc.sourceforge.net', // server name<br>
				'/server.php', // server endpoint<br>
				'examples.getStateName',// method name<br>
				$aParams // parameters that we prepared above
				</code>
			</div>
			<code>
				);
			</code>
		</div>

		<p>Result of making a request is a key-value pair. The first variable
		is a boolean that indicates success or failure; the second one is
		an array with the details.</p>
		
	</div>	 		

		<?php $this->txtState->RenderWithName(); ?>
		<?php $this->btnRequest->Render() ?>
		<br/>
		<?php $this->lblResults->Render(); ?>

<?php $this->RenderEnd(); ?>				

<?php require(__DOCROOT__ . __EXAMPLES__ . '/includes/footer.inc.php'); ?>