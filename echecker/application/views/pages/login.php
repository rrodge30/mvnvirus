
<div class="text login-header">

        <h5 class="log-head">ExaminationHUB</h5>
    </div>
<div class="card card-nav-tabs log-form" style="width:470px;height:280px;margin:0 auto;display:flex;margin-top:13%;">
	<div class="card-header" data-background-color="purple" style="margin-top:0px;padding-bottom: 22px;">
		<div class="nav-tabs-navigation">
			<div class="nav-tabs-wrapper">
				<span class="nav-tabs-title"><h4 style="text-align:center !important;">Login to your account</h4></span>
                <span class="nav-tabs-title">
                    <div class="validation-summary-errors hidden">
                        <h4 style="text-align:center;">Invalid Credential</h4> 
                    </div>
                </span>
				<ul class="nav nav-tabs" data-tabs="tabs">
					
				</ul>
			</div>
		</div>
	</div>

	<div class="card-content">
		<div class="tab-content">
        <form id="loginform" class="m-x-auto text-center app-login-form" role="form" method="POST" action="login/authenticateLogin" onsubmit="return false;">
            
            <div class="col-md-12" style="padding:5px;padding-top: 9px;">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons mail" style="padding:0;">person</i>
                    </span>
                    <input type="text" class="form-control eml" placeholder="Enter Username" id="login-username" name="username" required="required">
                </div>
            </div>
            <div class="col-md-12">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons lock" style="padding:0;">lock_outline</i>
                    </span>
                    <input type="password" class="form-control pass" id="login-password" name="password" placeholder="Enter Password" required="required">
                </div>
            </div>

            <div class="row">

                <div class="m-b-lg">
                    <div class="col-xs-6">
                        
                    </div>
                    <div class="col-xs-6">
                        <button class="btn btn-block btn-info-outline btn-login btn1" type="submit">LOGIN</button>
                    </div>
                    
                    <div class="text-center pad-top-20 got" style="padding-bottom:1px;">
                            
                    </div>
                </div>
            </div>
         </form>
		</div>
	</div>

 </div><!-- end card -->


   
  
   
   
   
   
   
   
   