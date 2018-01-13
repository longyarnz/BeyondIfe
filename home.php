<?php 

	require_once("controlla/views_db.php");
	// var_dump($_SERVER['REMOTE_ADDR']);
	// require_once("autoload.php");
	// console::log($select_tables->result, true, 'tables.log');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta lang="en">
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="Beyondife was born out of the need to change the Nigerian narrative of education.
		We are young innovative people with a singular desire to equip the Nigerian youth with professional skills and insight into entrepreneurship and global opportunities">
		<meta name="keywords" content="beyondife, beyondife7, beyondife8, beyond, ife, oauife, career-training, ife seminar, beyondife_8, beyondife_z">
		<meta property="og:title" content="BeyondIfe">
		<meta property="og:type" content="website">
		<meta property="og:url" content="http://beyondife.org">
		<meta property="og:description" content="Beyondife was born out of the need to change the Nigerian narrative of education.
		We are young innovative people with a singular desire to equip the Nigerian youth with professional skills and insight into entrepreneurship and global opportunities">
		<meta property="og:site_name" content="BeyondIfe">
		<link href="favicon.ico" rel="icon" type="image/x-icon">
		<link rel="stylesheet" type="text/css" href="css/font-awesome.css">
		<link rel="stylesheet" type="text/css" href="css/main.css">
		<title>#BeyondIfe</title>
	</head>
	<body>

		<header title="Click Here to Open Navigation Menu">
			<h4>
				<i class="fa fa-bars"></i>
				<span></span><span>Navigation</span> Menu<span></span>
			</h4>
		</header>

		<nav>
			<ul>
				<li>
					<a class="" data-nav="start" data-about="#BeyondIfe">
						<span>*</span>Start Page
					</a>
				</li>
				<li>
					<a class="dim" data-nav="nav-video" data-about="#Videos">
						<span>*</span>Videos
					</a>
				</li>
				<li>
					<a class="dim" data-nav="nav-article" data-about="#Articles">
						<span>*</span>Articles
					</a>
				</li>
				<li>
					<a class="dim twitter" data-nav="nav-handle" data-about="#Twitter">
						<span>*</span>Tweets
					</a>
				</li>
				<li>
					<a class="dim" data-nav="nav-profile" data-about="#Speakers">
						<span>*</span>Speakers
					</a>
				</li>
				<li>
					<a class="dim" data-nav="nav-team" data-about="#Team">
						<span>*</span>BI_Team
					</a>
				</li>
				<li>
					<a class="dim" data-nav="nav-patron" data-about="#Patrons">
						<span>*</span>Patrons
					</a>
				</li>
				<li>
					<a class="dim" data-nav="nav-social" data-about="#Social Media">
						<span>*</span>Social Media
					</a>
				</li>
				<li>
					<a class="dim" data-nav="nav-faqs" data-about="#FAQS">
						<span>*</span>FAQs
					</a>
				</li>
				<li>
					<a class="dim about-us" data-nav="nav-about" data-about="#AboutUs">
						<span>*</span>About Us
					</a>
				</li>
				<li>
					<a class="dim" data-nav="nav-contact" data-about="#ContactUs">
						<span>*</span>Contact Us
					</a>
				</li>
				<?php
					$nominate = false;
					foreach ($select_tables->result['remote_ip']['Ip'] as $key => $value) {
						if($value == $_SERVER['REMOTE_ADDR']) {$nominate = true; break; }
						else $nominate = false;
					}
					if($nominate == false) {
				?>
					<li>
						<a class="dim" data-nav="nav-nom" data-about="#Nominations">
							<span>*</span>Nominations
						</a>
					</li>
				<?php } ?>
			</ul>
		</nav>

		<section class="section-top">
			<div class="block-overlay">
				<div class="count-down">
					<span class="count-down"><art></art> <br> <small>DAYS</small></span>
					<span class="count-down"><art></art> <br> <small>HRS</small></span>
					<span class="count-down"><art></art> <br> <small>MINS</small></span>
					<span class="count-down"><art></art> <br> <small>SECS</small></span><br>
					<span>BEYONDIFE 9: NOV 25, 2017</span>
				</div>
				<?php
					$nominate = false;
					foreach ($select_tables->result['remote_ip']['Ip'] as $key => $value) {
						if($value == $_SERVER['REMOTE_ADDR']) {$nominate = true; break; }
						else $nominate = false;
					}
					if($nominate == false) {
				?>
					<a class="dim" data-nav="nav-nom" data-about="#Nominations">
						Make A Nomination For BI_9
					</a>
				<?php } ?>				
				<div class="block-side-panel block-side-panel-left">
					<div class="chevron chevron-left twitch">
						<a class="link-left twitch">
							<i class="fa fa-angle-down twitch"></i>
						</a>
					</div>
				</div>

				<div class="block-side-panel block-side-panel-right">
					<div class="chevron chevron-right twitch">
						<a class="link-right twitch">
							<i class="fa fa-angle-up twitch"></i>	
						</a>					
					</div>
				</div>

				<div class="block block-backdrop-footer">
					<span>
						<a href="http://www.facebook.com/beyondife8" target="_blank">
							<i class="fa fa-facebook"></i>
							<span>beyondife</span>
						</a>
					</span>
					<span>
						<a href="http://www.twitter.com/beyondife" target="_blank">
							<i class="fa fa-twitter"></i>
							<span>#beyondife</span>
						</a>
					</span>
					<span>
						<a href="https://www.instagram.com/p/BLF6GOrjwei/" target="_blank">
							<i class="fa fa-instagram"></i>
							<span>@beyond_ife</span>
						</a>
					</span>
				</div>
			</div>

			<?php
				$nav_item = array("article", "patron", "profile", "start", "team", "video");
				$int = -1;
				foreach ($select_tables->result as $table_key => $table_value) {
					if ($table_key == 'remote_ip') continue;
					$int++;
					if ($table_key == 'start_pictures') {
						$num = count($table_value['Tag']);
						for ($i=1; $i <= $num; $i++) { ?>
							<div class="block-content poster <?php if($i !== 1){echo " no-display";} ?>" <?php echo " data-id='$i'"; if($i == 1){echo " data-nav='$nav_item[$int]'";} ?>>
								<div class="block block-backdrop">
									<img src="uploads/<?php echo $table_value['Picture_xl_file'][$i - 1]; ?>" class="img-lg">
									<img src="uploads/<?php echo $table_value['Picture_sm_file'][$i - 1]; ?>" class="img-sm">									
								</div>
								<div class="block block-backdrop-1">
									<h1>#<?php echo $table_value['Tag'][$i - 1]." "; ?> @ <br class="hidden-lg hidden-md"> 
										<br class="hidden-lg hidden-md">
										<div><span class="beyond-text">Beyond</span>ife<span class="rotate-text">9</span></div>
									</h1>
								</div>
							</div>
						<?php }
					}
					else { ?>
						<div class="block-content no-display" data-id="a<?php echo $int;?>" data-nav="nav-<?php echo $nav_item[$int]; ?>">
							<div class="block block-backdrop-1 grey-background">
								<?php if ($table_key == 'articles') { ?>
									<h1 class="stories">#BI_STORIES</h1>
									<div class="story-board plain-article">
										<?php for ($i= 0; $i < count($table_value['Title']); $i++) { ?>
											<div class="story-pane click" data-pane="<?php echo $i; ?>">
												<div class="story-card">
													<img src="uploads/<?php echo $table_value['Picture_file'][$i]; ?>">
													<div class="card-footer">
														<h1 class="card-stories">
															<?php echo $table_value['Title'][$i]; ?>
														</h1>
														<p class="stories">
															<?php echo $table_value['Content_area'][$i]; ?>
														</p>
														<a class="stories">Read More Articles...</a>
													</div>
												</div>
											</div>
										<?php } ?>
									</div>
								<?php } 
									elseif ($table_key == "speakers") { ?>
										<h1 class="stories">#SPEAKERS</h1>
										<div class="story-board plain-article">
											<?php for ($i= 0; $i < count($table_value['Name']); $i++) { ?>
												<div class="story-pane click" data-pane="<?php echo $i; ?>">
													<div class="story-card">
														<span class="season">BeyondIfe<?php echo " ".$table_value['Beyondife_event'][$i]; ?></span>
														<img src="uploads/<?php echo $table_value['Picture_xl_file'][$i]; ?>" class="img-lg">
														<img src="uploads/<?php echo $table_value['Picture_sm_file'][$i]; ?>" class="img-sm">														
														<div class="play no-display">
														
														</div>
														<div class="card-footer">
															<h1 class="card-stories">
																<b><?php echo strtoupper($table_value['Name'][$i]); ?></b>
																<span class="play"><i class="fa fa-youtube-play"></i>Watch Talk....</span>
																<ul>
																	<?php
																		foreach ($select_tables->result['videos']['Speaker_name'] as $speaker_key => $speaker_value) {
																			if ($speaker_value == $table_value['Name'][$i]) {
																				echo "<li data-link='".$select_tables->result['videos']['Video_link'][$speaker_key].
																				"'>".$select_tables->result['videos']['Title'][$speaker_key]."</li>";
																			}
																		}
																	?>
																</ul>
															</h1>
															<h5 class="card-stories">
																<?php echo strtoupper($table_value['Job'][$i]); ?><br>
																<?php echo $table_value['Handle'][$i]." "; ?>, <?php echo $table_value['Email'][$i]." "; ?>, @beyondife
																<?php echo " ".$table_value['Beyondife_event'][$i]; ?><br>
																<span class="play"><i class="fa fa-youtube-play"></i>Watch Talk....</span>
															</h5>
															<p class="stories">
																<?php echo $table_value['About_speaker'][$i]; ?>
															</p>
															<a class="stories">Look Up More Speakers...</a>
														</div>
													</div>
												</div>
											<?php } ?>
										</div>
									<?php } 
									elseif ($table_key == 'teams') { ?>
										<h1 class="stories">#Team_Beyondife</h1>
										<div class="story-board plain-article">
											<?php for ($i= 0; $i < count($table_value['Name']); $i++) { ?>
												<div class="story-pane team" data-pane="<?php echo $i; ?>">
													<div class="story-card">
														<img src="uploads/<?php echo $table_value['Picture_file'][$i]; ?>">
														<div class="card-footer">
															<h1 class="card-stories">
																<?php echo $table_value['Name'][$i]; ?>
															</h1>
															<h5 class="card-stories">
																<?php echo $table_value['Dept'][$i]; ?> <br><?php echo $table_value['Email'][$i]; ?><br> <?php echo $table_value['Handle'][$i]; ?>, @beyondife <?php echo $table_value['Beyondife_event'][$i]; ?>
															</h5>
														</div>
													</div>
												</div>
											<?php } ?>
										</div>
									<?php }
									elseif ($table_key == "patrons") { ?>
										<h1 class="stories">#Patrons_Beyondife</h1>
										<div class="story-board plain-article">
											<?php for ($i= 0; $i < count($table_value['Name']); $i++) { ?>
												<div class="story-pane team" data-pane="<?php echo $i; ?>">
													<div class="story-card">
														<img src="uploads/<?php echo $table_value['Picture_file'][$i]; ?>">
														<div class="card-footer">
															<h1 class="card-stories">
																<?php echo $table_value['Name'][$i]; ?>
															</h1>
															<h5 class="card-stories">
																<?php echo $table_value['Department'][$i]; ?><br />
																BeyondIfe Patron
															</h5>
														</div>
													</div>
												</div>
											<?php } ?>
										</div>
									<?php }
									elseif ($table_key == "videos") { ?>
										<h1 class="stories">#Videos_BeyondIfe</h1>
										<div class="story-board plain-article">
											<?php for ($i= 0; $i < count($table_value['Title']); $i++) { ?>
												<div class="story-pane click video" data-pane="<?php echo $i; ?>">
													<div class="story-card">
														<item><?php echo $table_value['Video_link'][$i]; ?></item>
														<span class="season">BeyondIfe <?php echo $table_value['Beyondife_event'][$i]; ?></span>
														<img src="img/1 (11).jpg" class="img-lg">
														<img src="img/1 (11).jpg" class="img-sm">														
														<div class="play-background">
															<i class="fa fa-play-circle-o"></i>
														</div>
														<div class="play"></div>
														<div class="card-footer">
															<h1 class="card-stories">
																<?php echo $table_value['Title'][$i]; ?>
															</h1>
															<h5 class="card-stories">
																Speaker: <?php echo $table_value['Speaker_name'][$i]; ?>
																@beyondife <?php echo $table_value['Beyondife_event'][$i]; ?>
															</h5>
															<a class="stories">Watch More Videos...</a>
														</div>
													</div>
												</div>
											<?php } ?>
										</div>
									<?php }  
								?>												
							</div>
						</div>
					<?php }
				}
			?>

			<div class="block-content no-display" data-id="a6" data-nav="nav-about">
				<div class="block block-backdrop-1">
					<img src="img/3 (015).jpg" class="img-lg">					
					<h1 class="stories">The BeyondIfé Dream</h1>
					<p class="about">
						Beyondife was born out of the need to change the Nigerian narrative
						of education.<br>
						We are young innovative people with a singular
						desire to equip the Nigerian youth with professional skills and
						insight into entrepreneurship and global opportunities.
					</p>
					<p class="about">
						We believe the only way forward is to go beyond:<br>
						<b>Beyond</b> our strengths and our flaws, <br>
						<b>Beyond</b> our reality, <br>
						<b>Beyond</b> the norms of the society, <br>
						<b>Beyond</b> Ife. <br>
						We comprise a Lagos team and an Ife team.<br>
						The <b>Lagos team</b> comprises professionals who handle the
						strategy, finance, corporate branding and external relations. <br>
						The <b>Ife team</b> is a closely knit group of students who ensure that
						logistics, ticket sales and publicity are in place on the Obafemi
						Awolowo University campus.<br>
						Together we bring the Beyond Ife story to life, each year, with a unique twist.
						And from 2008 till date, we have succeeded in grooming youths for market
						place excellence.
					</p>
					<p class="about">
						In fulfilling our dream, we have produced a certified career-training and pre-employment seminar,
						held every academic session on great Ife campus.<br>
						Anchored by a rich mix of accomplished professionals, the training provides real time
						insights into life-after-university and it empowers trainees to make informed
						decisions as they grow in their career paths.
					</p>
					</div>
			</div>

			<div class="block-content no-display" data-id="a7" data-nav="nav-social">
				<div class="block block-backdrop-1">
					<h1 class="stories">
						#BEYOND_IFE						
					</h1>
					<div class="social-icons">
						<span>
							<a href="http://www.facebook.com/beyondife8" target="_blank">
								<i class="fa fa-facebook"></i>
								Join Our Fan Page <br>beyondife8
							</a>
						</span>
						<span>
							<a href="https://www.instagram.com/p/BLF6GOrjwei/" target="_blank">
								<i class="fa fa-instagram"></i>
								Follow Us on Instagram <br>@beyond_ife
							</a>
						</span>
						<span>
							<a href="http://www.twitter.com/beyondife" target="_blank">
								<i class="fa fa-twitter"></i>
								Follow Us on Twitter <br>#beyondife
							</a>
						</span>
					</div>
				</div>
			</div>

			<div class="block-content no-display" data-id="a8" data-nav="nav-handle">
				<div class="block block-backdrop-1">
					<iframe id="twitter-widget-0" scrolling="no" frameborder="0" allowtransparency="true" allowfullscreen="true" class="twitter-timeline twitter-timeline-rendered" style="position: absolute; visibility: hidden; display: block; width: 0px; height: 0px; padding: 0px; border: none;" data-height="600" data-width="1161.1"></iframe><a class="twitter-timeline twitter-timeline-error" data-link-color="#f00" href="https://twitter.com/BeyondIfe" data-height="600" data-width="1161.1" data-twitter-extracted-i1484639845192185126="true">Tweets by BeyondIfe</a> 
				</div>
			</div>

			<div class="block-content no-display" data-id="a9" data-nav="nav-faqs">
				<div class="block block-backdrop-1">
					<h1 class="stories faqs">
						FAQs				
					</h1>
					<div class="faqs-pane">
						<div class="faqs-pane-tab">
							<div class="q-pane">Q: How Do I Register for BeyondIfe Career Training Seminar?</div>
							<div class="a-pane">
								<b>A:</b> You can register by purchasing a ticket from our sales representative <b>(0703 481 6733)</b>, marketers and walk-in hotspots on campus.<br>
								Below is a list of our <b>MARKETERS</b> you can purchase your tickets from:
								<ul>
									<li><a href="tel:07034816733"><i class="fa fa-star"></i> Stephen - 0703 481 6733</a></li>
									<li><a href="tel:08180669759"><i class="fa fa-star"></i> Solomon - 0818 066 9759</a></li>
									<li><a href="tel:09028666201"><i class="fa fa-star"></i> Tobi - 0902 866 6201</a></li>
									<li><a href="tel:08082935102"><i class="fa fa-star"></i> Lekan - 0808 293 5102</a></li>
								</ul>
								Below is a list of our <b>WALK-IN HOTSPOTS</b> you can purchase your tickets from:
								<ul>
									<li><i class="fa fa-star"></i> Forks n Fingers</li>
									<li><i class="fa fa-star"></i> Kay's Chippy</li>
									<li><i class="fa fa-star"></i> Fivers</li>
									<li><i class="fa fa-star"></i> ThrillHouse</li>
								</ul>
							</div>
						</div>
						<div class="faqs-pane-tab">
							<div class="q-pane">Q: How Can I Register My Department for BeyondIfe Career Training Seminar?</div>
							<div class="a-pane">
								<b>A:</b> We love working with Departments and FYB committes. All you have to do is call Stephen 
								<b>(0703 481 6733)</b> and he will let you in on all the juicy stuff :)
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="block-content no-display" data-id="a10" data-nav="nav-contact">
				<div class="block block-backdrop-1 grey-background">
					<h1 class="stories">CONTACT US</h1>
					<div class="contact-form">
						<form role="contact-form" method="post" enctype="multipart/form-data">
							<div>
								<label>Name</label>
								<input type="text" placeholder="Write Your Name" name="input 1" required>
							</div>	
							<div>
								<label>Email</label>
								<input type="email" name="input 2" placeholder="Write Your Email" required>
							</div>
							<div>
								<label>Message</label>
								<textarea rows="7" name="input 3" placeholder="Write Your Message" required></textarea>
							</div>
							<button type="submit" role="button">Submit</button>
						</form>
						<div class="ajax-result no-display">
							<h1 class="ajax-result">Thank you very much <span></span>.<br>
							We appreciate your support.</h1>
							<i class="fa fa-thumbs-up"></i>
						</div>
					</div>
				</div>
			</div>

			<div class="block-content no-display" data-id="a11" data-nav="nav-nom">
				<div class="block block-backdrop-1 grey-background">
					<h1 class="stories">NOMINATIONS</h1>
					<div class="nomination-form">
						<form role="nomination-form" method="post" enctype="multipart/form-data">
							<fieldset>
								<legend><h1 class="levels">Student Leadership</h1></legend>
								<div>
									<label>Name</label>
									<input type="text" placeholder="Enter Nominee's Name" name="input 0" required>
								</div>	
								<div>
									<label>Department</label>
									<input type="text" name="input 1" placeholder="Enter Nominee's Department" required>
								</div>
								<div>
									<label>Level</label>
									<input type="text" placeholder="Enter Nominee's Level" name="input 2" required>
								</div>
								<div>
									<label>Association of Nominee</label>
									<input type="text" placeholder="Enter Nominee's Association/Organization" name="input 3" required>
								</div>	
								<div>
									<label>Reasons for Nomination</label>
									<textarea rows="5" name="input 4" placeholder="Reasons For Nomination" required></textarea>
								</div>
							</fieldset>
							<fieldset>
								<legend><h1 class="levels">Male Entrepreneur</h1></legend>	
								<div>
									<label>Name</label>
									<input type="text" placeholder="Enter Nominee's Name" name="input 5" required>
								</div>	
								<div>
									<label>Department</label>
									<input type="text" name="input 6" placeholder="Enter Nominee's Department" required>
								</div>
								<div>
									<label>Level</label>
									<input type="text" placeholder="Enter Nominee's Level" name="input 7" required>
								</div>
								<div>
									<label>Name of Business Owned</label>
									<input type="text" placeholder="Enter Nominee's Business" name="input 8" required>
								</div>	
								<div>
									<label>Reasons for Nomination</label>
									<textarea rows="5" name="input 9" placeholder="Reasons for Nomination" required></textarea>
								</div>
							</fieldset>
							<fieldset>
								<legend><h1 class="levels">Female Entrepreneur</h1></legend>
								<div>
									<label>Name</label>
									<input type="text" placeholder="Enter Nominee's Name" name="input 10" required>
								</div>	
								<div>
									<label>Department</label>
									<input type="text" name="input 11" placeholder="Enter Nominee's Departmentl" required>
								</div>
								<div>
									<label>Level</label>
									<input type="text" name="input 12" placeholder="Enter Nominee's Level" required>
								</div>
								<div>
									<label>Name of Business Owned</label>
									<input type="text" placeholder="Enter Nominee's Business" name="input 13" required>
								</div>	
								<div>
									<label>Reasons for Nomination</label>
									<textarea rows="5" name="input 14" placeholder="Reasons For Nomination" required></textarea>
								</div>
							</fieldset>
							<fieldset>
								<legend><h1 class="levels">Student-Friendly Organization</h1></legend>
								<div>
									<label>Name</label>
									<input type="text" placeholder="Enter Nominee's Name" name="input 15" required>
								</div>	
								<div>
									<label>What do they do</label>
									<textarea rows="5" name="input 16" placeholder="What Do They Do?" required></textarea>
								</div>
								<div>
									<label>Reasons for Nomination</label>
									<textarea rows="5" name="input 17" placeholder="Reasons For Nomination" required></textarea>>
								</div>
							</fieldset>
							<button type="submit" role="button">Complete Nomination</button>
						</form>
						<div class="nomination-result no-display">
							<h1 class="ajax-result">Thank you very much <span></span>.<br>
							We shall meet at Oduduwa Hall come November 25th.</h1>
							<i class="fa fa-thumbs-up"></i>
						</div>
					</div>
				</div>
			</div>
		</section>

		<script async="" src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
		<script src="js/jquery.js"></script>
		<script src="js/custom.js"></script>
		<script src="js/animate-home.min.js"></script>
		<script src="js/animate-nav.min.js"></script>
	</body>
</html>