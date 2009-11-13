<?php require(__DOCROOT__ . __EXAMPLES__ . '/includes/header.inc.php'); ?>
    <?php $this->RenderBegin(); ?>
    
    <div class="instructions">
        <h1 class="instruction_title">SMS Text Example</h1>
        <p>This is an example using QSmsMessage. It allows you to send text messages to mobile phones 
        using the QEmailServer's functionality.</p>
    </div>

    <h2>SMS Text Example</h2>

    <p><?php $this->txtMobileNumber->RenderWithName(); ?></p>
    <p><?php $this->lstCarrier->RenderWithName(); ?></p>
    <p><?php $this->btnSendText->Render(); ?></p>   

    <?php $this->RenderEnd(); ?>
<?php require(__DOCROOT__ . __EXAMPLES__ . '/includes/footer.inc.php'); ?>