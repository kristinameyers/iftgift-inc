<style>
/* overlay styles, all needed */
h3.gift_title{-moz-border-radius:12px 12px 0 0; -webkit-border-radius:12px 12px 0 0; border-radius:12px 12px 0 0}
.overlay{position:fixed; top:0; left:0; height:100%; width:100%; background:url(resource/images/overlay_bg.png); z-index:9999999}
/* just some content with arbitrary styles for explanation purposes */
.modals{width:auto; height:auto; padding:0 0 10px; position:relative; /*position:fixed; top:30%; left:32%;*/ background-color:#fff; /*margin-top:-110px; margin-left:-280px;*/ -moz-border-radius:10px; -webkit-border-radius:10px; border-radius:10px; behavior:url(PIE.htc);z-index:99999999}

.modals img{float:left; margin:0}
.modals a{float:right}
.modals a img{margin:-16px -16px 0 0}
</style>
<div class="mid_contant">
	<h2 class="title">Unwrap: Pending iftGift</h2>
	<div class="cont_bar">
		<div class="modals" id="release_request_div">
			<a style="cursor:pointer" onClick="close_div2();">
				<img src="<?php echo ru_resource; ?>images/close_icon.png" alt="Closed Icon" />
			</a>
			<h3 class="gift_title">iftScore Schedule of Awards</h3>
			<div class="cont_bar_inner cont_bar_inner_b gift_idea">
				<div class="regs_form regs_form_e regs_form_f">
					<div class="ift_schd">
						<h4>Answering iftput Q&A’S </h4>
						<ul class="unwrp_list">
							<li class="title_bar">
								<div class="from">&nbsp;</div>
								<div class="occas">Range</div>
								<div class="notft">Multiple Choice</div>
							</li>
							<li class="record">
								<div class="from">YOU earn for answering about them</div>
								<div class="occas">6</div>
								<div class="notft">8</div>
							</li>
							<li class="record record_bgk">
								<div class="from">THEY earn when you answer</div>
								<div class="occas">4</div>
								<div class="notft">6</div>
							</li>
							<li class="record">
								<div class="from">YOU when answering about yourself</div>
								<div class="occas">10</div>
								<div class="notft">14</div>
							</li>
							<li class="record record_bgk">
								<div class="from">Clicking Reality Check</div>
								<div class="occas">2</div>
								<div class="notft">2</div>
							</li>
							<li class="record">
								<div class="from">Submitting your own question</div>
								<div class="occas">12</div>
								<div class="notft">18</div>
							</li>
							<li class="record record_bgk">
								<div class="from">When your question is published</div>
								<div class="occas">60</div>
								<div class="notft">90</div>
							</li>
							<li class="record">
								<div class="from">For answering Feedback Q&A’s</div>
								<div class="occas">6</div>
								<div class="notft">6</div>
							</li>
							<li class="record record_bgk">
								<div class="from">Feedback essays earn: 10 points</div>
								<div class="occas">&nbsp;</div>
								<div class="notft">&nbsp;</div>
							</li>						
						</ul>
					</div>
					<div class="ift_schd">
						<h4>Personal Reminders</h4>
						<ul class="unwrp_list">
							<li class="title_bar">
								<div class="from">&nbsp;</div>
								<div class="occas">You</div>
								<div class="notft">Them</div>
							</li>
							<li class="record">
								<div class="from">Creating Reminder</div>
								<div class="occas">10</div>
								<div class="notft">2</div>
							</li>
							<li class="record record_bgk">
								<div class="from">Each Notification</div>
								<div class="occas">8</div>
								<div class="notft">1</div>
							</li>					
						</ul>
					</div>
					<div class="ift_schd">
						<h4>Build an iftGift </h4>
						<ul class="unwrp_list">
							<li class="title_bar">
								<div class="from">&nbsp;</div>
								<div class="occas">You</div>
								<div class="notft">Them</div>
							</li>
							<li class="record">
								<div class="from">Select a suggestion</div>
								<div class="occas">10</div>
								<div class="notft">2</div>
							</li>
							<li class="record record_bgk">
								<div class="from">Add item to iftWish List</div>
								<div class="occas">8</div>
								<div class="notft">1</div>
							</li>
							<li class="record">
								<div class="from">Add item to Owned / Hide List</div>
								<div class="occas">6</div>
								<div class="notft">1</div>
							</li>
							<li class="record record_bgk">
								<div class="from">Transfer Funds into Cash Stash</div>
								<div class="occas">1 point per dollar (amounts rounded up)</div>
								<div class="notft">&nbsp;</div>
							</li>						
						</ul>
					</div>
					<div class="ift_schd">
						<h4>Collect an iftGift / Shop iftGift</h4>
						<ul class="unwrp_list">
							<li class="title_bar">
								<div class="from">&nbsp;</div>
								<div class="occas">You</div>
								<div class="notft">Them</div>
							</li>
							<li class="record">
								<div class="from">Release Request</div>
								<div class="occas">10</div>
								<div class="notft">2</div>
							</li>
							<li class="record record_bgk">
								<div class="from">View Suggestion Detail</div>
								<div class="occas">8</div>
								<div class="notft">1</div>
							</li>
							<li class="record">
								<div class="from">Add item to iftWish List</div>
								<div class="occas">6</div>
								<div class="notft">1</div>
							</li>
							<li class="record record_bgk">
								<div class="from">Add item to Owned / Hide List</div>
								<div class="occas">4</div>
								<div class="notft">5</div>
							</li>
							<li class="record">
								<div class="from">Purchase a Suggestion / Item</div>
								<div class="occas">123</div>
								<div class="notft">33</div>
							</li>					
						</ul>
					</div>
				</div>
				<img src="<?php echo ru_resource;?>images/jester_as.jpg" alt="Jester Image" class="reg_jst_a reg_jst_e" />
			</div>	
		</div>
	</div>
</div>
<div class="overlay"></div>