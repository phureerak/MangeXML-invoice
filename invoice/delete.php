<?php
	echo "<HTML>";
	echo "<body>";
	$doc = new DOMDocument();
			$doc->preserveWhiteSpace = false ;
			$doc->load('invoice.xml');
			$root = $doc->firstChild;


			if($_GET['del']!=NULL){
				$id = $_GET['del'];
				$items=$root->childNodes->item(4);
				$item=$items->childNodes->item($id);
				$items->removeChild($item);
				$doc->formatOutput = true;
				$doc->save('invoice.xml');
			}

?>


<script type="text/javascript">
           window.location.href = "invoice.php";
 </script>