<?php 
  $I = new AcceptanceTester($scenario);
	$I->wantTo('try multi session'); 
 	$I->amOnPage('/login.php');
  	$I->seeCurrentUrlEquals('/WeAll/login.php');

function test_message($I)
{
     // logging in
     $I->amOnPage('/login.php');
     $I->fillField('name', 'Test2');
     $I->fillField('pass', '1234');
     $I->click('enter');
     $I->see('Exit Chat');
	$I->seeCurrentUrlEquals('/WeAll/index.php');
	// simple link
	$I->click('exit');
// button of form
	$I->click('Submit');
	$I->see('Please login First');

	
}
// in test:
test_message($I);

?>