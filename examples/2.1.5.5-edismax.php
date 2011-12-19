<?php

require('init.php');
htmlHeader();

// create a client instance
$client = new Solarium\Client\Client($config);

// get a select query instance
$query = $client->createSelect();

// get the dismax component and set a boost query
$dismax = $query->getDisMax();

// override the default setting of 'dismax' to enable 'edismax'
$dismax->setQueryParser('edismax');

// this query is now a dismax query
$query->setQuery('memory -printer');

// this executes the query and returns the result
$resultset = $client->select($query);

// display the total number of documents found by solr
echo 'NumFound: '.$resultset->getNumFound();

// show documents using the resultset iterator
foreach ($resultset as $document) {

    echo '<hr/><table>';

    // the documents are also iterable, to get all fields
    foreach($document AS $field => $value)
    {
        // this converts multivalue fields to a comma-separated string
        if(is_array($value)) $value = implode(', ', $value);

        echo '<tr><th>' . $field . '</th><td>' . $value . '</td></tr>';
    }

    echo '</table>';
}

htmlFooter();