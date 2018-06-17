<?php
			$doc = new DOMDocument();
			$doc->preserveWhiteSpace = false ;
			$doc->load('invoice.xml');
			$root = $doc->firstChild;
			$descrip= $_GET['description'];
			$pri = $_GET['price'];
			$quanti = $_GET['quantity'];
		
			$items=$root->childNodes->item(4);

			$sub=$quanti*$pri;
			
				
				echo $descrip."<BR>";
				echo $pri."<BR>";
				echo $quanti."<BR>";

			$item = $doc->createElement('item');
			$desc = $doc->createElement('desc');
			$price = $doc->createElement('price');
			$quantity = $doc->createElement('quantity');
			$subtotal = $doc->createElement('subtotal');

			$desc_text =$doc->createTextNode($descrip);
			$price_text =$doc->createTextNode($pri);
			$quantity_text =$doc->createTextNode($quanti);
			$subtotal_text =$doc->createTextNode($sub);


			$desc->appendChild($desc_text);
			$price->appendChild($price_text);
			$quantity->appendChild($quantity_text);
			$subtotal->appendChild($subtotal_text);

			$item->appendChild($desc);
			$item->appendChild($price);
			$item->appendChild($quantity);
			$item->appendChild($subtotal);

			$items->appendChild($item);

			$root-> appendChild($items);

			$doc->formatOutput = true;
			$doc->save('invoice.xml');

			?>
			<script type="text/javascript">
           window.location.href = "invoice.php";
 </script>