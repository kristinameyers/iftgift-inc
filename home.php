<script>
$(document).ready(function(){

$('.tlt2').textillate({
   in: {
	   effect: 'bounceInLeft',
	   initialDelay: 20000,
	   delayScale: 1.5,
       shuffle: false,
       sync: true
   },
   
   loop: false
});
});

$(document).ready(function(){

$('.tlt4').textillate({
   in: {
	   effect: 'bounceInLeft',
	   initialDelay: 2000000,
	   delayScale: 1.5,
       shuffle: false,
       sync: true
   },
   
   loop: false
});
});

$(document).ready(function(){

$('.tlt5').textillate({
   in: {
	   effect: 'fadeIn',
	   initialDelay: 1000000,
	   delayScale: 1.5,
       shuffle: false,
       sync: true
   },
   
   out: {
	   effect: 'fadeOutUp',
	   delayScale: 1.5,
   	   shuffle: true,
       sync: false
   },
   
   loop: true
});
});
</script>
<script type="text/javascript">
function video_ipad()
{
	$("#video_ipad").show();
	$("#ipad").hide();
	$("#video_img").hide();
	$("#player").play();
}
</script>
<div class="banner_bar">
		<div class="banner_bar_inner">
			<div class="banner_data">
				<h3>Suggest six gifts<span></span><br /> 
				you think they'd love...</h3>
				<h4 class="tlt2">So it's more PERSONAL than a gift card,</h4>
				<h3 class="tran_csh">...while you actually <span>send cash</span><br/> 
				to spend anyway they'd like.</h3>
				<h4 class="tlt4"><li>So it's more VERSATILE than any gift!</h4>
			</div>
			<div class="video">
				<div id="video_ipad" style="display:none">
					<iframe id="player" type="text/html" src="http://www.youtube.com/embed/VS47gCb7NpQ?rel=0" frameborder="0"></iframe>
				</div>
				<img src="<?php echo ru_resource; ?>images/dummy_video.png" id="ipad" alt="Dummy Video Image" />
				<div class="video_icon">
					<img src="<?php echo ru_resource; ?>images/play_icon.jpg" onclick="video_ipad()" id="video_img" alt="Video Play Icon" />
				</div>
			</div>
		</div>
	</div>
	<div class="banner_btm">
		<div class="banner_btm_inner">
			<h5>All you need is their name, email and a few fun minutes.</h5>
			<div class="banner_btm_sub">
				<a href="<?php echo ru; ?>register">New? Get started</a>
				<a href="<?php echo ru; ?>login" class="singin">Returning? Sign in</a>
			</div>
		</div>
	</div>
	<div class="mid_contant">
		<h2>It's <span>personal shopper</span> meets <span>gift card</span> meets <span>bank/e-wallet.</span></h2>
		<div class="personal_shopper">
			<a href="#"><img src="<?php echo ru_resource; ?>images/img_a.jpg" alt="Personal Shopping Image" /></a>
			<a href="#"><img src="<?php echo ru_resource; ?>images/img_b.jpg" alt="Gift Cards Image" /></a>
			<a href="#"><img src="<?php echo ru_resource; ?>images/img_c.jpg" alt="Visa Cards Image" /></a>
		</div>
		<h1>What is <span class="i">i</span><span class="f">f</span><span class="t">t</span>?</h1>
		<p class="what_ift">We all know what a gift is. But what's the meaning of '<span class="i">i</span><span class="f">f</span><span class="t">t</span>'? <br/> '<span class="i">i</span><span class="f">f</span><span class="t">t</span>' has many, many meanings</p>
		<div class="box">
			<div class="num_outer">
				<div class="one">1</div>
				<a href="#"><img src="<?php echo ru_resource; ?>images/sound_icon.jpg" alt="Sound Icon" /></a>
				<a href="#" class="play"><img src="<?php echo ru_resource; ?>images/play_icon_b.jpg" alt="Sound Play Icon" /> <span>PLAY ALL</span></a>
			</div>
			<div class="box_data">
				<h3>Internet <span>Fund</span> <span class="nd">Transfer</span></h3>
				<p>The only gift we actually deliver is cash over the Internet. Not in an envelope, not in a 'gotta-use-it-here / did-I-lose-there? / what-is-my-remaining-balance?' gift card. Just simple, spendable, accepted-everywhere cash. The funds are deposited into the recipient's iftGift Cash^Stash, where they can be used to make purchases or linked to a bank account, credit/debit card and/or e-wallet.</p>
			</div>
			<img src="<?php echo ru_resource; ?>images/icon_a.jpg" alt="Internet Fund Transfer Icon" class="icon" />
			<div class="box_btm"></div>
		</div>
		<div class="box box_b">
			<div class="num_outer">
				<a href="#"><img src="<?php echo ru_resource; ?>images/sound_icon.jpg" alt="Sound Icon" /></a>
				<div class="one">2</div>
			</div>
			<img src="<?php echo ru_resource; ?>images/icon_b.jpg" alt="Immediate, Fun, Thoughtful Icon" class="icon two" />
			<div class="box_data">
				<h3>Immediate, <span>Fun,</span> <span class="nd">Thoughtful</span></h3>
				<p>It takes less than three minutes to custom-make an iftGift. You can add your warmest personal wishes or wittiest wisecracks. Send your iftGift immediately or schedule future delivery. They'll receive a fun, emailed presentation of a half-dozen, thoughtful gift ideas you propose. Propose, not impose; you impose nothing with an iftGift because your suggestions come with cash. And,  as we like to say here at iftGift, CASH stands for: Can Always Satisfy Him/Herself.</p>
			</div>
			<div class="box_btm"></div>
		</div>
		<div class="box box_c">
			<div class="num_outer">
				<div class="one">3</div>
				<a href="#"><img src="<?php echo ru_resource; ?>images/sound_icon.jpg" alt="Sound Icon" /></a>
			</div>
			<img src="<?php echo ru_resource; ?>images/icon_c.jpg" alt="Individual Friends' Thinking Icon" class="icon" />
			<div class="box_data">
				<h3>Individual <span>Friends'</span> <span class="nd">Thinking</span></h3>
				<p>We all ask peoples' opinions. Well, with the help of his Q&A's, the iftGift s'Jester does too. The answers provided by you, your intended recipient and their entire iftClique network of family and friends are fed to our s'Jester. By correlating all that input he can instantly recommend perfect gift ideas to send along with your cash - suggestions that are sure to be appropriate and appreciated. He may tell you that others have already suggested the same gift idea. He can know if the item is already owned - and even tell you how much it is 'loved'. Or, if you like, you can control the easy iftGifting process all by yourself.</p>
			</div>
			<div class="box_btm"></div>
		</div>
		<div class="box box_b">
			<div class="num_outer">
				<a href="#"><img src="<?php echo ru_resource; ?>images/sound_icon.jpg" alt="Sound Icon" /></a>
				<div class="one">4</div>
			</div>
			<img src="<?php echo ru_resource; ?>images/icon_d.jpg" alt="Infinite Fantasies True Icon" class="icon" />
			<div class="box_data">
				<h3>Infinite <span>Fantasies </span> <span class="nd">True</span></h3>
				<p>An iftGift can do anything. Do they love a gift you suggested? Click, they buy it. Do they feel like splurging? Easy, our shopping affiliates offer just about anything. Want to save? That's smart, let the cash accumulate. Need to pay a personal bill? No problem; they can easily transfer from their iftGift Cash^Stash to their credit/debit card, bank account or e-wallet. And, while there may be a nominal fee when you SEND, iftGift is free of fees when you SPEND.</p>
			</div>
			<div class="box_btm"></div>
		</div>
		<div class="box box_c">
			<div class="num_outer">
				<div class="one">5</div>
				<a href="#"><img src="<?php echo ru_resource; ?>images/sound_icon.jpg" alt="Sound Icon" /></a>
			</div>
			<img src="<?php echo ru_resource; ?>images/icon_e.jpg" alt="Immense Footprint Terminated Icon" class="icon" />
			<div class="box_data">
				<h3>Immense <span>Footprint </span> <span class="nd">Terminated</span></h3>
				<p>Talk about big foot. The 10 billion or so gift cards used each year could extend 23 times back and forth to the moon. Unfortunately, they don't stay there. Instead, they leave noxious toxins leaching into our landfills or their incineration releases thousands of tons of air pollution. After that, those cards need to be replaced, of course. Making and distributing every single replacement card creates about 2 ounces of air pollution - yet each card itself weighs only 1/8 of an ounce! But you can breath easy because an iftGift is virtually carbon-free; even our s'Jester is pixels, not pencils.</p>
				<a href="#">http://blog.kiind.me/environmental-impact-gift-cards/</a>
			</div>
			<div class="box_btm"></div>
		</div>
		<div class="box box_b">
			<div class="num_outer">
				<a href="#"><img src="<?php echo ru_resource; ?>images/sound_icon.jpg" alt="Sound Icon" /></a>
				<div class="one">6</div>
			</div>
			<img src="<?php echo ru_resource; ?>images/icon_f.jpg" alt="Improve Future Times Icon" class="icon" />
			<div class="box_data">
				<h3>Improve  <span>Future </span> <span class="nd">Times</span></h3>
				<p>iftGift saves - not just interpersonal resources, not just financial resources, but the earth's treasured resources as well. And not just by supplanting gift cards. iftGift abolishes gift wrap, which Earth911.com estimates to be 8 billion pounds of waste a year. Also, almost 9% of all retail merchandise sales get returned annually. Does that seem minor? It equals almost $265 billion, more than the GDP - total of all goods and services produced - within 80% of the world's countries. Fortunately, when the whole world uses iftGift, there'll be a whole lot less wasted...</p>
				<a href="#">http://www.foxbusiness.com/personal-finance/2013/12/19/how-to-combat-hidden-cost-holidays/</a>
				<a href="#">https://www.theretailequation.com/retailers/IndustryReports</a>
			</div>
		</div>
		<div class="cloud_bar">
			<img src="<?php echo ru_resource; ?>images/clouds_bg.jpg" alt="Sound Icon" />
			<div class="cloud_bar_inner">
				<div id="myCanvasContainer">
					<canvas width="250" height="250" id="myCanvas">
						<p>will be replaced by something else</p>
					</canvas>
				</div>
				<div id="tags">
					<ul>
						<li><a style="font-size: 16pt">manufacturing</a></li>
						<li><a style="font-size: 16pt">packaging</a></li>
						<li><a style="font-size: 16pt">shipping</a></li>
						<li><a style="font-size: 13pt">distributing</a></li>
						<li><a style="font-size: 13pt">trucking</a></li>
						<li><a style="font-size: 4pt">unloading</a></li>
						<li><a style="font-size: 16pt">unpacking</a></li>
						<li><a style="font-size: 4pt">stocking</a></li>
						<li><a style="font-size: 13pt">inventorying</a></li>
						<li><a style="font-size: 4pt">displaying</a></li>
						<li><a style="font-size: 4pt">promoting</a></li>
						<li><a style="font-size: 16pt">driving</a></li>
						<li><a style="font-size: 13pt">searching</a></li>
						<li><a style="font-size: 13pt">parking</a></li>
						<li><a style="font-size: 16pt">shopping</a></li>
						<li><a style="font-size: 12pt">walking</a></li>
						<li><a style="font-size: 4pt">finding</a></li>
						<li><a style="font-size: 16pt">selecting</a></li>
						<li><a style="font-size: 12pt">considering</a></li>
						<li><a style="font-size: 4pt">debating</a></li>
						<li><a style="font-size: 4pt">deciding</a></li>
						<li><a style="font-size: 4pt">evaluating</a></li>
						<li><a style="font-size: 12pt">compromising</a></li>
						<li><a style="font-size: 12pt">worrying</a></li>
						<li><a style="font-size: 16pt">reconsidering</a></li>
						<li><a style="font-size: 4pt">refining</a></li>
						<li><a style="font-size: 4pt">haggling</a></li>
						<li><a style="font-size: 4pt">charging</a></li>
						<li><a style="font-size: 4pt">paying</a></li>
						<li><a style="font-size: 4pt">posting</a></li>
						<li><a style="font-size: 16pt">wrapping</a></li>
						<li><a style="font-size: 12pt">ribboning</a></li>
						<li><a style="font-size: 16pt">stamping</a></li>
						<li><a style="font-size: 12pt">packing</a></li>
						<li><a style="font-size: 4pt">taking</a></li>
						<li><a style="font-size: 12pt">carrying</a></li>
						<li><a style="font-size: 12pt">queuing</a></li>
						<li><a style="font-size: 16pt">mailing</a></li>
						<li><a style="font-size: 16pt">delivering</a></li>
						<li><a style="font-size: 16pt">ripping</a></li>
						<li><a style="font-size: 12pt">opening</a></li>
						<li><a style="font-size: 12pt">disposing</a></li>
						<li><a style="font-size: 12pt">faking</a></li>
						<li><a style="font-size: 12pt">breaking</a></li>
						<li><a style="font-size: 12pt">cluttering</a></li>
						<li><a style="font-size: 4pt">regretting</a></li>
						<li><a style="font-size: 16pt">returning</a></li>
						<li><a style="font-size: 12pt">refunding</a></li>
						<li><a style="font-size: 4pt">restocking</a></li>
						<li><a style="font-size: 4pt">discounting</a></li>
						<li><a style="font-size: 12pt">reselling</a></li>
						<li><a style="font-size: 4pt">remaindering</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>