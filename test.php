<?php

$h = "1Culo";
echo $ciao = "Chiappa $h !!!!";


$i = 2;
$j = 3;
$m = 1;
$k = $i + $j + $m;
$lotto = array("ombra" , $ciao , "3" , 4 );

/* comparare 2 stringhe vale (0 < 9 < A < Z < a < z) -- 
   comparare 1 stringa e un numero -> trasforma stringa in numero -> 0 se non contiene numeri all'inizio ,il numero iniziale della stringa se inizia con numero.
   comparare numeri o stringhe con valore true o false -> 0 e "0" corrispondo a false tutto il resto a true */
if ($i == 2) {echo " I Love You "; $i++;}          
$i = ($i >= 3)  ? "mamma" : "so much" ;
echo $i;

$prova = ($ciao > 9);
echo $prova;

switch ($ciao < 9)
{
case $m:
$i = 2;
if ($i == 2) {echo " I Love You "; $i++;}
$i = ($i >= 3)  ? "mamma" : "so much" ;
echo $i;
break;
case $j:
echo ($h + $k);
break;
default:
echo "NUOOOO";
break;   }

echo $lotto[$prova]; /* $prova assume il valore false, che è = a 0 quindi mi prende primo termine array */
echo $prova;         /* tuttavia essendo definito false in modo logico non vale davvero 0 quindi non lo stampa!!! */

echo "</br>".$lotto[2];

$lotto2 = array(    array("pere" => "molte" , "mele" => "poche" , "kiwi") ,
                    array("casi" => "giusti" , "problemi" => "molti"),
                    "5" );

$lotto2[5] = "hello!";
$lotto2[0][1] = "hi!";
$lotto2[] = "benin!";

echo "</br>";
echo $lotto2[1]["problemi"];
echo $lotto2[0][1];
echo $lotto2[6];

$num = count($lotto2[0]); /* ho saltato il termine 4 nell'array generale $lotto2 , usando count non me l'ha contata quella 4 vuota! */
echo $num;

echo "<div style='width:300px; height:150px; background-color:blue;'></div>";

define("CICCIA" , 1);
echo CICCIA;

$strada = "\\BELCONIGLIO\Users\Languasco Giustino\Desktop\Gioco Asylum2";
$fine_strada = basename($strada);
echo $fine_strada;

class MyClass {
 
        // proprietà
        public $a = 10;
        public $b = 20;
         
        // costruttore
        public function __construct($a, $b) {
                $this->a = $a;
                $this->b = $b;
                 
                // connessione al database interno
                //connect_to_my_db($this->a, $this->b);
        }
         
        // distruttore
        public function __destruct() {
                // operazioni di clean up...
                // chiusura del database e rilascio delle risorse
               // free_my_db();
        }
         
        // metodi
        public function sayHello() {
                echo "Hello! " . $this->a . " " . $this->b;
        }
 
}
 
// creazione delle istanze
$myClass_1 = new MyClass("username", "password");
$myClass_2 = new MyClass("con", "te");

$myClass_1 -> b = "amor";
echo $myClass_1 -> b;


class Numeri { 

    public $a=20;
    public static $b=10;
    const c='4';

    public function Successione(){ 
                         $this-> a;
			 Numeri::$b; 
			 self::c;
                         echo " io ho ". $this->a ." anni ";}
}

$helic = new Numeri();
$helic-> a=30;
$helic-> Successione();
echo Numeri::$b; 
echo Numeri::c;