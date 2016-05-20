<?php 
  $I = new AcceptanceTester($scenario);
	$I->wantTo('try multi session'); 
 	$I->amOnPage('/login.php');
  	$I->seeCurrentUrlEquals('/WeAll/login.php');

function test_message($I)
{
     // logging in
     $I->amOnPage('/WeAll/login.php');
    // $I->fillField('name', 'Test2');
     //$I->fillField('pass', '1234');
     //$I->click('enter');
     //$I->see('Exit Chat');
	//$I->seeCurrentUrlEquals('/WeAll/index.php');
	$I->fillField('usermsg', 'Hello all!');
    $I->click('submitmsg');
		$I->see('Hello all!');
	
}
// in test:
test_message($I);