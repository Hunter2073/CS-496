<?php
  include dirname(__DIR__, 1)."/backend/backendapi/backendapi.php";
  $backendapi = new BackendAPI(0);
// UT1.1
//Test plan: 1. Create Test User 2. Retrieve Test User's password 3. verify its hash
  //Test Data
  $test_uName = "JohnDoe";
  $test_pWord = "123cow";

  if ($backendapi->databaseapi->checkUsername($test_uName)){
    $backendapi->databaseapi->removeUser($test_uName);
  }

  $result = $backendapi->newAccount($test_uName, $test_pWord);
  $result_ut_1_1 = "fail";
  if (is_bool($result)){
    $ut_1_1_pwresult = $backendapi->databaseapi->getUserPassword($test_uName);
    if (is_string($ut_1_1_pwresult)){
      if (password_verify($test_pWord, $ut_1_1_pwresult)){
        $result_ut_1_1 = "pass";
      }
    }
  }

// UT1.2
//Test plan: 1. Create Test User 2. Login to Test User
if ($backendapi->databaseapi->checkUsername($test_uName)){
  $backendapi->databaseapi->removeUser($test_uName);
}

$result = $backendapi->newAccount($test_uName, $test_pWord);
$result_ut_1_2 = "fail";
if (is_bool($result)){
  $ut_1_2_loginresult = $backendapi->login($test_uName, $test_pWord);
  if (is_bool($ut_1_2_loginresult) && $ut_1_2_loginresult==true){
    $result_ut_1_2 = "pass";
  }
}

// UT1.3
//Test plan: 1. Create Test User 2. Attempt login with invalid password
if ($backendapi->databaseapi->checkUsername($test_uName)){
  $backendapi->databaseapi->removeUser($test_uName);
}

$result = $backendapi->newAccount($test_uName, "wrongpassword");
$result_ut_1_3 = "fail";
if (is_bool($result)){
  $ut_1_3_loginresult = $backendapi->login($test_uName, $test_pWord);
  if (strcmp(get_class($ut_1_3_loginresult), "ErrorThrow")==0){
    $result_ut_1_3 = "pass";
  }
}

// UT2.0
//Test plan: 1. Remove any previous test users 2. create new test user
if ($backendapi->databaseapi->checkUsername($test_uName)){
  $backendapi->databaseapi->removeUser($test_uName);
}

$result = $backendapi->newAccount($test_uName, "wrongpassword");
$result_ut_2_0 = "fail";
if (is_bool($result) && $result == true){
  $result_ut_2_0 = "pass";
}

// UT3.1

// UT3.2

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
