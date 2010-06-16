    <div style="width: 20%; height: 100px; border: 1px solid #111; margin-right: 5px; margin-bottom: 5px; padding: 5px 2px 5px 0px; overflow: auto;  ">
   <?php echo '<ul id=ul'.$_CONTROL->pnlSortablePanel->ControlId.'>'; ?>

			<?php
        $_CONTROL->pnlSortablePanel->Render();
				foreach ($_CONTROL->pnlSortablePanel->pnlArray as $pnlOp){
          echo '<li id="'.$pnlOp->ControlId.'_li">';
          $_CONTROL->pnlSortablePanel->pnlArray[$pnlOp->ControlId]->Render();
          echo '</li>';
        }
      ?>
   </ul>
</div>