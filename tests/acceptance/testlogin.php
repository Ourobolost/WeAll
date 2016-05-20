<?php 
  $I = new AcceptanceTester($scenario);
  $I->wantTo('ensure that frontpage works');
  $I->amOnPage('/WeAll/login.php');
  $I->seeCurrentUrlEquals('/WeAll/login.php');
function test_login($I)
{
     // logging in
     $I->amOnPage('/WeAll/login.php');
     $I->fillField('name', 'Test2');
     $I->fillField('pass', '1234');
     $I->click('enter');
     $I->see('Exit Chat');
  $I->seeCurrentUrlEquals('/WeAll/index.php');
}
// in test:
test_login($I);
