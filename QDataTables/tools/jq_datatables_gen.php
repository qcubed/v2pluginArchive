<?php
require('jq_control.php');


class DataTablesJqDoc extends JqDoc
{
    public $descriptionLine = 3000;
    public $hasDisabledProperty = false;

    public function __construct($strUrl)
    {
        parent::__construct('DataTables', 'dataTable', 'QDataTable', 'QSimpleTable');
        $this->options[] = new Option('Columns', 'aoColumns', 'array', '', 'Columns');
        $this->options[] = new Option('ColumnDefs', 'aoColumnDefs', 'array', '', 'Column Definitions');
        $this->options[] = new Option('Language', 'oLanguage', 'object', '', 'Language object');
        $html = file_get_html($strUrl);
        $tbody = $html->find("table[id=reference]", 0)->children(1);
        $cnt = count($tbody->children());
        for ($i = 4; $i < $cnt; $i += 2) {
            $row = $tbody->children($i);
            $name = $row->children(1)->plaintext();
            $configType = $row->children(2)->plaintext();
            if ($configType == 'Language' || $configType == 'Columns' || $configType == 'API') {
                // todo: add handling for these types
                continue;
            }
            $idx = strpos($name, '.');
            $type = 'object';
            $complexObject = $idx !== false;
            if ($complexObject) {
                $name = substr($name, 0, $idx);
            }
            if (!$complexObject && $this->has_name($name)) {
                continue;
            }
            $origName = $name;
            $description = $row->children(3)->plaintext();
//            $description = preg_replace('/\\s+/', ' ', $description);
            $row = $tbody->children($i+1);
            $detailRows = $row->find('div.column_details table tr');
            if (!$complexObject) {
                $cells = $detailRows[1]->find('td');
                $type = $cells[1]->plainText();
                if (!$type) {
                    $type = 'object';
                }
            }
            if ($type == 'boolean' && strncmp($name, 'b', 1) == 0) {
                $name = substr($name, 1);
            } else if ($type == 'array' && strncmp($name, 'aa', 2) == 0) {
                $name = substr($name, 2);
                $type = 'array[]';
            } else if ($type == 'array' && strncmp($name, 'ao', 2) == 0) {
                $name = substr($name, 2);
                $type = 'object[]';
            } else if ($type == 'array' && strncmp($name, 'as', 2) == 0) {
                $name = substr($name, 2);
                $type = 'string[]';
            } else if ($type == 'array' && strncmp($name, 'ai', 2) == 0) {
                $name = substr($name, 2);
                $type = 'integer[]';
            } else if ($type == 'array' && strncmp($name, 'a', 1) == 0) {
                $name = substr($name, 1);
                $type = 'integer[]';
            } else if ($type == 'int' && strncmp($name, 'i', 1) == 0) {
                $name = substr($name, 1);
            } else if ($type == 'string' && strncmp($name, 's', 1) == 0) {
                $name = substr($name, 1);
            } else if ($type == 'function' && strncmp($name, 'fn', 2) == 0) {
                $name = substr($name, 2);
            } else if ($type == 'object' && strncmp($name, 'o', 1) == 0) {
                $name = substr($name, 1);
            }
            $name = $this->unique_name($name);
            $cells = $detailRows[1]->find('td');
            $defaultValue = $cells[1]->plainText();
            $this->options[] = new Option($name, $origName, $type, $defaultValue, $description);
        }
    }
}

function jq_datatables_gen()
{
    $jqControlGen = new JqControlGen();
    $objJqDoc = new DataTablesJqDoc("datatables-reference.html");
    $jqControlGen->GenerateControl($objJqDoc);
}

jq_datatables_gen();

?>
 
