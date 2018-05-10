<?php
use \Codeception\Util\Locator;


/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method \Codeception\Lib\Friend haveFriend($name, $actorClass = NULL)
 *
 * @SuppressWarnings(PHPMD)
*/
class AcceptanceTester extends \Codeception\Actor
{
    use _generated\AcceptanceTesterActions;

   /**
    * Define custom actions here
    */
    
    public function verifyLink($link,$text){
        $this->amOnPage('/');
        $this->dontSee($text);
        $this->click($link);
        $this->wait(5);
        $this->see($text);
        //$this->moveBack(1); -not necessary
    }

    public function verifySearchTab($tab,$textToFill,$textToVerify){
        $this->amOnPage('/');
        $this->click($tab);
        $this->fillField('q',$textToFill);
        $this->seeInField('q', $textToFill);
        $this->click("Vyhledat");
        $this->wait(5);
        $this->see($textToVerify);
        }
    
        public function verifySearchJizdniRad($tab,$odkud,$kam,$textToVerify){  //jízdní řád
            
            $this->amOnPage('/');
            $this->click($tab);
            $this->fillField('q',$odkud);
            $this->fillField('input.search-form__input.input.input--hp-search.search-form__mhd-input-to', $kam);
            $this->click("Vyhledat");
            $this->waitForElement('div.routes',10);
            $this->see($textToVerify);
        }

        //dots instead of letters in password
    public function seeDots($selektor, $attribute){
        $this->grabAttributeFrom($selektor, $attribute)==='password';
    }

    //letters, not dots, in username
    public function dontSeeDots($selektor, $attribute){
        $this->grabAttributeFrom($selektor, $attribute)!='password';
    }

        public function verifyLogin($username, $password, $textToVerify){
        $this->amOnPage('/');
        $this->click('span.expander__button-in'); //Zobrazit přihlášení do emailu
        $this->wait(2);
        $this->fillField('username',$username);
        $this->fillField('password',$password);
        $this->click('button.button.button--submit.button--with-input.input-w-button__button');//Přejít do e-mailu
        $this->wait(2);
        $this->see($textToVerify);
        $this->moveback(1);
        $this->click('div.expander.expander--line-top');
    }
}
 