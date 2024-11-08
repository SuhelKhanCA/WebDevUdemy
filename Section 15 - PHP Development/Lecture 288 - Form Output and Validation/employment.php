<!doctype html>
<html>
<head>
    <title>PHP Form</title>
    <meta charset="utf-8">
    <style>
        .error {
            color: red;
        }
    </style>
</head>
<body>
<?php

  $name = $website = $position = $experience = $estatus = $comments = "";

  if($_SERVER["REQUEST_METHOD"] == "POST"){
    $has_error = false;
    
    if(empty($_POST["name"])){
        echo "<span class=\"error\">Error: First name Required </span><br>";
        $has_error = true;
    } elseif(!preg_match("/^[a-zA-Z]*$/", $_POST["name"])){
        echo "<span class=\"error\">Error: First name should contain only letters ! </span><br>";
        $has_error = true;
    }
    
    if(empty($_POST["website"])){
        echo "<span class=\"error\">Error: Website name Required </span><br>";
        $has_error = true;
    } elseif(!preg_match(
        "/\b(?:https?:\/\/)?(?:www\.)?[a-zA-Z0-9-]+\.[a-zA-Z]{2,6}\b/",
        $_POST["website"]
    )){
        echo "<span class=\"error\">Error: Website name is not in the correct format ! </span><br>";
        $has_error = true;
    }
    
    if (!$has_error) {
        $name = val($_POST["name"]);
        $website = val($_POST["website"]);
        $position = val($_POST["position"]);
        $experience = val($_POST["experience"]);
        $estatus = val($_POST["estatus"]);
        $comments = val($_POST["comments"]);
    }
  }

  function val($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

?>
<form name="employment" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post"> 
 <table width="600" border="0" cellspacing="1" cellpadding="1">
    <tr>
      <td><h2>Employment Application</h2></td>
      <td></td>
    </tr>
    <tr>
      <td>Name</td>
      <td><input type="text" name="name" maxlength="50" /></td>
    </tr>
    <tr>
      <td>Website</td>
      <td><input type="text" name="website" maxlength="50" /></td>
    </tr>
    <tr>
      <td>Position</td>
      <td>
        <select name="position">
          <option value="Accountant">Accountant</option>
          <option value="Receptionist">Receptionist</option>
          <option value="Administrator">Administrator</option>
          <option value="Supervisor">Supervisor</option>
        </select>
      </td>
    </tr>
    <tr>
      <td>Experience Level</td>
      <td>
        <select name="experience">
          <option value="Entry Level">Entry Level</option>
          <option value="Some Experience">Some Experience</option>
          <option value="Very Experienced">Very Experienced</option>
        </select>
      </td>
    </tr>
    <tr>
      <td>Employment Status</td>
      <td>
        <input type="radio" name="estatus" value="Employed" checked />Employed
        <input type="radio" name="estatus" value="Unemployed" />Unemployed
        <input type="radio" name="estatus" value="Student" />Student
      </td>
    </tr>
    <tr>
      <td>Additional Comments</td>
      <td>
        <textarea name="comments" cols="45" rows="5"></textarea>
      </td>
    </tr>
    <tr>
      <td></td>
      <td>
        <input type="submit" name="submit" value="Submit" />
        <input type="reset" name="reset" value="Reset" />
      </td>
    </tr>
  </table>
</form>

<?php
  if($_SERVER["REQUEST_METHOD"] == "POST" && !$has_error) {
    echo "<h2>User Data</h2>";
    echo "Name: " . htmlspecialchars($name) . "<br />";
    echo "Website: " . htmlspecialchars($website) . "<br />";
    echo "Position: " . htmlspecialchars($position) . "<br />";
    echo "Experience: " . htmlspecialchars($experience) . "<br />";
    echo "Employment Status: " . htmlspecialchars($estatus) . "<br />";
    echo "Comments: " . htmlspecialchars($comments) . "<br />";
  }
?>
</body>
</html>
