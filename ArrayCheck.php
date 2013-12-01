<?php

/* lo strumento consente alcuni controlli su array, l'array deve passare come propietà di una istanza ,
   deve inoltre essere richiamato il metodo AllCheck() per l'istanza stessa                             */

/* lo strumento consente l'attivazione/disattivazione dei singoli check dentro AllCheck(), per accedervi
   PROSEGUIRE A FONDO PAGINA                                                                            */

/* il controllo InitArr() per analisi di array dentro array,se attivato, è virtualmente limitato solo  
   dal numero di array annidati:FARE ATTENZIONE!                                                        */

class StartCtrl {

	

	public $num2;
	public $num3;
	public $num4;
	public $num5;
	public function num(){$this->num2 = count($this->arr)   -1;// echo $this->num2;
			      $this->num3 = count($this->cont2) -1;// echo $this->num3;
			      $this->num4 = count($this->key2)  -1;// echo $this->num4;
			      $this->num5 = count($this->key3)  -1;// echo $this->num5;
			      }

	public $cont2 = array();
	public $key2 = array();
	public $key3 = array();



	public $arr;
	protected $obb;

	public function __construct($input)  {
			$this->arr = $input;
			$this->FatalError($input);
				             }
			
	protected function   FatalError($input) {
			if(is_array($this->arr)) {$this->trova(); $this->num();$this->ArrCongruence();}					 
			else {echo 'Il parametro di input non è un array!!';}
					     }
						
	protected function ArrCongruence()      {
			if($this->num2 == $this->num3 && $this->num3 == $this->num4){$this->obb = true;}
			else{echo 'Alcuni dati di chiavi o contenuti non reperiti';}								
				             }

	protected function trova() 	     { 
			foreach($this->arr as $this->key => $this->cont) {	    
				$this->cont2[] = $this->cont;
				$this->key2[] = $this->key;
									 }
				             }

	protected function ordina()	     {
			echo '</br>'.'(';
	                for($boh=0;$boh<=$this->num2;$boh++){ 
                        if($boh!=$this->num2){echo '"' . $this->key2[$boh] . '" =: '  .  $this->cont2[$boh] . ',' . '</br>';}
                        else if($boh==$this->num2){echo '"' . $this->key2[$boh] . '" =: '  .  $this->cont2[$boh] . ')' . '</br>';}}
				             }

	protected function AxeptOutputordina()  {
			echo '</br>'.'(';
	                for($boh=0;$boh<=$this->num2;$boh++){ 
                        if($boh!=$this->num2){echo '"' . $this->key3[$boh] . '" =: '  .  $this->cont2[$boh] . ',' . '</br>';}
                        else if($boh==$this->num2){echo '"' . $this->key3[$boh] . '" =: '  .  $this->cont2[$boh] . ')' . '</br>';}}
				             }
}

class ClassText extends StartCtrl { 

	private $Upper;
	private $Upper2;
	public  $kind = 1;
	protected function AxeptOutput()	     {   /* l'array mette in automatico gli apici se non ci sono e ingloba in 1 2 valori uguali! */				
			foreach($this->key2 as $obj){ if($obj==""){$obj=null;}	    /* necessario perchè tali elementi non possiedono prima lettera e il check della prima lettera nell'if darebbe errore */
					       			if($this->kind == 1){
						             if(ctype_alpha($obj[0])){$this->Upper = strtoupper($obj[0]);  $this->Upper2 = str_ireplace("$obj[0]", "$this->Upper", "$obj");  $this->key3[]=$this->Upper2;}
							     else if($obj[0]=='') {$this->key3[]=$obj; echo '</br>' . "La prima lettera del Key $obj dell array deve essere una lettera maiuscola A-Z invece è [0-9] o vuota";}
						             else  {$this->key3[]=$obj; echo '</br>' . "La prima lettera del Key $obj dell array deve essere una lettera maiuscola A-Z invece è $obj[0]!";}
							                       	    }
							   else if($this->kind == 0){
						             if(ctype_alpha($obj[0])){$this->Upper = strtoupper($obj[0]);  $this->Upper2 = str_ireplace("$obj[0]", "$this->Upper", "$obj");  $this->key3[]=$this->Upper2;}
							     $this->num5 = count($this->key3) -1; /*necessario poichè num5 non è aggiornato*/
							     $this->num2 = $this->num5;
										    }
	    			                     }						
						     $this->AxeptOutputordina(); 
					     }			
				      
	protected function InitArr() 	     { 
			foreach($this->arr as $obj){ if(is_array($obj)) {  $this->arr = $obj; $this->input = $obj; $obj = 'Array'; $this->cont2 = array();
									   $this->key2 = array();  $this->key3 = array(); $this->obb = false; $this->FatalError($this->input); $this->AllChecks();}
						   }									 
					     }

	public function AllChecks() 	     { if($this->obb == true){

		//	$this->kind = 0;   /* se attiva restituisce solo i valori concessi da AxeptOutput() ,DEVE RIMANERE PRIMA di AxeptOutput()*/
  
			$this->AxeptOutput();  /* attiva i cambiamenti personalizzati dell'array di input ed il relativo stamp */
			$this->InitArr();      /* attiva il loop d'analisi Array se ci sono Array dentro Array */	
		//	$this->ordina();       /* attivare solo in caso AllCheck() vuoto per lo stamp dell'array senza testing */ 
					   } }
}

$item1 = new ClassText($input = array( ""=>"mani","^"=>"piedi","_"=>array("whela"=>"ciao",""=> "^",array("bene"=>"detto")),"quarto"=>"chiappe","10"=>1,1=>"1","£"=>2,array("cosa"=>"dici","//"=>"cara")));
$item2 = new ClassText($input = array("primo"=>"mani","secondo"=>"piedi","terzo"=>"testa","quarto"=>"chiappe","10"=>1,1=>"1","£"=>2));
$item3 = new ClassText($input = array("mani","Secondo"=>"piedi","caioo"=>"testa","quarto"=>"chiappe"));
$item4 = new ClassText($input = "ciao");

$item1->AllChecks();
$item2->AllChecks();
$item3->AllChecks();


