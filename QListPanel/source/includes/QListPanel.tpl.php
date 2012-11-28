<?php

/**
 * All controls of this QListPanel object
 * @var QControl 
 */
$objChildArray = $_CONTROL->GetChildControls();
foreach($objChildArray as $objChild) {
?>
<li>
	<?php
		$objChild->Render();
	?>
</li>
<?php
}
?>
