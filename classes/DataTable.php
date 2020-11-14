<?php


class DataTable
{
    private $dataSet;
    private $columns;
    private $export;
    private $view;

    /**
     * DataTable constructor.
     */
    public function __construct($dataSet)
    {
        $this->dataSet = $dataSet;
    }

    /**
     * @return mixed
     */
    public function AddView()
    {
        $this->view = true;
    }

    public function AddExport()
    {
        $this->export = true;
    }

    public function addColumn($key, $humanReadableKey)
    {
        $this->columns[$key] = $humanReadableKey;
    }

    public function render($nazev)
    {
        echo ' <table class="pure-table">';
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
            if ($this->view) {
                echo "<a href='../" . $nazev . "View.php?id=$id' title='View record'><i class='far fa-eye'></i></a>";
            }
            echo "<a href='" . $nazev . "Edit.php?id=$id' title='Edit record'><i class='fas fa-edit'></i></a>";
            echo "<a href='./includes/" . $nazev . "Delete.inc.php?id=$id' title='Delete Record'><i class='far fa-trash-alt''></i></a>";
            if ($this->export) {
                echo "<a href='./includes/" . $nazev . "Export.inc.php?id=$id' title='Export record'><i class='fas fa-file-export'></i></a>";
            }
            echo "</td>";

            echo '</tr>';
        }
        echo "</tbody>";
        echo '</table>';
    }
}