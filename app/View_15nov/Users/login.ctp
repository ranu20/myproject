<?php /*$layout = 'default_login';*/ ?>
<script>

    $(document).ready(function(){
        $('.flashMessage').html('')
        //$('div.form, div.index, div.view').css({'border-left':'none'});
        //$('#UserLoginForm').css({'width':'50%'});
        //$('#content').css({'overflow':'hidden', 'scroll':'none'});
	
    });

   function validate_form () {

        if ($.trim ( $('#UserUsername').val()) =='' ) {
            $('#flashMessage').html('Please enter valid user name').show();			
            $('#UserUsername').focus();
            return false;
        }

        if ( $.trim ( $('#UserPassword').val()) == '' ) {            
            $('#flashMessage').html('Please enter password').show();            
            $('#UserPassword').focus();
            return false;
        }
        return true;
    }
</script>

  


	<div id='loginbox'>		

		<div id='login_form' style='height:250px'>


			<?php echo $this->Form->create('Attribute', array('onSubmit'=>'return validate_form()')); ?>	

				<div style="display:none;">
				<input type="hidden" value="POST" name="_method">
				</div>				
				<div style="color:#006fbc; font-size: 19px;">
					<div id="flashMessage" class="message" style='height:25px'> <?php echo $this->Session->flash(); ?> </div>
				</div>			   
				
				<div class='input_text'> 
					<label class='login_label'>Username</label>
					<input id="UserUsername" type="text" maxlength="50" name="data[User][username]">
				</div>
			
				<div class='input_text'>
					<label class='login_label'>Password</label>
					<input id="UserPassword" type="password" name="data[User][password]">
				</div>        
			
					<div>
						
						<div class='login_submit'>
							<input type="submit" value="Login" id='login_submit'>
						</div>

						<!-- <div id='forgotpassword_container' style='margin:0px 75px 0px 0px'>
							<a href='forgotpassword' class='forgot_password'> Forgot Password  </a>  
						</div> -->

						
						
				</div>
			</form>	
		</div>
		<div id='kutta_holder' style='height:325px; margin-top:50px' align='center'>
			<img alt="" src="/petgurudev/img/kutta.png">
		</div>
	</div>


    
    
    
    
    

