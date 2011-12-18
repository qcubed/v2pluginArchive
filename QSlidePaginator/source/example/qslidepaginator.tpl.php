<?php require(__DOCROOT__ . __EXAMPLES__ . '/includes/header.inc.php'); ?>
    <?php $this->RenderBegin(); ?>

    <div class="instructions">
        <h1 class="instruction_title">QSlidePagination</h1>
        If we have a lot of pages (10+), standard paginator can be sometimes 
        unpractical, because it shows only up to ten direct links. This can be changed,
        but if we have a lot of pages shown in header, then the form itself is vast.<br/><br/>

        QSlidePagination is handy, because it introduces a text field in which
        page number can be entered. Page change is triggered on change and on enter
        key press. Also, it has a slider (based on the jquery ui slider control),
        with which we can slide among pages; and also links to previous, next, first and last page.
    </div>

        <?php $this->dtgPersons->Render(); ?>

    <?php $this->RenderEnd(); ?>
<?php require(__DOCROOT__ . __EXAMPLES__ . '/includes/footer.inc.php'); ?>
