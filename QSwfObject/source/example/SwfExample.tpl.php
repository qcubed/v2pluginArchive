<?php require(__DOCROOT__ . __EXAMPLES__ . '/includes/header.inc.php'); ?>
	<?php $this->RenderBegin(); ?>

	<div class="instructions">
		<div class="instruction_title">SwfObject Control</div>

		<p>This example shows off the <b>QSwfObject</b> control.<br/><br/>

		This control is a QControl wrapper for the popular SwfObject javascript control. It can be used to embed 
        Flash media easily into your QForms. You can get more information on SwfObect at <a href="http://code.google.com/p/swfobject/wiki/documentation">the SwfObject wiki page</a>.  I used Alex Rabe's PHP SwfObject class as a guide. Information on Alex's class can be viewed
        at <a href="http://alexrabe.boelinger.com/2008/09/17/swfobject-21/"> Alex's blog</a>. </p>
        
        <p>Why use SwfObject to embed Flash?<br>
		<ul><li>It will detect if Flash Player is present</li>
			<li>It will verify that the correct version of Flash Player is present</li>
			<li>It Will display Alternative content if Flash Player is not present or is wrong version</li>
			<li>Can utilize Adobe Express install to get latest Flash Player</li>
			<li>Easy API to access Flash Player's attributes</li>			
		</ul>		
		</p>
        
		<p>The control is easy to use. Just instantiate a QSwfObject and set the SwfUrl property to the URL of your Flash SWF file(can be a local or a remote URL). That is the minimum that is required.</p>
		<p>This plugin copies the ExpressInstall.swf file from the SWFObect project into the images directory. It can be used as is if you plan on using the <a href="http://www.adobe.com/cfusion/knowledgebase/index.cfm?id=6a253b75" target="_blank">Adobe Express Install</a> method. The FLA and AS source files are included in the assets/plugins/QSwfObject/example/SRC/ directory if you wish to customize ExpressInstall.swf.   </p>
				
	</div>
	<div>
	<p>Local Flash file loaded</p>
	<?php $this->swfLocalExample->Render(); ?>
	</div>
	<div>
	<p>File loaded from YouTube</p>
	<?php $this->swfRemoteExample->Render(); ?>
	</div>
	
	<?php $this->RenderEnd(); ?>
<?php require(__DOCROOT__ . __EXAMPLES__ . '/includes/footer.inc.php'); ?>