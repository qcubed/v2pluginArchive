The script jq_datatables_gen.php uses the DataTables reference documentation.
However, since the online version of the reference is an ajax based dynamic page,
we need to get a clean single page version of the reference before we can run the generator.

To get the full reference of DataTables needed by the generator:
1. Go to http://datatables.net and navigate to "Usage > Full Reference". Or directly to http://datatables.net/ref
2. Open firebug, go to console tab and run the following:
  jQuery('td.control').click()
This will expand all the rows of the reference table
3. In firebug go to the HTML tab, find the table element with id "reference",
right-click and select "Copy HTML"
4. Open a copy of datatables-reference-bare.html from this directory
5. Paste into the file, between the comments about the reference table
6. Save the file as datatables-reference.html

