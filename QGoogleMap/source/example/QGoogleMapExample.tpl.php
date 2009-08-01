<?php require(__DOCROOT__ . __EXAMPLES__ . '/includes/header.inc.php'); ?>
	<?php $this->RenderBegin(); ?>

    <div class="instructions">
        <div class="instruction_title">QGoogleMap</div>
        <p><strong>QGoogleMap</strong> will draw a Google Map using the provided API key. An API key needs to be generated for the domain you plan to use this control on.</p>
        <p><strong>Attributes:</strong></p>
        <ul>
            <li>AddAddress() takes three parameters - Address, Info Window Text, Menu Link Text</li>
            <li>MapKey: The unique API key for your domain. STRING</li>
            <li>MapSensor: Set this to true if you use a GPS sensor to gather data. BOOLEAN Default = FALSE</li>
            <li>MapWidth: Map Width. INTEGER Default = 500</li>
            <li>MapHeight: Map Height. INTEGER Default = 300</li>
            <li>MapZoom: Zoom Level. INTEGER Default = 13</li>
            <li>IconStyle: Which marker to use. STRING Default = GT_FLAT<ul><li>Other Options:</li><li>FLAG</li><li>GT_PILLOW</li><li>HOUSE</li><li>PIN</li><li>PUSH_PIN</li><li>STAR</li></ul></li>
            <li>IconColor: Color scheme to use. STRING Default = PACIFICA<ul><li>Other Options:</li><li>YOSEMITE</li><li>MOAB</li><li>GRANITE_PINE</li><li>DESERT_SPICE</li><li>TAHITI_SEA</li><li>POPPY</li><li>NAUTICA</li><li>SLATE</li></ul></li>
            <li>MapControl: The map control system. STRING Default = SMALL_PAN_ZOOM<ul><li>Other Options:</li><li>NONE</li><li>LARGE_PAN_ZOOM</li><li>SMALL_ZOOM</li></ul></li>
            <li>ContinuousZoom: Toggle continuous zoom. BOOLEAN Default=FALSE</li>
            <li>DoubleClickZoom: Toggle double-click zoom. BOOLEAN Default=FALSE</li>
            <li>MapScale: Show/Hide the map scale. BOOLEAN Default=TRUE</li>
            <li>MapInset: Show/Hide the map inset. BOOLEAN Default=FALSE</li>
            <li>MapType: Show/Hide the map type switcher. BOOLEAN Default=FALSE</li>
        </ul>
    </div>
	<?php $this->objMap->Render(); ?>

	<?php $this->RenderEnd(); ?>
<?php require(__DOCROOT__ . __EXAMPLES__ . '/includes/footer.inc.php'); ?>