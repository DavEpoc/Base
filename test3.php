<?php

class SupClass {

   public $a = 1, $b = 2, $c = 3;
   protected $var = 5;
   private $imm = 8;

   public function Hello(){

	echo "hello". $this->a . "guy";			}

   final public function Ciao(){

	echo "ciao". $this->a . "bello";			}

   public function Var0() { echo $this->var . $this->imm;}   // chiamare la funzione Var mi da' errore! posso stampare var perchè l'ho richiamato in una function non fuori direttamente.

}

$sup1 = new SupClass();
//$sup1->Hello();
$sup1->Ciao();
//echo $sup1->var; da' errore perchè var è protected!
$sup1->Var0();



class SubClass extends SupClass {

   public $d = 4, $e = 5, $f = 6;

   public function Hello(){
	parent::Hello();
	echo "hello". $this->var . "man";			}

/*   public function Ciao(){

	echo "ciao". $this->a . "pirla";			} */ //non posso sovrascrivere un final!da' errore.


}


$sub1 = new SubClass();
$sub1->Hello();
// echo $sub1->imm; da' errore che dice che non trova imm, infatti anche se SubClass è estesa a SupClass imm è privato quindi solo di SupClass!


class SubSubClass extends SubClass {

/*   public function Ciao(){

	echo "ciao". $this->a . "canaglia";			} */ //non posso sovrascrivere un final!da' errore.


}

$subsub1 = new SubSubClass();


/* classi astratte ed interface */
                                         /* se un metodo(funzione) è astratto anche la classe DEVE esserlo, la classe astratta non può avere oggetti suoi!!! */
abstract class Riferimento{

        abstract public function Posto($primo,$secondo);   
	abstract public function Bella($you,$me);

}


class Estesa extends Riferimento{

	public $primo;					/* per chiarezza : il __construct e le variabili utilizzate vanno tutti definiti nella classe che estende la classe astratta o l'interfaccia!! */
	public $secondo;				/* funzionava anche senza definire le variabili,dato che erano gia definite in __costruct e anche mettendo construct sulla classe astratta! */
	public $you;
	public $me;


	public function __construct($primo,$secondo,$you,$me){

	$this->primo = $primo;
	$this->secondo = $secondo;
	$this->you = $you;
	$this->me = $me;}

	public function Posto($primo,$secondo) {
	                                         echo $this->primo . $this->secondo;}


	public function Bella($you,$me) {   echo "bella!". $this->you. $this->me;}
}

$abs = new Estesa("PRIM","SEC","L'altro","Me stesso");

echo $abs->primo.$abs->secondo;
$abs->Posto(1,2);   /* per qualche ragione quando richiamo il metodo Posto non posso scrivere($primo,$secondo) ma ci devo mettere qualche valore a caso,perche? */

$obj = $abs;
$obj2 = clone $abs;

$abs->primo = "CASO";

echo "</br></br>";
echo $obj->primo;   /* obj è identico a abs quindi subisce il cambiamento in CASO, obj2 è una copia di abs fatta prima del cambiamento... quindi rimane PRIM!! */
echo $obj2->primo;

		    /* con type hinting posso forzare come parametro di una funzione l'insieme degli oggetti di una classe, se scrivo il nome della classe 
		       in cui stà la funzione sono validi gli oggetti di quella classe e basta.  se scrivo il nome di una classe che la classe in cui sta la funzione
		       estende sono validi gli oggetti della classe stessa ed estesa.  se scrivo il nome di una INTERFACCIA tuttavia sono validi tutti gli oggetti 
		       che estendono l'interfaccia!! */

interface BaseA {

	public function   Aram1($item1,$item2);
	public function   Aram2($item3,$item4);
}
class TypeHinting2 implements BaseA {

	public $item1=2;
	public $item2=3;

	public function Aram1($item1,$item2){ echo $this->item1; }
	public function Aram2($item3,$item4){ echo $this->item2; }

}

$objT2 = new TypeHinting2;

class TypeHinting implements BaseA {

	public $item1;
	public $item2;
	public $item3=1;
	public $item4=1;


	public function __construct($item1,$item2){

		$this->item1 = $item1;
		$this->item2 = $item2;

					}

	public function Aram1($item1,$item2){ echo $this->item1; }
	public function Aram2($item3,$item4){ echo $this->item2; }
	public function Aram3($item1,$item2){ $this->Aram1($item1,$item2);}	/* una funzione non puo tenere altre variabili oltre quelle indicate dunque non puo' rimandare a funzioni con variabili diverse */				
	public function Hint(BaseA $objT){ echo ($objT instanceof BaseA)? "si" : "no";}  /* objT non è definito, è il valore che ci metto 5 righe sotto quando richiamo la funione x un particolare oggetto! */

}

$objT1 = new TypeHinting("ciao","mamma");

$objT1-> Hint($objT1);
$objT1-> Hint($objT2); /* x quello scritto nel commentone sopra ho richiamato un oggetto della classe TypeHinting2 in una funzione di TypeHinting,
			  l'ho potuto fare poiche il type hinting indicava l'intefaccia ! alla quale entrambe le classi sono legate! */
$objT1-> Aram3(1,2);

