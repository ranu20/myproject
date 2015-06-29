<?php /*$layout = 'default_login';*/ ?>
<script>

    $(document).ready(function(){
        $('.error_message').html('')
        //$('div.form, div.index, div.view').css({'border-left':'none'});
        //$('#UserLoginForm').css({'width':'50%'});
        //$('#content').css({'overflow':'hidden', 'scroll':'none'});
    });

    function form_validate() {

        if ($.trim ( $('#UserEmail').val()) =='' ) {
            $('#error_message').html('Please Enter Valid email').show();
            $('#UserEmail').focus();
            return false;
        }
        
        return true;
    }
</script>

    <?php echo $this->Session->flash('auth'); ?>
    
    <div id='loginbox'>
        <form id="UserLoginForm" accept-charset="utf-8" method="post" onsubmit="return form_validate()" action="/petgurustage/users/forgotpassword" class='login_form'>
            <div style="display:none;">
                <input type="hidden" value="POST" name="_method">
            </div>
	    <div style='color:red; font-weight:bold'> <?php echo $this->Session->flash(); ?> </div>
            
            <div id='error_message' style='color: #72AFD9; font-size: 19px; margin-bottom: 0px;height: 10px'> &nbsp;
                
            </div>
                
            <div class='input_text'> 
                <label class='login_label'>Enter Email</label>
                <input id="UserEmail" type="text" maxlength="50" name="data[User][email]">
            </div>

	    <div style='padding:0; margin: 0'>                
                <div class='submit' style='mar'>
                    <input type="submit" value="Submit" id='login_submit'>
                </div>
            </div>

        </form>
	 <!-- <div id='kutta_holder' style='position:relative; height:250px'>
			<div style='margin:50px 0px 0px 120px '> 			
				<img alt="" src="/petgurustage/img/kutta.png" style='position: relative;left:-35px;'>
			</div>
        </div> -->
    </div>
    
    
    

