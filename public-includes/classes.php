<?php

interface DBConnects{
	public function getData($table);  
	public function getDataByID($id);
	public function deleteData($table);
	public function deleteDataByID($id);
}