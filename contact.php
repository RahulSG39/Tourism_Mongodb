<!DOCTYPE html>
<html lang="en">
<head>
<title>Contact</title>

<style>
    input{
        border: none;
        height: 40px;
        width: 40%;
        padding: 5px;
        margin-bottom: 5px;
    }
    textarea{
        border: none;
        width: 40%;
        padding: 5px;
    }
    form{
        width: 60%;
        margin: auto;
        display:flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    button{
        border: none;
    }
</style>

</head>
  <?php include('INCLUDES/header.php') ?>
  <link rel="stylesheet" href="CSS/style.css" />
<body>
	<div style="color:white;padding:50px;">
          <h2 style=" text-align: center;">CONTACT</h2>
    </div>

<!--contents---->


<div style="display:block;
    background:#000;
    background:rgba(0, 0, 0, 0.4);
    color:#FFF;
    padding:20px 5px;
    text-align:center;">
    <strong>
    <br>
    <h3>Any Queries?</h3><br>
    <form style="text-align:center;">
      Name &nbsp<input type="text" style="border-radius:5px; background-color:teal; color:white;"><br><br>
      Email &nbsp<input type="text" style="border-radius:5px; background-color:teal; color:white;"><br>
      <br>
      Comments &nbsp<textarea style="border-radius:5px; background-color:teal; color:white;"></textarea><br><br>
      <button style="border-radius:5px; background-color:teal; color:white; width:100px;">SUBMIT</button>
    </form>
   <br><br>
   <p><strong>Or Feel Free to Call us at +91 999 888 7777</strong></p>
   <br>
    </strong>
   </div>

  </body>
</html>