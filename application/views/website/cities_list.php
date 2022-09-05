<?php
	$cityData = $this->Businesslistings_model->listOfCities($whereArr = 0);
	echo json_encode($cityData);
?>