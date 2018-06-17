
<?php
	
	$doc = new DOMDocument();
	$doc->preserveWhiteSpace = false ;
	$doc->load('invoice.xml');
	$root = $doc->firstChild;

	//echo "root = ".$root->nodeName."<BR>";
	$n=0;
	while (isset($root->childNodes->item($n)->nodeName)) {
		//echo $root->childNodes->item($n)->nodeName."<BR>";
		$mb=0;
		if ($root->childNodes->item($n)->nodeName=="trackingNumber") {
			$trackingNumber=$root->childNodes->item($n);
		}
		else if ($root->childNodes->item($n)->nodeName=="billTo") {
			$billTo=$root->childNodes->item($n);
		}
		else if (($root->childNodes->item($n)->nodeName)=="date") {
			$date=$root->childNodes->item($n);
		}
		else if (($root->childNodes->item($n)->nodeName)=="items") {
			$items=$root->childNodes->item($n);
		}
		else if (($root->childNodes->item($n)->nodeName)=="delivery") {
			$delivery=$root->childNodes->item($n);
		}
		$n++;
	}
	echo "Track No : ".$trackingNumber->nodeValue."<BR>";
	$k=0;
	$address="";
	while (isset($billTo->childNodes->item($k)->nodeName)) {
		$nam=$billTo->childNodes->item($k);
		$k++;
		$kr=0;
		while (isset($nam->childNodes->item($kr)->nodeValue)) {
			if ($nam->nodeName=="name") {
				$nameBill=$nam->childNodes->item($kr)->nodeValue;
			}
			else if ($nam->nodeName=="address") {
				$adrs=$nam->childNodes->item($kr)->nodeValue." ";
				$address=$address.$adrs;
			}
			$kr++;
		}
	}
	echo "Bill To : ".$nameBill."<BR>";
	echo "Address  : ".$address."<BR>";
	echo "Invoice date : ".$date->nodeValue. "<BR>";
	echo "Detail : <BR>";
	$ph=0;
	while (isset($items->childNodes->item($ph)->nodeName)) {
		$item[$ph]=$items->childNodes->item($ph);
		$jr=0;
		while (isset($item[$ph]->childNodes->item($jr)->nodeName)) {
			if ($item[$ph]->childNodes->item($jr)->nodeName=="desc") {
				$desc[$ph]=$item[$ph]->childNodes->item($jr)->nodeValue;
			}
			else if ($item[$ph]->childNodes->item($jr)->nodeName=="price") {
				$price[$ph]=$item[$ph]->childNodes->item($jr)->nodeValue;
			}
			else if (($item[$ph]->childNodes->item($jr)->nodeName)=="quantity") {
				$quantity[$ph]=$item[$ph]->childNodes->item($jr)->nodeValue;
			}
			else if (($item[$ph]->childNodes->item($jr)->nodeName)=="subtotal") {
				$subtotal[$ph]=$item[$ph]->childNodes->item($jr)->nodeValue;
			}	
			$jr++;
		}
		$ph++;
	}
	$pointer=$jr;
	?>

<html>
<body>
<table border="1" width="100%">
	<th>item description </th>
	<th>price</th>
	<th> quantity</th>
	<th> Sub-Total	</th>
	<th> Edit	</th>
		<?php  
			for ($eq=0; $eq < count($price); $eq++) {
			
			echo "<tr>";
			echo "<td>".($eq+1).".".$desc[$eq]."</td>"."<td>".$price[$eq]."</td>";
			echo "<td>".$quantity[$eq]."</td>"."<td>".$subtotal[$eq]."</td>";
			echo "<td> <a href='edit.php?iedit=".$eq."'>Edit</a>";
			echo "<a href='delete.php?del=".$eq."'>   Delete</a></td>";
			echo "</tr>";	
			}
		?>
</table>
<?php
 echo "Shiping option : ".$delivery->nodeValue;

	echo "<table  width='50%'>";
	echo "<form method='get' action='invoiceadd.php'>";
	echo " <tr><td>Description </td><td><input type='text' name='description'></td></tr>";
	
	echo "<tr><td> Price </td><td><input type='text' name='price'></td></tr>";
	echo "<tr><td> Quantity </td><td><input type='text' name='quantity'> </td></tr>";
	echo "<input type='hidden' name='pointer' value='$pointer'>";
	echo "<tr><td></td><td><input type='submit' name='add' value='Add'></td></tr> <BR> ";
echo "</form> ";
echo "</table> ";
echo "</body> ";
echo "</html>";
?>


