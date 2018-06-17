<?php
	$doc = new DOMDocument();
			$doc->preserveWhiteSpace = false ;
			$doc->load('invoice.xml');
			$root = $doc->firstChild;
			$edi = $_GET['iedit'];

			if (isset($_POST['update'])) {
				$id = $_POST['id'];
				$ds=$_POST['description'];
				$pr=$_POST['price'];
				$qn=$_POST['quantity'];
				$sub=$qn*$pr;
				$items=$root->childNodes->item(4);
				$item=$items->childNodes->item($id);

				$item->childNodes->item(0)->nodeValue=$ds;
				$item->childNodes->item(1)->nodeValue=$pr;
				$item->childNodes->item(2)->nodeValue=$qn;
				$item->childNodes->item(3)->nodeValue=$sub;
				$doc->formatOutput = true;
				$doc->save('invoice.xml');

			 echo "<script type='text/javascript'>";
   			 echo " window.location.href = 'invoice.php' ";
			 echo "</script>";
			}
			$items=$root->childNodes->item(4);
			$item=$items->childNodes->item($edi);

			$desc=$item->childNodes->item(0)->nodeValue;
			$price=$item->childNodes->item(1)->nodeValue;
			$quantity=$item->childNodes->item(2)->nodeValue;
			$subtotal=$item->childNodes->item(3)->nodeValue;


	echo "<form method='POST' action='#'>";
	echo "Description<input type='text' name='description' value='$desc'> <BR>";
	echo "Price <input type='text' name='price' value='$price' > <BR>";
	echo "Quantity <input type='text' name='quantity' value='$quantity' > <BR> ";
	echo "<input type='hidden' name='id' value='$edi'> <BR> ";
	echo "<input type='submit' name='update' value='Edit'> <BR> ";
	echo "</form> ";

?>



