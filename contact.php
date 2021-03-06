<?php
session_start();
require_once('contact_files/includes/recaptchalib.php');
?>

<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <?php require_once('inti/headerc.php'); ?>
  </head>

<body>
	<div class="row">	
	<div class="col s12">
		<div class="row">
			<div class="col s12">
			  <div class="card blue-grey darken-1">
			  <div class="card-content white-text">
				<div class="card-content">
				  <h3>Contact Us</h3>
								<?php

								// To check the origin of the POST data based on token and date and time of form submit
								$token = sha1(uniqid(rand(), true));
								$_SESSION['token'] = $token;

								$date = date("D M d, Y G:i");
								$_SESSION['dateandtime'] = $date;

								$userIp = $_SERVER['REMOTE_ADDR'];

								?>
      
								<form id="contact_form" name="contact_form" class="form-contact" action="" onSubmit="return false;">
									<div class="control-group">
										<input type="text" id="inputName" name="inputName" placeholder="Name" class="input-block-level" dir="auto" maxlength="100">
									</div>
									<div class="control-group">
										<input type="text" id="inputEmail" name="inputEmail" placeholder="Email *" class="input-block-level" maxlength="100">

									</div>
									<div class="control-group">
										<input type="text" id="inputSubject" name="inputSubject" placeholder="Subject" class="input-block-level" dir="auto" maxlength="100">
									</div>
									<div class="control-group">
										  <textarea class="input-block-level" rows="9" name="inputMessage" placeholder="Message *" style="max-width: 100%;" dir="auto"></textarea>

									</div>
									<div class="control-group">
									  
										  <div id="recaptcha_widget" class="form-captcha" style="display:none">
										<div id="recaptcha_image" style="max-width:210px;"></div>
										<div class="recaptcha_only_if_incorrect_sol" style="color:red">Incorrect please try again</div>
										 
										<input type="text" id="recaptcha_response_field" name="recaptcha_response_field" class="input-block-level" placeholder="Enter the words / numbers" />
										<br/>
										<span><a href="javascript:Recaptcha.reload()"><i class="icon-refresh"></i></a></span>
										<span class="recaptcha_only_if_image"><a href="javascript:Recaptcha.switch_type('audio')"><i class="icon-volume-up"></i></a></span>
										<span class="recaptcha_only_if_audio"><a href="javascript:Recaptcha.switch_type('image')"><i class="icon-eye-open"></i></a></span>
										<span><a href="javascript:Recaptcha.showhelp()"><i class="icon-question-sign"></i></a></span>
										<span style="font-size: 10px; padding-left: 25%;">powered by <a href="http://www.google.com/recaptcha" target="_blank">reCAPTCHA</a></span>
										  </div>
										 
										  <script type="text/javascript"
										 src="http://www.google.com/recaptcha/api/challenge?k=6Leqf-USAAAAALwY8sVy5KXdX0AsQ4IwxIi7G8Bh">
										  </script>
										  <noscript>
										<iframe src="http://www.google.com/recaptcha/api/noscript?k=6Leqf-USAAAAALwY8sVy5KXdX0AsQ4IwxIi7G8Bh"
											 height="300" width="500" frameborder="0"></iframe><br>
										<textarea name="recaptcha_challenge_field" rows="3" cols="40">
										</textarea>
										<input type="hidden" name="recaptcha_response_field"
											 value="manual_challenge">
										  </noscript>
										  
									</div>
									<input type="hidden" name="token1" value="<?php echo $token; ?>" />
									<input type="hidden" name="token2" value="<?php echo $date; ?>" />
									<input type="hidden" name="token3" value="<?php echo $userIp; ?>" />
									<input class="btn btn-primary" type="submit" name="submit" id="submitBtn" disabled="disabled" value="Send" />
									<img src="contact_files/img/ajax-loader.gif" alt="ajax loader icon" class="ajaxLoader" /><br/><br/>
									<div id="resultMessage" style="display: none;"></div>
									<div style="font-size: 10px;">Designed by <a href="http://www.facebook.com/candra.gannes" target="_blank">Candra Zuckerberg</a></div>
								</form>
				</div>
			  </div>
			</div>

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script src="contact_files/js/bootstrap-button.js"></script>
    <script src="contact_files/js/jquery.validate.min.js"></script>
    <script src="contact_files/js/jquery.validate.extended.js"></script>

    <script type="text/javascript">
	  $(document).ready(function(){
			
                        // disable submit button in case of disabled javascript browsers
                        $(function(){
                          $('#submitBtn').attr('disabled', false);
                        });
            
			$("#contact_form").validate({
				rules:{
					inputEmail:{
                                            required: true,
                                            email: true
						},
                                        inputMessage:{
                                            required: true
                                        },
					recaptcha_response_field:{
					  required: true
					}
				},
                                highlight: function(element) {
                                  $(element).closest('.control-group').removeClass('success').addClass('error');},
                                success: function(element) {
                                  $(element).closest('.control-group').removeClass('error').addClass('success');
                                  $(element).closest('.control-group').find('label').remove();
                                },
                                errorClass: "help-inline"
			});
                        
                        $("#contact_form").submit(function()
                                                  {
                                                    if ($("#contact_form").valid())
                                                    {

                                                      // Disable button while processing
                                                      $('#submitBtn').attr('disabled', true);

                                                      // show ajax loader icon
                                                      $('.ajaxLoader').fadeIn("fast");

                                                      var dataString = $("#contact_form").serialize();

                                                    $.ajax({
                                                      type: "POST",
                                                      url: "contactProcess.php",
                                                      data: dataString,
                                                      success: function(dataString) {
                                                            $("#resultMessage").html(dataString).fadeIn("slow");

                                                          // If is successful, reset the form
                                                          if (dataString == "<div class='alert alert-success'>Your message has been sent. </div>")
                                                              $('#contact_form')[0].reset();

                                                          // hide ajax loader icon
                                                          $('.ajaxLoader').fadeOut("fast");

                                                          // Enable button after processing
                                                          $('#submitBtn').attr('disabled', false);

                                                          setTimeout(function() {
                                                              $("#resultMessage").fadeOut("slow")
                                                          }, 5000);

                                                          // Reload the captcha code after each submit
                                                          Recaptcha.reload();

                                                        }
                                                      });
                                                      
                                                    }

                                                      return false;

                                                  });

		});
	  </script>
                        </div><!--/span-->
                    </div><!-- content -->
                </div>
            </div><!--/row-->

			
            <?php require_once('inti/footer.php'); ?> 
			
        </div><!--/.fluid-container-->
        <script type='text/javascript' src='./js/bootstrap.min.js'></script>
			
</body></html>