<?php


class HomepageCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    public function _after(AcceptanceTester $I)
    {
    }

   public function tryToTestHomepage(AcceptanceTester $I)
   {
        $I->amOnPage("/");
        $I->see("O Seznamu");
        $I->see("přihlášení do Emailu");
    }

    public function tryToTestSearchTabs(AcceptanceTester $I)
    {
        $I->verifySearchTab('li.search__tab.search__tab--fulltext', "Mrakoplas", "Wikipedie");
        $I->verifySearchTab('li.search__tab.search__tab--firmy', "koloniál", "Přidat svou firmu");
        $I->verifySearchTab('li.search__tab.search__tab--mapy', "Mikulov", "Batůžek");
        $I->verifySearchTab('li.search__tab.search__tab--zbozi', "koloběžka", "Cyklistika");
        $I->verifySearchTab('li.search__tab.search__tab--obrazky', "slon", "Všechny velikosti");
        $I->verifySearchTab('li.search__tab.search__tab--slovnik', "borůvka", "Moje slovíčka");
        $I->verifySearchJizdniRad('li.search__tab.search__tab--jizdni-rady', "Třeboň","Slavonice", "Předchozí spojení");
        $I->verifySearchTab('li.search__tab.search__tab--video', "hobby", "Podle shody");
    } 

      public function tryToTestMainLinks(AcceptanceTester $I)
      {
        $I->verifyLink('//a[contains(@href, \'https://www.seznamzpravy.cz/\')]',"Audiovizuální mediální služby");
        $I->verifyLink('//a[contains(@href, \'https://www.novinky.cz/\')]',"redakce@novinky.cz");
        $I->verifyLink('//a[contains(@href, \'https://www.super.cz/\')]',"redakce@super.cz");
        $I->verifyLink('//a[contains(@href, \'https://www.sport.cz/\')]',"serveru Sport.cz jsou určeny");
        $I->verifyLink('//a[contains(@href, \'https://www.stream.cz/\')]',"napady@firma.stream.cz");
        $I->verifyLink('//a[contains(@href, \'https://www.prozeny.cz/\')]',"Sledujte Proženy na sociálních sítích");
        $I->verifyLink('//a[contains(@href, \'//pocasi.seznam.cz/\')]',"Co říkáte na počasí.cz");
        $I->verifyLink('//a[contains(@href, \'https://tv.seznam.cz/\')]',"Sloupcový");
    }

    public function tryToTestLoginFormExpander(AcceptanceTester $I)
    {
        $I->amOnPage("/");
        $I->click('span.expander__button-in'); //Zobrazit přihlášení do emailu
        $I->wait(1);
        $I->see("Skrýt přihlášení");//Skrýt přihlášení
        $I->dontSee("Zobrazit přihlášení"); 
        $I->see("Přejít do Emailu");
        $I->click('div.expander.expander--line-top'); 
        $I->wait(1);
        $I->see("Zobrazit přihlášení");
        $I->dontSee("Skrýt přihlášení");
    }

    public function tryToTestFillingLoginForm(AcceptanceTester $I)
    {
        $I->amOnPage("/");
        $I->click('span.expander__button-in'); //Zobrazit přihlášení do emailu
        $I->wait(1);
        $I->SeeDots('input.input.input--on-left.input-w-button__input.login-form__input',"type"); 
        $I->dontSeeDots('input.input.input--on-left.login-form__input.login-form__input--username', 'type');
        $I->fillField('username','jmeno.prijmeni');
        $I->fillField('password','veslo');
        $I->seeInField('username','jmeno.prijmeni');
        $I->seeInField('password', 'veslo');
        $I->pressKey('input.input.input--on-left.login-form__input.login-form__input--username', array('ctrl', 'a'), \Facebook\WebDriver\WebDriverKeys::DELETE);
        $I->dontseeInField('username','jmeno.prijmeni');
        $I->pressKey('input.input.input--on-left.input-w-button__input.login-form__input', array('ctrl', 'a'), \Facebook\WebDriver\WebDriverKeys::DELETE);
        $I->dontSeeInField('password','jmeno.prijmeni');
        $I->click('div.expander.expander--line-top'); 
    }

    public function tryToTestFancyCheckbox(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->click('span.expander__button-in'); //Zobrazit přihlášení do emailu
        $I->SeeCheckboxIsChecked('remember');
        $I->click('span.fancy-checkbox__text');
        $I->dontSeeCheckboxIsChecked('remember');
        $I->click('span.fancy-checkbox__text');
        $I->SeeCheckboxIsChecked('remember');
        $I->click('span.fancy-checkbox__text');
        $I->dontSeeCheckboxIsChecked('remember');
        $I->click('div.expander.expander--line-top'); 
    }

    public function tryToTestLogin(AcceptanceTester $I)
    {
        $usernameOK='c94aki76dp2';
        $passOK='bg1A3zV-o0';
        $wrongPass='veslo';
        $wrongName="n";
        $textOK="Doručené";
        $textNotOK="Chybně zadané";
        $I->amOnPage('/');
        $I->verifyLogin($usernameOK, $wrongPass, $textNotOK);
        $I->verifyLogin($wrongName, $passOK, $textNotOK);
        $I->verifyLogin("", $passOK, $textNotOK);
        $I->verifyLogin($wrongName, "", $textNotOK);
        $I->verifyLink('//a[contains(@href, \'https://registrace.seznam.cz/?hp\')]',"Registrace");
        $I->moveBack(1);
        $I->verifyLogin($usernameOK, $passOK, $textOK);
    }    
      
    
    
/*  this element has disappeared
    public function closePromoSeznam(AcceptanceTester $I){
    $I->amOnPage('/');
    $text=($I->grabTextFrom('div.seznam-promo.animated-height'));
    $I->See($text);
    $I->click("Zavřít",'div.gadget__controls');
    $I->wait(2);
    $I->dontSee($text);
 }*/

}