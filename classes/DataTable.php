<?php


class DataTable
{

    private $dataSet;
    private $columns;

    /**
     * DataTable constructor.
     */
    public function __construct($dataSet)
    {
        $this->dataSet = $dataSet;
    }

    public function addColumn($key, $humanReadableKey)
    {
        $this->columns[$key] = $humanReadableKey;
    }

    public function render($nazev)
    {
        echo ' <table >';
        echo '<thead>';
        foreach ($this->columns as $key => $value) {
            echo '<th>' . $value . '</th>';
        }
        echo "<th>Akce</th>";

        echo '</thead>';
        echo ' <tbody>';
        foreach ($this->dataSet as $row) {
            $id = $row[array_key_first($row)];
            echo ' <tr>';
            foreach ($this->columns as $key => $value) {
                echo '<td>' . $row[$key] . '</td>';
            }
            echo "<td>";
            echo "<a href='" . $nazev . "Edit.php?id=$id' title='Edit record' data-toggle='tooltip'><i class='edit icon'></i></a>";
            echo "<a href='./includes/" . $nazev . "Delete.inc.php?id=$id' title='Delete Record' data-toggle='tooltip'><i class='trash icon'></i></a>";
            echo "</td>";

            echo '</tr>';
        }
        echo "</tbody>";
        echo '</table>';
    }
}