<?php require(__DOCROOT__ . __EXAMPLES__ . '/includes/header.inc.php'); ?>
	<?php $this->RenderBegin(); ?>

	<div class="instructions">
		<h1 class="instruction_title">QObjectDiff: What fields changed in my form?</h1>

		<p>What if you want to easily tell which fields have changed in your form after the 
		user has saved it? What if you need it for some kind of logging, or an audit trail?
		<strong>QObjectDiff</strong> lets you do exactly that.</p>
		
		<p>Imagine that you have a form that allows different members of a team to edit project
		details; you want to keep a log of all project detail modifications, so that at the
		end of the project, you could easily tell how the dates/budgets/other things have
		changed over time. So, you present the user with just a simple form - the form below;
		when they click on Save, you pass both the old AND the modified instances of the
		Project object to <strong>QObjectDiff</strong>, and it returns a detailed report on
		what fields, if any, have changed. It also tells you what the old and new values of
		those fields are, so that you can write it out nicely to your audit trail.</p>
		
		<p>Note that <strong>QObjectDiff</strong> can be used to compare the state of CodeGen-generated
		ORM objects, or to compare two custom objects of any class.</p>
		
		<p>There are two important limitations:</p>
		<ul>
			<li><strong>QObjectDiff</strong> cannot compare private fields between the objects. This is a
			fundamental limitation of reflection in PHP5.</li>
			<li><strong>QObjectDiff</strong> compares the values of the actual objects only - not child
			objects. If you want to compare child objects, you'll have to call
			<strong>QObjectDiff::Compare()</strong>on them explicitly.</li>
		</ul>
	</div>
		
		<div><span>First name:</span><br /><?php $this->txtFirstName->Render() ?></div>
		<div><span>Last name:</span><br /><?php $this->txtLastName->Render() ?></div>
		
		<div><?php $this->btnCompare->Render() ?></div>
		
		<p><?php $this->lblComparisonResult->Render() ?></p>

<?php $this->RenderEnd(); ?>
<?php require(__DOCROOT__ . __EXAMPLES__ . '/includes/footer.inc.php'); ?>
