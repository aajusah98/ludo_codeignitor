
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>LudoBattles</title>

<style type="text/css">
  @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap');
  .clickBtn {
    width: 95%;
    height: 46px;
    text-align: center;
    padding: 23px 10px 3px;
    background: #113742;
    color: #fff;
    display: table;
    border-radius: 6px;
    -webkit-transition: .4s linear;
    -moz-transition: .4s linear;
    -ms-transition: .4s linear;
    transition: .4s linear;
    cursor: pointer;
    font: 500 32px/22px Montserrat;
    margin: 30px auto 0;
    margin-bottom: 0%;
    vertical-align: middle;
    text-decoration: none;
  }
</style>

</head>

<body>
<table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left" valign="top">
      <div>
        <div style="background-color: #113741;height: 13px;" >
        </div>
      </div>
    </td>
  </tr>

  <tr>
    <td align="left" valign="top">
      <div>
        <div style="background-color: #fff;height: 100px; text-align: center;" >
          <img src="<?php echo base_url(); ?>assets/images/logo.svg" width="280" style="border:1px solid white; background-color: white;padding: 10px 10px 10px 10px">
        </div>
      </div>
    </td>
  </tr>

  <tr>
    <td align="left" valign="top">
      <div>
        <div style="background-color: #C5001A;height: 30px;" >
        </div>
      </div>
    </td>
  </tr>

  <tr>
    <td align="center" valign="top" bgcolor="white" style="background-color:#white; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000; padding:10px;">
      <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
        <tr>
          <td align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:18px; color:#000000;">
            <div style="font-family: Montserrat, 'Times New Roman', Times, serif; font-size:56px; color:#000000;">Reset Password
            </div>
            <div style="font-size: 23px;"><br>
              Hi <?php echo $name;?>,<br>
            </div>
            <br>
            <div style="font-size: 18px;">
                          Forgot your password? Let's get you a new one.
            </div>
            <br>
            <div>
               <a class="clickBtn" href="<?php echo base_url();?>welcome/changePassword/<?php echo base64_encode($email);?>" target="_blank">Reset</a><br>
            </div>
                        <h4>Important: This link is valid for a one time use within 10 days. This is an auto-generated email. Please
do not reply to this.</h4>
                        <p>Didn't request this action? Kindly contact us at support@InternMart.com.</p>

            <div>
              Regards,<br>
              Internmart Team<br>
              Follow Us:<br>
              Facebook | Twitter | Youtube<br>
            </div>
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td align="left" valign="top" bgcolor="#113741" style="background-color:#113741;"><table width="100%" border="0" cellspacing="0" cellpadding="15">
      <tr>
        <td align="left" valign="top" style="color:#ffffff; font-family:Arial, Helvetica, sans-serif; font-size:13px;">Note : This is an auto-generated email.Please do <b><i>NOT</i></b> reply to this.</td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>