<?php require(__DOCROOT__ . __EXAMPLES__ . '/includes/header.inc.php'); ?>
	<?php $this->RenderBegin(); ?>

    <div class="instructions">
        <div class="instruction_title">QGoogleMap</div>
        <p><b>QGoogleMap</b> will draw a Google Map using the provided API key. An API key needs to be generated for the domain you plan to use this control on.</p>
        <p><b>Attributes:</b></p>
        <ul>
            <li>AddAddress() takes three parameters - Address, Info Window Text, Menu Link Text</li>
            <li>MapKey: STRING Default = </li>
            <li>MapWidth: INTEGER Default = 500</li>
            <li>MapHeight: INTEGER Default = 300</li>
            <li>MapZoom: INTEGER Default = 13</li>
            <li>IconStyle: STRING Default = GT_FLAT<ul><li>Other Options:</li><li>FLAG</li><li>GT_PILLOW</li><li>HOUSE</li><li>PIN</li><li>PUSH_PIN</li><li>STAR</li></ul></li>
            <li>IconColor: STRING Default = PACIFICA<ul><li>Other Options:</li><li>YOSEMITE</li><li>MOAB</li><li>GRANITE_PINE</li><li>DESERT_SPICE</li><li>TAHITI_SEA</li><li>POPPY</li><li>NAUTICA</li><li>SLATE</li></ul></li>
            <li>MapControl: STRING Default = SMALL_PAN_ZOOM<ul><li>Other Options:</li><li>NONE</li><li>LARGE_PAN_ZOOM</li><li>SMALL_ZOOM</li></ul></li>
            <li>ContinuousZoom: BOOLEAN Default=FALSE</li>
            <li>DoubleClickZoom: BOOLEAN Default=FALSE</li>
            <li>MapScale: BOOLEAN Default=TRUE</li>
            <li>MapInset: BOOLEAN Default=FALSE</li>
            <li>MapType: BOOLEAN Default=FALSE</li>
        </ul>
    </div>
	<?php $this->objMap->Render(); ?>

	<?php $this->RenderEnd(); ?>
<?php require(__DOCROOT__ . __EXAMPLES__ . '/includes/footer.inc.php'); ?>