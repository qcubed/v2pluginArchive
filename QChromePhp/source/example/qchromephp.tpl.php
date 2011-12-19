<?php require(__DOCROOT__ . __EXAMPLES__ . '/includes/header.inc.php'); ?>


<div id="nunz_page_wrapper">
<?php
    $this->RenderBegin();
?>
    <div class="instructions">
            <h1 class="instruction_title">QChromePhp: debugging with Chrome</h1>
            
            <b>QChromePhp</b> is a wrapper for the Google Chrome extension  <a href="http://www.chromephp.com">ChromePhp</a>. QChromePhp works very similar as QFirebug which includes database profiling. To get these examples running you 
            need Google Chrome and the extension ChromePhp installed. If you switch on the extension and no console is appearing it might help to push the F12 button. 
            <br/>
            <br/>
            Button 'Server' shows functions QChromePhp::log() and QChromePhp::warn() QChromePhp::error() for a server call. 
            <br/>
            <br/>
            Button 'Ajax' shows functions QChromePhp::log() and QChromePhp::warn() QChromePhp::error() for an Ajax call. 
            <br/>
            <br/>
            Button 'Test DB Profiling' shows how to use database profiling.
            <br/>
            <br/>
            You may find that you get an error message complaining about a maximum cookie size of 4kb. If you need to get around that limit use the function QChromePhp::useFile().
            Plesae find documentation for this function (section 'File Storage') at the <a href="http://www.chromephp.com">ChromePhp</a> site.
            
    </div>
<?php

    
    $this->btnAjax->Render();
    $this->btnServer->Render();
    $this->btnDB->Render();

    $this->RenderEnd();
?>

</div>

<?php require(__DOCROOT__ . __EXAMPLES__ . '/includes/footer.inc.php'); ?>