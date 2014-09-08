<html>
    <head>
        <meta http-equiv='content-type' content="text/html: charset='utf-8'"/>
        <title> Thêm Người dùng</title>
    </head>
    <body>
        <div>
            <?php if(isset($success)) {                
                echo '<p class="info">' . $success . '</p>';
            }
            ?>
        </div>
        <form method="post" action="<?php echo base_url('admin/user/add');?>">
            <fieldset">
                <legend>Thêm Người dùng</legend>
                <table class="table" border="0">
                    <tr>
                        <td size="125px"> User name :</td>
                        <td > <input type='text' name="user_name" class="form-control"/></td>
                    </tr>
                    <tr>
                        <td  width="125px"> Full name :</td>
                        <td > <input type='text' name="full_name" class="form-control"/></td>
                    </tr>
                    <tr>
                        <td  size="125px"> Password :</td>
                        <td > <input type='password' name="pass" class="form-control"/></td>
                    </tr>
                    <tr>
                        <td  size="125px"> Email :</td>
                        <td > <input type='text' name="user_email" class="form-control"/></td>
                    </tr>
                    <tr>
                        <td  size="125px"> Address :</td>
                        <td > <input type='text' name="user_address" class="form-control"/></td>
                    </tr>
                    <tr>
                        <td  size="125px"> Phone :</td>
                        <td > <input type='text' name="user_phone" class="form-control"/></td>
                    </tr>
                    <tr>
                        <td  size="125px"> Level :</td>
                        <td > <input type='text' name="user_level" class="form-control"/></td>
                    </tr>
                    <tr>
                        <td  size="125px"> Gender:</td>
                        <td > <input type='radio' name="user_gender" value="1" checked/> Name 
                              <input type='radio' name="user_gender" value="0"/> Nữ </td>
                    </tr>
                    <tr>
                        <td colspan="2" align='center'> <input type="submit" name="submit" value="ADD" /> </td>
                    </tr>
                </table>
            </fieldset>
        </form>
    </body>
</html>