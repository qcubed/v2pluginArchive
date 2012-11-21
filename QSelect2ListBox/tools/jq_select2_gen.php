<?php
require('jq_control.php');


class Select2JqDoc extends JqDoc
{
    public $descriptionLine = 3000;
    public $hasDisabledProperty = false;

    public function __construct($strUrl)
    {
        parent::__construct('Select2', 'select2', 'QSelect2', 'QListBox');
        $this->options[] = new Option('ContainerWidth', 'width', 'string', 'copy', 'Controls the width style attribute of the Select2 container div. The following values are supported: "off", "element", "copy", "resolve"');
        $this->options[] = new Option('MinimumInputLength', 'minimumInputLength', 'Integer', '', 'Number of characters necessary to start a search');
        $this->options[] = new Option('MinimumResultsForSearch', 'minimumResultsForSearch', 'Integer', '', 'The minimum number of results that must be initially (after opening the dropdown for the first time) populated in order to keep the search field. This is useful for cases where local data is used with just a few results, in which case the search box is not very useful and wastes screen space. ');
        $this->options[] = new Option('MaximumSelectionSize', 'maximumSelectionSize', 'Integer', '', ' The maximum number of items that can be selected in a multi-select control. If this number is less than 1 selection is not limited. Once the number of selected items reaches the maximum specified the contents of the dropdown will be populated by the formatSelectionTooBig function');
        $this->options[] = new Option('Placeholder', 'placeholder', 'string', '', 'Initial value that is selected if no other selection is made. The placeholder can also be specified as a data-placeholder attribute on the select or input element that Select2 is attached to.');
        $this->options[] = new Option('Separator', 'separator', 'string', '', 'Separator character or string used to delimit ids in value attribute of the multi-valued selects. The default delimiter is the , character. ');
        $this->options[] = new Option('AllowClear', 'allowClear', 'Boolean', '', 'Whether or not a clear button is displayed when the select box has a selection. The button, when clicked, resets the value of the select box back to the placeholder, thus this option is only available when the placeholder is specified. ');
        $this->options[] = new Option('CloseOnSelect', 'closeOnSelect', 'Boolean', '', 'If set to false the dropdown is not closed after a selection is made, allowing for rapid selection of multiple items. By default this option is disabled. ');
        $this->options[] = new Option('OpenOnEnter', 'openOnEnter', 'Boolean', '', 'If set to true the dropdown is opened when the user presses the enter key and Select2 is closed. By default this option is enabled. ');
        $this->options[] = new Option('Matcher', 'matcher', 'function', '', 'Used to determine whether or not the search term matches an option when a built-in query function is used. The built in query function is used when Select2 is attached to a select, or the local or tags helpers are used. ');
        $this->options[] = new Option('FormatSelection', 'formatSelection', 'function', '', 'Function used to render the current selection.');
        $this->options[] = new Option('FormatResult', 'formatResult', 'function', '', 'Function used to render a result that the user can select. ');
        $this->options[] = new Option('FormatResultCssClass', 'formatResultCssClass', 'function', '', 'Function used to add css classes to result elements ');
        $this->options[] = new Option('FormatNoMatches', 'formatNoMatches', 'function', '', 'Function used to render the "No matches" message');
        $this->options[] = new Option('FormatSearching', 'formatSearching', 'function', '', 'Function used to render the "Searching..." message that is displayed while search is in progress ');
        $this->options[] = new Option('FormatInputTooShort', 'formatInputTooShort', 'function', '', 'Function used to render the "Search input too short" message ');
        $this->options[] = new Option('FormatSelectionTooBig', 'formatSelectionTooBig', 'function', '', 'Function used to render the "You cannot select any more choices" message ');
        $this->options[] = new Option('FormatLoadMore', 'formatLoadMore', 'function', '', 'Function used to render the "Loading more results..." message ');
        $this->options[] = new Option('CreateSearchChoice', 'createSearchChoice', 'function', '', 'Creates a new selectable choice from user's search term. Allows creation of choices not available via the query function. Useful when the user can create choices on the fly, eg for the 'tagging' usecase. ');
        $this->options[] = new Option('InitSelection', 'initSelection', 'function', '', 'Called when Select2 is created to allow the user to initialize the selection based on the value of the element select2 is attached to. ');
        $this->options[] = new Option('Tokenizer', 'tokenizer', 'function', '', 'A tokenizer function can process the input typed into the search field after every keystroke and extract and select choices. This is useful, for example, in tagging scenarios where the user can create tags quickly by separating them with a comma or a space instead of pressing enter. ');
        $this->options[] = new Option('TokenSeparators', 'tokenSeparators', 'array', '', 'An array of strings that define token separators for the default tokenizer function. By default, this option is set to an empty array which means tokenization using the default tokenizer is disabled. Usually it is sensible to set this option to a value similar to [",", " "]');
        $this->options[] = new Option('Query', 'query', 'function', '', 'Function used to query results for the search term. ');
        $this->options[] = new Option('Ajax', 'ajax', 'object', '', 'Options for the built in ajax query function. This object acts as a shortcut for having to manually write a function that performs ajax requests. The built-in function supports more advanced features such as throttling and dropping out-of-order responses. ');
        $this->options[] = new Option('Data', 'data', 'object', '', 'Options for the built in query function that works with arrays. ');
        $this->options[] = new Option('Tags', 'tags', 'object', '', 'Puts Select2 into 'tagging'mode where the user can add new choices and pre-existing tags are provided via this options attribute which is either an array or a function that returns an array of objects or strings');
        $this->options[] = new Option('ContainerCss', 'containerCss', 'object', '', 'Inline css that will be added to select2's container. Either an object containing css property/value key pairs or a function that returns such an object.');
        $this->options[] = new Option('ContainerCssClass', 'containerCssClass', 'object', '', 'Css class that will be added to select2's container tag ');
        $this->options[] = new Option('DropdownCss', 'dropdownCss', 'object', '', 'Inline css that will be added to select2's dropdown container. Either an object containing css property/value key pairs or a function that returns such an object.');
        $this->options[] = new Option('DropdownCssClass', 'dropdownCssClass', 'object', '', 'Css class that will be added to select2's dropdown container ');
        $this->options[] = new Option('EscapeMarkup', 'escapeMarkup', 'function', '', 'Function used to post-process markup returned from formatter functions. By default this function escapes html entities to prevent javascript injection.');
    }
}

function jq_select2_gen()
{
    $jqControlGen = new JqControlGen();
    $objJqDoc = new Select2JqDoc("http://ivaynberg.github.com/select2/#documentation");
    $jqControlGen->GenerateControl($objJqDoc);
}

jq_select2_gen();

?>
 
