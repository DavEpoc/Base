<?php

interface IFormCheck {

	public function checkname();
	public function checkLastname();
	public function checkEmail();
	public function checkYear();
	public function checkAll();
	public function setErrorMsgs($errs);
}

abstract class AFormCheck implements IFormCheck {


	public $name;
	public $lastname;
	public $email;
	public $year;
	public $errorMsgs = array(
			'name' =>  'Il nome deve essere composto da caratteri alfanumerici e deve contenere dai 4 ai 10 caratteri al massimo',
			'lastname' =>'Il cognome deve essere composto da caratteri alfanumerici e deve contenere dai 4 ai 15 caratteri al massimo',
			'email' =>'L email deve essere composta nella seguente forma : "mailname@mailserver.mailext"',
			'year' =>'L anno di nascita deve essere superiore al 1900'
				 );

	private $err = '';        //errori immagazinati
	public $clean = array();  //info immagazzinate


	public function __construct() {
		$this->name = $_POST['name'];
		$this->lastname = $_POST['lastname'];
		$this->email = $_POST['email'];
		$this->year = $_POST['year'];
				     }
 // metodi di tracking/erroring

	protected function trackErrorMsg($field){
				if($this->errorMsgs[$field]) {
					$this->err .= "<p>" . $this->errorMsgs[$field] . "</p>";
				}
				else {
					$this->internalError();
				}


						}
	protected function getErrorMsg() {
				if($this->err != '') {
				echo "<h4>Errore!</h4>";
				echo $this->err;
				return false;
				}
				else{
				echo "<h4>Ok!</h4>";
				echo "<p> Tutti i campi del form sono stati inviati correttamente.</p>";
				return true;
				}}
        protected function internalError() {
                trigger_error('Non esiste un errore di questo tipo.', E_USER_WARNING);}


}





class FormCheck extends AFormCheck {
         
        // metodi di checking
        public function checkName() {
                if(is_string($this->name) && ctype_alnum($this->name) && (strlen($this->name) <= 10) && (strlen($this->name) >= 4)) {
                        echo "<p>Il nome è stato inviato correttamente.</p>";
                        $this->clean['name'] = htmlentities($this->name, ENT_QUOTES);
                }
                else {
                        $this->trackErrorMsg('name');
                }
        }
         
        public function checkLastname() {
                if(is_string($this->lastname) && ctype_alnum($this->lastname) && (strlen($this->lastname) <= 15) && (strlen($this->lastname) >= 4)) {
                        echo "<p>Il cognome è stato inviato correttamente.</p>";
                        $this->clean['lastname'] = htmlentities($this->lastname, ENT_QUOTES);
                }
                else {
                        $this->trackErrorMsg('lastname');
                }
        }
         
        public function checkEMail() {
                if(is_string($this->email) && eregi('^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+.[a-zA-Z.]{2,5}$', $this->email)) {
                        echo "<p>L'e-mail è stata inviata correttamente.</p>";
                        $this->clean['email'] = $this->email;
                }
                else {
                        $this->trackErrorMsg('email');
                }
        }
         
        public function checkYear() {
                if((intval($this->year) >= 1900)) {
                        echo "<p>L'anno di nascita è stato inviato correttamente.</p>";
                        $this->clean['year'] = (int)$this->year;
                }
                else {
                        $this->trackErrorMsg('year');
                }
        }

public function checkAll() {
                $this->checkName();
                $this->checkLastname();
                $this->checkEMail();
                $this->checkYear();
                return $this->getErrorMsg();
        }
         
        // altro
        public function setErrorMsgs($errs) {
                foreach($errs as $err => $txt) {
                        $this->errorMsgs[$err] = $txt;
                }
        }
 
}

$form = new FormCheck();
 
if(!$form->checkAll()) { 
        exit();
}
else {
        echo "<p><strong>Nome:</strong>" . $form->clean['name'] . "</p>";
        echo "<p><strong>Cognome:</strong>" . $form->clean['lastname'] . "</p>";
        echo "<p><strong>Mail:</strong>" . $form->clean['email'] . "</p>";
        echo "<p><strong>Year:</strong>" . $form->clean['year'] . "</p>";
}

// aggiungo il campo password! senza cambiare nulla di quello gi fatto!!

class MoreFormCheck extends FormCheck {
 
    public $pw;
    public $pw2;
     
    // costruttore
    public function __construct() {
        parent::__construct();
         
        $this->pw1 = $_POST['pw1'];
        $this->pw2 = $_POST['pw2'];
         
        $this->setErrorMsgs(array('pw' => 'La password non è corretta.'));
    }
     
    // metodi di checking
    public function checkPw() {
        if($this->pw1 === $this->name && $this->pw2 === $this->name) {
            echo "<p>La password è stata inviata correttamente.</p>";
            $this->clean['pw'] = $this->pw;
        }
        else {
            $this->trackErrorMsg('pw');
        }
    }

// ...
 
public function checkAll() {
                $this->checkName();
                $this->checkLastname();
                $this->checkEMail();
                $this->checkYear();
                $this->checkPw();
                return $this->getErrorMsg();
        }
 
}

$form = new MoreFormCheck();
 
if(!$form->checkAll()) { 
        exit();
}
else {
        echo "<p><strong>Nome:</strong>" . $form->clean['name'] . "</p>";
        echo "<p><strong>Cognome:</strong>" . $form->clean['lastname'] . "</p>";
        echo "<p><strong>Mail:</strong>" . $form->clean['email'] . "</p>";
        echo "<p><strong>Year:</strong>" . $form->clean['year'] . "</p>";
        echo "<p><strong>Password:</strong>" . $form->clean['pw'] . "</p>";
}
