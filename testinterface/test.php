<?php
include dirname(__DIR__, 1)."/backend/backendapi/backendapi.php";
$backendapi = new BackendAPI(0);

$test_uName = "JohnDoe";
$test_pWord = "123cow";

function resetTestUser(){
  $test_uName = "JohnDoe";
  $test_pWord = "123cow";
  $backendapi = new BackendAPI(0);
  $result = $backendapi->databaseapi->checkUsername($test_uName);
  if (!$result->isError() && $result->getResult()==true){
    $backendapi->databaseapi->removeUser($test_uName);
  }

}

// UT1.1
//Test plan: 1. Create Test User 2. Retrieve Test User's password 3. verify its hash
//Test Data
resetTestUser();
$result = $backendapi->newAccount($test_uName, $test_pWord);
$result_ut_1_1 = "fail";

if (!$result->isError()){
  $ut_1_1_pwresult = $backendapi->databaseapi->getUserPassword($test_uName);
  if (!$ut_1_1_pwresult->isError()){
    if (password_verify($test_pWord, $ut_1_1_pwresult->getResult())){
      $result_ut_1_1 = "pass";
    }
  }
}

// UT1.2
//Test plan: 1. Create Test User 2. Login to Test User
resetTestUser();

$result = $backendapi->newAccount($test_uName, $test_pWord);
$result_ut_1_2 = "fail";

if (!$result->isError()){
  $ut_1_2_loginresult = $backendapi->login($test_uName, $test_pWord);
  if (!$ut_1_2_loginresult->isError() && ($ut_1_2_loginresult->getResult())==true){
    $result_ut_1_2 = "pass";
  }
}

// UT1.3
//Test plan: 1. Create Test User 2. Attempt login with invalid password
resetTestUser();

$result = $backendapi->newAccount($test_uName, "wrongpassword");
$result_ut_1_3 = "fail";
if (!$result->isError()){
  $ut_1_3_loginresult = $backendapi->login($test_uName, $test_pWord);
  if ($ut_1_3_loginresult->getResult()==false){
    $result_ut_1_3 = "pass";
  }
}

// UT2.0
//Test plan: 1. Remove any previous test users 2. create new test user
resetTestUser();
$result = $backendapi->newAccount($test_uName, "wrongpassword");
$result_ut_2_0 = "fail";
if (!$result->isError() && $result->getResult() == true){
  $result_ut_2_0 = "pass";
}

// UT3.1

// UT3.2
resetTestUser();
?>

<table>
  <tr>
    <th>Unit Test</th>
    <th>Description</th>
    <th>Results</th>
  </tr>
  <tr>
    <td>UT1.1</td>
    <td>Tests password hashing</td>
    <td><?= $result_ut_1_1 ?></td>
  </tr>
  <tr>
    <td>UT1.2</td>
    <td>Insures that login is functioning</td>
    <td><?= $result_ut_1_2 ?></td>
  </tr>
  <tr>
    <td>UT1.3</td>
    <td>Tests inappropriate password/username combinations</td>
    <td><?= $result_ut_1_3 ?></td>
  </tr>
  <tr>
    <td>UT2</td>
    <td>Tests new account creation</td>
    <td><?= $result_ut_2_0 ?></td>
  </tr>
  <tr>
    <td>UT3.1</td>
    <td>Tests project creation</td>
    <td id="ut3.1result">not yet finished</td>
  </tr>
  <tr>
    <td>UT3.2</td>
    <td>Tests new account updating</td>
    <td id="ut3.2result">not yet finished</td>
  </tr>
</table>
