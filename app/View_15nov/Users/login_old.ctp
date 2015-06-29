<?php /*$layout = 'default_login';*/ ?>
<script>

    $(document).ready(function(){
        $('.error_message').html('')
        //$('div.form, div.index, div.view').css({'border-left':'none'});
        //$('#UserLoginForm').css({'width':'50%'});
        //$('#content').css({'overflow':'hidden', 'scroll':'none'});
    });

    function form_validate() {

        if ($.trim ( $('#UserUsername').val()) =='' ) {
            $('#error_message').html('Please Enter Valid user name').show();
            $('#UserUsername').focus();
            return false;
        }

        if ( $.trim ( $('#UserPassword').val()) == '' ) {            
            $('#error_message').html('Please Enter Password').show();            
            $('#UserPassword').focus();
            return false;
        }
        return true;
    }
</script>

    <?php echo $this->Session->flash('auth'); ?>

    <div align='center' style='margin: auto;'> 
	<div id='loginbox'>
		<form id="UserLoginForm" accept-charset="utf-8" method="post" onsubmit="return form_validate()" action="/petgurudev/users/login" class='login_form'>

		    <div style="display:none;">
			<input type="hidden" value="POST" name="_method">
		    </div>
		    
				<div style='color:red'> <?php echo $this->Session->flash(); ?> </div>
		    
		    <div id='error_message' style='color: #72AFD9; font-size: 19px; margin-bottom: 0px;height: 10px'> &nbsp;
			
		    </div>
			
		    <div class='input_text'> 
			<label class='login_label'>Username</label>
			<input id="UserUsername" type="text" maxlength="50" name="data[User][username]">
		    </div>
	    
		    <div class='input_text'>
			<label class='login_label'>Password</label>
			<input id="UserPassword" type="password" name="data[User][password]">
		    </div>        
	    
				<div style='padding:0; margin: 0'>
					<!-- <a href='forgotpassword' class='forgot_password'> Forgot Password  </a> -->
			<div class='submit' style='float:right'>
			    <input type="submit" value="Login" id='login_submit'>
			</div>
		    </div>
		</form>
		<div id='kutta_holder' style='position:relative; height:250px'>
				<div style='margin:50px 0px 0px 145px '> 			
					<img alt="" src="/petgurudev/img/kutta.png" style='position: relative;left:-35px;'>
				</div>
		</div>
	</div>
	</div>
    
    
    
    
    

