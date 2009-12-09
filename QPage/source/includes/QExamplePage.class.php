<?php
class QExamplePage extends QPage {
	// Here we set the default page header and footer
	protected $strPageFooter = '';
	protected $strPageHeader = '';
	
	protected function Form_Create() {
		parent::Form_Create();
		$this->PageTitle = QApplication::Translate(Examples::PageName()." - QCubed PHP 5 Development Framework - Examples");
		$this->Description = QApplication::Translate(
			Examples::PageName()." - QPage Example"
		);
		// We are actually reintroducing these, they are called in a normal QForm but were stripped out of QPage.
		$this->AddJavascriptFile('qcubed.js');
		$this->AddJavascriptFile('logger.js');
		$this->AddJavascriptFile('event.js');
		$this->AddJavascriptFile('post.js');
		$this->AddJavascriptFile('control.js');
		$this->AddCSSFile('styles.css');

		QApplication::ExecuteJavaScript("function ViewSource(intCategoryId, intExampleId, strFilename) {
				var fileNameSection = '';
				if (arguments.length == 3) {
					fileNameSection = '/' + strFilename;
				}
				var objWindow = window.open('__EXAMPLES__/view_source.php/' + intCategoryId + '/' + intExampleId + fileNameSection, 'ViewSource', 'menubar=no,toolbar=no,location=no,status=no,scrollbars=yes,resizable=yes,width=1000,height=750,left=50,top=50');
				objWindow.focus();
			}");

		$this->strPageHeader = ?><div id="page">
			<div id="header">
				<div id="headerLeft">
					<?php if(isset($mainPage)) { ?>
					<div id="codeVersion"><span class="headerSmall">QCubed Examples - <?php _p(QCUBED_VERSION); ?></span></div>
					<?php } ?>
					<?php if(!isset($mainPage)) { ?>
					<div id="categoryName"><span class="headerSmall"><?php _p((Examples::GetCategoryId() + 1) . '. ' . Examples::$Categories[Examples::GetCategoryId()]['name'], false); ?></span></div>
					<?php } ?>
					<div id="pageName"><?php _p(Examples::PageName(), false); ?></div>
					
					<div id="pageLinks"><span class="headerSmall">
					<?php if(!isset($mainPage)) { ?>
						<?php _p(Examples::PageLinks(), false); ?>
					<?php } else { ?>
							<strong><a class="headerLink" href="http://qcu.be">QCubed website</a></strong>
					<?php } ?>
					</span></div>
				</div>
				<div id="headerRight">
					<?php if(!isset($mainPage)) { ?>
						<div id="viewSource"><a href="javascript:ViewSource(<?php _p(Examples::GetCategoryId() . ',' . Examples::GetExampleId()); ?>);">View Source</a></div>
		<!--				<a href="#" onclick="window.open('http://localhost/validator/htdocs/check?uri=<?php _p(urlencode('http://qcodo/' . QApplication::$RequestUri)); ?>'); return false;" style="color: #ffffff;">Validate</a>-->
						<div id="willOpen"><span class="headerSmall">will open in a new window</span></div>
					<?php } ?>
				</div>
			</div>
			<div id="content"><?php ;
		$this->strPageFooter = '</div>
			<div id="footer">
				<div id="footerLeft"><a href="http://qcu.be/" title="Visit the QCubed Homepage"><img src="'.__VIRTUAL_DIRECTORY__.__IMAGE_ASSETS__.'"/qcubed_logo_footer.png" alt="QCubed - A Rapid Prototyping PHP5 Framework" /></a></div>
				<div id="footerRight">
					<div><span class="footerSmall">For more information, please visit the QCubed website at <a href="http://www.qcu.be/" class="footerLink">http://www.qcu.be/</a></span></div>
					<div><span class="footerSmall">Questions, comments, or issues can be discussed at the <a href="http://qcu.be/forum" class="footerLink">Examples Site Forum</a></span></div>
				</div>
			</div>
		</div>
		<script type="text/javascript">
		var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
		document.write(unescape("%3Cscript src=\'" + gaJsHost + "google-analytics.com/ga.js\' type=\'text/javascript\'%3E%3C/script%3E"));
		</script>
		<script type="text/javascript">
		try {
		var pageTracker = _gat._getTracker("UA-7231795-1");
		pageTracker._trackPageview();
		} catch(err) {}
		</script>';
	}

	public function RenderBegin($blnDisplayOutput = true) {
		// Ensure that RenderBegin() has not yet been called
		switch ($this->intFormStatus) {
			case QFormBase::FormStatusUnrendered:
				break;
			case QFormBase::FormStatusRenderBegun:
			case QFormBase::FormStatusRenderEnded:
				throw new QCallerException('$this->RenderBegin() has already been called');
				break;
			default:
				throw new QCallerException('FormStatus is in an unknown status');
		}
		// Update FormStatus and Clear Included JS/CSS list
		$this->intFormStatus = QFormBase::FormStatusRenderBegun;
		
		
		$strToReturn = '';
		$strToReturn .= $this->HtmlHead();
		$strToReturn .= $this->HtmlBodyBegin();
		$strToReturn .= $this->HtmlFormBegin();
		// Header
		$strToReturn .= $this->strPageHeader;
		
		// Perhaps a strFormModifiers as an array to
		// allow controls to update other parts of the form, like enctype, onsubmit, etc.

		// Return or Display
		if ($blnDisplayOutput) {
			print($strToReturn);
			return null;
		} else
			return $strToReturn;
	}

	// Override the default QPage RenderEnd function to add page footer
	public function RenderEnd($blnDisplayOutput = true) {
		// Ensure that RenderEnd() has not yet been called
		switch ($this->intFormStatus) {
			case QFormBase::FormStatusUnrendered:
				throw new QCallerException('$this->RenderBegin() was never called');
			case QFormBase::FormStatusRenderBegun:
				break;
			case QFormBase::FormStatusRenderEnded:
				throw new QCallerException('$this->RenderEnd() has already been called');
				break;
			default:
				throw new QCallerException('FormStatus is in an unknown status');
		}

		
		$strToReturn = '';	
		
		
		// Footer
		$strToReturn .= $this->strPageFooter;
		$strToReturn .= $this->HtmlFormEnd();
		$strToReturn .= $this->WriteEndScripts();
		$strToReturn .= "\r\n</div></body></html>";

		// Update Form Status
		$this->intFormStatus = QFormBase::FormStatusRenderEnded;

		// Display or Return
		if ($blnDisplayOutput) {
			print($strToReturn);
			return null;
		} else
			return $strToReturn;
	}
}
?>